<?php

namespace Admingenerated\AdmingeneratorDemoBundle\BaseController;

use Admingenerator\GeneratorBundle\Controller\Doctrine\BaseController as BaseDoctrineController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DeleteController extends BaseDoctrineController
{    /**
     */
    public function indexAction($id)
    {
        try {
            $this->process($id);
            $this->get('session')->setFlash('success','The record have been successfully deleted');
        } catch(\InvalidArgumentException $e) {
            $this->get('session')->setFlash('error',"The record can't be deleted");
        }
        
        return new RedirectResponse($this->generateUrl("DemoBundle_list"));
    }
protected function process($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $Movie = $em
             ->getRepository('Admingenerator\DemoBundle\Entity\Movie')
             ->findOneById($id);
        
        if(!$Movie) {
            throw new \InvalidArgumentException("No Admingenerator\DemoBundle\Entity\Movie found on id : $id");
        }
        
        $em->remove($Movie);
        $em->flush();
        $em->clear();
    }
    
}