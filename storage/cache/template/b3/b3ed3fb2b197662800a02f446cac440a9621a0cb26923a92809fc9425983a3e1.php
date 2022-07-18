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

/* user/api_form.twig */
class __TwigTemplate_387c5d619127903815cd3e7cb088be4b352d2640d25f331b93350883de2daff4 extends \Twig\Template
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
        <button type=\"submit\" form=\"form-api\" data-toggle=\"tooltip\" title=\"";
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
  <div class=\"container-fluid\">";
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
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-api\" class=\"form-horizontal\">
          <ul class=\"nav nav-tabs\">
            <li class=\"active\"><a href=\"#tab-general\" data-toggle=\"tab\">";
        // line 28
        echo ($context["tab_general"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-ip\" data-toggle=\"tab\">";
        // line 29
        echo ($context["tab_ip"] ?? null);
        echo "</a></li>
            <li><a href=\"#tab-session\" data-toggle=\"tab\">";
        // line 30
        echo ($context["tab_session"] ?? null);
        echo "</a></li>
          </ul>
          <div class=\"tab-content\">
            <div class=\"tab-pane active\" id=\"tab-general\">
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-username\">";
        // line 35
        echo ($context["entry_username"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"username\" value=\"";
        // line 37
        echo ($context["username"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_username"] ?? null);
        echo "\" id=\"input-username\" class=\"form-control\" />
                  ";
        // line 38
        if (($context["error_username"] ?? null)) {
            // line 39
            echo "                  <div class=\"text-danger\">";
            echo ($context["error_username"] ?? null);
            echo "</div>
                  ";
        }
        // line 40
        echo " </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-key\">";
        // line 43
        echo ($context["entry_key"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <textarea name=\"key\" placeholder=\"";
        // line 45
        echo ($context["entry_key"] ?? null);
        echo "\" rows=\"5\" id=\"input-key\" class=\"form-control\">";
        echo ($context["key"] ?? null);
        echo "</textarea>
                  <br/>
                  <button type=\"button\" id=\"button-generate\" class=\"btn btn-primary\"><i class=\"fa fa-refresh\"></i> ";
        // line 47
        echo ($context["button_generate"] ?? null);
        echo "</button>
                  ";
        // line 48
        if (($context["error_key"] ?? null)) {
            // line 49
            echo "                  <div class=\"text-danger\">";
            echo ($context["error_key"] ?? null);
            echo "</div>
                  ";
        }
        // line 50
        echo " </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-status\">";
        // line 53
        echo ($context["entry_status"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"status\" id=\"input-status\" class=\"form-control\">                    
                    ";
        // line 56
        if (($context["status"] ?? null)) {
            echo "                    
                    <option value=\"0\">";
            // line 57
            echo ($context["text_disabled"] ?? null);
            echo "</option>
                    <option value=\"1\" selected=\"selected\">";
            // line 58
            echo ($context["text_enabled"] ?? null);
            echo "</option>                    
                    ";
        } else {
            // line 59
            echo "                    
                    <option value=\"0\" selected=\"selected\">";
            // line 60
            echo ($context["text_disabled"] ?? null);
            echo "</option>
                    <option value=\"1\">";
            // line 61
            echo ($context["text_enabled"] ?? null);
            echo "</option>                    
                    ";
        }
        // line 62
        echo "                  
                  </select>
                </div>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-ip\">
              <div class=\"alert alert-info\"><i class=\"fa fa-info-circle\"></i> ";
        // line 68
        echo ($context["text_ip"] ?? null);
        echo "</div>
              <div class=\"table-responsive\">
                <table id=\"ip\" class=\"table table-striped table-bordered table-hover\">
                  <thead>
                    <tr>
                      <td class=\"text-left\">";
        // line 73
        echo ($context["entry_ip"] ?? null);
        echo "</td>
                      <td class=\"text-left\"></td>
                    </tr>
                  </thead>
                  <tbody>
                  
                  ";
        // line 79
        $context["ip_row"] = 0;
        // line 80
        echo "                  ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["api_ips"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["api_ip"]) {
            // line 81
            echo "                  <tr id=\"ip-row";
            echo ($context["ip_row"] ?? null);
            echo "\">
                    <td class=\"text-left\"><input type=\"text\" name=\"api_ip[]\" value=\"";
            // line 82
            echo twig_get_attribute($this->env, $this->source, $context["api_ip"], "ip", [], "any", false, false, false, 82);
            echo "\" placeholder=\"";
            echo ($context["entry_ip"] ?? null);
            echo "\" class=\"form-control\" /></td>
                    <td class=\"text-left\"><button type=\"button\" onclick=\"\$('#ip-row";
            // line 83
            echo ($context["ip_row"] ?? null);
            echo "').remove()\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_remove"] ?? null);
            echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>
                  </tr>
                  ";
            // line 85
            $context["ip_row"] = (($context["ip_row"] ?? null) + 1);
            // line 86
            echo "                  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['api_ip'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 87
        echo "                    </tbody>
                  
                  <tfoot>
                    <tr>
                      <td></td>
                      <td class=\"text-left\"><button type=\"button\" onclick=\"addIp()\" data-toggle=\"tooltip\" title=\"";
        // line 92
        echo ($context["button_ip_add"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus-circle\"></i></button></td>
                    </tr>
                  </tfoot>
\t\t  
                </table>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-session\">
              <div class=\"table-responsive\">
                <table id=\"session\" class=\"table table-striped table-bordered table-hover\">
                  <thead>
                    <tr>
                      <td class=\"text-left\">";
        // line 104
        echo ($context["column_token"] ?? null);
        echo "</td>
                      <td class=\"text-left\">";
        // line 105
        echo ($context["column_ip"] ?? null);
        echo "</td>
                      <td class=\"text-left\">";
        // line 106
        echo ($context["column_date_added"] ?? null);
        echo "</td>
                      <td class=\"text-left\">";
        // line 107
        echo ($context["column_date_modified"] ?? null);
        echo "</td>
                      <td class=\"text-right\">";
        // line 108
        echo ($context["column_action"] ?? null);
        echo "</td>
                    </tr>
                  </thead>
                  <tbody>
                  
                  ";
        // line 113
        if (($context["api_sessions"] ?? null)) {
            // line 114
            echo "                  ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["api_sessions"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["api_session"]) {
                // line 115
                echo "                  <tr>
                    <td class=\"text-left\">";
                // line 116
                echo twig_get_attribute($this->env, $this->source, $context["api_session"], "session_id", [], "any", false, false, false, 116);
                echo "</td>
                    <td class=\"text-left\">";
                // line 117
                echo twig_get_attribute($this->env, $this->source, $context["api_session"], "ip", [], "any", false, false, false, 117);
                echo "</td>
                    <td class=\"text-left\">";
                // line 118
                echo twig_get_attribute($this->env, $this->source, $context["api_session"], "date_added", [], "any", false, false, false, 118);
                echo "</td>
                    <td class=\"text-left\">";
                // line 119
                echo twig_get_attribute($this->env, $this->source, $context["api_session"], "date_modified", [], "any", false, false, false, 119);
                echo "</td>
                    <td class=\"text-right\"><button type=\"button\" value=\"";
                // line 120
                echo twig_get_attribute($this->env, $this->source, $context["api_session"], "api_session_id", [], "any", false, false, false, 120);
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_remove"] ?? null);
                echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>
                  </tr>
                  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['api_session'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 123
            echo "                  ";
        } else {
            // line 124
            echo "                  <tr>
                    <td class=\"text-center\" colspan=\"5\">";
            // line 125
            echo ($context["text_no_results"] ?? null);
            echo "</td>
                  </tr>
                  ";
        }
        // line 128
        echo "                    </tbody>
                  
                </table>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type=\"text/javascript\"><!--
\$('#button-generate').on('click', function() {
\trand = '';

\tstring = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

\tfor (i = 0; i < 256; i++) {
\t\trand += string[Math.floor(Math.random() * (string.length - 1))];
\t}

\t\$('#input-key').val(rand);
});
//--></script> 
  <script type=\"text/javascript\"><!--
var ip_row = ";
        // line 152
        echo ($context["ip_row"] ?? null);
        echo ";

function addIp() {
\thtml  = '<tr id=\"ip-row' + ip_row + '\">';
    html += '  <td class=\"text-right\"><input type=\"text\" name=\"api_ip[]\" value=\"\" placeholder=\"";
        // line 156
        echo ($context["entry_ip"] ?? null);
        echo "\" class=\"form-control\" /></td>';
\thtml += '  <td class=\"text-left\"><button type=\"button\" onclick=\"\$(\\'#ip-row' + ip_row + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
        // line 157
        echo ($context["button_remove"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>';
\thtml += '</tr>';

\t\$('#ip tbody').append(html);

\tip_row++;
}
//--></script> 
  <script type=\"text/javascript\"><!--
\$('#session button').on('click', function(e) {
\te.preventDefault();

\tvar node = this;

\t\$.ajax({
\t\turl: 'index.php?route=user/api/deletesession&user_token=";
        // line 172
        echo ($context["user_token"] ?? null);
        echo "&api_session_id=' + \$(node).val(),
\t\ttype: 'post',
\t\tdataType: 'json',
\t\tbeforeSend: function() {
\t\t\t\$(node).button('loading');
\t\t},
\t\tcomplete: function() {
\t\t\t\$(node).button('reset');
\t\t},
\t\tsuccess: function(json) {
\t\t\t\$('.alert-dismissible').remove();

\t\t\tif (json['error']) {
\t\t\t\t\$('#tab-session').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');
\t\t\t}

\t\t\tif (json['success']) {
\t\t\t\t\$('#tab-session').prepend('<div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ' + json['success'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');

\t\t\t\t\$(node).parent().parent().remove();
\t\t\t}
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});
//--></script>
</div>
";
        // line 201
        echo ($context["footer"] ?? null);
        echo " 
";
    }

    public function getTemplateName()
    {
        return "user/api_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  446 => 201,  414 => 172,  396 => 157,  392 => 156,  385 => 152,  359 => 128,  353 => 125,  350 => 124,  347 => 123,  336 => 120,  332 => 119,  328 => 118,  324 => 117,  320 => 116,  317 => 115,  312 => 114,  310 => 113,  302 => 108,  298 => 107,  294 => 106,  290 => 105,  286 => 104,  271 => 92,  264 => 87,  258 => 86,  256 => 85,  249 => 83,  243 => 82,  238 => 81,  233 => 80,  231 => 79,  222 => 73,  214 => 68,  206 => 62,  201 => 61,  197 => 60,  194 => 59,  189 => 58,  185 => 57,  181 => 56,  175 => 53,  170 => 50,  164 => 49,  162 => 48,  158 => 47,  151 => 45,  146 => 43,  141 => 40,  135 => 39,  133 => 38,  127 => 37,  122 => 35,  114 => 30,  110 => 29,  106 => 28,  101 => 26,  95 => 23,  91 => 21,  83 => 17,  81 => 16,  76 => 13,  65 => 11,  61 => 10,  56 => 8,  50 => 7,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "user/api_form.twig", "");
    }
}
