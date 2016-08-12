<?php

namespace GDCPStoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GDCPStoreBundle:Default:index.html.twig');
    }
}
