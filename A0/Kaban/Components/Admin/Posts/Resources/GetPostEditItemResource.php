<?php

namespace Kaban\Components\Admin\Posts\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Kaban\General\Enums\EPostStatus;

class GetPostEditItemResource extends JsonResource {

    public function toArray( $request ) {
        if ( $thePoster = $this->thePoster ) {
            $thePoster = $thePoster->only( 'id', 'url', 'title' );
        }
        if ( $theBackdrop = $this->theBackdrop ) {
            $theBackdrop = $theBackdrop->only( 'id', 'url', 'title' );
        }

        return [
            'title'         => $this->title,
            'categories'    => $this->category->id,
            'categoryItems' => [ [ 'value' => $this->category->id, 'text' => $this->category->title ] ],
            'excerpt'       => $this->excerpt,
            'id'            => $this->id,
            'content'       => $this->content,
            'status'        => [ 'value' => $this->status, 'text' => EPostStatus::farsi( $this->status ) ],
            'statusItems'   => EPostStatus::vuetifyTransFlip( 'admin.status_' ),
            'tags'          => $this->tags->pluck( 'name' ),
            'poster'        => null,
            'posterImg'     => $thePoster,
            'backdrop'      => null,
            'backdropImg'   => $theBackdrop,
        ];
    }
}
