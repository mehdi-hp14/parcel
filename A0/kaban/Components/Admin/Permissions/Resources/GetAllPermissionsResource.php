<?php

namespace Kaban\Components\Admin\Permissions\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GetAllPermissionsResource extends JsonResource {

    public function toArray( $request ) {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'description' => $this->description,
        ];
    }
}
