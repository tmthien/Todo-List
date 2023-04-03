<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusTask extends Enum
{
    const Pending    =   'pending';
    const Processing =   'processing';
    const Complete   =   'complete';
}
