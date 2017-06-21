<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as BaseEncrypter;

class EncryptCookies extends BaseEncrypter
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        'requestTokenSecret',
    	'callbackUrl',
    	'aweber-access-token',
    	'aweber-access-token-secret'
    ];
}
