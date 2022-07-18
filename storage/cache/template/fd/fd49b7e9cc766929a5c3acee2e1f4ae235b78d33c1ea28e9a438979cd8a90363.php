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

/* journal3/template/common/language.twig */
class __TwigTemplate_cb3d2c477568ed580719ce421fafc9e9022cc0c4e4c4ebc885f78ce0c4bc01f3 extends \Twig\Template
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
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 1), "get", [0 => "catalogLanguageStatus"], "method", false, false, false, 1)) {
            // line 2
            if ((twig_length_filter($this->env, ($context["languages"] ?? null)) > 1)) {
                // line 3
                echo "  ";
                $context["current_language"] = null;
                // line 4
                echo "  ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                    // line 5
                    echo "    ";
                    if ((twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 5) == ($context["code"] ?? null))) {
                        // line 6
                        echo "      ";
                        $context["current_language"] = $context["language"];
                        // line 7
                        echo "    ";
                    }
                    // line 8
                    echo "  ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 9
                echo "  <div id=\"language\" class=\"language\">
    <form action=\"";
                // line 10
                echo ($context["action"] ?? null);
                echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-language\">
      <div class=\"dropdown drop-menu\">
        <button type=\"button\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
          <span class=\"language-flag-title\">
            <span class=\"symbol\"><img src=\"";
                // line 14
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "imageToBase64", [0 => (((("catalog/language/" . twig_get_attribute($this->env, $this->source, ($context["current_language"] ?? null), "code", [], "any", false, false, false, 14)) . "/") . twig_get_attribute($this->env, $this->source, ($context["current_language"] ?? null), "code", [], "any", false, false, false, 14)) . ".png")], "method", false, false, false, 14);
                echo "\" width=\"16\" height=\"11\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["current_language"] ?? null), "name", [], "any", false, false, false, 14);
                echo "\" title=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["current_language"] ?? null), "name", [], "any", false, false, false, 14);
                echo "\"/></span>
            <span class=\"language-title\">";
                // line 15
                echo twig_get_attribute($this->env, $this->source, ($context["current_language"] ?? null), "name", [], "any", false, false, false, 15);
                echo "</span>
          </span>
        </button>
        <div class=\"dropdown-menu j-dropdown\">
          <ul class=\"j-menu\">
            ";
                // line 20
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                    // line 21
                    echo "              <li>
                <a class=\"language-select\" data-name=\"";
                    // line 22
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 22);
                    echo "\">
                  <span class=\"language-flag\"><img src=\"";
                    // line 23
                    echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "imageToBase64", [0 => (((("catalog/language/" . twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 23)) . "/") . twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 23)) . ".png")], "method", false, false, false, 23);
                    echo "\" width=\"16\" height=\"11\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 23);
                    echo "\" title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 23);
                    echo "\"/></span>
                  <span class=\"language-title-dropdown\">";
                    // line 24
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 24);
                    echo "</span>
                </a>
              </li>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 28
                echo "          </ul>
        </div>
      </div>
      <input type=\"hidden\" name=\"code\" value=\"\"/>
      <input type=\"hidden\" name=\"redirect\" value=\"";
                // line 32
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
        return "journal3/template/common/language.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  125 => 32,  119 => 28,  109 => 24,  101 => 23,  97 => 22,  94 => 21,  90 => 20,  82 => 15,  74 => 14,  67 => 10,  64 => 9,  58 => 8,  55 => 7,  52 => 6,  49 => 5,  44 => 4,  41 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/common/language.twig", "");
    }
}
