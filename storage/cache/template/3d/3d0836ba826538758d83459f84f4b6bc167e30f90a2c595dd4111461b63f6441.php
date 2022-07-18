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

/* journal3/template/journal3/css.twig */
class __TwigTemplate_945c48bd8eb75cf7599c80bc78ef8065074822a4db763d543f16c627dba9089f extends \Twig\Template
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
        echo "<style>
  /*No top bar not over*/
  ";
        // line 3
        if ((((twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "stickyStatus", [], "any", false, false, false, 3) &&  !twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "stickyFullHomePadding", [], "any", false, false, false, 3)) &&  !twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "topBarStatus", [], "any", false, false, false, 3)) && twig_in_filter(twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "headerType", [], "any", false, false, false, 3), [0 => "slim", 1 => "compact"]))) {
            // line 4
            echo "  .desktop body{
    padding-top: ";
            // line 5
            echo twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "headerCompactHeight", [], "any", false, false, false, 5);
            echo "px
  }
  .desktop header{
    width: 100%;
    top: 0;
    position: fixed;
  }
  .desktop.popup-open header.header-compact {
    padding-right: 17px;
  }
  .desktop.popup-open.webkit header.header-compact {
    padding-right: ";
            // line 16
            echo twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "scrollBarWidth", [], "any", false, false, false, 16);
            echo "px;
  }
  ";
        }
        // line 19
        echo "
  /*No top bar over*/
  ";
        // line 21
        if ((((twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "stickyStatus", [], "any", false, false, false, 21) && twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "stickyFullHomePadding", [], "any", false, false, false, 21)) &&  !twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "topBarStatus", [], "any", false, false, false, 21)) && twig_in_filter(twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "headerType", [], "any", false, false, false, 21), [0 => "slim", 1 => "compact"]))) {
            // line 22
            echo "  .desktop:not(.route-common-home) body{
    padding-top: ";
            // line 23
            echo twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "headerCompactHeight", [], "any", false, false, false, 23);
            echo "px
  }
  .desktop header{
    width: 100%;
    top: 0;
    position: fixed;
  }
  .desktop.popup-open header.header-compact {
    padding-right: 17px;
  }
  .desktop.popup-open.webkit header.header-compact {
    padding-right: ";
            // line 34
            echo twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "scrollBarWidth", [], "any", false, false, false, 34);
            echo "px;
  }
  ";
        }
        // line 37
        echo "

  /*Top bar not over*/
  ";
        // line 40
        if ((((twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "stickyStatus", [], "any", false, false, false, 40) &&  !twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "stickyFullHomePadding", [], "any", false, false, false, 40)) && twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "topBarStatus", [], "any", false, false, false, 40)) && twig_in_filter(twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "headerType", [], "any", false, false, false, 40), [0 => "slim", 1 => "compact"]))) {
            // line 41
            echo "  .desktop header{
    position: -webkit-sticky;
    position: sticky;
    top: -";
            // line 44
            echo twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "headerTopBarHeight", [], "any", false, false, false, 44);
            echo "px;
  }
  .popup-open .sticky-compact, .mobile-overlay .sticky-compact{
    padding-top:";
            // line 47
            echo (twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "headerCompactHeight", [], "any", false, false, false, 47) + twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "headerTopBarHeight", [], "any", false, false, false, 47));
            echo "px;
  }
  .popup-open .sticky-compact header, .mobile-overlay .sticky-compact header {
    position: fixed;
    width: calc(100% - 12px);
  }
  ";
        }
        // line 54
        echo "
  /*Top bar over*/
  ";
        // line 56
        if ((((twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "stickyStatus", [], "any", false, false, false, 56) && twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "stickyFullHomePadding", [], "any", false, false, false, 56)) && twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "topBarStatus", [], "any", false, false, false, 56)) && twig_in_filter(twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "headerType", [], "any", false, false, false, 56), [0 => "slim", 1 => "compact"]))) {
            // line 57
            echo "  .desktop header{
    position: -webkit-sticky;
    position: sticky;
    top: -";
            // line 60
            echo twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "headerTopBarHeight", [], "any", false, false, false, 60);
            echo "px;
  }

  /*Home*/
  .desktop.route-common-home header{
    margin-bottom: -";
            // line 65
            echo twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "headerCompactHeight", [], "any", false, false, false, 65);
            echo "px;
  }
  .popup-open .sticky-compact, .mobile-overlay .sticky-compact{
    padding-top:";
            // line 68
            echo (twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "headerCompactHeight", [], "any", false, false, false, 68) + twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "headerTopBarHeight", [], "any", false, false, false, 68));
            echo "px;
  }
  .popup-open.route-common-home .sticky-compact, .mobile-overlay.route-common-home .sticky-compact{
    padding-top:";
            // line 71
            echo twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "headerTopBarHeight", [], "any", false, false, false, 71);
            echo "px;
  }
  .popup-open .sticky-compact header, .mobile-overlay .sticky-compact header {
    position: fixed;
    width: calc(100% - 12px);
  }
  ";
        }
        // line 78
        echo "
  /*Title before breadcrumbs*/

  ";
        // line 81
        if ((twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "titleBeforeBreadcrumbs", [], "any", false, false, false, 81) && (twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "pageTitlePosition", [], "any", false, false, false, 81) == "top"))) {
            // line 82
            echo "    header{
      order:-5
    }
    .breadcrumb{
      order:0
    }
    .page-title{
      order:-1
    }
  ";
        }
        // line 92
        echo "
  ";
        // line 93
        if ((twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "headerMiniSearchDisplay", [], "any", false, false, false, 93) == "page")) {
            // line 94
            echo "  .mini-search .tt-menu{
    padding-left:";
            // line 95
            echo twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "headerMiniSearchDropdownPadding", [], "any", false, false, false, 95);
            echo "px;
    padding-right:";
            // line 96
            echo twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "headerMiniSearchDropdownPadding", [], "any", false, false, false, 96);
            echo "px;
  }
  ";
        }
        // line 99
        echo "
  /*Shipping payment visibility*/
  ";
        // line 101
        if (((twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "sectionShippingVisibility", [], "any", false, false, false, 101) != "true") && (twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "sectionPaymentVisibility", [], "any", false, false, false, 101) != "true"))) {
            // line 102
            echo "  .quick-checkout-wrapper .shipping-payment{
    display: none;
  }
  ";
        }
        // line 106
        echo "
  /*Site overlay offset*/
  @media only screen and (max-width: ";
        // line 108
        echo twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "globalPageContentWidth", [], "any", false, false, false, 108);
        echo "px){
    .desktop-main-menu-wrapper .main-menu>.j-menu>.first-dropdown::before{
      transform: none !important;
    }
  }
</style>

";
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/css.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  217 => 108,  213 => 106,  207 => 102,  205 => 101,  201 => 99,  195 => 96,  191 => 95,  188 => 94,  186 => 93,  183 => 92,  171 => 82,  169 => 81,  164 => 78,  154 => 71,  148 => 68,  142 => 65,  134 => 60,  129 => 57,  127 => 56,  123 => 54,  113 => 47,  107 => 44,  102 => 41,  100 => 40,  95 => 37,  89 => 34,  75 => 23,  72 => 22,  70 => 21,  66 => 19,  60 => 16,  46 => 5,  43 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/css.twig", "");
    }
}
