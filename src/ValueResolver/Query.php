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

class Query implements ArgumentValueResolverInterface
{

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return $argument->getName() === 'query';
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        yield $request->query->all();
    }
}