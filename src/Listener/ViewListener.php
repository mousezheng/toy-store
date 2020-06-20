<?php

/**
 * Created by : PhpStorm
 * User: mousezheng
 * Date: 2020/6/20
 * Time: 下午4:26
 */

namespace App\Listener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class ViewListener
{
    public function onKernelView(ViewEvent $event)
    {
        $value = $event->getControllerResult();
        if ($value instanceof Response) {
            return;
        }
        $jsonResponse = new JsonResponse([
            'code'    => 0,
            'message' => 'success.',
            'data'    => $value
        ]);
        $jsonResponse->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        $event->setResponse($jsonResponse);
    }
}
