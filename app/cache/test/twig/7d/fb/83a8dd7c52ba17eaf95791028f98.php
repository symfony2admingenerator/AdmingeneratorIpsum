<?php

/* AdmingeneratorDemoBundle:New:index.html.twig */
class __TwigTemplate_7dfb83a8dd7c52ba17eaf95791028f98 extends Twig_Template
{
    protected $parent;

    public function getParent(array $context)
    {
        if (null === $this->parent) {
            $this->parent = $this->env->loadTemplate("Admingenerated/AdmingeneratorDemoBundle/Resources/views/New/index.html.twig");
        }

        return $this->parent;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $context = array_merge($this->env->getGlobals(), $context);

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    public function getTemplateName()
    {
        return "AdmingeneratorDemoBundle:New:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
