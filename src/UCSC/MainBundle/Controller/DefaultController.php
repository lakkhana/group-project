<?php

namespace UCSC\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('UCSCMainBundle:Default:index.html.twig');
    }
}
