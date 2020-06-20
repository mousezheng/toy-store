<?php

/**
 * Created by : PhpStorm
 * User: mousezheng
 * Date: 2020/6/20
 * Time: 下午3:52
 */

namespace App\Enum;

use MyCLabs\Enum\Enum;

class UrlType extends Enum
{
    public const LINK  = 'link';
    public const IMG   = 'img';
    public const FILE  = 'file';
    public const OTHER = 'other';
}
