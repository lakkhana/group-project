<?php

namespace UCSC\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class MenuController extends Controller
{
    
    public function menuAction($tab)
    {
    	if($tab == 'exam') {
    		return $this->render('UCSCResultBundle::layout.html.twig');
    	}
        return $this->render('UCSCMainBundle:Default:index.html.twig');
    }
}