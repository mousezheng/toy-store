<?php

/**
 * Created by : PhpStorm
 * User: mousezheng
 * Date: 2020/6/19
 * Time: 下午11:31
 */

namespace App\ValueResolver;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class Content implements ArgumentValueResolverInterface
{

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return $argument->getName() === 'content';
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $content    = $request->getContent();
        $contentArr = json_decode($content, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            yield $contentArr;
        } else {
            yield $content;
        }
    }
}