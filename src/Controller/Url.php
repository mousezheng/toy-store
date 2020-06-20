<?php

/**
 * Created by : PhpStorm
 * User: mousezheng
 * Date: 2020/6/20
 * Time: 下午1:55
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Url
 *
 * @package App\Controller
 * @Route("/url/")
 */
class Url extends AbstractController
{
    /**
     * @param int $id
     * @Route("toy/{id}", methods="POST")
     *
     * @return Response
     */
    public function save(int $id): Response
    {
        return $this->json([$id]);
    }

    /**
     * @param int $id
     * @Route("toy/{id}", methods="DELETE")
     */
    public function delete(int $id)
    {

    }

    /**
     * @param int $id
     * @Route("toy/{id}", methods="GET")
     */
    public function geta(int $id)
    {

    }
}