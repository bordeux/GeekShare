<?php

namespace Acme\GeekShareBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TemplateController extends Controller {

    /**
     * In response is view file for angular module
     * @Route("/assets/templates/{module}/{view}.html")
     */
    public function indexAction($module, $view) {
        $viewFile = $this->container->get('kernel')->locateResource("@AcmeGeekShareBundle/Angular/modules/{$module}/views/{$view}.html");
       
        return new Response(
                file_get_contents($viewFile), Response::HTTP_OK, array('content-type' => 'text/html; charset=utf-8')
        );
    }

}
