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

/* journal3/template/journal3/module/product_tabs.twig */
class __TwigTemplate_02722976a50fd4aaf61326bca2a427f831dfd0f803f32dff813e179053b9ddc2 extends \Twig\Template
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
        if ((($context["display"] ?? null) == "tabs")) {
            // line 2
            echo "  <div class=\"tabs-container ";
            echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => ($context["classes"] ?? null)], "method", false, false, false, 2);
            echo "\">
    <ul class=\"nav nav-tabs\">
      ";
            // line 4
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 5
                echo "        <li class=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "tab_classes", [], "any", false, false, false, 5)], "method", false, false, false, 5);
                echo "\">
          ";
                // line 6
                if ((twig_get_attribute($this->env, $this->source, $context["item"], "tabType", [], "any", false, false, false, 6) == "link")) {
                    // line 7
                    echo "            <a href=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 7), "href", [], "any", false, false, false, 7);
                    echo "\" ";
                    echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "linkAttrs", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 7)], "method", false, false, false, 7);
                    echo ">";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 7);
                    echo "</a>
          ";
                } else {
                    // line 9
                    echo "            <a href=\"#";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 9);
                    echo "\" data-toggle=\"tab\">";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 9);
                    echo "</a>
          ";
                }
                // line 11
                echo "        </li>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 13
            echo "    </ul>
    <div class=\"tab-content\">
      ";
            // line 15
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 16
                echo "        <div class=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "classes", [], "any", false, false, false, 16)], "method", false, false, false, 16);
                echo "\" id=\"";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 16);
                echo "\">
          <div class=\"block-body expand-block\">
            <div class=\"block-wrapper\">
              <div class=\"block-content ";
                // line 19
                if (twig_get_attribute($this->env, $this->source, $context["item"], "expandButton", [], "any", false, false, false, 19)) {
                    echo "expand-content";
                }
                echo "\">
                ";
                // line 20
                echo twig_get_attribute($this->env, $this->source, $context["item"], "content", [], "any", false, false, false, 20);
                echo "
                ";
                // line 21
                if (twig_get_attribute($this->env, $this->source, $context["item"], "expandButton", [], "any", false, false, false, 21)) {
                    // line 22
                    echo "                  <div class=\"block-expand-overlay\"><a class=\"block-expand btn\"></a></div>
                ";
                }
                // line 24
                echo "              </div>
            </div>
          </div>
        </div>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 29
            echo "    </div>
  </div>
";
        } elseif ((        // line 31
($context["display"] ?? null) == "accordion")) {
            // line 32
            echo "  <div class=\"panel-group ";
            echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => ($context["classes"] ?? null)], "method", false, false, false, 32);
            echo "\">
    ";
            // line 33
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 34
                echo "      <div class=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "classes", [], "any", false, false, false, 34)], "method", false, false, false, 34);
                echo "\">
        <div class=\"panel-heading\">
          <h4 class=\"panel-title\">
            <a href=\"#";
                // line 37
                echo twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 37);
                echo "\" class=\"accordion-toggle collapsed\" data-toggle=\"collapse\" aria-expanded=\"false\">
              ";
                // line 38
                echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 38);
                echo "
              <i class=\"fa fa-caret-down\"></i>
            </a>
          </h4>
        </div>
        <div class=\"";
                // line 43
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "panel_classes", [], "any", false, false, false, 43)], "method", false, false, false, 43);
                echo "\" id=\"";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 43);
                echo "\">
          <div class=\"block-body expand-block\">
            <div class=\"block-wrapper\">
              <div class=\"panel-body block-content ";
                // line 46
                if (twig_get_attribute($this->env, $this->source, $context["item"], "expandButton", [], "any", false, false, false, 46)) {
                    echo "expand-content";
                }
                echo "\">
                ";
                // line 47
                echo twig_get_attribute($this->env, $this->source, $context["item"], "content", [], "any", false, false, false, 47);
                echo "
                ";
                // line 48
                if (twig_get_attribute($this->env, $this->source, $context["item"], "expandButton", [], "any", false, false, false, 48)) {
                    // line 49
                    echo "                  <div class=\"block-expand-overlay\"><a class=\"block-expand btn\"></a></div>
                ";
                }
                // line 51
                echo "              </div>
            </div>
          </div>
        </div>
      </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 57
            echo "  </div>
";
        } else {
            // line 59
            echo "  <div class=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => ($context["classes"] ?? null)], "method", false, false, false, 59);
            echo "\">
    ";
            // line 60
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 61
                echo "      <div class=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "classes", [], "any", false, false, false, 61)], "method", false, false, false, 61);
                echo "\">
        ";
                // line 62
                if (twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 62)) {
                    // line 63
                    echo "        <h3 class=\"title module-title\">";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 63);
                    echo "</h3>
        ";
                }
                // line 65
                echo "        <div class=\"block-body expand-block\">
          <div class=\"block-wrapper\">
            <div class=\"block-content ";
                // line 67
                if (twig_get_attribute($this->env, $this->source, $context["item"], "expandButton", [], "any", false, false, false, 67)) {
                    echo "expand-content";
                }
                echo "\">
              ";
                // line 68
                echo twig_get_attribute($this->env, $this->source, $context["item"], "content", [], "any", false, false, false, 68);
                echo "
              ";
                // line 69
                if (twig_get_attribute($this->env, $this->source, $context["item"], "expandButton", [], "any", false, false, false, 69)) {
                    // line 70
                    echo "                <div class=\"block-expand-overlay\"><a class=\"block-expand btn\"></a></div>
              ";
                }
                // line 72
                echo "            </div>
          </div>
        </div>
      </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 77
            echo "  </div>
";
        }
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/module/product_tabs.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  249 => 77,  239 => 72,  235 => 70,  233 => 69,  229 => 68,  223 => 67,  219 => 65,  213 => 63,  211 => 62,  206 => 61,  202 => 60,  197 => 59,  193 => 57,  182 => 51,  178 => 49,  176 => 48,  172 => 47,  166 => 46,  158 => 43,  150 => 38,  146 => 37,  139 => 34,  135 => 33,  130 => 32,  128 => 31,  124 => 29,  114 => 24,  110 => 22,  108 => 21,  104 => 20,  98 => 19,  89 => 16,  85 => 15,  81 => 13,  74 => 11,  66 => 9,  56 => 7,  54 => 6,  49 => 5,  45 => 4,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/module/product_tabs.twig", "");
    }
}
