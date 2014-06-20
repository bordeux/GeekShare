<?php

namespace Acme\GeekShareBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api/user")
 */
class FilesController extends Controller {

    /**
     * @Route("/resource")
     */
    public function resourcection() {
        exit("TesT");
    }


}
