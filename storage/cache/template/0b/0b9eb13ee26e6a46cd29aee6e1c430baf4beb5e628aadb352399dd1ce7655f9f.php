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

/* journal3/template/journal3/headers/desktop/compact.twig */
class __TwigTemplate_52f8b0ac4429ae9c39d01ea5efe0970105fe9878044efc3712de29cf08847166 extends \Twig\Template
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
        echo "<div class=\"header header-compact header-sm\">
  <div class=\"top-bar navbar-nav\">
    ";
        // line 3
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 3), "get", [0 => "desktop_top_menu"], "method", false, false, false, 3);
        echo "

    ";
        // line 5
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 5), "get", [0 => "langPosition"], "method", false, false, false, 5) == "top")) {
            // line 6
            echo "      <div class=\"language-currency top-menu\">
        <div class=\"desktop-language-wrapper\">
          ";
            // line 8
            echo ($context["language"] ?? null);
            echo "
        </div>
        <div class=\"desktop-currency-wrapper\">
          ";
            // line 11
            echo ($context["currency"] ?? null);
            echo "
        </div>
      </div>
    ";
        }
        // line 15
        echo "    <div class=\"third-menu\">";
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 15), "get", [0 => "desktop_top_menu_3"], "method", false, false, false, 15);
        echo "</div>
    ";
        // line 16
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 16), "get", [0 => "secondaryMenuPosition"], "method", false, false, false, 16) == "top")) {
            // line 17
            echo "      <div class=\"top-menu secondary-menu\">";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 17), "get", [0 => "desktop_top_menu_2"], "method", false, false, false, 17);
            echo "</div>
    ";
        }
        // line 19
        echo "  </div>
  <div class=\"mid-bar navbar-nav\">
    <div class=\"desktop-logo-wrapper\">
      <div id=\"logo\">
        ";
        // line 23
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 23), "get", [0 => "logo_src"], "method", false, false, false, 23)) {
            // line 24
            echo "          <a href=\"";
            echo ($context["home"] ?? null);
            echo "\">
            <img src=\"";
            // line 25
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 25), "get", [0 => "logo_src"], "method", false, false, false, 25);
            echo "\" ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 25), "get", [0 => "logo2x_src"], "method", false, false, false, 25)) {
                echo "srcset=\"";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 25), "get", [0 => "logo_src"], "method", false, false, false, 25);
                echo " 1x, ";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 25), "get", [0 => "logo2x_src"], "method", false, false, false, 25);
                echo " 2x\"";
            }
            echo " width=\"";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 25), "get", [0 => "logo_width"], "method", false, false, false, 25);
            echo "\" height=\"";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 25), "get", [0 => "logo_height"], "method", false, false, false, 25);
            echo "\" alt=\"";
            echo ($context["name"] ?? null);
            echo "\" title=\"";
            echo ($context["name"] ?? null);
            echo "\"/>
          </a>
        ";
        } else {
            // line 28
            echo "          <h1><a href=\"";
            echo ($context["home"] ?? null);
            echo "\">";
            echo ($context["name"] ?? null);
            echo "</a></h1>
        ";
        }
        // line 30
        echo "      </div>
    </div>
    <div class=\"desktop-main-menu-wrapper navbar-nav\">
      ";
        // line 33
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "document", [], "any", false, false, false, 33), "hasClass", [0 => "mobile-header-active"], "method", false, false, false, 33)) ? ("") : (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 33), "get", [0 => "desktop_main_menu"], "method", false, false, false, 33)));
        echo "
    </div>

    <div class=\"header-cart-group\">
      ";
        // line 37
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 37), "get", [0 => "langPosition"], "method", false, false, false, 37) == "search")) {
            // line 38
            echo "        <div class=\"language-currency top-menu\">
          <div class=\"desktop-language-wrapper\">
            ";
            // line 40
            echo ($context["language"] ?? null);
            echo "
          </div>
          <div class=\"desktop-currency-wrapper\">
            ";
            // line 43
            echo ($context["currency"] ?? null);
            echo "
          </div>
        </div>
      ";
        }
        // line 47
        echo "      ";
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 47), "get", [0 => "secondaryMenuPosition"], "method", false, false, false, 47) == "cart")) {
            // line 48
            echo "        <div class=\"top-menu secondary-menu\">";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 48), "get", [0 => "desktop_top_menu_2"], "method", false, false, false, 48);
            echo "</div>
      ";
        }
        // line 50
        echo "      ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 50), "get", [0 => "catalogSearchStatus"], "method", false, false, false, 50)) {
            // line 51
            echo "      <div class=\"desktop-search-wrapper mini-search\">
        ";
            // line 52
            echo ($context["search"] ?? null);
            echo "
      </div>
      ";
        }
        // line 55
        echo "      <div class=\"desktop-cart-wrapper\">
        ";
        // line 56
        echo ($context["cart"] ?? null);
        echo "
      </div>
    </div>
  </div>
</div>

";
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/headers/desktop/compact.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  176 => 56,  173 => 55,  167 => 52,  164 => 51,  161 => 50,  155 => 48,  152 => 47,  145 => 43,  139 => 40,  135 => 38,  133 => 37,  126 => 33,  121 => 30,  113 => 28,  91 => 25,  86 => 24,  84 => 23,  78 => 19,  72 => 17,  70 => 16,  65 => 15,  58 => 11,  52 => 8,  48 => 6,  46 => 5,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/headers/desktop/compact.twig", "C:\\wamp64\\www\\catalog\\view\\theme\\journal3\\template\\journal3\\headers\\desktop\\compact.twig");
    }
}
