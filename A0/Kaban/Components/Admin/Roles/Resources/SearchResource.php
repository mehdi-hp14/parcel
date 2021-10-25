<?php

namespace Kaban\Components\Admin\Roles\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource {

    public function toArray( $request ) {
        return [
            'text'  => $this->title,
            'value' => $this->id,
        ];
    }
}
