<?php

namespace Kaban\Components\Admin\Posts\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GetSearchedPostsResource extends JsonResource {
//class GetAllPostsResource extends ResourceCollection {
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray( $request ) {

        return [
            'text'  => $this->title,
            'media' => $this->media,
            'value' => $this->id,
        ];

        return parent::toArray( $request );
    }
}
