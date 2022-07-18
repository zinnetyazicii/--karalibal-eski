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

/* journal3/template/journal3/module/info_blocks.twig */
class __TwigTemplate_6dca7d3ef1930eeb85530d5166eede5a046402626770760d11f7cd78428bf14b extends \Twig\Template
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
        echo "<div class=\"";
        echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => ($context["classes"] ?? null)], "method", false, false, false, 1);
        echo "\">
  <div class=\"module-body\">
    ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 4
            echo "      <div class=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "classes", [], "any", false, false, false, 4)], "method", false, false, false, 4);
            echo "\">
        ";
            // line 5
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 5), "href", [], "any", false, false, false, 5)) {
                // line 6
                echo "          <a href=\"";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 6), "href", [], "any", false, false, false, 6);
                echo "\" class=\"info-block\" ";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "linkAttrs", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 6)], "method", false, false, false, 6);
                echo ">
            ";
                // line 7
                if ((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 7) == "image")) {
                    // line 8
                    echo "              <img src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, false, 8);
                    echo "\" ";
                    if (twig_get_attribute($this->env, $this->source, $context["item"], "image2x", [], "any", false, false, false, 8)) {
                        echo " srcset=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, false, 8);
                        echo " 1x, ";
                        echo twig_get_attribute($this->env, $this->source, $context["item"], "image2x", [], "any", false, false, false, 8);
                        echo " 2x\" ";
                    }
                    echo " width=\"";
                    echo twig_get_attribute($this->env, $this->source, ($context["imageDimensions"] ?? null), "width", [], "any", false, false, false, 8);
                    echo "\" height=\"";
                    echo twig_get_attribute($this->env, $this->source, ($context["imageDimensions"] ?? null), "height", [], "any", false, false, false, 8);
                    echo "\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 8);
                    echo "\" class=\"info-block-img\"/>
            ";
                }
                // line 10
                echo "            <div class=\"info-block-content\">
              <div class=\"info-block-title\">";
                // line 11
                echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 11);
                echo "</div>
              <div class=\"info-block-text\">";
                // line 12
                echo twig_get_attribute($this->env, $this->source, $context["item"], "content", [], "any", false, false, false, 12);
                echo "</div>
            </div>
            ";
                // line 14
                if ( !(null === twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 14), "total", [], "any", false, false, false, 14))) {
                    // line 15
                    echo "              <span class=\"count-badge\">";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 15), "total", [], "any", false, false, false, 15);
                    echo "</span>
            ";
                }
                // line 17
                echo "          </a>
        ";
            } else {
                // line 19
                echo "          <div class=\"info-block\">
            ";
                // line 20
                if ((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 20) == "image")) {
                    // line 21
                    echo "              <img src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, false, 21);
                    echo "\" ";
                    if (twig_get_attribute($this->env, $this->source, $context["item"], "image2x", [], "any", false, false, false, 21)) {
                        echo " srcset=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, false, 21);
                        echo " 1x, ";
                        echo twig_get_attribute($this->env, $this->source, $context["item"], "image2x", [], "any", false, false, false, 21);
                        echo " 2x\" ";
                    }
                    echo " width=\"";
                    echo twig_get_attribute($this->env, $this->source, ($context["imageDimensions"] ?? null), "width", [], "any", false, false, false, 21);
                    echo "\" height=\"";
                    echo twig_get_attribute($this->env, $this->source, ($context["imageDimensions"] ?? null), "height", [], "any", false, false, false, 21);
                    echo "\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 21);
                    echo "\" class=\"info-block-img\"/>
            ";
                }
                // line 23
                echo "            <div class=\"info-block-content\">
              <div class=\"info-block-title\">";
                // line 24
                echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 24);
                echo "</div>
              <div class=\"info-block-text\">";
                // line 25
                echo twig_get_attribute($this->env, $this->source, $context["item"], "content", [], "any", false, false, false, 25);
                echo "</div>
            </div>
          </div>
        ";
            }
            // line 29
            echo "      </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 31
        echo "  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/module/info_blocks.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  153 => 31,  146 => 29,  139 => 25,  135 => 24,  132 => 23,  112 => 21,  110 => 20,  107 => 19,  103 => 17,  97 => 15,  95 => 14,  90 => 12,  86 => 11,  83 => 10,  63 => 8,  61 => 7,  54 => 6,  52 => 5,  47 => 4,  43 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/module/info_blocks.twig", "");
    }
}
