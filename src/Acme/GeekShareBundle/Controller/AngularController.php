<?php

namespace Acme\GeekShareBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AngularController extends Controller {

    /**
     * Index action - view JS File with headers
     * @Route("/app/{version}.js")
     */
    public function indexAction($version) {
        return new Response(
                $this->getJsFile(), Response::HTTP_OK, array('content-type' => 'text/javascript')
        );
    }

    /**
     * Getting merqued JS files with modules directives, controlers etc.
     * @return string
     */
    public function getJsFile() {
        $angularDir = $this->container->get('kernel')->locateResource('@AcmeGeekShareBundle/Angular');

        $includeFiles = array();
        $includeFiles[] = $angularDir.'/modules/*/bootstrap.js';
        $includeFiles[] = $angularDir . '/modules/*/controllers/*Controller.js';
        $includeFiles[] = $angularDir . '/modules/*/directives/*Directive.js';
        $includeFiles[] = $angularDir . '/modules/*/services/*Service.js';
        $includeFiles[] = $angularDir . '/modules/*/factory/*Factory.js';
        $includeFiles[] = $angularDir . '/modules/*/filters/*Filter.js';
        
        $files = glob(sprintf("{%s}", implode(",", $includeFiles)), GLOB_BRACE);
      
       
        
        $jsString = file_get_contents($angularDir."/init/app.js");
        
        /**
         * CONFIG
         */
        $config = $this->getConfigJs();
        $configJson = json_encode($config);
        $jsString .= "app.setConfig({$configJson});";
        
        
        array_push($files, $angularDir."/init/run.js");
        foreach ($files as $filename) {
                 $jsString .= file_get_contents($filename);
        }
        
       


        return $jsString;
 
    }
    /**
     * Get config array
     * @return array
     */
    public function getConfigJs(){
        $config['version'] = 1.0;
        $config['urls'] = array(
            "assets"    => $this->getRequest()->getUriForPath('/assets'), //without last slash
            "css"       => $this->getRequest()->getUriForPath('/css'), //without last slash
            "templates" => $this->getRequest()->getUriForPath('/assets/templates'),
            "api"       => $this->getRequest()->getUriForPath('/api'),
            "site"      => $this->getRequest()->getUriForPath('/'),
        );
        return $config;
    }

}
