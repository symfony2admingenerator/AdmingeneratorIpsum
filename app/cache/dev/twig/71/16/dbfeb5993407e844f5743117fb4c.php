<?php

/* AdmingeneratorDemoBundle:Edit:index.html.twig */
class __TwigTemplate_7116dbfeb5993407e844f5743117fb4c extends Twig_Template
{
    protected $parent;

    public function getParent(array $context)
    {
        if (null === $this->parent) {
            $this->parent = $this->env->loadTemplate("Admingenerated/AdmingeneratorDemoBundle/Resources/views/Edit/index.html.twig");
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
        return "AdmingeneratorDemoBundle:Edit:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
