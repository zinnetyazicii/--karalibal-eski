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

/* journal3/template/journal3/manufacturer_grid.twig */
class __TwigTemplate_e3b0fb636c584aab6e61846db61a97f6574bf35ef30a60b188252fe288fcb808 extends \Twig\Template
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
        $context['_seq'] = twig_ensure_traversable(($context["manufacturers"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["manufacturer"]) {
            // line 2
            echo "  <div class=\"manufacturer-layout ";
            echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["manufacturer"], "classes", [], "any", false, false, false, 2)], "method", false, false, false, 2);
            echo "\">
    <div class=\"manufacturer-thumb\">
      <div class=\"image\">
        <a href=\"";
            // line 5
            echo twig_get_attribute($this->env, $this->source, $context["manufacturer"], "href", [], "any", false, false, false, 5);
            echo "\">
          ";
            // line 6
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 6), "get", [0 => "performanceLazyLoadImagesStatus"], "method", false, false, false, 6)) {
                // line 7
                echo "            <img src=\"";
                echo ($context["dummy_image"] ?? null);
                echo "\" data-src=\"";
                echo twig_get_attribute($this->env, $this->source, $context["manufacturer"], "thumb", [], "any", false, false, false, 7);
                echo "\" ";
                if (twig_get_attribute($this->env, $this->source, $context["manufacturer"], "thumb2x", [], "any", false, false, false, 7)) {
                    echo "data-srcset=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["manufacturer"], "thumb", [], "any", false, false, false, 7);
                    echo " 1x, ";
                    echo twig_get_attribute($this->env, $this->source, $context["manufacturer"], "thumb2x", [], "any", false, false, false, 7);
                    echo " 2x\" ";
                }
                echo " width=\"";
                echo ($context["image_width"] ?? null);
                echo "\" height=\"";
                echo ($context["image_height"] ?? null);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["manufacturer"], "name", [], "any", false, false, false, 7);
                echo "\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["manufacturer"], "name", [], "any", false, false, false, 7);
                echo "\" class=\"lazyload\"/>
          ";
            } else {
                // line 9
                echo "            <img src=\"";
                echo twig_get_attribute($this->env, $this->source, $context["manufacturer"], "thumb", [], "any", false, false, false, 9);
                echo "\" ";
                if (twig_get_attribute($this->env, $this->source, $context["manufacturer"], "thumb2x", [], "any", false, false, false, 9)) {
                    echo " srcset=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["manufacturer"], "thumb", [], "any", false, false, false, 9);
                    echo " 1x, ";
                    echo twig_get_attribute($this->env, $this->source, $context["manufacturer"], "thumb2x", [], "any", false, false, false, 9);
                    echo " 2x\" ";
                }
                echo " width=\"";
                echo ($context["image_width"] ?? null);
                echo "\" height=\"";
                echo ($context["image_height"] ?? null);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["manufacturer"], "name", [], "any", false, false, false, 9);
                echo "\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["manufacturer"], "name", [], "any", false, false, false, 9);
                echo "\"/>
          ";
            }
            // line 11
            echo "        </a>
      </div>

      <div class=\"caption\">
        <div class=\"name\"><a href=\"";
            // line 15
            echo twig_get_attribute($this->env, $this->source, $context["manufacturer"], "href", [], "any", false, false, false, 15);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["manufacturer"], "name", [], "any", false, false, false, 15);
            echo "</a></div>
      </div>
    </div>
  </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['manufacturer'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/manufacturer_grid.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  106 => 15,  100 => 11,  78 => 9,  54 => 7,  52 => 6,  48 => 5,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/manufacturer_grid.twig", "C:\\wamp64\\www\\catalog\\view\\theme\\journal3\\template\\journal3\\manufacturer_grid.twig");
    }
}
