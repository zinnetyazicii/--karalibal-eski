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

/* sale/voucher_list.twig */
class __TwigTemplate_0739117d0edfbfcae098c0e4ffd91b83ecf6a47f340ac91ed56a75e5726def8f extends \Twig\Template
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
        <button type=\"button\" id=\"button-send\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo ($context["button_send"] ?? null);
        echo "\" class=\"btn btn-warning\"><i class=\"fa fa-envelope\"></i></button>
        <a href=\"";
        // line 7
        echo ($context["add"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_add"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus\"></i></a>
        <button type=\"button\" data-toggle=\"tooltip\" title=\"";
        // line 8
        echo ($context["button_delete"] ?? null);
        echo "\" class=\"btn btn-danger\" onclick=\"confirm('";
        echo ($context["text_confirm"] ?? null);
        echo "') ? \$('#form-voucher').submit() : false;\"><i class=\"fa fa-trash-o\"></i></button>
      </div>
      <h1>";
        // line 10
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      <ul class=\"breadcrumb\">
        ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 13
            echo "        <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 13);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 13);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "      </ul>
    </div>
  </div>
  <div class=\"container-fluid\">
    ";
        // line 19
        if (($context["error_warning"] ?? null)) {
            // line 20
            echo "    <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 24
        echo "    ";
        if (($context["success"] ?? null)) {
            // line 25
            echo "    <div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 29
        echo "    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-list\"></i> ";
        // line 31
        echo ($context["text_list"] ?? null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
        <form action=\"";
        // line 34
        echo ($context["delete"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-voucher\">
          <div class=\"table-responsive\">
            <table class=\"table table-bordered table-hover\">
              <thead>
                <tr>
                  <td style=\"width: 1px;\" class=\"text-center\"><input type=\"checkbox\" onclick=\"\$('input[name*=\\'selected\\']').prop('checked', this.checked);\" /></td>
                  <td class=\"text-left\">";
        // line 40
        if ((($context["sort"] ?? null) == "v.code")) {
            // line 41
            echo "                    <a href=\"";
            echo ($context["sort_code"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_code"] ?? null);
            echo "</a>
                    ";
        } else {
            // line 43
            echo "                    <a href=\"";
            echo ($context["sort_code"] ?? null);
            echo "\">";
            echo ($context["column_code"] ?? null);
            echo "</a>
                    ";
        }
        // line 44
        echo "</td>
                  <td class=\"text-left\">";
        // line 45
        if ((($context["sort"] ?? null) == "v.from_name")) {
            // line 46
            echo "                    <a href=\"";
            echo ($context["sort_from"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_from"] ?? null);
            echo "</a>
                    ";
        } else {
            // line 48
            echo "                    <a href=\"";
            echo ($context["sort_from"] ?? null);
            echo "\">";
            echo ($context["column_from"] ?? null);
            echo "</a>
                    ";
        }
        // line 49
        echo "</td>
                  <td class=\"text-left\">";
        // line 50
        if ((($context["sort"] ?? null) == "v.to_name")) {
            // line 51
            echo "                    <a href=\"";
            echo ($context["sort_to"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_to"] ?? null);
            echo "</a>
                    ";
        } else {
            // line 53
            echo "                    <a href=\"";
            echo ($context["sort_to"] ?? null);
            echo "\">";
            echo ($context["column_to"] ?? null);
            echo "</a>
                    ";
        }
        // line 54
        echo "</td>
                  <td class=\"text-right\">";
        // line 55
        if ((($context["sort"] ?? null) == "v.amount")) {
            // line 56
            echo "                    <a href=\"";
            echo ($context["sort_amount"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_amount"] ?? null);
            echo "</a>
                    ";
        } else {
            // line 58
            echo "                    <a href=\"";
            echo ($context["sort_amount"] ?? null);
            echo "\">";
            echo ($context["column_amount"] ?? null);
            echo "</a>
                    ";
        }
        // line 59
        echo "</td>
                  <td class=\"text-left\">";
        // line 60
        if ((($context["sort"] ?? null) == "theme")) {
            // line 61
            echo "                    <a href=\"";
            echo ($context["sort_theme"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_theme"] ?? null);
            echo "</a>
                    ";
        } else {
            // line 63
            echo "                    <a href=\"";
            echo ($context["sort_theme"] ?? null);
            echo "\">";
            echo ($context["column_theme"] ?? null);
            echo "</a>
                    ";
        }
        // line 64
        echo "</td>
                  <td class=\"text-left\">";
        // line 65
        if ((($context["sort"] ?? null) == "v.status")) {
            // line 66
            echo "                    <a href=\"";
            echo ($context["sort_status"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_status"] ?? null);
            echo "</a>
                    ";
        } else {
            // line 68
            echo "                    <a href=\"";
            echo ($context["sort_status"] ?? null);
            echo "\">";
            echo ($context["column_status"] ?? null);
            echo "</a>
                    ";
        }
        // line 69
        echo "</td>
                  <td class=\"text-left\">";
        // line 70
        if ((($context["sort"] ?? null) == "v.date_added")) {
            // line 71
            echo "                    <a href=\"";
            echo ($context["sort_date_added"] ?? null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, ($context["order"] ?? null));
            echo "\">";
            echo ($context["column_date_added"] ?? null);
            echo "</a>
                    ";
        } else {
            // line 73
            echo "                    <a href=\"";
            echo ($context["sort_date_added"] ?? null);
            echo "\">";
            echo ($context["column_date_added"] ?? null);
            echo "</a>
                    ";
        }
        // line 74
        echo "</td>
                  <td class=\"text-right\">";
        // line 75
        echo ($context["column_action"] ?? null);
        echo "</td>
                </tr>
              </thead>
              <tbody>
                ";
        // line 79
        if (($context["vouchers"] ?? null)) {
            // line 80
            echo "                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["vouchers"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["voucher"]) {
                // line 81
                echo "                <tr>
                  <td class=\"text-center\">";
                // line 82
                if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["voucher"], "voucher_id", [], "any", false, false, false, 82), ($context["selected"] ?? null))) {
                    // line 83
                    echo "                    <input type=\"checkbox\" name=\"selected[]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["voucher"], "voucher_id", [], "any", false, false, false, 83);
                    echo "\" checked=\"checked\" />
                    ";
                } else {
                    // line 85
                    echo "                    <input type=\"checkbox\" name=\"selected[]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["voucher"], "voucher_id", [], "any", false, false, false, 85);
                    echo "\" />
                    ";
                }
                // line 86
                echo "</td>
                  <td class=\"text-left\">";
                // line 87
                echo twig_get_attribute($this->env, $this->source, $context["voucher"], "code", [], "any", false, false, false, 87);
                echo "</td>
                  <td class=\"text-left\">";
                // line 88
                echo twig_get_attribute($this->env, $this->source, $context["voucher"], "from", [], "any", false, false, false, 88);
                echo "</td>
                  <td class=\"text-left\">";
                // line 89
                echo twig_get_attribute($this->env, $this->source, $context["voucher"], "to", [], "any", false, false, false, 89);
                echo "</td>
                  <td class=\"text-right\">";
                // line 90
                echo twig_get_attribute($this->env, $this->source, $context["voucher"], "amount", [], "any", false, false, false, 90);
                echo "</td>
                  <td class=\"text-left\">";
                // line 91
                echo twig_get_attribute($this->env, $this->source, $context["voucher"], "theme", [], "any", false, false, false, 91);
                echo "</td>
                  <td class=\"text-left\">";
                // line 92
                echo twig_get_attribute($this->env, $this->source, $context["voucher"], "status", [], "any", false, false, false, 92);
                echo "</td>
                  <td class=\"text-left\">";
                // line 93
                echo twig_get_attribute($this->env, $this->source, $context["voucher"], "date_added", [], "any", false, false, false, 93);
                echo "</td>
                  <td class=\"text-right\">
                  ";
                // line 95
                if (twig_get_attribute($this->env, $this->source, $context["voucher"], "order", [], "any", false, false, false, 95)) {
                    // line 96
                    echo "                  <a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["voucher"], "order", [], "any", false, false, false, 96);
                    echo "\" data-toggle=\"tooltip\" title=\"";
                    echo ($context["button_order"] ?? null);
                    echo "\" class=\"btn btn-info\"><i class=\"fa fa fa-eye\"></i></a>
                  ";
                }
                // line 98
                echo "                  <a href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["voucher"], "edit", [], "any", false, false, false, 98);
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_edit"] ?? null);
                echo "\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i></a></td>
                </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['voucher'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 101
            echo "                ";
        } else {
            // line 102
            echo "                <tr>
                  <td class=\"text-center\" colspan=\"9\">";
            // line 103
            echo ($context["text_no_results"] ?? null);
            echo "</td>
                </tr>
                ";
        }
        // line 106
        echo "              </tbody>
            </table>
          </div>
        </form>
        <div class=\"row\">
          <div class=\"col-sm-6 text-left\">";
        // line 111
        echo ($context["pagination"] ?? null);
        echo "</div>
          <div class=\"col-sm-6 text-right\">";
        // line 112
        echo ($context["results"] ?? null);
        echo "</div>
        </div>
      </div>
    </div>
  </div>
  <script type=\"text/javascript\"><!--
\$('#button-send').on('click', function() {
\t\$.ajax({
\t\turl: 'index.php?route=sale/voucher/send&user_token=";
        // line 120
        echo ($context["user_token"] ?? null);
        echo "',
\t\ttype: 'post',
\t\tdataType: 'json',
\t\tdata: \$('input[name^=\\'selected\\']:checked'),
\t\tbeforeSend: function() {
\t\t\t\$('#button-send i').replaceWith('<i class=\"fa fa-circle-o-notch fa-spin\"></i>');
\t\t\t\$('#button-send').prop('disabled', true);
\t\t},\t
\t\tcomplete: function() {
\t\t\t\$('#button-send i').replaceWith('<i class=\"fa fa-envelope\"></i>');
\t\t\t\$('#button-send').prop('disabled', false);
\t\t},
\t\tsuccess: function(json) {
\t\t\t\$('.alert-dismissible').remove();
\t\t\t
\t\t\tif (json['error']) {
\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error'] + '</div>');
\t\t\t}
\t\t\t
\t\t\tif (json['success']) {
\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ' + json['success'] + '</div>');
\t\t\t}\t\t
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});\t
})
//--></script></div>
";
        // line 149
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "sale/voucher_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  441 => 149,  409 => 120,  398 => 112,  394 => 111,  387 => 106,  381 => 103,  378 => 102,  375 => 101,  363 => 98,  355 => 96,  353 => 95,  348 => 93,  344 => 92,  340 => 91,  336 => 90,  332 => 89,  328 => 88,  324 => 87,  321 => 86,  315 => 85,  309 => 83,  307 => 82,  304 => 81,  299 => 80,  297 => 79,  290 => 75,  287 => 74,  279 => 73,  269 => 71,  267 => 70,  264 => 69,  256 => 68,  246 => 66,  244 => 65,  241 => 64,  233 => 63,  223 => 61,  221 => 60,  218 => 59,  210 => 58,  200 => 56,  198 => 55,  195 => 54,  187 => 53,  177 => 51,  175 => 50,  172 => 49,  164 => 48,  154 => 46,  152 => 45,  149 => 44,  141 => 43,  131 => 41,  129 => 40,  120 => 34,  114 => 31,  110 => 29,  102 => 25,  99 => 24,  91 => 20,  89 => 19,  83 => 15,  72 => 13,  68 => 12,  63 => 10,  56 => 8,  50 => 7,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "sale/voucher_list.twig", "");
    }
}
