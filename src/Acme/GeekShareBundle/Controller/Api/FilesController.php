<?php

namespace Acme\GeekShareBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api/files")
 */
class FilesController extends Controller {

    /**
     * @Route("/getFiles.json")
     */
    public function getFilesAction() {
        $response = new JsonResponse();
        $response->setData(array('message' => 'hello'));

        return $response;
    }


}
