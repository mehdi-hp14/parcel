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

class Permission extends Model {

    protected $guarded = [];

    public function roles() {

        return $this->belongsToMany( Role::class, 'roles_permissions' );

    }

    public function users() {

        return $this->belongsToMany( User::class, 'users_permissions' );

    }
}
