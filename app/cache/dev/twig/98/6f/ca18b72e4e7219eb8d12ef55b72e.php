<?php

/* AdmingeneratorDemoBundle:List:index.html.twig */
class __TwigTemplate_986fca18b72e4e7219eb8d12ef55b72e extends Twig_Template
{
    protected $parent;

    public function getParent(array $context)
    {
        if (null === $this->parent) {
            $this->parent = $this->env->loadTemplate("Admingenerated/AdmingeneratorDemoBundle/Resources/views/List/index.html.twig");
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
        return "AdmingeneratorDemoBundle:List:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
