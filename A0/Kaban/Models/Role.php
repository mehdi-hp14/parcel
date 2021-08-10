<?php

namespace Kaban\Models;

use Illuminate\Database\Eloquent\Model;
use jDate;
use Kaban\Core\Enums\EState;
use Kaban\Core\Models\BaseModel;
use Kaban\General\Enums\EPostStatus;
use Kaban\General\Enums\ETagType;
use Kaban\General\Interfaces\ICommentable;
use Kaban\General\Interfaces\IHittable;
use Kaban\General\Interfaces\IReactable;
use Kaban\General\Interfaces\IValuable;
use Kaban\General\Services\Content;

class Role extends Model {
    protected $fillable = [ 'name', 'permissions' ];

    public function permissions() {
        return $this->belongsToMany( Permission::class, 'roles_permissions' );
    }

    public function users() {
        return $this->belongsToMany( User::class, 'users_roles' );
    }

    public function syncPermissions( $arr ) {
        $this->permissions()->sync( $arr );
    }

}
