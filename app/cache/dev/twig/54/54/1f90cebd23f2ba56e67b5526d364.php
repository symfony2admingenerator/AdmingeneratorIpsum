<?php

/* AdmingeneratorGeneratorBundle::base_admin.html.twig */
class __TwigTemplate_54541f90cebd23f2ba56e67b5526d364 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'logo' => array($this, 'block_logo'),
            'profile' => array($this, 'block_profile'),
            'menu' => array($this, 'block_menu'),
            'header' => array($this, 'block_header'),
            'flashes' => array($this, 'block_flashes'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $context = array_merge($this->env->getGlobals(), $context);

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 19
        echo "        <link rel=\"shortcut icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html");
        echo "\" />
    </head>
    <body>
        <div id=\"header\">
            ";
        // line 23
        $this->displayBlock('header', $context, $blocks);
        // line 60
        echo "        </div>
        <div id=\"content\">
            ";
        // line 62
        $this->displayBlock('flashes', $context, $blocks);
        // line 74
        echo "            
            ";
        // line 75
        $this->displayBlock('body', $context, $blocks);
        // line 76
        echo "        </div>
        ";
        // line 77
        $this->displayBlock('javascripts', $context, $blocks);
        // line 87
        echo "    </body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Admin";
    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 7
        echo "            ";
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "19874bd_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_19874bd_0") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/19874bd_screen_1.css");
            // line 11
            echo "                <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, 'asset_url'), "html");
            echo "\" type=\"text/css\" media=\"all\" />
            ";
            // asset "19874bd_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_19874bd_1") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/19874bd_menu_2.css");
            echo "                <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, 'asset_url'), "html");
            echo "\" type=\"text/css\" media=\"all\" />
            ";
        } else {
            // asset "19874bd"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_19874bd") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/19874bd.css");
            echo "                <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, 'asset_url'), "html");
            echo "\" type=\"text/css\" media=\"all\" />
            ";
        }
        unset($context["asset_url"]);
        // line 13
        echo "            <!--[if IE]>
                ";
        // line 14
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "c9001be_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_c9001be_0") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/c9001be_ie_1.css");
            // line 15
            echo "                     <link href=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, 'asset_url'), "html");
            echo "\" rel=\"stylesheet\" type=\"text/css\" />
                ";
        } else {
            // asset "c9001be"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_c9001be") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/c9001be.css");
            echo "                     <link href=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, 'asset_url'), "html");
            echo "\" rel=\"stylesheet\" type=\"text/css\" />
                ";
        }
        unset($context["asset_url"]);
        // line 17
        echo "            <![endif]-->
        ";
    }

    // line 24
    public function block_logo($context, array $blocks = array())
    {
        // line 25
        echo "                <div class=\"logo\">
                    Admin
                </div>
                ";
    }

    // line 29
    public function block_profile($context, array $blocks = array())
    {
        // line 30
        echo "                <div class=\"profile\">
                    <ul>
                        <li>
                            <a href=\"#\">Welcome</a>
                        </li>
                        <li>
                            <a class='logout' href=\"#\">Log out will be connect to security</a>
                        </li>
                    </ul>
                </div>
                ";
    }

    // line 41
    public function block_menu($context, array $blocks = array())
    {
        // line 42
        echo "                <ul class=\"menu\" id=\"main_navigation\">
                    <li>
                        <a href=\"#\" class=\"sub main\">Will use KnpMenuBundle</a>
                        <ul>
                            <li class=\"topline\"><a href=\"#\">Navigation Item 1</a></li>
                            <li class=\"spacer\"><!-- --></li>
                            <li><a href=\"#\">Navigation Item 2</a></li>
                            <li class=\"spacer\"><!-- --></li>
                            <li><a href=\"#\">Navigation Item 3</a></li>
                            <li class=\"spacer\"><!-- --></li>
                            <li><a href=\"#\">Navigation Item 4</a></li>
                            <li class=\"spacer\"><!-- --></li>
                            <li><a href=\"#\">Navigation Item 5</a></li>
                        </ul>
                    </li>
                </ul>
                ";
    }

    // line 23
    public function block_header($context, array $blocks = array())
    {
        // line 24
        echo "                ";
        $this->displayBlock('logo', $context, $blocks);
        // line 29
        echo "                ";
        $this->displayBlock('profile', $context, $blocks);
        // line 41
        echo "                ";
        $this->displayBlock('menu', $context, $blocks);
        // line 59
        echo "            ";
    }

    // line 62
    public function block_flashes($context, array $blocks = array())
    {
        // line 63
        echo "                ";
        if ($this->getAttribute($this->getAttribute($this->getContext($context, 'app'), "session", array(), "any", false), "flash", array("success", ), "method", false)) {
            // line 64
            echo "                    <div class=\"notification_box success\">
                        ";
            // line 65
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, 'app'), "session", array(), "any", false), "flash", array("success", ), "method", false), "html");
            echo "
                    </div>
                ";
        }
        // line 68
        echo "                ";
        if ($this->getAttribute($this->getAttribute($this->getContext($context, 'app'), "session", array(), "any", false), "flash", array("error", ), "method", false)) {
            // line 69
            echo "                    <div class=\"notification_box error\">
                        ";
            // line 70
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, 'app'), "session", array(), "any", false), "flash", array("error", ), "method", false), "html");
            echo "
                    </div>
                ";
        }
        // line 73
        echo "            ";
    }

    // line 75
    public function block_body($context, array $blocks = array())
    {
    }

    // line 77
    public function block_javascripts($context, array $blocks = array())
    {
        // line 78
        echo "            ";
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "2642646_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_2642646_0") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/2642646_menu_1.js");
            // line 80
            echo "                <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, 'asset_url'), "html");
            echo "\"></script>
            ";
        } else {
            // asset "2642646"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_2642646") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/2642646.js");
            echo "                <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, 'asset_url'), "html");
            echo "\"></script>
            ";
        }
        unset($context["asset_url"]);
        // line 82
        echo "            <script type=\"text/javascript\">
                var menu=new menu.dd(\"menu\");
                menu.init(\"main_navigation\",\"mainhover\");
            </script>
        ";
    }

    public function getTemplateName()
    {
        return "AdmingeneratorGeneratorBundle::base_admin.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
