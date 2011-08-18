<?php

/* Admingenerated/AdmingeneratorDemoBundle/Resources/views/List/index.html.twig */
class __TwigTemplate_8bb9f36092ed7dc260bb95257c5fec03 extends Twig_Template
{
    protected $parent;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'list_title' => array($this, 'block_list_title'),
            'list_thead' => array($this, 'block_list_thead'),
            'list_row' => array($this, 'block_list_row'),
            'list_object_actions' => array($this, 'block_list_object_actions'),
            'list_tbody' => array($this, 'block_list_tbody'),
            'list_paginator' => array($this, 'block_list_paginator'),
            'list_actions' => array($this, 'block_list_actions'),
            'list_filters' => array($this, 'block_list_filters'),
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
    <h1>Here is a beautifull title no  ???</h1>
</head>
";
    }

    // line 10
    public function block_list_thead($context, array $blocks = array())
    {
        echo "   
    <thead>
        <tr class=\"list_thead\">
        
                        
            <th class=\"list_thead_column\">
                                    ";
        // line 16
        if ((($this->getContext($context, 'sortColumn') == "id") && ($this->getContext($context, 'sortOrder') == "ASC"))) {
            // line 17
            echo "                        <a href=\"?sort=id&order_by=desc\">
                    ";
        } else {
            // line 19
            echo "                        <a href=\"?sort=id&order_by=asc\">
                    ";
        }
        // line 21
        echo "                                    Id
                                    </a>
                    ";
        // line 23
        if (($this->getContext($context, 'sortColumn') == "id")) {
            // line 24
            echo "                        <span class=\"arrow
                        ";
            // line 25
            if ((($this->getContext($context, 'sortColumn') == "id") && ($this->getContext($context, 'sortOrder') == "ASC"))) {
                // line 26
                echo "                            order_asc
                        ";
            } else {
                // line 28
                echo "                            order_desc
                        ";
            }
            // line 30
            echo "                        \"> </span>
                    ";
        }
        // line 32
        echo "                            </th>
            
                        
            <th class=\"list_thead_column\">
                                    ";
        // line 36
        if ((($this->getContext($context, 'sortColumn') == "title") && ($this->getContext($context, 'sortOrder') == "ASC"))) {
            // line 37
            echo "                        <a href=\"?sort=title&order_by=desc\">
                    ";
        } else {
            // line 39
            echo "                        <a href=\"?sort=title&order_by=asc\">
                    ";
        }
        // line 41
        echo "                                    Title
                                    </a>
                    ";
        // line 43
        if (($this->getContext($context, 'sortColumn') == "title")) {
            // line 44
            echo "                        <span class=\"arrow
                        ";
            // line 45
            if ((($this->getContext($context, 'sortColumn') == "title") && ($this->getContext($context, 'sortOrder') == "ASC"))) {
                // line 46
                echo "                            order_asc
                        ";
            } else {
                // line 48
                echo "                            order_desc
                        ";
            }
            // line 50
            echo "                        \"> </span>
                    ";
        }
        // line 52
        echo "                            </th>
            
                        
            <th class=\"list_thead_column\">
                                    ";
        // line 56
        if ((($this->getContext($context, 'sortColumn') == "is_published") && ($this->getContext($context, 'sortOrder') == "ASC"))) {
            // line 57
            echo "                        <a href=\"?sort=is_published&order_by=desc\">
                    ";
        } else {
            // line 59
            echo "                        <a href=\"?sort=is_published&order_by=asc\">
                    ";
        }
        // line 61
        echo "                                    Is published
                                    </a>
                    ";
        // line 63
        if (($this->getContext($context, 'sortColumn') == "is_published")) {
            // line 64
            echo "                        <span class=\"arrow
                        ";
            // line 65
            if ((($this->getContext($context, 'sortColumn') == "is_published") && ($this->getContext($context, 'sortOrder') == "ASC"))) {
                // line 66
                echo "                            order_asc
                        ";
            } else {
                // line 68
                echo "                            order_desc
                        ";
            }
            // line 70
            echo "                        \"> </span>
                    ";
        }
        // line 72
        echo "                            </th>
            
                        
                            <th class=\"actions\">Actions</th>
                    </tr>
    </thead>
";
    }

    // line 84
    public function block_list_row($context, array $blocks = array())
    {
        // line 85
        echo "            <td>
                            ";
        // line 86
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, 'Movie'), "id", array(), "any", false), "html");
        echo "
                    </td>
            <td>
                            ";
        // line 89
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, 'Movie'), "title", array(), "any", false), "html");
        echo "
                    </td>
            <td>
                ";
        // line 92
        if ($this->getAttribute($this->getContext($context, 'Movie'), "isPublished", array(), "any", false)) {
            // line 93
            echo "        <img src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/admingeneratorgenerator/images/tick.png"), "html");
            echo "\" alt=\"OK\" />
    ";
        } else {
            // line 95
            echo "        <img src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/admingeneratorgenerator/images/cross.png"), "html");
            echo "\" alt=\"KO\" />
    ";
        }
        // line 97
        echo "        </td>
    ";
    }

    // line 99
    public function block_list_object_actions($context, array $blocks = array())
    {
        // line 100
        echo "         <td class=\"actions\">
                    <a class=\"edit\" href=\"";
        // line 101
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("DemoBundle_edit", array("id" => $this->getAttribute($this->getContext($context, 'Movie'), "id", array(), "any", false))), "html");
        echo "\"> </a>
                    <a class=\"delete\" href=\"";
        // line 102
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("DemoBundle_delete", array("id" => $this->getAttribute($this->getContext($context, 'Movie'), "id", array(), "any", false))), "html");
        echo "\"> </a>
             </td>
    ";
    }

    // line 79
    public function block_list_tbody($context, array $blocks = array())
    {
        // line 80
        echo "    <tbody>
        ";
        // line 81
        if ((twig_length_filter($this->env, $this->getContext($context, 'Movies')) > 0)) {
            // line 82
            echo "         
        ";
            // line 83
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, 'Movies'));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context['_key'] => $context['Movie']) {
                // line 84
                echo "        <tr class=\"list_trow\">";
                $this->displayBlock('list_row', $context, $blocks);
                // line 99
                $this->displayBlock('list_object_actions', $context, $blocks);
                // line 105
                echo "</tr>
        ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['Movie'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 107
            echo "        
        ";
        } else {
            // line 109
            echo "        <tr class=\"list_trow no_results_row\">
            <td colspan=\"4\">There is no results</td>
        </tr>
        ";
        }
        // line 113
        echo "    </tbody>
";
    }

    // line 115
    public function block_list_paginator($context, array $blocks = array())
    {
        // line 116
        echo "    <div class=\"pagination\">
        ";
        // line 117
        echo $this->env->getExtension('pagerfanta')->renderPagerfanta($this->getContext($context, 'Movies'), "admingenerator");
        echo "
    </div>
";
    }

    // line 120
    public function block_list_actions($context, array $blocks = array())
    {
        // line 121
        echo "         <ul class=\"actions\">
                    <li><a class=\"new\" href=\"";
        // line 122
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("DemoBundle_new"), "html");
        echo "\">New</a></li>
             </ul>
    ";
    }

    // line 135
    public function block_list_filters($context, array $blocks = array())
    {
        // line 136
        echo "<form action=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("DemoBundle_filters"), "html");
        echo "\" method=\"post\" ";
        echo $this->env->getExtension('form')->renderEnctype($this->getContext($context, 'form'));
        echo ">
    <fieldset class=\"form_block\">
        ";
        // line 138
        echo $this->env->getExtension('form')->renderErrors($this->getContext($context, 'form'));
        echo "
        <ul>
                    <li>
                ";
        // line 141
        echo $this->env->getExtension('form')->renderLabel($this->getAttribute($this->getContext($context, 'form'), "title", array(), "array", false));
        echo "
                ";
        // line 142
        echo $this->env->getExtension('form')->renderWidget($this->getAttribute($this->getContext($context, 'form'), "title", array(), "array", false));
        echo "
                ";
        // line 143
        echo $this->env->getExtension('form')->renderErrors($this->getAttribute($this->getContext($context, 'form'), "title", array(), "array", false));
        echo "
            </li>
                    <li>
                ";
        // line 146
        echo $this->env->getExtension('form')->renderLabel($this->getAttribute($this->getContext($context, 'form'), "is_published", array(), "array", false));
        echo "
                ";
        // line 147
        echo $this->env->getExtension('form')->renderWidget($this->getAttribute($this->getContext($context, 'form'), "is_published", array(), "array", false));
        echo "
                ";
        // line 148
        echo $this->env->getExtension('form')->renderErrors($this->getAttribute($this->getContext($context, 'form'), "is_published", array(), "array", false));
        echo "
            </li>
                    <li>
                 ";
        // line 151
        echo $this->env->getExtension('form')->renderRest($this->getContext($context, 'form'));
        echo "
                 <input type=\"submit\" class=\"submit_button\" value=\"Filter\" />
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
        echo "<div class=\"main_content\">
        <table>";
        // line 10
        $this->displayBlock('list_thead', $context, $blocks);
        // line 78
        echo "   
";
        // line 79
        $this->displayBlock('list_tbody', $context, $blocks);
        // line 114
        echo "   
</table>";
        // line 115
        $this->displayBlock('list_paginator', $context, $blocks);
        // line 120
        $this->displayBlock('list_actions', $context, $blocks);
        // line 125
        echo "</div>
    <div class=\"filters\">
        <table>
            <thead>
                <tr>
                    <th>Filters</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>";
        // line 135
        $this->displayBlock('list_filters', $context, $blocks);
        // line 158
        echo "</td>
                </tr>
            </tbody>
        </table>
    </div>    
";
    }

    public function getTemplateName()
    {
        return "Admingenerated/AdmingeneratorDemoBundle/Resources/views/List/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
