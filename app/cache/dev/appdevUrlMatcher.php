<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appdevUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appdevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = urldecode($pathinfo);

        // _welcome
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', '_welcome');
            }
            return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\WelcomeController::indexAction',  '_route' => '_welcome',);
        }

        // _demo_login
        if ($pathinfo === '/demo/secured/login') {
            return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::loginAction',  '_route' => '_demo_login',);
        }

        // _security_check
        if ($pathinfo === '/demo/secured/login_check') {
            return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::securityCheckAction',  '_route' => '_security_check',);
        }

        // _demo_logout
        if ($pathinfo === '/demo/secured/logout') {
            return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::logoutAction',  '_route' => '_demo_logout',);
        }

        // acme_demo_secured_hello
        if ($pathinfo === '/demo/secured/hello') {
            return array (  'name' => 'World',  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::helloAction',  '_route' => 'acme_demo_secured_hello',);
        }

        // _demo_secured_hello
        if (0 === strpos($pathinfo, '/demo/secured/hello') && preg_match('#^/demo/secured/hello/(?P<name>[^/]+?)$#x', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::helloAction',)), array('_route' => '_demo_secured_hello'));
        }

        // _demo_secured_hello_admin
        if (0 === strpos($pathinfo, '/demo/secured/hello/admin') && preg_match('#^/demo/secured/hello/admin/(?P<name>[^/]+?)$#x', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::helloadminAction',)), array('_route' => '_demo_secured_hello_admin'));
        }

        if (0 === strpos($pathinfo, '/demo')) {
            // _demo
            if (rtrim($pathinfo, '/') === '/demo') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_demo');
                }
                return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\DemoController::indexAction',  '_route' => '_demo',);
            }

            // _demo_hello
            if (0 === strpos($pathinfo, '/demo/hello') && preg_match('#^/demo/hello/(?P<name>[^/]+?)$#x', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Acme\\DemoBundle\\Controller\\DemoController::helloAction',)), array('_route' => '_demo_hello'));
            }

            // _demo_contact
            if ($pathinfo === '/demo/contact') {
                return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\DemoController::contactAction',  '_route' => '_demo_contact',);
            }

        }

        // _assetic_19874bd
        if ($pathinfo === '/css/19874bd.css') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => '19874bd',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_19874bd',);
        }

        // _assetic_19874bd_0
        if ($pathinfo === '/css/19874bd_screen_1.css') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => '19874bd',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_19874bd_0',);
        }

        // _assetic_19874bd_1
        if ($pathinfo === '/css/19874bd_menu_2.css') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => '19874bd',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_19874bd_1',);
        }

        // _assetic_c9001be
        if ($pathinfo === '/css/c9001be.css') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => 'c9001be',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_c9001be',);
        }

        // _assetic_c9001be_0
        if ($pathinfo === '/css/c9001be_ie_1.css') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => 'c9001be',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_c9001be_0',);
        }

        // _assetic_2642646
        if ($pathinfo === '/js/2642646.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => 2642646,  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_2642646',);
        }

        // _assetic_2642646_0
        if ($pathinfo === '/js/2642646_menu_1.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => 2642646,  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_2642646_0',);
        }

        // _wdt
        if (preg_match('#^/_wdt/(?P<token>[^/]+?)$#x', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::toolbarAction',)), array('_route' => '_wdt'));
        }

        if (0 === strpos($pathinfo, '/_profiler')) {
            // _profiler_search
            if ($pathinfo === '/_profiler/search') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchAction',  '_route' => '_profiler_search',);
            }

            // _profiler_purge
            if ($pathinfo === '/_profiler/purge') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::purgeAction',  '_route' => '_profiler_purge',);
            }

            // _profiler_import
            if ($pathinfo === '/_profiler/import') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::importAction',  '_route' => '_profiler_import',);
            }

            // _profiler_export
            if (0 === strpos($pathinfo, '/_profiler/export') && preg_match('#^/_profiler/export/(?P<token>[^/\\.]+?)\\.txt$#x', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::exportAction',)), array('_route' => '_profiler_export'));
            }

            // _profiler_search_results
            if (preg_match('#^/_profiler/(?P<token>[^/]+?)/search/results$#x', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchResultsAction',)), array('_route' => '_profiler_search_results'));
            }

            // _profiler
            if (preg_match('#^/_profiler/(?P<token>[^/]+?)$#x', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::panelAction',)), array('_route' => '_profiler'));
            }

        }

        if (0 === strpos($pathinfo, '/_configurator')) {
            // _configurator_home
            if (rtrim($pathinfo, '/') === '/_configurator') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_configurator_home');
                }
                return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
            }

            // _configurator_step
            if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]+?)$#x', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',)), array('_route' => '_configurator_step'));
            }

            // _configurator_final
            if ($pathinfo === '/_configurator/final') {
                return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
            }

        }

        if (0 === strpos($pathinfo, '/admin-demo')) {
            // DemoBundle_list
            if (rtrim($pathinfo, '/') === '/admin-demo') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'DemoBundle_list');
                }
                return array (  '_controller' => 'Admingenerator\\DemoBundle\\Controller\\ListController::indexAction',  '_route' => 'DemoBundle_list',);
            }

            // DemoBundle_delete
            if (preg_match('#^/admin\\-demo/(?P<id>[^/]+?)/delete$#x', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Admingenerator\\DemoBundle\\Controller\\DeleteController::indexAction',)), array('_route' => 'DemoBundle_delete'));
            }

            // DemoBundle_edit
            if (preg_match('#^/admin\\-demo/(?P<id>[^/]+?)/edit$#x', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Admingenerator\\DemoBundle\\Controller\\EditController::indexAction',)), array('_route' => 'DemoBundle_edit'));
            }

            // DemoBundle_update
            if (preg_match('#^/admin\\-demo/(?P<id>[^/]+?)/update$#x', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Admingenerator\\DemoBundle\\Controller\\EditController::updateAction',)), array('_route' => 'DemoBundle_update'));
            }

            // DemoBundle_new
            if ($pathinfo === '/admin-demo/new') {
                return array (  '_controller' => 'Admingenerator\\DemoBundle\\Controller\\NewController::indexAction',  '_route' => 'DemoBundle_new',);
            }

            // DemoBundle_create
            if ($pathinfo === '/admin-demo/create') {
                return array (  '_controller' => 'Admingenerator\\DemoBundle\\Controller\\NewController::createAction',  '_route' => 'DemoBundle_create',);
            }

            // DemoBundle_filters
            if ($pathinfo === '/admin-demo/filter') {
                return array (  '_controller' => 'Admingenerator\\DemoBundle\\Controller\\ListController::filtersAction',  '_route' => 'DemoBundle_filters',);
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
