<?php

/**
 * Created by : PhpStorm
 * User: zsl
 * Date: 2020/10/18
 * Time: 19:22
 */

namespace App\Controller;

use App\Service\Util as UtilService;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Util
 *
 * @package App\Controller
 * @Route("/util/")
 */
class Util
{
    private UtilService $utilService;

    public function __construct(UtilService $utilService)
    {
        $this->utilService = $utilService;
    }

    /**
     * @return string
     * @Route("upload")
     */
    public function upload(): string
    {
        return $this->utilService->upload($_FILES);
    }
}
