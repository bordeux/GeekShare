<?php

namespace Acme\GeekShareBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Acme\GeekShareBundle\Entity\Directory;
use Acme\GeekShareBundle\Entity\User;
use Acme\GeekShareBundle\Entity\File;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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
     * Download selected file
     * @Route("/download/{id}/{key}/{filename}", name="download_file") , requirements={"id" = "\d+"}
     */
    public function downloadAction($id, $key, $filename){
        
        $repository = $this->getDoctrine()->getRepository('AcmeGeekShareBundle:File');
        /* @var $directory Directory */
        $where = array(
            "id" => $id,
            "key"=> $key,
            "deleted" => false
        );
        /* @var $file File */
        $file = $repository->findOneBy($where);
        
        if(!($file)){
            throw new NotFoundHttpException('File not existing!');
        }
        
        $response = new BinaryFileResponse($file->getFile());
        $response->setPublic();
        $fileName = $file->getFileName();
        $fileName = str_replace("\"", '', $fileName);
        $response->headers->set('Content-disposition', 'filename="'.$fileName.'"');
        
        return $response;
    }
    
    
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
        
        $files = [];
        $fileRepo = $this->getDoctrine()->getRepository('AcmeGeekShareBundle:File');
        $fileResult = $fileRepo->findBy(array(
            'usrId'=>$user->getId(),
            'path'=>$data->directory,
            'deleted' => false
        ));
        
        /* @var $file File */
        foreach($fileResult as $file){
            $files[] = array(
                "id" => $file->getId(),
                "name" => $file->getFileName(),
                "size" => $file->getFileSize(),
                "extenstion" => pathinfo($file->getFileSize(), PATHINFO_EXTENSION ),
                "downloadLink" =>  $this->get('router')->generate('download_file', array(
                    'id' => $file->getId(),
                    'key' => $file->getKey(),
                    'filename' => $file->getFileName(),
                ), true)
            );
        }
        
        
        $response->setData(array(
            "directories" => $dirs,
            "files" => $files,
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
        $response = new JsonResponse();
        $directory = $request->get('directory');
        /* @var $user User */
        $user = $this->get('security.context')->getToken()->getUser();
        
        foreach($_FILES as $item){
            $file = new File();
            $file->setPath($directory);
            $file->setUsrId($user->getId());
            $file->setFileName($item['name']);
            $file->setFile($item['tmp_name']);
            $file->setMime($item['type']);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($file);
            $em->flush();
        }
     
 
        return $response;
    }
    
    /**
     * Delete user dir
     * @param integer $dirId
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function _deleteDir($dirId, $user){
        $response = new JsonResponse();
        $repository = $this->getDoctrine()->getRepository('AcmeGeekShareBundle:Directory');
        /* @var $directory Directory */
        $where = array(
            "id" => $dirId,
            "usrId"=> $user->getId(),
            "deleted" => false
        );
        $em = $this->getDoctrine()->getManager();
        $directory = $repository->findOneBy($where);
        if(!$directory){
                $response->setStatusCode(404);
            return $response;
        }
        $directory->setDeleted(true);
        $em->flush();
        return $response;
    }
    
    /**
     * Delete user file
     * @param integer $fileId
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function _deleteFile($fileId, $user){
        $response = new JsonResponse();
        $repository = $this->getDoctrine()->getRepository('AcmeGeekShareBundle:File');
        /* @var $directory Directory */
        $where = array(
            "id" => $fileId,
            "usrId"=> $user->getId(),
            "deleted" => false
        );
        $em = $this->getDoctrine()->getManager();
        $file = $repository->findOneBy($where);
        if(!$file){
                $response->setStatusCode(404);
            return $response;
        }
        $file->setDeleted(true);
        $em->flush();
        return $response;
    }
    
    
    /**
     * Action, when user click on delete folder button
     * @Route("/delete")
     * @Security("has_role('ROLE_USER')")
     */
    public function deleteAction(Request $request) {
        /* @var $user User */
        $user = $this->get('security.context')->getToken()->getUser();
        $data = json_decode($request->getContent());
        
        if(isset($data->dir)){
            return $this->_deleteDir($data->dir, $user);
        }
        
        if(isset($data->file)){
            return $this->_deleteFile($data->file, $user);
        }
        

        
   
       
    }


}
