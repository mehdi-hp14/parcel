<?php

namespace Kaban\General\Enums;


use Kaban\Core\Enums\BaseEnum;

class EAdminRank extends BaseEnum {
    const normal = 0;
    const superAdmin = 10;

    static $farsiArray = [
        0 => 'admin',
        10 => 'super admin',
    ];
}
