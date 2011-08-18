<?php

namespace Admingenerated\AdmingeneratorDemoBundle\BaseController;

use Admingenerator\GeneratorBundle\Controller\Doctrine\BaseController as BaseDoctrineController;
use Symfony\Component\HttpFoundation\RedirectResponse;

// these import the "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Admingenerator\DemoBundle\Form\Type\EditType;
class EditController extends BaseDoctrineController
{
    /**
     * @Template()
     */
    public function indexAction($id)
    {
        $Movie = $this->getObject($id);
        
        if(!$Movie) {
            throw new NotFoundHttpException("The Admingenerator\DemoBundle\Entity\Movie with id $id can't be found");
        }
        
        $form = $this->createForm(new EditType(), $Movie);
        
        return array(
            "Movie" => $Movie,
            "form" => $form->createView(),
        );
    }

    /**
     * @Template("AdmingeneratorDemoBundle:Edit:index.html.twig")
     */
    public function updateAction($id)
    {
        $Movie = $this->getObject($id);
        
        if(!$Movie) {
            throw new NotFoundHttpException("The Admingenerator\DemoBundle\Entity\Movie with id $id can't be found");
        }
        
        $form = $this->createForm(new EditType(), $Movie);
        $form->bindRequest($this->get('request'));
        
        if ($form->isValid()) {
            $this->saveObject($Movie);
            
            $this->get('session')->setFlash('success', 'The object was successfully saved');
            
            return new RedirectResponse($this->generateUrl("DemoBundle_edit", array('id' => $Movie->getId()) ));
            
        } else {
            $this->get('session')->setFlash('error', "The form can't be saved. Check errors and try to resubmit");
        }
        
        return array(
            "Movie" => $Movie,
            "form" => $form->createView(),
        );
    }
protected function getObject($id)
    {
        return $this->getDoctrine()
                    ->getEntityManager()
                    ->getRepository('Admingenerator\DemoBundle\Entity\Movie')
                    ->findOneById($id);
    }

    protected function saveObject(\Admingenerator\DemoBundle\Entity\Movie $Movie)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($Movie);
        $em->flush();
    }
}