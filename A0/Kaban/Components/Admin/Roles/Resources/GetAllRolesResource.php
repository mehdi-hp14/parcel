<?php

namespace Kaban\Components\Admin\Roles\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GetAllRolesResource extends JsonResource {

    public function toArray( $request ) {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'description' => $this->description,
        ];
    }
}
