<?php


namespace Kaban\Components\Admin\Posts\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Kaban\Components\Admin\Posts\Resources\GetAllPostsResource;
use Kaban\Components\Admin\Posts\Resources\GetPostEditItemResource;
use Kaban\Components\Admin\Posts\Resources\GetPostTagsResource;
use Kaban\Components\Admin\Posts\Resources\GetSearchedPostsResource;
use Kaban\Core\Controllers\AdminBaseController;
use Kaban\General\Enums\EMediaType;
use Kaban\General\Enums\EPostStatus;
use Kaban\General\Enums\ETagType;
use Kaban\General\Services\Media\MediaService;
use Kaban\Models\Post;
use Kaban\Models\Tag;

class PostsController extends AdminBaseController {
    private $mediaService;

    public function __construct( MediaService $mediaService ) {
        $this->mediaService = $mediaService;
    }

    public function edit( $id ) {
        $post = Post::with( 'tags', 'media' )->findOrFail( $id );

        return new GetPostEditItemResource( $post );
    }

    public function search() {
        $post = Post::with( 'media' )->paginate( 10 );

        return GetSearchedPostsResource::collection( $post );
    }

    public function searchTags( Request $request ) {
        $tags = Tag::when( $request->val, function ( $q ) use ( $request ) {
            $q->where( 'name', 'like', "%$request->val%" );
//        } )->where( 'type', ETagType::post )->take( 10 )->get()->map->only( 'id', 'name' );
        } )->where( 'type', ETagType::post )->paginate( 10 );

        return GetPostTagsResource::collection( $tags );
        $post = Post::with( 'media' )->paginate( 10 );

        return GetSearchedPostsResource::collection( $post );
    }

    public function all( Request $request ) {
        $sortType = 'DESC';
        $sortBy   = 'id';

        if ( ! empty( $request->sortBy[0] ) && in_array( $request->sortBy[0], [ 'id', 'title' ] ) ) {
            $sortBy = $request->sortBy[0];
        }
        if ( empty( $request->sortDesc[0] ) ) {
            $sortType = 'ASC';
        }

        $posts = Post::when( $request->search, function ( $q ) use ( $request ) {
            $q->where( 'title', 'like', "%$request->search%" );
        } )->orderBy( $sortBy, $sortType )->paginate( $request->itemsPerPage, [ '*' ], 'ascasc', $request->page );

        return GetAllPostsResource::collection( $posts );
//        return new GetAllPostsResource( $posts );
    }

    public function store( Request $request ) {
        $uid  = auth()->id();
        $form = json_decode( $request->form );

        $post = Post::create( [
            'content'     => $form->content,
            'title'       => $form->title,
            'excerpt'     => $form->excerpt,
            'category_id' => $form->categories,
            'author_id'   => $uid,
            'created_by'  => $uid,
            'updated_by'  => $uid,
            'status'      => EPostStatus::approved,
            'slug'        => slugify( $form->title )
        ] );
        $this->updateMedia( $request, $post );

        $tagIds = $post->syncTags( $form->tags );

        $post->tag_ids = $tagIds;
        $post->save();
    }

    public function update( Request $request ) {
        $uid  = auth()->id();
        $form = json_decode( $request->form );
        $post = Post::find( $form->id );


        $this->updateMedia( $request, $post );

        $post->update( [
            'content'     => $form->content,
            'title'       => $form->title,
            'excerpt'     => $form->excerpt,
            'category_id' => $form->categories,
            'author_id'   => $uid,
            'created_by'  => $uid,
            'updated_by'  => $uid,
            'status'      => $form->status->value,
            'slug'        => slugify( $form->title )
        ] );
        $tagIds = $post->syncTags( $form->tags );

        $post->tag_ids = $tagIds;
        $post->save();

    }

    public function destroy( $id ) {
        $status = Post::findOrFail( $id )->delete();

        return 'done';
    }

    private function updateMedia( Request $request, Post $post ) {
        $oldPoster   = $post->the_poster;
        $oldBackdrop = $post->the_backdrop;
        $this->mediaService->getUploader()->setConfigKey( 'post' );
        //        dd( $post->the_poster );
        if ( $request->file( 'poster' ) ) {
            $mediaFilePoster = MediaService::fromUploadedFile( $request->file( 'poster' ) );
            if ( $this->mediaService->upload( $mediaFilePoster ) && $this->mediaService->uploadThumb( $mediaFilePoster ) ) {
                $data  = [
                    'type'                => EMediaType::poster,
                    'approved_at'         => Carbon::now(),
                    'thumbnail_full_path' => $mediaFilePoster->getFullThumbnailPath(),
                ];
                $media = $this->mediaService->createMedia( $mediaFilePoster, $data );

                if ( $oldPoster ) {
                    $this->mediaService->removeMedia( $post->the_poster );
                }

                $this->mediaService->attachMedia( $media, $post, 'poster', [] );
            }
        }
        if ( $request->file( 'backdrop' ) ) {

            $mediaFileBackdrop = MediaService::fromUploadedFile( $request->file( 'backdrop' ) );
            if ( $this->mediaService->upload( $mediaFileBackdrop ) && $this->mediaService->uploadThumb( $mediaFileBackdrop ) ) {
                $data  = [
                    'type'                => EMediaType::backdrop,
                    'approved_at'         => Carbon::now(),
                    'thumbnail_full_path' => $mediaFileBackdrop->getFullThumbnailPath(),
                ];
                $media = $this->mediaService->createMedia( $mediaFileBackdrop, $data );

                if ( $oldBackdrop ) {
                    $this->mediaService->removeMedia( $post->the_backdrop );
                }
                $this->mediaService->attachMedia( $media, $post, 'postsBackdrop', [] );
            }
        }
    }
}
