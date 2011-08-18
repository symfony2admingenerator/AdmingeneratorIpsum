<?php

namespace Admingenerated\AdmingeneratorDemoBundle\BaseController;

use Admingenerator\DemoBundle\Form\Type\FiltersType;


use Admingenerator\GeneratorBundle\Controller\Doctrine\BaseController as BaseDoctrineController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter as PagerAdapter;

// these import the "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ListController extends BaseDoctrineController
{    /**
     * @Template()
     */
    public function indexAction()
    {
        if ($this->get('request')->query->get('page'))
        {
          $this->setPage($this->get('request')->query->get('page'));
        }
        
        if ($this->get('request')->query->get('sort'))
        {
          $this->setSort($this->get('request')->query->get('sort'), $this->get('request')->query->get('order_by','ASC'));
        }
        
        $form = $this->getFilterForm();

        return array(
            'Movies' => $this->getPager(),
            'form'                      => $form->createView(),
            'sortColumn'                => $this->getSortColumn(),
            'sortOrder'                 => $this->getSortOrder(),
        );
    }
    /**
     * Store in the session service the current page
     *
     * @param integer $page The page number
     */
    protected function setPage($page)
    {
        $this->get('session')->set('Admingenerator\DemoBundle\List\Page', $page);
    }
    
    /**
     * Return the stored page
     *
     * @return integer $page The page number
     */
    protected function getPage()
    {
        return $this->get('session')->get('Admingenerator\DemoBundle\List\Page', 1);
    }
    
    protected function getPager()
    {
        $paginator = new Pagerfanta(new PagerAdapter($this->getQuery()));
        $paginator->setMaxPerPage(3);
        $paginator->setCurrentPage($this->getPage(), false, true);
        
        return $paginator;
    }
    /**
     * Store in the session service the current sort
     *
     * @param string $column The column
     * @param string $order_by The order sorting (ASC,DESC)
     */
    protected function setSort($column, $order_by)
    {
        $this->get('session')->set('Admingenerator\DemoBundle\List\Sort', $column);
        
        if($order_by == 'desc') {
            $this->get('session')->set('Admingenerator\DemoBundle\List\OrderBy', 'DESC');
        } else {
             $this->get('session')->set('Admingenerator\DemoBundle\List\OrderBy', 'ASC');
        }
    }
    
    /**
     * Return the stored sort
     *
     * @return string The column to sort
     */
    protected function getSortColumn()
    {
        return $this->get('session')->get('Admingenerator\DemoBundle\List\Sort');
    }
    
    /**
     * Return the stored sort order
     *
     * @return string the order mode ASC|DESC
     */
    protected function getSortOrder()
    {
        return $this->get('session')->get('Admingenerator\DemoBundle\List\OrderBy','ASC');
    }
    
    /**
     * @Template()
     */
    public function filtersAction()
    {
        $form = $this->getFilterForm();
        $form->bindRequest($this->get('request'));
        
        if($form->isValid()) {
            $this->setFilters($form->getClientData());
        }
        
        return new RedirectResponse($this->generateUrl("DemoBundle_list"));
    }
    
    /**
     * Store in the session service the current filters
     *
     * @param array the filters
     */
    protected function setFilters($filters)
    {
        $this->get('session')->set('Admingenerator\DemoBundle\List\Filters', $filters);
    }
    
    protected function getFilters()
    {
        return $this->get('session')->get('Admingenerator\DemoBundle\List\Filters', new \Admingenerator\DemoBundle\Entity\Movie);
    }
    
    protected function getFilterForm()
    {
        return $this->createForm(new FiltersType(), $this->getFilters());
    }
protected function getQuery()
    {
        $query = $this->getDoctrine()
                    ->getEntityManager()
                    ->createQueryBuilder()
                    ->select('q')
                    ->from('Admingenerator\DemoBundle\Entity\Movie', 'q');
        
        $this->processSort($query); 
        $this->processFilters($query); 

        return $query->getQuery();
    }
    
    protected function processSort($query)
    {
        if($this->getSortColumn()) { //@todo implement join method to sort on undirect columns
            $query->orderBy('q.'.$this->getSortColumn(), $this->getSortOrder());
        }
    }
    
    protected function processFilters($query)
    {
        $filterObject = $this->getFilters();

                
        if(null !== $filterObject->getTitle()) {
            $query->andWhere("q.title LIKE :title");
            $query->setParameter("title", "%".$filterObject->getTitle()."%"); //@todo Find a solution to optimize this !
        }
                
        if(null !== $filterObject->getIsPublished()) {
            $query->andWhere("q.is_published LIKE :is_published");
            $query->setParameter("is_published", "%".$filterObject->getIsPublished()."%"); //@todo Find a solution to optimize this !
        }
                
    }
}