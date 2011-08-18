<?php

/* Admingenerated/AdmingeneratorDemoBundle/Resources/views/Edit/index.html.twig */
class __TwigTemplate_35f11e6769c8ff8c5c10664539c3132e extends Twig_Template
{
    protected $parent;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'list_title' => array($this, 'block_list_title'),
            'form' => array($this, 'block_form'),
            'body' => array($this, 'block_body'),
        );
    }

    public function getParent(array $context)
    {
        if (null === $this->parent) {
            $this->parent = $this->env->loadTemplate("AdmingeneratorGeneratorBundle::base_admin.html.twig");
        }

        return $this->parent;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $context = array_merge($this->env->getGlobals(), $context);

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_list_title($context, array $blocks = array())
    {
        echo "   
<head>
    <h1>You're editing the movie \"";
        // line 6
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, 'Movie'), "title", array(), "any", false), "html");
        echo "\"</h1>
</head>
";
    }

    // line 9
    public function block_form($context, array $blocks = array())
    {
        // line 10
        echo "<form 
";
        // line 11
        if ($this->getAttribute($this->getContext($context, 'Movie'), "id", array(), "any", false)) {
            // line 12
            echo "    action=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("DemoBundle_update", array("id" => $this->getAttribute($this->getContext($context, 'Movie'), "id", array(), "any", false))), "html");
            echo "\"
";
        } else {
            // line 14
            echo "    action=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("DemoBundle_create"), "html");
            echo "\"
";
        }
        // line 16
        echo " method=\"post\" ";
        echo $this->env->getExtension('form')->renderEnctype($this->getContext($context, 'form'));
        echo ">
    <fieldset class=\"form_block\">
        ";
        // line 18
        echo $this->env->getExtension('form')->renderErrors($this->getContext($context, 'form'));
        echo "
        <ul>
                    <li>
                ";
        // line 21
        echo $this->env->getExtension('form')->renderLabel($this->getAttribute($this->getContext($context, 'form'), "title", array(), "array", false));
        echo "
                ";
        // line 22
        echo $this->env->getExtension('form')->renderWidget($this->getAttribute($this->getContext($context, 'form'), "title", array(), "array", false));
        echo "
                ";
        // line 23
        echo $this->env->getExtension('form')->renderErrors($this->getAttribute($this->getContext($context, 'form'), "title", array(), "array", false));
        echo "
            </li>
                    <li>
                ";
        // line 26
        echo $this->env->getExtension('form')->renderLabel($this->getAttribute($this->getContext($context, 'form'), "is_published", array(), "array", false));
        echo "
                ";
        // line 27
        echo $this->env->getExtension('form')->renderWidget($this->getAttribute($this->getContext($context, 'form'), "is_published", array(), "array", false));
        echo "
                ";
        // line 28
        echo $this->env->getExtension('form')->renderErrors($this->getAttribute($this->getContext($context, 'form'), "is_published", array(), "array", false));
        echo "
            </li>
                    <li>
                 ";
        // line 31
        echo $this->env->getExtension('form')->renderRest($this->getContext($context, 'form'));
        echo "
                 <input type=\"submit\" class=\"submit_button\" value=\"Save\" />
            </li>
        </ul>
    </fieldset>
</form>
";
    }

    // line 4
    public function block_body($context, array $blocks = array())
    {
        $this->displayBlock('list_title', $context, $blocks);
        // line 9
        $this->displayBlock('form', $context, $blocks);
    }

    public function getTemplateName()
    {
        return "Admingenerated/AdmingeneratorDemoBundle/Resources/views/Edit/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
