<?php

namespace Acme\GeekShareBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Acme\GeekShareBundle\Entity\Directory;
use Acme\GeekShareBundle\Entity\Page;

/**
 * @Route("/api/pages")
 */
class PagesController extends Controller {


    /**
     * Get page content 
     * @Route("/get")
     */
    public function getAction(Request $request) {
        $response = new JsonResponse();
        $pageName = $request->get("name");
        
    
        $dirRepo = $this->getDoctrine()->getRepository('AcmeGeekShareBundle:Page');
        /* @var $page Page */
        $page = $dirRepo->findOneBy(array(
            'name'=>$pageName,
        ));
        if(!$page){
            $response->setStatusCode(404);
            return $response;
        }
        
        $response->setData(array(
            "title" => $page->getTitle(),
            "name" => $page->getName(),
            "id" => $page->getId(),
            "content" => $page->getContent()
        ));
        return $response;
    }
    

}
