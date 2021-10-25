<?php

namespace Kaban\Components\Admin\Roles\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GetRolePermissionsResource extends JsonResource {

    public function toArray( $request ) {

        return [
            'text'  => $this->name,
            'value' => $this->id,
        ];
    }
}
