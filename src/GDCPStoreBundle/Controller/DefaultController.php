<?php

namespace GDCPStoreBundle\Controller;

use GDCPStoreBundle\Document\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GDCPStoreBundle:Default:index.html.twig');
    }
    
    public function createAction()
    {
        $product = new Product();
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($product);
        $dm->flush();

        return new Response('Created product id '.$product->getId());
    }
    
    public function showAction($id)
    {
            
        $product = $this->get('doctrine_mongodb')
            ->getRepository('GDCPStoreBundle:Product')
            ->find($id);
        
        if (!$product) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }
         
        // do something, like pass the $product object into a template
    }
    
    public function updateAction($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $product = $dm->getRepository('GDCPStoreBundle:Product')->find($id);

        if (!$product) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }

        $product->setName('New product name!');
        $dm->flush();

        return $this->redirect($this->generateUrl('homepage'));
    }
}
