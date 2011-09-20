<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            //Core
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\DoctrineBundle\DoctrineBundle(),
            new Symfony\Bundle\DoctrineMongoDBBundle\DoctrineMongoDBBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            //new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            //new JMS\AopBundle\JMSAopBundle(),
            
            //Menu
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            
            //Pager 
            new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
            
            //Generator
            new Admingenerator\GeneratorBundle\AdmingeneratorGeneratorBundle(),
            
            //Doctrine
            new Symfony\Bundle\DoctrineFixturesBundle\DoctrineFixturesBundle(),
            new Admingenerator\DemoBundle\AdmingeneratorDemoBundle(),
            
            //Doctrine MONGO
            new Admingenerator\DoctrineODMDemoBundle\AdmingeneratorDoctrineODMDemoBundle(),
            new Admingenerator\DoctrineODMDemoActorBundle\AdmingeneratorDoctrineODMDemoActorBundle(),
            
            //Propel
            new Propel\PropelBundle\PropelBundle(),
            new Admingenerator\PropelDemoBundle\AdmingeneratorPropelDemoBundle(),
            
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

       if (in_array($this->getEnvironment(), array('test'))) {
            $bundles[] = new Behat\BehatBundle\BehatBundle();
            $bundles[] = new Behat\MinkBundle\MinkBundle();
       }

       return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
