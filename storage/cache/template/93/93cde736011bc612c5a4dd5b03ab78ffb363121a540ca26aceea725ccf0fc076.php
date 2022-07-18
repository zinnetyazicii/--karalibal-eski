<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* journal3/template/journal3/module/icons_menu.twig */
class __TwigTemplate_b4adfdcae034f4a49abaaec3902464ffd58559e9457e9f9d093e6433ed32e953 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        if (($context["items"] ?? null)) {
            // line 2
            echo "  <div class=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => ($context["classes"] ?? null)], "method", false, false, false, 2);
            echo "\">
    ";
            // line 3
            if (($context["title"] ?? null)) {
                // line 4
                echo "      <h3 class=\"title module-title\">";
                echo ($context["title"] ?? null);
                echo "</h3>
    ";
            }
            // line 6
            echo "    <ul>
      ";
            // line 7
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 8
                echo "        <li class=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "classes", [], "any", false, false, false, 8)], "method", false, false, false, 8);
                echo "\">
          ";
                // line 9
                if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 9), "href", [], "any", false, false, false, 9)) {
                    // line 10
                    echo "            <a ";
                    if (($context["tooltipStatus"] ?? null)) {
                        echo "data-toggle=\"tooltip\" data-tooltip-class=\"icons-menu-tooltip-";
                        echo ($context["module_id"] ?? null);
                        echo "\" data-placement=\"";
                        echo ($context["tooltipPosition"] ?? null);
                        echo "\" title=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 10);
                        echo "\"";
                    }
                    echo " href=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 10), "href", [], "any", false, false, false, 10);
                    echo "\" ";
                    echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "linkAttrs", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 10)], "method", false, false, false, 10);
                    echo ">
              ";
                    // line 11
                    if ((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 11) == "image")) {
                        // line 12
                        echo "                <img src=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, false, 12);
                        echo "\" ";
                        if (twig_get_attribute($this->env, $this->source, $context["item"], "image2x", [], "any", false, false, false, 12)) {
                            echo " srcset=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, false, 12);
                            echo " 1x, ";
                            echo twig_get_attribute($this->env, $this->source, $context["item"], "image2x", [], "any", false, false, false, 12);
                            echo " 2x\" ";
                        }
                        echo " width=\"";
                        echo twig_get_attribute($this->env, $this->source, ($context["imageDimensions"] ?? null), "width", [], "any", false, false, false, 12);
                        echo "\" height=\"";
                        echo twig_get_attribute($this->env, $this->source, ($context["imageDimensions"] ?? null), "height", [], "any", false, false, false, 12);
                        echo "\" alt=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 12);
                        echo "\" class=\"info-block-img\"/>
              ";
                    }
                    // line 14
                    echo "              ";
                    echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "countBadge", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 14), 1 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 14), "total", [], "any", false, false, false, 14), 2 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 14), "classes", [], "any", false, false, false, 14)], "method", false, false, false, 14);
                    echo "
            </a>
          ";
                } else {
                    // line 17
                    echo "            <a>
              ";
                    // line 18
                    if ((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 18) == "image")) {
                        // line 19
                        echo "                <img src=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, false, 19);
                        echo "\" ";
                        if (twig_get_attribute($this->env, $this->source, $context["item"], "image2x", [], "any", false, false, false, 19)) {
                            echo " srcset=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, false, 19);
                            echo " 1x, ";
                            echo twig_get_attribute($this->env, $this->source, $context["item"], "image2x", [], "any", false, false, false, 19);
                            echo " 2x\" ";
                        }
                        echo " width=\"";
                        echo twig_get_attribute($this->env, $this->source, ($context["imageDimensions"] ?? null), "width", [], "any", false, false, false, 19);
                        echo "\" height=\"";
                        echo twig_get_attribute($this->env, $this->source, ($context["imageDimensions"] ?? null), "height", [], "any", false, false, false, 19);
                        echo "\" alt=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 19);
                        echo "\" class=\"info-block-img\"/>
              ";
                    }
                    // line 21
                    echo "              ";
                    echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "countBadge", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 21), 1 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 21), "total", [], "any", false, false, false, 21), 2 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 21), "classes", [], "any", false, false, false, 21)], "method", false, false, false, 21);
                    echo "
            </a>
          ";
                }
                // line 24
                echo "        </li>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 26
            echo "    </ul>
  </div>
";
        }
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/module/icons_menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  151 => 26,  144 => 24,  137 => 21,  117 => 19,  115 => 18,  112 => 17,  105 => 14,  85 => 12,  83 => 11,  66 => 10,  64 => 9,  59 => 8,  55 => 7,  52 => 6,  46 => 4,  44 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/module/icons_menu.twig", "");
    }
}
