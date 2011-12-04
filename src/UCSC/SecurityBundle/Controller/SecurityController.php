<?php

namespace UCSC\SecurityBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

use UCSC\DatabaseBundle\Entity\User;
use UCSC\DatabaseBundle\Entity\Role;


class SecurityController extends Controller
{
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('UCSCSecurityBundle:Security:login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }
    
    public function registerformAction()
    {    	
    	$user = new User();
    	$form = $this->createFormBuilder($user)
        ->add('username', 'text')
        ->add('password', 'password')
        ->getForm();
    	return $this->render('UCSCSecurityBundle:Security:register.html.twig', array(
    			'form' => $form->createView(),
    	));
    }
    
    public function registerAction(Request $request)
    {
    	$user = new User();
    	
    	$form = $this->createFormBuilder($user)
    	->add('username', 'text')
    	->add('password', 'password')
    	->getForm();
    	
    	if ($request->getMethod() == 'POST') {
        	
    		$form->bindRequest($request);
    		
        	if ($form->isValid()) {
        		
				$user->setSalt(md5(time()));
				$user->setRole('ROLE_USER');
				
				$factory = $this->get('security.encoder_factory');
				$encoder = $factory->getEncoder($user);
				$password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
				$user->setPassword($password);
				
		    	$em = $this->getDoctrine()->getEntityManager();
		    	$em->persist($user);
		    	$em->flush();
		    
		    	return $this->redirect($this->generateUrl('login'));
        	}
    	}
    }
}