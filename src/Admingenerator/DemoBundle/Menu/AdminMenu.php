<?php 

namespace Admingenerator\DemoBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class AdminMenu
{
    private $factory;

    /**
     * @param \Knp\Menu\FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }
    
    /**
     * @param Request $request
     * @param Router $router
     */
    public function createAdminMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');

        $menu->setCurrentUri($request->getRequestUri());
        
        $menu->setAttributes(array('id' => 'main_navigation', 'class'=>'menu'));

        //Propel demos
        $propel = $menu->addChild('Propel', array('uri' => '#'));
        $propel->setLinkAttributes(array('class'=>'sub main'));
        $propel->addChild('Movies', array('route' => 'PropelDemoBundle_list'));
        
        //Doctrine ORM demos
        $doctrine = $menu->addChild('Doctrine ORM', array('uri' => '#'));
        $doctrine->setLinkAttributes(array('class'=>'sub main'));
        $doctrine->addChild('Movies', array('route' => 'DemoBundle_list'));
        
        //Doctrine ODM demos
        $doctrine = $menu->addChild('Doctrine ODM', array('uri' => '#'));
        $doctrine->setLinkAttributes(array('class'=>'sub main'));
        $doctrine->addChild('Movies', array('route' => 'DoctrineODMDemoBundle_list'));
        $doctrine->addChild('Actors', array('route' => 'DoctrineODMDemoActorBundle_list'));
        
        //Help
        $help = $menu->addChild('Overwrite this menu', array('uri' => '#'));
        $help->setLinkAttributes(array('class'=>'sub main'));
        $help->addChild('Configure menu class', array('uri' => 'https://github.com/knplabs/KnpMenuBundle/blob/master/Resources/doc/index.md'));
        $help->addChild('Configure php class to use', array('uri' => 'https://github.com/cedriclombardot/AdmingeneratorGeneratorBundle/blob/master/Resources/doc/change-the-menu-class.markdown'));
        
        return $menu;
    }
}

