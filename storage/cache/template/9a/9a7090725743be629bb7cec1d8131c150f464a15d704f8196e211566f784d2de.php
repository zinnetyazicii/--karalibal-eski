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

/* journal3/template/journal3/headers/desktop/classic.twig */
class __TwigTemplate_8990be4019cba58ad1b1e9c5d5ae4295a01cf0a988a6d575c1a89ed1e52bcafe extends \Twig\Template
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
        echo "<div class=\"header header-classic header-lg\">
  <div class=\"top-bar navbar-nav\">
    ";
        // line 3
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 3), "get", [0 => "desktop_top_menu"], "method", false, false, false, 3);
        echo "
    ";
        // line 4
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 4), "get", [0 => "langPosition"], "method", false, false, false, 4) == "top")) {
            // line 5
            echo "      <div class=\"language-currency top-menu\">
        <div class=\"desktop-language-wrapper\">
          ";
            // line 7
            echo ($context["language"] ?? null);
            echo "
        </div>
        <div class=\"desktop-currency-wrapper\">
          ";
            // line 10
            echo ($context["currency"] ?? null);
            echo "
        </div>
      </div>
    ";
        }
        // line 14
        echo "    <div class=\"third-menu\">";
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 14), "get", [0 => "desktop_top_menu_3"], "method", false, false, false, 14);
        echo "</div>
    ";
        // line 15
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 15), "get", [0 => "secondaryMenuPosition"], "method", false, false, false, 15) == "top")) {
            // line 16
            echo "      <div class=\"top-menu secondary-menu\">";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 16), "get", [0 => "desktop_top_menu_2"], "method", false, false, false, 16);
            echo "</div>
    ";
        }
        // line 18
        echo "  </div>
  <div class=\"mid-bar navbar-nav\">
    <div class=\"desktop-logo-wrapper\">
      <div id=\"logo\">
        ";
        // line 22
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 22), "get", [0 => "logo_src"], "method", false, false, false, 22)) {
            // line 23
            echo "          <a href=\"";
            echo ($context["home"] ?? null);
            echo "\">
            <img src=\"";
            // line 24
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 24), "get", [0 => "logo_src"], "method", false, false, false, 24);
            echo "\" ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 24), "get", [0 => "logo2x_src"], "method", false, false, false, 24)) {
                echo "srcset=\"";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 24), "get", [0 => "logo_src"], "method", false, false, false, 24);
                echo " 1x, ";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 24), "get", [0 => "logo2x_src"], "method", false, false, false, 24);
                echo " 2x\"";
            }
            echo " width=\"";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 24), "get", [0 => "logo_width"], "method", false, false, false, 24);
            echo "\" height=\"";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 24), "get", [0 => "logo_height"], "method", false, false, false, 24);
            echo "\" alt=\"";
            echo ($context["name"] ?? null);
            echo "\" title=\"";
            echo ($context["name"] ?? null);
            echo "\"/>
          </a>
        ";
        } else {
            // line 27
            echo "          <h1><a href=\"";
            echo ($context["home"] ?? null);
            echo "\">";
            echo ($context["name"] ?? null);
            echo "</a></h1>
        ";
        }
        // line 29
        echo "      </div>
    </div>
    ";
        // line 31
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 31), "get", [0 => "headerMainMenu2Position"], "method", false, false, false, 31) == "top")) {
            // line 32
            echo "      ";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 32), "get", [0 => "desktop_main_menu_2"], "method", false, false, false, 32);
            echo "
    ";
        }
        // line 34
        echo "    <div class=\"desktop-search-wrapper full-search default-search-wrapper\">
      ";
        // line 35
        echo ($context["search"] ?? null);
        echo "
    </div>
    ";
        // line 37
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 37), "get", [0 => "langPosition"], "method", false, false, false, 37) == "search")) {
            // line 38
            echo "      <div class=\"language-currency top-menu\">
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
        echo "    <div class=\"classic-cart-wrapper\">
        ";
        // line 48
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 48), "get", [0 => "secondaryMenuPosition"], "method", false, false, false, 48) == "cart")) {
            // line 49
            echo "          <div class=\"top-menu secondary-menu\">";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 49), "get", [0 => "desktop_top_menu_2"], "method", false, false, false, 49);
            echo "</div>
        ";
        }
        // line 51
        echo "        ";
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 51), "get", [0 => "cartPosition"], "method", false, false, false, 51) == "top")) {
            // line 52
            echo "          <div class=\"desktop-cart-wrapper default-cart-wrapper\">
              ";
            // line 53
            echo ($context["cart"] ?? null);
            echo "
          </div>
        ";
        }
        // line 56
        echo "    </div>
  </div>
  <div class=\"desktop-main-menu-wrapper menu-";
        // line 58
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 58), "get", [0 => "headerMenuLayout"], "method", false, false, false, 58);
        echo " ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 58), "get", [0 => "desktop_main_menu_2"], "method", false, false, false, 58)) {
            echo "has-menu-2";
        }
        echo " navbar-nav\">
    ";
        // line 59
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "document", [], "any", false, false, false, 59), "hasClass", [0 => "mobile-header-active"], "method", false, false, false, 59)) ? ("") : (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 59), "get", [0 => "desktop_main_menu"], "method", false, false, false, 59)));
        echo "
    ";
        // line 60
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 60), "get", [0 => "headerMainMenu2Position"], "method", false, false, false, 60) == "menu")) {
            // line 61
            echo "    ";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 61), "get", [0 => "desktop_main_menu_2"], "method", false, false, false, 61);
            echo "
    ";
        }
        // line 63
        echo "    ";
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 63), "get", [0 => "cartPosition"], "method", false, false, false, 63) == "menu")) {
            // line 64
            echo "      <div class=\"desktop-cart-wrapper default-cart-wrapper\">
        ";
            // line 65
            echo ($context["cart"] ?? null);
            echo "
      </div>
    ";
        }
        // line 68
        echo "  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/headers/desktop/classic.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  218 => 68,  212 => 65,  209 => 64,  206 => 63,  200 => 61,  198 => 60,  194 => 59,  186 => 58,  182 => 56,  176 => 53,  173 => 52,  170 => 51,  164 => 49,  162 => 48,  159 => 47,  152 => 43,  146 => 40,  142 => 38,  140 => 37,  135 => 35,  132 => 34,  126 => 32,  124 => 31,  120 => 29,  112 => 27,  90 => 24,  85 => 23,  83 => 22,  77 => 18,  71 => 16,  69 => 15,  64 => 14,  57 => 10,  51 => 7,  47 => 5,  45 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/headers/desktop/classic.twig", "C:\\wamp64\\www\\catalog\\view\\theme\\journal3\\template\\journal3\\headers\\desktop\\classic.twig");
    }
}
