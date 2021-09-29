<?php

namespace Kaban\Components\Admin\Categories\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GetAllCategoriesResource extends JsonResource {
//class GetAllPostsResource extends ResourceCollection {

    public function toArray( $request ) {
        return [
            'id'     => $this->id,
            'title'  => $this->title,
            'parent' => $this->parent_title,
        ];
    }
}
