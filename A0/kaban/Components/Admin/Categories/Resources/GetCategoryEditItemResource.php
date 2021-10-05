<?php

namespace Kaban\Components\Admin\Categories\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Kaban\General\Enums\EPostStatus;

class GetCategoryEditItemResource extends JsonResource {

    public function toArray( $request ) {

//        dd( $this->parent->toArray() );

        return [
            'title'         => $this->title,
            'parent'        => $this->parent_id,
            'categoryItems' => [ [ 'value' => $this->parent_id, 'text' => $this->parent->title ] ],
        ];
    }
}
