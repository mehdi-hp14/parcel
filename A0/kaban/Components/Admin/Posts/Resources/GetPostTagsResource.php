<?php

namespace Kaban\Components\Admin\Posts\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GetPostTagsResource extends JsonResource {

    public function toArray( $request ) {

        return [
            'text'  => $this->name,
            'value' => $this->id,
        ];
    }
}
