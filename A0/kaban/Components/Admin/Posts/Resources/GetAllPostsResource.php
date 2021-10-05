<?php

namespace Kaban\Components\Admin\Posts\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GetAllPostsResource extends JsonResource {
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
            'title'    => $this->title,
            'category' => $this->category->title,
//            'content' => $this->content,
            'excerpt'  => $this->excerpt,
            'id'       => $this->id,
        ];

        return parent::toArray( $request );
    }
}
