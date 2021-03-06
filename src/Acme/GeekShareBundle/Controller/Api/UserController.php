<?php

namespace Acme\GeekShareBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\Request;
use Acme\GeekShareBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;

/**
 * @Route("/api/user")
 */
class UserController extends Controller {

    protected $firewallName ="secured_area";
    
    /**
     * Action, when user register new account
     * @Route("/create")
     * @Method({"PUT"})
     */
    public function createAction(Request $request) {
        $response = new JsonResponse();
        $userData = json_decode($request->getContent());


        $repository = $this->getDoctrine()->getRepository('AcmeGeekShareBundle:User');
        $user = $repository->findOneByEmail($userData->email);

        if ($user) {
            $response->setStatusCode(403);
            $response->setData(array('message' => 'Email alredy exsist'));
            return $response;
        }



        $user = new User();
        $user->setEmail($userData->email);
        $user->setPassword($userData->password);
        $user->setName($userData->name);
        $user->setRoles(array("ROLE_USER"));

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $token = new UsernamePasswordToken($user, $user->getPassword(), $this->firewallName, $user->getRoles());
        $this->get("security.context")->setToken($token);
        
        $event = new InteractiveLoginEvent($request, $token);
        $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);
        

        $response->setData(array('id' => $user->getId()));
        return $response;
    }

    /**
     * Action, when user log in
     * @Route("/login")
     * @Method({"PUT"})
     */
    public function loginAction(Request $request) {
        $response = new JsonResponse();
        $userData = json_decode($request->getContent());

        $repository = $this->getDoctrine()->getRepository('AcmeGeekShareBundle:User');
        /* @var $user User */
        $user = $repository->findOneByEmail($userData->email);

        if (!$user) {
            $response->setStatusCode(404);
            $response->setData(array('message' => 'User not found'));
            return $response;
        }

        if (!$user->validyPassword($userData->password)) {
            $response->setStatusCode(403);
            $response->setData(array('message' => 'Invalid password'));
            return $response;
        }
        
        
        
        $token = new UsernamePasswordToken($user, $user->getPassword(), $this->firewallName, $user->getRoles());
        $this->get("security.context")->setToken($token);
        
        $event = new InteractiveLoginEvent($request, $token);
        $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);
  
        
        
        $response->setData(array(
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'roles' => $user->getRoles()
        ));
        return $response;
    }
    
    /**
     * Logout action
     * @Route("/logout")
     */
    public function logoutAction(){
        
        $token = new AnonymousToken('secured_area', 'anon.');
        $this->get('security.context')->setToken($token);
        $this->get('request')->getSession()->invalidate();
        $response = new JsonResponse();
        $response->setData(array(
            'result' => true
        ));
        return $response;
    }
    
    /**
     * @Route("/getUser")
     * @Security("has_role('ROLE_USER')")
     */
    public function getUserAction(Request $request) {
        $response = new JsonResponse();
        $userToken = $this->get('security.context')->getToken()->getUser();

        $response->setData(array(
            'id' => $userToken->getID(),
            'email' => $userToken->getEmail(),
            'roles' => $userToken->getRoles()
        ));
        return $response;
    }
    
    /**
     * @Route("/403")
     */
    public function unauthorizedAction(Request $request) {
        $response = new JsonResponse();
        $response->setStatusCode(403);
        return $response;
    }
    
    
    

}
