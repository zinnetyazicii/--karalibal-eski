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

/* journal3/template/account/voucher.twig */
class __TwigTemplate_6205f26f714c9614d20b4c3173a9311a994a44bd0e908bc21ee229d57ed526c3 extends \Twig\Template
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
        echo ($context["header"] ?? null);
        echo "
<ul class=\"breadcrumb\">
  ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 4
            echo "  <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 4);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 4);
            echo "</a></li>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 6
        echo "</ul>
";
        // line 7
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 7), "get", [0 => "pageTitlePosition"], "method", false, false, false, 7) == "top")) {
            // line 8
            echo "  <h1 class=\"title page-title\"><span>";
            echo ($context["heading_title"] ?? null);
            echo "</span></h1>
";
        }
        // line 10
        echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "loadController", [0 => "journal3/layout", 1 => "top"], "method", false, false, false, 10);
        echo "
<div id=\"account-voucher\" class=\"container\">
  ";
        // line 12
        if (($context["error_warning"] ?? null)) {
            // line 13
            echo "  <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "</div>
  ";
        }
        // line 15
        echo "  <div class=\"row\">";
        echo ($context["column_left"] ?? null);
        echo "
    ";
        // line 16
        if ((($context["column_left"] ?? null) && ($context["column_right"] ?? null))) {
            // line 17
            echo "    ";
            $context["class"] = "col-sm-6";
            // line 18
            echo "    ";
        } elseif ((($context["column_left"] ?? null) || ($context["column_right"] ?? null))) {
            // line 19
            echo "    ";
            $context["class"] = "col-sm-9";
            // line 20
            echo "    ";
        } else {
            // line 21
            echo "    ";
            $context["class"] = "col-sm-12";
            // line 22
            echo "    ";
        }
        // line 23
        echo "    <div id=\"content\" class=\"";
        echo ($context["class"] ?? null);
        echo "\">
      ";
        // line 24
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 24), "get", [0 => "pageTitlePosition"], "method", false, false, false, 24) == "default")) {
            // line 25
            echo "        <h1 class=\"title page-title\">";
            echo ($context["heading_title"] ?? null);
            echo "</h1>
      ";
        }
        // line 27
        echo "      ";
        echo ($context["content_top"] ?? null);
        echo "
      <p>";
        // line 28
        echo ($context["text_description"] ?? null);
        echo "</p>
      <form action=\"";
        // line 29
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" class=\"form-horizontal\">
        <div class=\"form-group required\">
          <label class=\"col-sm-2 control-label\" for=\"input-to-name\">";
        // line 31
        echo ($context["entry_to_name"] ?? null);
        echo "</label>
          <div class=\"col-sm-10\">
            <input type=\"text\" name=\"to_name\" value=\"";
        // line 33
        echo ($context["to_name"] ?? null);
        echo "\" id=\"input-to-name\" class=\"form-control\" />
            ";
        // line 34
        if (($context["error_to_name"] ?? null)) {
            // line 35
            echo "            <div class=\"text-danger\">";
            echo ($context["error_to_name"] ?? null);
            echo "</div>
            ";
        }
        // line 37
        echo "          </div>
        </div>
        <div class=\"form-group required\">
          <label class=\"col-sm-2 control-label\" for=\"input-to-email\">";
        // line 40
        echo ($context["entry_to_email"] ?? null);
        echo "</label>
          <div class=\"col-sm-10\">
            <input type=\"text\" name=\"to_email\" value=\"";
        // line 42
        echo ($context["to_email"] ?? null);
        echo "\" id=\"input-to-email\" class=\"form-control\" />
            ";
        // line 43
        if (($context["error_to_email"] ?? null)) {
            // line 44
            echo "            <div class=\"text-danger\">";
            echo ($context["error_to_email"] ?? null);
            echo "</div>
            ";
        }
        // line 46
        echo "          </div>
        </div>
        <div class=\"form-group required\">
          <label class=\"col-sm-2 control-label\" for=\"input-from-name\">";
        // line 49
        echo ($context["entry_from_name"] ?? null);
        echo "</label>
          <div class=\"col-sm-10\">
            <input type=\"text\" name=\"from_name\" value=\"";
        // line 51
        echo ($context["from_name"] ?? null);
        echo "\" id=\"input-from-name\" class=\"form-control\" />
            ";
        // line 52
        if (($context["error_from_name"] ?? null)) {
            // line 53
            echo "            <div class=\"text-danger\">";
            echo ($context["error_from_name"] ?? null);
            echo "</div>
            ";
        }
        // line 55
        echo "          </div>
        </div>
        <div class=\"form-group required\">
          <label class=\"col-sm-2 control-label\" for=\"input-from-email\">";
        // line 58
        echo ($context["entry_from_email"] ?? null);
        echo "</label>
          <div class=\"col-sm-10\">
            <input type=\"text\" name=\"from_email\" value=\"";
        // line 60
        echo ($context["from_email"] ?? null);
        echo "\" id=\"input-from-email\" class=\"form-control\" />
            ";
        // line 61
        if (($context["error_from_email"] ?? null)) {
            // line 62
            echo "            <div class=\"text-danger\">";
            echo ($context["error_from_email"] ?? null);
            echo "</div>
            ";
        }
        // line 64
        echo "          </div>
        </div>
        <div class=\"form-group required\">
          <label class=\"col-sm-2 control-label\">";
        // line 67
        echo ($context["entry_theme"] ?? null);
        echo "</label>
          <div class=\"col-sm-10\">
           ";
        // line 69
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["voucher_themes"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["voucher_theme"]) {
            // line 70
            echo "            ";
            if ((twig_get_attribute($this->env, $this->source, $context["voucher_theme"], "voucher_theme_id", [], "any", false, false, false, 70) == ($context["voucher_theme_id"] ?? null))) {
                // line 71
                echo "            <div class=\"radio\">
              <label>
                <input type=\"radio\" name=\"voucher_theme_id\" value=\"";
                // line 73
                echo twig_get_attribute($this->env, $this->source, $context["voucher_theme"], "voucher_theme_id", [], "any", false, false, false, 73);
                echo "\" checked=\"checked\" />
                ";
                // line 74
                echo twig_get_attribute($this->env, $this->source, $context["voucher_theme"], "name", [], "any", false, false, false, 74);
                echo "</label>
            </div>
            ";
            } else {
                // line 77
                echo "            <div class=\"radio\">
              <label>
                <input type=\"radio\" name=\"voucher_theme_id\" value=\"";
                // line 79
                echo twig_get_attribute($this->env, $this->source, $context["voucher_theme"], "voucher_theme_id", [], "any", false, false, false, 79);
                echo "\" />
                ";
                // line 80
                echo twig_get_attribute($this->env, $this->source, $context["voucher_theme"], "name", [], "any", false, false, false, 80);
                echo "</label>
            </div>
            ";
            }
            // line 83
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['voucher_theme'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 84
        echo "            ";
        if (($context["error_theme"] ?? null)) {
            // line 85
            echo "            <div class=\"text-danger\">";
            echo ($context["error_theme"] ?? null);
            echo "</div>
            ";
        }
        // line 87
        echo "          </div>
        </div>
        <div class=\"form-group\">
          <label class=\"col-sm-2 control-label\" for=\"input-message\"><span data-toggle=\"tooltip\" title=\"";
        // line 90
        echo ($context["help_message"] ?? null);
        echo "\">";
        echo ($context["entry_message"] ?? null);
        echo "</span></label>
          <div class=\"col-sm-10\">
            <textarea name=\"message\" cols=\"40\" rows=\"5\" id=\"input-message\" class=\"form-control\">";
        // line 92
        echo ($context["message"] ?? null);
        echo "</textarea>
          </div>
        </div>
        <div class=\"form-group\">
          <label class=\"col-sm-2 control-label\" for=\"input-amount\"><span data-toggle=\"tooltip\" title=\"";
        // line 96
        echo ($context["help_amount"] ?? null);
        echo "\">";
        echo ($context["entry_amount"] ?? null);
        echo "</span></label>
          <div class=\"col-sm-10\">
            <input type=\"text\" name=\"amount\" value=\"";
        // line 98
        echo ($context["amount"] ?? null);
        echo "\" id=\"input-amount\" class=\"form-control\" size=\"5\" />
            ";
        // line 99
        if (($context["error_amount"] ?? null)) {
            // line 100
            echo "            <div class=\"text-danger\">";
            echo ($context["error_amount"] ?? null);
            echo "</div>
            ";
        }
        // line 102
        echo "          </div>
        </div>
        <div class=\"buttons clearfix\">
          <div class=\"pull-right\"> ";
        // line 105
        echo ($context["text_agree"] ?? null);
        echo "
            ";
        // line 106
        if (($context["agree"] ?? null)) {
            // line 107
            echo "            <input type=\"checkbox\" name=\"agree\" value=\"1\" checked=\"checked\" />
            ";
        } else {
            // line 109
            echo "            <input type=\"checkbox\" name=\"agree\" value=\"1\" />
            ";
        }
        // line 111
        echo "            &nbsp;
            <button type=\"submit\" value=\"";
        // line 112
        echo ($context["button_continue"] ?? null);
        echo "\" class=\"btn btn-primary\" ><span>";
        echo ($context["button_continue"] ?? null);
        echo "</span></button>
          </div>
        </div>
      </form>
      ";
        // line 116
        echo ($context["content_bottom"] ?? null);
        echo "</div>
    ";
        // line 117
        echo ($context["column_right"] ?? null);
        echo "</div>
</div>
";
        // line 119
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "journal3/template/account/voucher.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  354 => 119,  349 => 117,  345 => 116,  336 => 112,  333 => 111,  329 => 109,  325 => 107,  323 => 106,  319 => 105,  314 => 102,  308 => 100,  306 => 99,  302 => 98,  295 => 96,  288 => 92,  281 => 90,  276 => 87,  270 => 85,  267 => 84,  261 => 83,  255 => 80,  251 => 79,  247 => 77,  241 => 74,  237 => 73,  233 => 71,  230 => 70,  226 => 69,  221 => 67,  216 => 64,  210 => 62,  208 => 61,  204 => 60,  199 => 58,  194 => 55,  188 => 53,  186 => 52,  182 => 51,  177 => 49,  172 => 46,  166 => 44,  164 => 43,  160 => 42,  155 => 40,  150 => 37,  144 => 35,  142 => 34,  138 => 33,  133 => 31,  128 => 29,  124 => 28,  119 => 27,  113 => 25,  111 => 24,  106 => 23,  103 => 22,  100 => 21,  97 => 20,  94 => 19,  91 => 18,  88 => 17,  86 => 16,  81 => 15,  75 => 13,  73 => 12,  68 => 10,  62 => 8,  60 => 7,  57 => 6,  46 => 4,  42 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/account/voucher.twig", "");
    }
}
