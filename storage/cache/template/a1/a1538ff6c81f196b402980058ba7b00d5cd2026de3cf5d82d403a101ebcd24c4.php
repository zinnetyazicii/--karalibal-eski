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

/* localisation/tax_class_form.twig */
class __TwigTemplate_7cb5b2601b681a26a92c3f8409c4a38d6a0c8f0d26d4abb9bb4fc374ea3e64b2 extends \Twig\Template
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
        echo ($context["column_left"] ?? null);
        echo "
<div id=\"content\">
  <div class=\"page-header\">
    <div class=\"container-fluid\">
      <div class=\"pull-right\">
        <button type=\"submit\" form=\"form-tax-class\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo ($context["button_save"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i></button>
        <a href=\"";
        // line 7
        echo ($context["cancel"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_cancel"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply\"></i></a></div>
      <h1>";
        // line 8
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      <ul class=\"breadcrumb\">
        ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 11
            echo "        <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 11);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 11);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "      </ul>
    </div>
  </div>
  <div class=\"container-fluid\"> ";
        // line 16
        if (($context["error_warning"] ?? null)) {
            // line 17
            echo "    <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 21
        echo "    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i> ";
        // line 23
        echo ($context["text_form"] ?? null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
        <form action=\"";
        // line 26
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" class=\"form-horizontal\" id=\"form-tax-class\">
          <fieldset>
            <legend>";
        // line 28
        echo ($context["text_tax_class"] ?? null);
        echo "</legend>
            <div class=\"form-group required\">
              <label class=\"col-sm-2 control-label\" for=\"input-title\">";
        // line 30
        echo ($context["entry_title"] ?? null);
        echo "</label>
              <div class=\"col-sm-10\">
                <input type=\"text\" name=\"title\" value=\"";
        // line 32
        echo ($context["title"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_title"] ?? null);
        echo "\" id=\"input-title\" class=\"form-control\" />
                ";
        // line 33
        if (($context["error_title"] ?? null)) {
            // line 34
            echo "                <div class=\"text-danger\">";
            echo ($context["error_title"] ?? null);
            echo "</div>
                ";
        }
        // line 35
        echo " </div>
            </div>
            <div class=\"form-group required\">
              <label class=\"col-sm-2 control-label\" for=\"input-description\">";
        // line 38
        echo ($context["entry_description"] ?? null);
        echo "</label>
              <div class=\"col-sm-10\">
                <input type=\"text\" name=\"description\" value=\"";
        // line 40
        echo ($context["description"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_description"] ?? null);
        echo "\" id=\"input-description\" class=\"form-control\" />
                ";
        // line 41
        if (($context["error_description"] ?? null)) {
            // line 42
            echo "                <div class=\"text-danger\">";
            echo ($context["error_description"] ?? null);
            echo "</div>
                ";
        }
        // line 43
        echo " </div>
            </div>
          </fieldset>
          <fieldset>
            <legend>";
        // line 47
        echo ($context["text_tax_rate"] ?? null);
        echo "</legend>
            <table id=\"tax-rule\" class=\"table table-striped table-bordered table-hover\">
              <thead>
                <tr>
                  <td class=\"text-left\">";
        // line 51
        echo ($context["entry_rate"] ?? null);
        echo "</td>
                  <td class=\"text-left\">";
        // line 52
        echo ($context["entry_based"] ?? null);
        echo "</td>
                  <td class=\"text-left\">";
        // line 53
        echo ($context["entry_priority"] ?? null);
        echo "</td>
                  <td></td>
                </tr>
              </thead>
              <tbody>
              
              ";
        // line 59
        $context["tax_rule_row"] = 0;
        // line 60
        echo "              ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["tax_rules"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["tax_rule"]) {
            // line 61
            echo "              <tr id=\"tax-rule-row";
            echo ($context["tax_rule_row"] ?? null);
            echo "\">
                <td class=\"text-left\"><select name=\"tax_rule[";
            // line 62
            echo ($context["tax_rule_row"] ?? null);
            echo "][tax_rate_id]\" class=\"form-control\">
                    ";
            // line 63
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["tax_rates"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["tax_rate"]) {
                // line 64
                echo "                    ";
                if ((twig_get_attribute($this->env, $this->source, $context["tax_rate"], "tax_rate_id", [], "any", false, false, false, 64) == twig_get_attribute($this->env, $this->source, $context["tax_rule"], "tax_rate_id", [], "any", false, false, false, 64))) {
                    // line 65
                    echo "                    <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["tax_rate"], "tax_rate_id", [], "any", false, false, false, 65);
                    echo "\" selected=\"selected\">";
                    echo twig_get_attribute($this->env, $this->source, $context["tax_rate"], "name", [], "any", false, false, false, 65);
                    echo "</option>
                    ";
                } else {
                    // line 67
                    echo "                    <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["tax_rate"], "tax_rate_id", [], "any", false, false, false, 67);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["tax_rate"], "name", [], "any", false, false, false, 67);
                    echo "</option>
                    ";
                }
                // line 69
                echo "                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tax_rate'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 70
            echo "                  </select></td>
                <td class=\"text-left\"><select name=\"tax_rule[";
            // line 71
            echo ($context["tax_rule_row"] ?? null);
            echo "][based]\" class=\"form-control\">
                    ";
            // line 72
            if ((twig_get_attribute($this->env, $this->source, $context["tax_rule"], "based", [], "any", false, false, false, 72) == "shipping")) {
                // line 73
                echo "                    <option value=\"shipping\" selected=\"selected\">";
                echo ($context["text_shipping"] ?? null);
                echo "</option>
                    ";
            } else {
                // line 75
                echo "                    <option value=\"shipping\">";
                echo ($context["text_shipping"] ?? null);
                echo "</option>
                    ";
            }
            // line 77
            echo "                     ";
            if ((twig_get_attribute($this->env, $this->source, $context["tax_rule"], "based", [], "any", false, false, false, 77) == "payment")) {
                // line 78
                echo "                    <option value=\"payment\" selected=\"selected\">";
                echo ($context["text_payment"] ?? null);
                echo "</option>
                    ";
            } else {
                // line 80
                echo "                    <option value=\"payment\">";
                echo ($context["text_payment"] ?? null);
                echo "</option>
                    ";
            }
            // line 82
            echo "                    ";
            if ((twig_get_attribute($this->env, $this->source, $context["tax_rule"], "based", [], "any", false, false, false, 82) == "store")) {
                // line 83
                echo "                    <option value=\"store\" selected=\"selected\">";
                echo ($context["text_store"] ?? null);
                echo "</option>
                    ";
            } else {
                // line 85
                echo "                    <option value=\"store\">";
                echo ($context["text_store"] ?? null);
                echo "</option>
                    ";
            }
            // line 87
            echo "                  </select></td>
                <td class=\"text-left\"><input type=\"text\" name=\"tax_rule[";
            // line 88
            echo ($context["tax_rule_row"] ?? null);
            echo "][priority]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["tax_rule"], "priority", [], "any", false, false, false, 88);
            echo "\" placeholder=\"";
            echo ($context["entry_priority"] ?? null);
            echo "\" class=\"form-control\" /></td>
                <td class=\"text-left\"><button type=\"button\" onclick=\"\$('#tax-rule-row";
            // line 89
            echo ($context["tax_rule_row"] ?? null);
            echo "').remove();\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_remove"] ?? null);
            echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>
              </tr>
              ";
            // line 91
            $context["tax_rule_row"] = (($context["tax_rule_row"] ?? null) + 1);
            // line 92
            echo "              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tax_rule'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 93
        echo "                </tbody>
              
              <tfoot>
                <tr>
                  <td colspan=\"3\"></td>
                  <td class=\"text-left\"><button type=\"button\" onclick=\"addRule();\" data-toggle=\"tooltip\" title=\"";
        // line 98
        echo ($context["button_rule_add"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus-circle\"></i></button></td>
                </tr>
              </tfoot>
\t      
            </table>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
  <script type=\"text/javascript\"><!--
var tax_rule_row = ";
        // line 109
        echo ($context["tax_rule_row"] ?? null);
        echo ";

function addRule() {
\thtml  = '<tr id=\"tax-rule-row' + tax_rule_row + '\">';
\thtml += '  <td class=\"text-left\"><select name=\"tax_rule[' + tax_rule_row + '][tax_rate_id]\" class=\"form-control\">';
    ";
        // line 114
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["tax_rates"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["tax_rate"]) {
            // line 115
            echo "    html += '    <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["tax_rate"], "tax_rate_id", [], "any", false, false, false, 115);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["tax_rate"], "name", [], "any", false, false, false, 115), "js");
            echo "</option>';
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tax_rate'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 117
        echo "    html += '  </select></td>';
\thtml += '  <td class=\"text-left\"><select name=\"tax_rule[' + tax_rule_row + '][based]\" class=\"form-control\">';
    html += '    <option value=\"shipping\">";
        // line 119
        echo ($context["text_shipping"] ?? null);
        echo "</option>';
    html += '    <option value=\"payment\">";
        // line 120
        echo ($context["text_payment"] ?? null);
        echo "</option>';
    html += '    <option value=\"store\">";
        // line 121
        echo ($context["text_store"] ?? null);
        echo "</option>';
    html += '  </select></td>';
\thtml += '  <td class=\"text-left\"><input type=\"text\" name=\"tax_rule[' + tax_rule_row + '][priority]\" value=\"\" placeholder=\"";
        // line 123
        echo ($context["entry_priority"] ?? null);
        echo "\" class=\"form-control\" /></td>';
\thtml += '  <td class=\"text-left\"><button type=\"button\" onclick=\"\$(\\'#tax-rule-row' + tax_rule_row + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
        // line 124
        echo ($context["button_remove"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>';
\thtml += '</tr>';
\t
\t\$('#tax-rule tbody').append(html);
\t
\ttax_rule_row++;
}
//--></script></div>
";
        // line 132
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "localisation/tax_class_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  382 => 132,  371 => 124,  367 => 123,  362 => 121,  358 => 120,  354 => 119,  350 => 117,  339 => 115,  335 => 114,  327 => 109,  313 => 98,  306 => 93,  300 => 92,  298 => 91,  291 => 89,  283 => 88,  280 => 87,  274 => 85,  268 => 83,  265 => 82,  259 => 80,  253 => 78,  250 => 77,  244 => 75,  238 => 73,  236 => 72,  232 => 71,  229 => 70,  223 => 69,  215 => 67,  207 => 65,  204 => 64,  200 => 63,  196 => 62,  191 => 61,  186 => 60,  184 => 59,  175 => 53,  171 => 52,  167 => 51,  160 => 47,  154 => 43,  148 => 42,  146 => 41,  140 => 40,  135 => 38,  130 => 35,  124 => 34,  122 => 33,  116 => 32,  111 => 30,  106 => 28,  101 => 26,  95 => 23,  91 => 21,  83 => 17,  81 => 16,  76 => 13,  65 => 11,  61 => 10,  56 => 8,  50 => 7,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "localisation/tax_class_form.twig", "");
    }
}
