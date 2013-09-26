<?php

namespace P5indicatori\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $message = 'Acces /login to log in; /register to register;  /logout to exit';
        return $this->render('P5indicatoriUserBundle:Default:index.html.twig', array('name' => $message));
    }
   
}
