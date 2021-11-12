<?php

namespace Kaban\General\Enums;


use Kaban\Core\Enums\BaseEnum;

class EQuoteStatus extends BaseEnum {
    const pending = 0;
    const hold = 1;
    const active = 2;
    const cancelled = 3;
    const completed = 4;

    static $farsiArray = [
        0 => 'pending',
        1 => 'hold',
        2 => 'active',
        3 => 'cancelled',
        4 => 'completed',
    ];
}
