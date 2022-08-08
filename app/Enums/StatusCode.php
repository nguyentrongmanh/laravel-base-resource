<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusCode extends Enum
{
    const OK = 200;
    const CREATED = 201;
    const NO_CONTENT = 204;
    const NOT_MODIFIED = 304;
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const ACCOUNT_LOCK = 406;
    const METHOD_NOT_ALLOWED = 405;
    const MAINTAIN = 407;
    const GONE = 410;
    const UNSUPOPPER_MEDIA_TYPE = 415;
    const UNPROCESSABLE_ENTITY = 422;
    const TOO_MANY_REQUEST = 429;
    const PARAMS_ERR = 600;
    const INTERNAL_ERR = 500;
    const ERROR = 'error';
    const SUCCESS = 'success';
    const WARNING = 'warning';
    const A1R = 406;
    const A1M = 407;
    const A1V = 408;
}
