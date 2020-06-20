<?php

/**
 * Created by : PhpStorm
 * User: mousezheng
 * Date: 2020/6/20
 * Time: 下午3:58
 */

namespace App\Enum;

use MyCLabs\Enum\Enum;

class RedirectType extends Enum
{
    /**
     * 永久跳转
     */
    public const PERMANENT = 301;
    /**
     * 临时跳转
     */
    public const TEMPORARY = 302;
}
