<?php


namespace Kaban\Components\Admin\Media\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kaban\Components\Admin\Media\Resources\GetAllMediaResource;
use Kaban\Components\Site\Reviews\Requests\ReviewMediaUploadRequest;
use Kaban\General\Services\Media\MediaService;
use Kaban\Models\Media;

class MediaController {

    protected $mediaService;

    /**
     * create new controller instance
     *
     * ReviewsController constructor.
     *
     * @param MediaService $mediaService
     */
    public function __construct( MediaService $mediaService ) {
        $this->mediaService = $mediaService;
    }

    public function getAll() {

        return $this->all();
    }

    public function all( $postType, $postID ) {
        $model = 'Kaban\\Models\\' . $postType;
        $media = $model::find( $postID )->media()
                       ->paginate( 50 );

        return GetAllMediaResource::collection( $media );
    }

    public function upload( Request $request ) {
        $model = 'Kaban\\Models\\' . $request->postType;
        $post  = $model::find( $request->postID );

        try {
            $auth = Auth::user();

//            $review = $auth->reviews()->findOrFail( $request->input( 'id' ) );
//
//            $reviewable = $review->reviewable;

            $mediaFile = MediaService::fromUploadedFile( $request->file( 'file' ) );

            $this->mediaService->getUploader()->setConfigKey( 'review' );
            if ( $this->mediaService->upload( $mediaFile ) ) {
                $oldMedia = null;
                $data     = [
                    'approved_at' => Carbon::now(),
                    'name'        => 'mehdi'
                ];

                if ( $oldMedia ) {
                    $data = array_merge( $data, [
                        'old_id' => $oldMedia->id,
                    ] );
                }

                $pivotData = [
                    'category_id' => $post->category_id,
                ];
                $media     = $this->mediaService->createMedia( $mediaFile, $data );

                $this->mediaService->attachMedia( $media, $post, 'posts', [] );

//                $this->mediaService->attachMedia( $media, $review, null, [], $pivotData );

//                if ( $oldMedia && ! $oldMedia->is_approved ) {
//                    $this->mediaService->removeMedia( $oldMedia );
//                }
            } else {
                throw new Exception( "Cannot upload media" );
            }


            return response()->json( [
                'success' => true,
                'all'     => $this->all( $request->postType, $request->postID ),
                'media'   => [
                    'id'          => $media->id,
                    'url'         => $media->url,
                    'category'    => $request->input( 'category' ),
                    'is_approved' => false,
                    'description' => $request->input( 'description' ),
                    'category_id' => $request->input( 'category' ),

                ],
                'message' => trans( 'site.reviews.media.media_uploaded_successfully' ),
            ] );

        } catch ( Exception $e ) {
            return response()->json( [
                'status'  => false,
                'message' => $e->getMessage(),
            ], 400 );
        }
    }

    public function destroy( Request $request ) {
        $oldMedia = Media::findOrFail( $request->id );
        $this->mediaService->removeMedia( $oldMedia );

        return response()->json( [
            'success' => true,
            'all'     => $this->all( $request->postType, $request->postID ),
            'message' => trans( 'site.media.media.media_removed_successfully' ),
        ] );

        return 'done';
    }
}
