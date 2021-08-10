<?php

namespace Kaban\Components\Admin\Users\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GetAllUsersResource extends JsonResource {

    public function toArray( $request ) {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'email' => $this->email,
        ];
    }
}
