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

/* journal3/template/journal3/category_grid.twig */
class __TwigTemplate_63af10c68bb868134d82ad5214c75853c3f510e378fb243556112c613789bbf5 extends \Twig\Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 2
            echo "  <div class=\"category-layout ";
            echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["category"], "classes", [], "any", false, false, false, 2)], "method", false, false, false, 2);
            echo "\">
    <div class=\"category-thumb\">
      ";
            // line 4
            if (($context["images"] ?? null)) {
                // line 5
                echo "      <div class=\"image\">
        <a href=\"";
                // line 6
                echo twig_get_attribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 6);
                echo "\">
          ";
                // line 7
                if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 7), "get", [0 => "performanceLazyLoadImagesStatus"], "method", false, false, false, 7)) {
                    // line 8
                    echo "            <img src=\"";
                    echo ($context["dummy_image"] ?? null);
                    echo "\" data-src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "thumb", [], "any", false, false, false, 8);
                    echo "\" ";
                    if (twig_get_attribute($this->env, $this->source, $context["category"], "thumb2x", [], "any", false, false, false, 8)) {
                        echo "data-srcset=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["category"], "thumb", [], "any", false, false, false, 8);
                        echo " 1x, ";
                        echo twig_get_attribute($this->env, $this->source, $context["category"], "thumb2x", [], "any", false, false, false, 8);
                        echo " 2x\" ";
                    }
                    echo " width=\"";
                    echo ($context["image_width"] ?? null);
                    echo "\" height=\"";
                    echo ($context["image_height"] ?? null);
                    echo "\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 8);
                    echo "\" title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 8);
                    echo "\" class=\"img-responsive lazyload\"/>
          ";
                } else {
                    // line 10
                    echo "            <img src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "thumb", [], "any", false, false, false, 10);
                    echo "\" ";
                    if (twig_get_attribute($this->env, $this->source, $context["category"], "thumb2x", [], "any", false, false, false, 10)) {
                        echo "srcset=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["category"], "thumb", [], "any", false, false, false, 10);
                        echo " 1x, ";
                        echo twig_get_attribute($this->env, $this->source, $context["category"], "thumb2x", [], "any", false, false, false, 10);
                        echo " 2x\" ";
                    }
                    echo " width=\"";
                    echo ($context["image_width"] ?? null);
                    echo "\" height=\"";
                    echo ($context["image_height"] ?? null);
                    echo "\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 10);
                    echo "\" title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 10);
                    echo "\" class=\"img-responsive\"/>
          ";
                }
                // line 12
                echo "        </a>
      </div>
      ";
            }
            // line 15
            echo "
      <div class=\"caption\">
        <div class=\"name\"><a href=\"";
            // line 17
            echo twig_get_attribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 17);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 17);
            echo "</a></div>

        <div class=\"description\">";
            // line 19
            echo twig_get_attribute($this->env, $this->source, $context["category"], "description", [], "any", false, false, false, 19);
            echo "</div>

        <div class=\"button-group\">
          <a class=\"btn btn-view-more\" href=\"";
            // line 22
            echo twig_get_attribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 22);
            echo "\" ";
            if (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 22), "getIn", [0 => "CategoryButtonDisplay", 1 => $context], "method", false, false, false, 22) == "icon") && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 22), "getIn", [0 => "CategoryButtonTooltipStatus", 1 => $context], "method", false, false, false, 22))) {
                echo " data-toggle=\"tooltip\" data-tooltip-class=\"";
                echo ((($context["module_id"] ?? null)) ? ((("module-categories-" . ($context["module_id"] ?? null)) . " module-categories-grid")) : ("category-grid"));
                echo " view-more-tooltip\" data-placement=\"";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 22), "getIn", [0 => "CategoryButtonTooltipPosition", 1 => $context], "method", false, false, false, 22);
                echo "\" title=\"";
                echo ($context["viewMoreText"] ?? null);
                echo "\" ";
            }
            echo ">
            <span class=\"btn-text\">";
            // line 23
            echo ($context["viewMoreText"] ?? null);
            echo "</span>
          </a>
        </div>
      </div>
    </div>
  </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/category_grid.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  140 => 23,  126 => 22,  120 => 19,  113 => 17,  109 => 15,  104 => 12,  82 => 10,  58 => 8,  56 => 7,  52 => 6,  49 => 5,  47 => 4,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/category_grid.twig", "C:\\wamp64\\www\\catalog\\view\\theme\\journal3\\template\\journal3\\category_grid.twig");
    }
}
