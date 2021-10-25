<?php

namespace Kaban\General\Enums;


use Kaban\Core\Enums\BaseEnum;

class EAdminStatus extends BaseEnum {
    const disabled = 0;
    const active = 1;

    static $farsiArray = [
        0 => 'Suspended',
        1 => 'Active',
    ];
}
