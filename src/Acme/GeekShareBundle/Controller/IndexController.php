<?php

namespace Acme\GeekShareBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller {

    /**
     * Index action
     * @Route("/")
     * @Route("/{action}")
     * @Route("/{action}/{subaction}")
     */
    public function indexAction() {
        return $this->render('AcmeGeekShareBundle:Index:index.html.twig', array('name' => 'test'));
    }

}
