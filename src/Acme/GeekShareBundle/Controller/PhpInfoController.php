<?php

namespace Acme\GeekShareBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PhpInfoController extends Controller {

    /**
     * @Route("/phpinfo")
     */
    public function indexAction() {
        phpinfo();
        exit;
    }

}
