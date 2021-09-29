<?php

namespace Kaban\Components\Admin\Media\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GetAllMediaResource extends JsonResource {
//class GetAllPostsResource extends ResourceCollection {

    public function toArray( $request ) {
        return [
            'id'            => $this->id,
            'url'           => $this->url,
            'thumbnail_url' => $this->thumbnail_url,
        ];
    }
}
