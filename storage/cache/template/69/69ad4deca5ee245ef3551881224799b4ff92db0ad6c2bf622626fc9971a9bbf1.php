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

/* journal3/template/common/currency.twig */
class __TwigTemplate_7df6aa67150c896f08a7093118625815e7b164c34186f99358610bf1b08561e5 extends \Twig\Template
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
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 1), "get", [0 => "catalogCurrencyStatus"], "method", false, false, false, 1)) {
            // line 2
            if ((twig_length_filter($this->env, ($context["currencies"] ?? null)) > 1)) {
                // line 3
                echo "  ";
                $context["current_currency"] = null;
                // line 4
                echo "  ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["currencies"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["currency"]) {
                    // line 5
                    echo "    ";
                    if ((twig_get_attribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 5) == ($context["code"] ?? null))) {
                        // line 6
                        echo "      ";
                        $context["current_currency"] = $context["currency"];
                        // line 7
                        echo "    ";
                    }
                    // line 8
                    echo "  ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['currency'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 9
                echo "  <div id=\"currency\" class=\"currency\">
    <form action=\"";
                // line 10
                echo ($context["action"] ?? null);
                echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-currency\">
      <div class=\"dropdown drop-menu\">
        <button type=\"button\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
          <span class=\"currency-symbol-title\">
            ";
                // line 14
                if (twig_get_attribute($this->env, $this->source, ($context["current_currency"] ?? null), "symbol_left", [], "any", false, false, false, 14)) {
                    // line 15
                    echo "              <span class=\"symbol\">";
                    echo twig_get_attribute($this->env, $this->source, ($context["current_currency"] ?? null), "symbol_left", [], "any", false, false, false, 15);
                    echo "</span>
              <span class=\"currency-title\">";
                    // line 16
                    echo twig_get_attribute($this->env, $this->source, ($context["current_currency"] ?? null), "title", [], "any", false, false, false, 16);
                    echo "</span>
              <span class=\"currency-code\">";
                    // line 17
                    echo twig_get_attribute($this->env, $this->source, ($context["current_currency"] ?? null), "code", [], "any", false, false, false, 17);
                    echo "</span>
            ";
                } else {
                    // line 19
                    echo "              <span class=\"symbol\">";
                    echo twig_get_attribute($this->env, $this->source, ($context["current_currency"] ?? null), "symbol_right", [], "any", false, false, false, 19);
                    echo "</span>
              <span class=\"currency-title\">";
                    // line 20
                    echo twig_get_attribute($this->env, $this->source, ($context["current_currency"] ?? null), "title", [], "any", false, false, false, 20);
                    echo "</span>
              <span class=\"currency-code\">";
                    // line 21
                    echo twig_get_attribute($this->env, $this->source, ($context["current_currency"] ?? null), "code", [], "any", false, false, false, 21);
                    echo "</span>
            ";
                }
                // line 23
                echo "          </span>
        </button>
        <div class=\"dropdown-menu j-dropdown\">
          <ul class=\"j-menu\">
            ";
                // line 27
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["currencies"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["currency"]) {
                    // line 28
                    echo "              ";
                    if (twig_get_attribute($this->env, $this->source, $context["currency"], "symbol_left", [], "any", false, false, false, 28)) {
                        // line 29
                        echo "                <li>
                  <a class=\"currency-select\" data-name=\"";
                        // line 30
                        echo twig_get_attribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 30);
                        echo "\">
                    <span class=\"currency-symbol\">";
                        // line 31
                        echo twig_get_attribute($this->env, $this->source, $context["currency"], "symbol_left", [], "any", false, false, false, 31);
                        echo "</span>
                    <span class=\"currency-title-dropdown\">";
                        // line 32
                        echo twig_get_attribute($this->env, $this->source, $context["currency"], "title", [], "any", false, false, false, 32);
                        echo "</span>
                    <span class=\"currency-code-dropdown\">";
                        // line 33
                        echo twig_get_attribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 33);
                        echo "</span>
                  </a>
                </li>
              ";
                    } else {
                        // line 37
                        echo "                <li>
                  <a class=\"currency-select\" data-name=\"";
                        // line 38
                        echo twig_get_attribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 38);
                        echo "\">
                    <span class=\"currency-symbol\">";
                        // line 39
                        echo twig_get_attribute($this->env, $this->source, $context["currency"], "symbol_right", [], "any", false, false, false, 39);
                        echo "</span>
                    <span class=\"currency-title-dropdown\">";
                        // line 40
                        echo twig_get_attribute($this->env, $this->source, $context["currency"], "title", [], "any", false, false, false, 40);
                        echo "</span>
                    <span class=\"currency-code-dropdown\">";
                        // line 41
                        echo twig_get_attribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 41);
                        echo "</span>
                  </a>
                </li>
              ";
                    }
                    // line 45
                    echo "            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['currency'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 46
                echo "          </ul>
        </div>
      </div>
      <input type=\"hidden\" name=\"code\" value=\"\"/>
      <input type=\"hidden\" name=\"redirect\" value=\"";
                // line 50
                echo ($context["redirect"] ?? null);
                echo "\"/>
    </form>
  </div>
";
            }
        }
    }

    public function getTemplateName()
    {
        return "journal3/template/common/currency.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  173 => 50,  167 => 46,  161 => 45,  154 => 41,  150 => 40,  146 => 39,  142 => 38,  139 => 37,  132 => 33,  128 => 32,  124 => 31,  120 => 30,  117 => 29,  114 => 28,  110 => 27,  104 => 23,  99 => 21,  95 => 20,  90 => 19,  85 => 17,  81 => 16,  76 => 15,  74 => 14,  67 => 10,  64 => 9,  58 => 8,  55 => 7,  52 => 6,  49 => 5,  44 => 4,  41 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/common/currency.twig", "");
    }
}
