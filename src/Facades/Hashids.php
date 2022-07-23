<?php

namespace AntoninMasek\Hashids\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method \AntoninMasek\Hashids\Hashids salt(string $salt = null)
 * @method \AntoninMasek\Hashids\Hashids alphabet(string $alphabet = null)
 * @method \AntoninMasek\Hashids\Hashids minLength(int $minLength = null)
 * @method string encode(array|int $numbers)
 * @method array decode(string $numbers)
 *
 * @see \AntoninMasek\Hashids\Hashids
 */
class Hashids extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \AntoninMasek\Hashids\Hashids::class;
    }
}
