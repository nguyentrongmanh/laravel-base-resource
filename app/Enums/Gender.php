<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class Gender extends Enum implements LocalizedEnum
{
    const MALE = 1;
    const FEMALE = 2;
    const OTHER = 3;
}
