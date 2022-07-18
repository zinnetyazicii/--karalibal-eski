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

/* customer/custom_field_form.twig */
class __TwigTemplate_618efba4adacc9a9c4cc2df6f6c94ff12eec377197effce5b891acf59fa2c1ec extends \Twig\Template
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
        <button type=\"submit\" form=\"form-custom-field\" data-toggle=\"tooltip\" title=\"";
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
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-custom-field\" class=\"form-horizontal\">
                      <fieldset>
              <legend>";
        // line 28
        echo ($context["text_custom_field"] ?? null);
        echo "</legend>
          
          <div class=\"form-group required\">
            <label class=\"col-sm-2 control-label\">";
        // line 31
        echo ($context["entry_name"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\"> ";
        // line 32
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 33
            echo "              <div class=\"input-group\"><span class=\"input-group-addon\"><img src=\"language/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 33);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 33);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 33);
            echo "\" /></span>
                <input type=\"text\" name=\"custom_field_description[";
            // line 34
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 34);
            echo "][name]\" value=\"";
            echo (((($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = ($context["custom_field_description"] ?? null)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 34)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = ($context["custom_field_description"] ?? null)) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 34)] ?? null) : null), "name", [], "any", false, false, false, 34)) : (""));
            echo "\" placeholder=\"";
            echo ($context["entry_name"] ?? null);
            echo "\" class=\"form-control\" />
              </div>
              ";
            // line 36
            if ((($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = ($context["error_name"] ?? null)) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 36)] ?? null) : null)) {
                // line 37
                echo "              <div class=\"text-danger\">";
                echo (($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = ($context["error_name"] ?? null)) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 37)] ?? null) : null);
                echo "</div>
              ";
            }
            // line 39
            echo "              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        echo "            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-location\">";
        // line 43
        echo ($context["entry_location"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"location\" id=\"input-location\" class=\"form-control\">
                ";
        // line 46
        if ((($context["location"] ?? null) == "account")) {
            // line 47
            echo "                <option value=\"account\" selected=\"selected\">";
            echo ($context["text_account"] ?? null);
            echo "</option>
                ";
        } else {
            // line 49
            echo "                <option value=\"account\">";
            echo ($context["text_account"] ?? null);
            echo "</option>
                ";
        }
        // line 51
        echo "                ";
        if ((($context["location"] ?? null) == "address")) {
            // line 52
            echo "                <option value=\"address\" selected=\"selected\">";
            echo ($context["text_address"] ?? null);
            echo "</option>
                ";
        } else {
            // line 54
            echo "                <option value=\"address\">";
            echo ($context["text_address"] ?? null);
            echo "</option>
                ";
        }
        // line 56
        echo "                ";
        if ((($context["location"] ?? null) == "affiliate")) {
            // line 57
            echo "                <option value=\"affiliate\" selected=\"selected\">";
            echo ($context["text_affiliate"] ?? null);
            echo "</option>
                ";
        } else {
            // line 59
            echo "                <option value=\"affiliate\">";
            echo ($context["text_affiliate"] ?? null);
            echo "</option>
                ";
        }
        // line 61
        echo "              </select>
            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-type\">";
        // line 65
        echo ($context["entry_type"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"type\" id=\"input-type\" class=\"form-control\">
                <optgroup label=\"";
        // line 68
        echo ($context["text_choose"] ?? null);
        echo "\">
                ";
        // line 69
        if ((($context["type"] ?? null) == "select")) {
            // line 70
            echo "                <option value=\"select\" selected=\"selected\">";
            echo ($context["text_select"] ?? null);
            echo "</option>
                ";
        } else {
            // line 72
            echo "                <option value=\"select\">";
            echo ($context["text_select"] ?? null);
            echo "</option>
                ";
        }
        // line 74
        echo "                ";
        if ((($context["type"] ?? null) == "radio")) {
            // line 75
            echo "                <option value=\"radio\" selected=\"selected\">";
            echo ($context["text_radio"] ?? null);
            echo "</option>
                ";
        } else {
            // line 77
            echo "                <option value=\"radio\">";
            echo ($context["text_radio"] ?? null);
            echo "</option>
                ";
        }
        // line 79
        echo "                ";
        if ((($context["type"] ?? null) == "checkbox")) {
            // line 80
            echo "                <option value=\"checkbox\" selected=\"selected\">";
            echo ($context["text_checkbox"] ?? null);
            echo "</option>
                ";
        } else {
            // line 82
            echo "                <option value=\"checkbox\">";
            echo ($context["text_checkbox"] ?? null);
            echo "</option>
                ";
        }
        // line 84
        echo "                </optgroup>
                <optgroup label=\"";
        // line 85
        echo ($context["text_input"] ?? null);
        echo "\">
                ";
        // line 86
        if ((($context["type"] ?? null) == "text")) {
            // line 87
            echo "                <option value=\"text\" selected=\"selected\">";
            echo ($context["text_text"] ?? null);
            echo "</option>
                ";
        } else {
            // line 89
            echo "                <option value=\"text\">";
            echo ($context["text_text"] ?? null);
            echo "</option>
                ";
        }
        // line 91
        echo "                ";
        if ((($context["type"] ?? null) == "textarea")) {
            // line 92
            echo "                <option value=\"textarea\" selected=\"selected\">";
            echo ($context["text_textarea"] ?? null);
            echo "</option>
                ";
        } else {
            // line 94
            echo "                <option value=\"textarea\">";
            echo ($context["text_textarea"] ?? null);
            echo "</option>
                ";
        }
        // line 96
        echo "                </optgroup>
                <optgroup label=\"";
        // line 97
        echo ($context["text_file"] ?? null);
        echo "\">
                ";
        // line 98
        if ((($context["type"] ?? null) == "file")) {
            // line 99
            echo "                <option value=\"file\" selected=\"selected\">";
            echo ($context["text_file"] ?? null);
            echo "</option>
                ";
        } else {
            // line 101
            echo "                <option value=\"file\">";
            echo ($context["text_file"] ?? null);
            echo "</option>
                ";
        }
        // line 103
        echo "                </optgroup>
                <optgroup label=\"";
        // line 104
        echo ($context["text_date"] ?? null);
        echo "\">
                ";
        // line 105
        if ((($context["type"] ?? null) == "date")) {
            // line 106
            echo "                <option value=\"date\" selected=\"selected\">";
            echo ($context["text_date"] ?? null);
            echo "</option>
                ";
        } else {
            // line 108
            echo "                <option value=\"date\">";
            echo ($context["text_date"] ?? null);
            echo "</option>
                ";
        }
        // line 110
        echo "                ";
        if ((($context["type"] ?? null) == "time")) {
            // line 111
            echo "                <option value=\"time\" selected=\"selected\">";
            echo ($context["text_time"] ?? null);
            echo "</option>
                ";
        } else {
            // line 113
            echo "                <option value=\"time\">";
            echo ($context["text_time"] ?? null);
            echo "</option>
                ";
        }
        // line 115
        echo "                ";
        if ((($context["type"] ?? null) == "datetime")) {
            // line 116
            echo "                <option value=\"datetime\" selected=\"selected\">";
            echo ($context["text_datetime"] ?? null);
            echo "</option>
                ";
        } else {
            // line 118
            echo "                <option value=\"datetime\">";
            echo ($context["text_datetime"] ?? null);
            echo "</option>
                ";
        }
        // line 120
        echo "                </optgroup>
              </select>
            </div>
          </div>
          <div class=\"form-group\" id=\"display-value\">
            <label class=\"col-sm-2 control-label\" for=\"input-value\">";
        // line 125
        echo ($context["entry_value"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"value\" value=\"";
        // line 127
        echo ($context["value"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_value"] ?? null);
        echo "\" id=\"input-value\" class=\"form-control\" />
            </div>
          </div>
          <div class=\"form-group\" id=\"display-validation\">
            <label class=\"col-sm-2 control-label\" for=\"input-validation\"><span data-toggle=\"tooltip\" title=\"";
        // line 131
        echo ($context["help_regex"] ?? null);
        echo "\">";
        echo ($context["entry_validation"] ?? null);
        echo "</span></label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"validation\" id=\"input-validation\" value=\"";
        // line 133
        echo ($context["validation"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["text_regex"] ?? null);
        echo "\"  class=\"form-control\"/>
            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 137
        echo ($context["entry_customer_group"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">";
        // line 138
        $context["customer_group_row"] = 0;
        // line 139
        echo "              ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["customer_groups"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["customer_group"]) {
            // line 140
            echo "              <div class=\"checkbox\">
                <label> ";
            // line 141
            if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 141), ($context["custom_field_customer_group"] ?? null))) {
                // line 142
                echo "                  <input type=\"checkbox\" name=\"custom_field_customer_group[";
                echo ($context["customer_group_row"] ?? null);
                echo "][customer_group_id]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 142);
                echo "\" checked=\"checked\" />
                  ";
                // line 143
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 143);
                echo "
                  ";
            } else {
                // line 145
                echo "                  <input type=\"checkbox\" name=\"custom_field_customer_group[";
                echo ($context["customer_group_row"] ?? null);
                echo "][customer_group_id]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 145);
                echo "\" />
                  ";
                // line 146
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 146);
                echo "
                  ";
            }
            // line 147
            echo " </label>
              </div>
              ";
            // line 149
            $context["customer_group_row"] = (($context["customer_group_row"] ?? null) + 1);
            // line 150
            echo "              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['customer_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo "</div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 153
        echo ($context["entry_required"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">";
        // line 154
        $context["customer_group_row"] = 0;
        // line 155
        echo "              ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["customer_groups"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["customer_group"]) {
            // line 156
            echo "              <div class=\"checkbox\">
                <label> ";
            // line 157
            if (twig_in_filter(twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 157), ($context["custom_field_required"] ?? null))) {
                // line 158
                echo "                  <input type=\"checkbox\" name=\"custom_field_customer_group[";
                echo ($context["customer_group_row"] ?? null);
                echo "][required]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 158);
                echo "\" checked=\"checked\" />
                  ";
                // line 159
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 159);
                echo "
                  ";
            } else {
                // line 161
                echo "                  <input type=\"checkbox\" name=\"custom_field_customer_group[";
                echo ($context["customer_group_row"] ?? null);
                echo "][required]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 161);
                echo "\" />
                  ";
                // line 162
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 162);
                echo "
                  ";
            }
            // line 163
            echo "</label>
              </div>
              ";
            // line 165
            $context["customer_group_row"] = (($context["customer_group_row"] ?? null) + 1);
            // line 166
            echo "              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['customer_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo "</div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-status\">";
        // line 169
        echo ($context["entry_status"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"status\" id=\"input-status\" class=\"form-control\">
                ";
        // line 172
        if (($context["status"] ?? null)) {
            // line 173
            echo "                <option value=\"1\" selected=\"selected\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
                <option value=\"0\">";
            // line 174
            echo ($context["text_disabled"] ?? null);
            echo "</option>
                ";
        } else {
            // line 176
            echo "                <option value=\"1\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
                <option value=\"0\" selected=\"selected\">";
            // line 177
            echo ($context["text_disabled"] ?? null);
            echo "</option>
                ";
        }
        // line 179
        echo "              </select>
            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-sort-order\"><span data-toggle=\"tooltip\" title=\"";
        // line 183
        echo ($context["help_sort_order"] ?? null);
        echo "\">";
        echo ($context["entry_sort_order"] ?? null);
        echo "</span></label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"sort_order\" value=\"";
        // line 185
        echo ($context["sort_order"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_sort_order"] ?? null);
        echo "\" id=\"input-sort-order\" class=\"form-control\" />
            </div>
          </div>
          </fieldset>
          <br/>
          <div id=\"custom-field-value\">
            <fieldset>
              <legend>";
        // line 192
        echo ($context["text_value"] ?? null);
        echo "</legend>
              <table class=\"table table-striped table-bordered table-hover\">
                <thead>
                  <tr>
                    <td class=\"text-left required\">";
        // line 196
        echo ($context["entry_custom_value"] ?? null);
        echo "</td>
                    <td class=\"text-right\">";
        // line 197
        echo ($context["entry_sort_order"] ?? null);
        echo "</td>
                    <td></td>
                  </tr>
                </thead>
                <tbody>
                
                ";
        // line 203
        $context["custom_field_value_row"] = 0;
        // line 204
        echo "                ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["custom_field_values"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["custom_field_value"]) {
            // line 205
            echo "                <tr id=\"custom-field-value-row";
            echo ($context["custom_field_value_row"] ?? null);
            echo "\">
                  <td class=\"text-left\" style=\"width: 70%;\"><input type=\"hidden\" name=\"custom_field_value[";
            // line 206
            echo ($context["custom_field_value_row"] ?? null);
            echo "][custom_field_value_id]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 206);
            echo "\" />
                    ";
            // line 207
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 208
                echo "                    <div class=\"input-group\"> <span class=\"input-group-addon\"><img src=\"language/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 208);
                echo "/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 208);
                echo ".png\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 208);
                echo "\" /></span>
                      <input type=\"text\" name=\"custom_field_value[";
                // line 209
                echo ($context["custom_field_value_row"] ?? null);
                echo "][custom_field_value_description][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 209);
                echo "][name]\" value=\"";
                echo (((($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 = twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_description", [], "any", false, false, false, 209)) && is_array($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4) || $__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 instanceof ArrayAccess ? ($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 209)] ?? null) : null)) ? (twig_get_attribute($this->env, $this->source, (($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 = twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_description", [], "any", false, false, false, 209)) && is_array($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666) || $__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 instanceof ArrayAccess ? ($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 209)] ?? null) : null), "name", [], "any", false, false, false, 209)) : (""));
                echo "\" placeholder=\"";
                echo ($context["entry_custom_value"] ?? null);
                echo "\" class=\"form-control\" />
                    </div>
                    ";
                // line 211
                if ((($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e = (($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 = ($context["error_custom_field_value"] ?? null)) && is_array($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52) || $__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 instanceof ArrayAccess ? ($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52[($context["custom_field_value_row"] ?? null)] ?? null) : null)) && is_array($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e) || $__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e instanceof ArrayAccess ? ($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 211)] ?? null) : null)) {
                    // line 212
                    echo "                    <div class=\"text-danger\">";
                    echo (($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 = (($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 = ($context["error_custom_field_value"] ?? null)) && is_array($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386) || $__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 instanceof ArrayAccess ? ($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386[($context["custom_field_value_row"] ?? null)] ?? null) : null)) && is_array($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136) || $__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 instanceof ArrayAccess ? ($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 212)] ?? null) : null);
                    echo "</div>
                    ";
                }
                // line 214
                echo "                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "</td>
                  <td class=\"text-right\"><input type=\"text\" name=\"custom_field_value[";
            // line 215
            echo ($context["custom_field_value_row"] ?? null);
            echo "][sort_order]\" value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "sort_order", [], "any", false, false, false, 215);
            echo "\" placeholder=\"";
            echo ($context["entry_sort_order"] ?? null);
            echo "\" class=\"form-control\" /></td>
                  <td class=\"text-left\"><button onclick=\"\$('#custom-field-value-row";
            // line 216
            echo ($context["custom_field_value_row"] ?? null);
            echo "').remove();\" data-toggle=\"tooltip\" title=\"";
            echo ($context["button_remove"] ?? null);
            echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>
                </tr>
                ";
            // line 218
            $context["custom_field_value_row"] = (($context["custom_field_value_row"] ?? null) + 1);
            // line 219
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field_value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 220
        echo "                  </tbody>
                
                <tfoot>
                  <tr>
                    <td colspan=\"2\"></td>
                    <td class=\"text-left\"><button type=\"button\" onclick=\"addCustomFieldValue();\" data-toggle=\"tooltip\" title=\"";
        // line 225
        echo ($context["button_custom_field_value_add"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus-circle\"></i></button></td>
                  </tr>
                </tfoot>
\t\t
              </table>
            </fieldset>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type=\"text/javascript\"><!--
\$('select[name=\\'type\\']').on('change', function() {
\tif (this.value == 'select' || this.value == 'radio' || this.value == 'checkbox') {
\t\t\$('#custom-field-value').show();
\t\t\$('#display-value, #display-validation').hide();
\t} else {
\t\t\$('#custom-field-value').hide();
\t\t\$('#display-value, #display-validation').show();
\t}

\tif (this.value == 'date') {
\t\t\$('#display-value > div').html('<div class=\"input-group date\"><input type=\"text\" name=\"value\" value=\"' + \$('#input-value').val() + '\" placeholder=\"";
        // line 247
        echo ($context["entry_value"] ?? null);
        echo "\" data-date-format=\"YYYY-MM-DD\" id=\"input-value\" class=\"form-control\" /><span class=\"input-group-btn\"><button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button></span></div>');
\t} else if (this.value == 'time') {
\t\t\$('#display-value > div').html('<div class=\"input-group time\"><input type=\"text\" name=\"value\" value=\"' + \$('#input-value').val() + '\" placeholder=\"";
        // line 249
        echo ($context["entry_value"] ?? null);
        echo "\" data-date-format=\"HH:mm\" id=\"input-value\" class=\"form-control\" /><span class=\"input-group-btn\"><button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button></span></div>');
\t} else if (this.value == 'datetime') {
\t\t\$('#display-value > div').html('<div class=\"input-group datetime\"><input type=\"text\" name=\"value\" value=\"' + \$('#input-value').val() + '\" placeholder=\"";
        // line 251
        echo ($context["entry_value"] ?? null);
        echo "\" data-date-format=\"YYYY-MM-DD HH:mm\" id=\"input-value\" class=\"form-control\" /><span class=\"input-group-btn\"><button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button></span></div>');
\t} else if (this.value == 'textarea') {
\t\t\$('#display-value > div').html('<textarea name=\"value\" placeholder=\"";
        // line 253
        echo ($context["entry_value"] ?? null);
        echo "\" id=\"input-value\" class=\"form-control\">' + \$('#input-value').val() + '</textarea>');
\t} else {
\t\t\$('#display-value > div').html('<input type=\"text\" name=\"value\" value=\"' + \$('#input-value').val() + '\" placeholder=\"";
        // line 255
        echo ($context["entry_value"] ?? null);
        echo "\" id=\"input-value\" class=\"form-control\" />');
\t}

\t\$('.date').datetimepicker({
\t\tlanguage: '";
        // line 259
        echo ($context["datepicker"] ?? null);
        echo "',
\t\tpickTime: false
\t});

\t\$('.time').datetimepicker({
\t\tlanguage: '";
        // line 264
        echo ($context["datepicker"] ?? null);
        echo "',
\t\tpickDate: false
\t});

\t\$('.datetime').datetimepicker({
\t\tlanguage: '";
        // line 269
        echo ($context["datepicker"] ?? null);
        echo "',
\t\tpickDate: true,
\t\tpickTime: true
\t});
});

\$('select[name=\\'type\\']').trigger('change');

var custom_field_value_row = ";
        // line 277
        echo ($context["custom_field_value_row"] ?? null);
        echo ";

function addCustomFieldValue() {
\thtml  = '<tr id=\"custom-field-value-row' + custom_field_value_row + '\">';
    html += '  <td class=\"text-left\" style=\"width: 70%;\"><input type=\"hidden\" name=\"custom_field_value[' + custom_field_value_row + '][custom_field_value_id]\" value=\"\" />';
\t";
        // line 282
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 283
            echo "\thtml += '    <div class=\"input-group\">';
\thtml += '      <span class=\"input-group-addon\"><img src=\"language/";
            // line 284
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 284);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 284);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 284);
            echo "\" /></span><input type=\"text\" name=\"custom_field_value[' + custom_field_value_row + '][custom_field_value_description][";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 284);
            echo "][name]\" value=\"\" placeholder=\"";
            echo ($context["entry_custom_value"] ?? null);
            echo "\" class=\"form-control\" />';
    html += '    </div>';
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 287
        echo "\thtml += '  </td>';
\thtml += '  <td class=\"text-right\"><input type=\"text\" name=\"custom_field_value[' + custom_field_value_row + '][sort_order]\" value=\"\" placeholder=\"";
        // line 288
        echo ($context["entry_sort_order"] ?? null);
        echo "\" class=\"form-control\" /></td>';
\thtml += '  <td class=\"text-left\"><button type=\"button\" onclick=\"\$(\\'#custom-field-value-row' + custom_field_value_row + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
        // line 289
        echo ($context["button_remove"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>';
\thtml += '</tr>';

\t\$('#custom-field-value tbody').append(html);

\tcustom_field_value_row++;
}
//--></script></div>
";
        // line 297
        echo ($context["footer"] ?? null);
        echo " 
";
    }

    public function getTemplateName()
    {
        return "customer/custom_field_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  814 => 297,  803 => 289,  799 => 288,  796 => 287,  779 => 284,  776 => 283,  772 => 282,  764 => 277,  753 => 269,  745 => 264,  737 => 259,  730 => 255,  725 => 253,  720 => 251,  715 => 249,  710 => 247,  685 => 225,  678 => 220,  672 => 219,  670 => 218,  663 => 216,  655 => 215,  647 => 214,  641 => 212,  639 => 211,  628 => 209,  619 => 208,  615 => 207,  609 => 206,  604 => 205,  599 => 204,  597 => 203,  588 => 197,  584 => 196,  577 => 192,  565 => 185,  558 => 183,  552 => 179,  547 => 177,  542 => 176,  537 => 174,  532 => 173,  530 => 172,  524 => 169,  514 => 166,  512 => 165,  508 => 163,  503 => 162,  496 => 161,  491 => 159,  484 => 158,  482 => 157,  479 => 156,  474 => 155,  472 => 154,  468 => 153,  458 => 150,  456 => 149,  452 => 147,  447 => 146,  440 => 145,  435 => 143,  428 => 142,  426 => 141,  423 => 140,  418 => 139,  416 => 138,  412 => 137,  403 => 133,  396 => 131,  387 => 127,  382 => 125,  375 => 120,  369 => 118,  363 => 116,  360 => 115,  354 => 113,  348 => 111,  345 => 110,  339 => 108,  333 => 106,  331 => 105,  327 => 104,  324 => 103,  318 => 101,  312 => 99,  310 => 98,  306 => 97,  303 => 96,  297 => 94,  291 => 92,  288 => 91,  282 => 89,  276 => 87,  274 => 86,  270 => 85,  267 => 84,  261 => 82,  255 => 80,  252 => 79,  246 => 77,  240 => 75,  237 => 74,  231 => 72,  225 => 70,  223 => 69,  219 => 68,  213 => 65,  207 => 61,  201 => 59,  195 => 57,  192 => 56,  186 => 54,  180 => 52,  177 => 51,  171 => 49,  165 => 47,  163 => 46,  157 => 43,  152 => 40,  146 => 39,  140 => 37,  138 => 36,  129 => 34,  120 => 33,  116 => 32,  112 => 31,  106 => 28,  101 => 26,  95 => 23,  91 => 21,  83 => 17,  81 => 16,  76 => 13,  65 => 11,  61 => 10,  56 => 8,  50 => 7,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "customer/custom_field_form.twig", "");
    }
}
