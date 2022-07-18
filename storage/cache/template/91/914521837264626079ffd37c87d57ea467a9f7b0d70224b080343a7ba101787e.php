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

/* journal3/template/journal3/headers/desktop/slim.twig */
class __TwigTemplate_5e9db3177c61484afbdc29bdeb736cdb3f956681308a3c97d84076c550ccef4f extends \Twig\Template
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
    <div class=\"desktop-main-menu-wrapper\">
      ";
        // line 23
        echo ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "document", [], "any", false, false, false, 23), "hasClass", [0 => "mobile-header-active"], "method", false, false, false, 23)) ? ("") : (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 23), "get", [0 => "desktop_main_menu"], "method", false, false, false, 23)));
        echo "
    </div>
    <div class=\"desktop-logo-wrapper\">
      <div id=\"logo\">
        ";
        // line 27
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 27), "get", [0 => "logo_src"], "method", false, false, false, 27)) {
            // line 28
            echo "          <a href=\"";
            echo ($context["home"] ?? null);
            echo "\">
            <img src=\"";
            // line 29
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 29), "get", [0 => "logo_src"], "method", false, false, false, 29);
            echo "\" ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 29), "get", [0 => "logo2x_src"], "method", false, false, false, 29)) {
                echo "srcset=\"";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 29), "get", [0 => "logo_src"], "method", false, false, false, 29);
                echo " 1x, ";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 29), "get", [0 => "logo2x_src"], "method", false, false, false, 29);
                echo " 2x\"";
            }
            echo " width=\"";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 29), "get", [0 => "logo_width"], "method", false, false, false, 29);
            echo "\" height=\"";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 29), "get", [0 => "logo_height"], "method", false, false, false, 29);
            echo "\" alt=\"";
            echo ($context["name"] ?? null);
            echo "\" title=\"";
            echo ($context["name"] ?? null);
            echo "\"/>
          </a>
        ";
        } else {
            // line 32
            echo "          <h1><a href=\"";
            echo ($context["home"] ?? null);
            echo "\">";
            echo ($context["name"] ?? null);
            echo "</a></h1>
        ";
        }
        // line 34
        echo "      </div>
    </div>
    <div class=\"desktop-search-wrapper full-search\">
      ";
        // line 37
        echo ($context["search"] ?? null);
        echo "
    </div>

    <div class=\"header-cart-group\">
      ";
        // line 41
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 41), "get", [0 => "langPosition"], "method", false, false, false, 41) == "search")) {
            // line 42
            echo "        <div class=\"language-currency top-menu\">
          <div class=\"desktop-language-wrapper\">
            ";
            // line 44
            echo ($context["language"] ?? null);
            echo "
          </div>
          <div class=\"desktop-currency-wrapper\">
            ";
            // line 47
            echo ($context["currency"] ?? null);
            echo "
          </div>
        </div>
      ";
        }
        // line 51
        echo "      ";
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 51), "get", [0 => "secondaryMenuPosition"], "method", false, false, false, 51) == "cart")) {
            // line 52
            echo "        <div class=\"top-menu secondary-menu\">";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 52), "get", [0 => "desktop_top_menu_2"], "method", false, false, false, 52);
            echo "</div>
      ";
        }
        // line 54
        echo "      <div class=\"desktop-cart-wrapper\">
        ";
        // line 55
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
        return "journal3/template/journal3/headers/desktop/slim.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  171 => 55,  168 => 54,  162 => 52,  159 => 51,  152 => 47,  146 => 44,  142 => 42,  140 => 41,  133 => 37,  128 => 34,  120 => 32,  98 => 29,  93 => 28,  91 => 27,  84 => 23,  78 => 19,  72 => 17,  70 => 16,  65 => 15,  58 => 11,  52 => 8,  48 => 6,  46 => 5,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/headers/desktop/slim.twig", "C:\\wamp64\\www\\catalog\\view\\theme\\journal3\\template\\journal3\\headers\\desktop\\slim.twig");
    }
}
