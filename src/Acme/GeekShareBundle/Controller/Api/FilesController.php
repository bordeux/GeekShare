<?php

namespace Acme\GeekShareBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Acme\GeekShareBundle\Entity\Directory;
use Acme\GeekShareBundle\Entity\User;

/**
 * Class for /api/files routing
 * @Route("/api/files")
 */
class FilesController extends Controller {

    /**
     * Directory seprator
     * @var string 
     */
    protected $ds = "→";
  
    /**
     * List directories and files in dir
     * @Route("/list")
     * @Security("has_role('ROLE_USER')")
     */
    public function listAction(Request $request) {
        $data = json_decode($request->getContent());
        $response = new JsonResponse();
        
        /* @var $user User */
        $user = $this->get('security.context')->getToken()->getUser();
        
        $dirRepo = $this->getDoctrine()->getRepository('AcmeGeekShareBundle:Directory');
        $result = $dirRepo->findBy(array(
            'usrId'=>$user->getId(),
            'path'=>$data->directory,
            'deleted' => false
        ));
        $dirs = [];
        
        /* @var $dir Directory */
        foreach($result as $dir){
            $dirs[] = array(
                "path" => $dir->getPath(),
                "name" => $dir->getName(),
                "lastModified" => $dir->getLastModified(),
                "id" => $dir->getId(),
                "files" => $dir->getFiles(),
                "fullPath" => $dir->getPath().$this->ds.$dir->getName()
            );
        }
        $response->setData(array(
            "directories" => $dirs,
            "currentPath" => $data->directory
        ));
        return $response;
    }
    
    /**
     * Action, when user create new dir
     * @Route("/create")
     * @Security("has_role('ROLE_USER')")
     */
    public function createAction(Request $request) {
        $data = json_decode($request->getContent());

        /* @var $user User */
        $user = $this->get('security.context')->getToken()->getUser();
        
        $dirPaths = explode($this->ds, $data->directory);
        $response = new JsonResponse();
        $directory = new Directory();
        $directory->setName($data->name);
        $directory->setPath($data->directory);
        $directory->setUsrId($user->getId());
        $directory->setLastModified(new \DateTime('NOW'));
        $directory->setFiles(0);
        $directory->setDeep(count($dirPaths));
        
        
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($directory);
        $em->flush();
        
        return $response;
    }
    
    /**
     * Action, when user upload file to the server
     * @Route("/upload")
     * @Security("has_role('ROLE_USER')")
     */
    public function uploadAction(Request $request) {
        var_dump($_FILES);
        exit;
        return '';
    }
    
    /**
     * Action, when user click on delete folder button
     * @Route("/delete")
     * @Security("has_role('ROLE_USER')")
     */
    public function deleteAction(Request $request) {
        $response = new JsonResponse();
        $data = json_decode($request->getContent());

        $em = $this->getDoctrine()->getManager();
        /* @var $user User */
        $user = $this->get('security.context')->getToken()->getUser();
        
        $dirPaths = explode($this->ds, $data->directory);
        
        
        $repository = $this->getDoctrine()->getRepository('AcmeGeekShareBundle:Directory');
        $dirName = array_pop($dirPaths);
        
        /* @var $directory Directory */
        $where = array(
            "path" => implode($this->ds, $dirPaths),
            "name" => $dirName,
            "usrId"=> $user->getId(),
            "deleted" => false
        );
        $directory = $repository->findOneBy($where);
        if(!$directory){
                $response->setStatusCode(404);
            return $response;
        }
        $directory->setDeleted(true);
        $em->flush();
 
        
        return $response;
    }


}
