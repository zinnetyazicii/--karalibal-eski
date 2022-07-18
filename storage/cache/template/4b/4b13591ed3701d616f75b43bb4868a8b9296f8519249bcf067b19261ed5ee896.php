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

/* sale/order_form.twig */
class __TwigTemplate_8094c48cabff9d549f425eafdbf8f64b05f40f974c35c348bb1f3cc88fbf3a49 extends \Twig\Template
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
      <div class=\"pull-right\"><a href=\"";
        // line 5
        echo ($context["cancel"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply\"></i> ";
        echo ($context["button_cancel"] ?? null);
        echo "</a></div>
      <h1>";
        // line 6
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      <ul class=\"breadcrumb\">
        ";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 9
            echo "        <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 9);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 9);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "      </ul>
    </div>
  </div>
  <div class=\"container-fluid\">
    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i> ";
        // line 17
        echo ($context["text_form"] ?? null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
        <form class=\"form-horizontal\">
          <ul id=\"order\" class=\"nav nav-tabs nav-justified\">
            <li class=\"disabled active\"><a href=\"#tab-customer\" data-toggle=\"tab\">1. ";
        // line 22
        echo ($context["tab_customer"] ?? null);
        echo "</a></li>
            <li class=\"disabled\"><a href=\"#tab-cart\" data-toggle=\"tab\">2. ";
        // line 23
        echo ($context["tab_product"] ?? null);
        echo "</a></li>
            <li class=\"disabled\"><a href=\"#tab-payment\" data-toggle=\"tab\">3. ";
        // line 24
        echo ($context["tab_payment"] ?? null);
        echo "</a></li>
            <li class=\"disabled\"><a href=\"#tab-shipping\" data-toggle=\"tab\">4. ";
        // line 25
        echo ($context["tab_shipping"] ?? null);
        echo "</a></li>
            <li class=\"disabled\"><a href=\"#tab-total\" data-toggle=\"tab\">5. ";
        // line 26
        echo ($context["tab_total"] ?? null);
        echo "</a></li>
          </ul>
          <div class=\"tab-content\">
            <div class=\"tab-pane active\" id=\"tab-customer\">
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-store\">";
        // line 31
        echo ($context["entry_store"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"store_id\" id=\"input-store\" class=\"form-control\">
                    ";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["stores"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 35
            echo "                    ";
            if ((twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 35) == ($context["store_id"] ?? null))) {
                // line 36
                echo "                    <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 36);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 36);
                echo "</option>
                    ";
            } else {
                // line 38
                echo "                    <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["store"], "store_id", [], "any", false, false, false, 38);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["store"], "name", [], "any", false, false, false, 38);
                echo "</option>
                    ";
            }
            // line 40
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 41
        echo "                  </select>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-currency\">";
        // line 45
        echo ($context["entry_currency"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"currency\" id=\"input-currency\" class=\"form-control\">
                    ";
        // line 48
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["currencies"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["currency"]) {
            // line 49
            echo "                    ";
            if ((twig_get_attribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 49) == ($context["currency_code"] ?? null))) {
                // line 50
                echo "                    <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 50);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["currency"], "title", [], "any", false, false, false, 50);
                echo "</option>
                    ";
            } else {
                // line 52
                echo "                    <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["currency"], "code", [], "any", false, false, false, 52);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["currency"], "title", [], "any", false, false, false, 52);
                echo "</option>
                    ";
            }
            // line 54
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['currency'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 55
        echo "                  </select>
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-customer\">";
        // line 59
        echo ($context["entry_customer"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"customer\" value=\"";
        // line 61
        echo ($context["customer"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_customer"] ?? null);
        echo "\" id=\"input-customer\" class=\"form-control\" />
                  <input type=\"hidden\" name=\"customer_id\" value=\"";
        // line 62
        echo ($context["customer_id"] ?? null);
        echo "\" />
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-customer-group\">";
        // line 66
        echo ($context["entry_customer_group"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"customer_group_id\" id=\"input-customer-group\" class=\"form-control\">
                    ";
        // line 69
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["customer_groups"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["customer_group"]) {
            // line 70
            echo "                    ";
            if ((twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 70) == ($context["customer_group_id"] ?? null))) {
                // line 71
                echo "                    <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 71);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 71);
                echo "</option>
                    ";
            } else {
                // line 73
                echo "                    <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "customer_group_id", [], "any", false, false, false, 73);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["customer_group"], "name", [], "any", false, false, false, 73);
                echo "</option>
                    ";
            }
            // line 75
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['customer_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 76
        echo "                  </select>
                </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-firstname\">";
        // line 80
        echo ($context["entry_firstname"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"firstname\" value=\"";
        // line 82
        echo ($context["firstname"] ?? null);
        echo "\" id=\"input-firstname\" class=\"form-control\" />
                </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-lastname\">";
        // line 86
        echo ($context["entry_lastname"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"lastname\" value=\"";
        // line 88
        echo ($context["lastname"] ?? null);
        echo "\" id=\"input-lastname\" class=\"form-control\" />
                </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-email\">";
        // line 92
        echo ($context["entry_email"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"email\" value=\"";
        // line 94
        echo ($context["email"] ?? null);
        echo "\" id=\"input-email\" class=\"form-control\" />
                </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-telephone\">";
        // line 98
        echo ($context["entry_telephone"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"telephone\" value=\"";
        // line 100
        echo ($context["telephone"] ?? null);
        echo "\" id=\"input-telephone\" class=\"form-control\" />
                </div>
              </div>
              ";
        // line 103
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["custom_fields"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["custom_field"]) {
            // line 104
            echo "              ";
            if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 104) == "account")) {
                // line 105
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 105) == "select")) {
                    // line 106
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 106);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 106) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\" for=\"input-custom-field";
                    // line 107
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 107);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 107);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"custom_field[";
                    // line 109
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 109);
                    echo "]\" id=\"input-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 109);
                    echo "\" class=\"form-control\">
                    <option value=\"\">";
                    // line 110
                    echo ($context["text_select"] ?? null);
                    echo "</option>
                    ";
                    // line 111
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_value", [], "any", false, false, false, 111));
                    foreach ($context['_seq'] as $context["_key"] => $context["custom_field_value"]) {
                        // line 112
                        echo "                    ";
                        if (((($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = ($context["account_custom_field"] ?? null)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 112)] ?? null) : null) && (twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 112) == (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = ($context["account_custom_field"] ?? null)) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 112)] ?? null) : null)))) {
                            // line 113
                            echo "                    <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 113);
                            echo "\" selected=\"selected\">";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 113);
                            echo "</option>
                    ";
                        } else {
                            // line 115
                            echo "                    <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 115);
                            echo "\">";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 115);
                            echo "</option>
                    ";
                        }
                        // line 117
                        echo "                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 118
                    echo "                  </select>
                </div>
              </div>
              ";
                }
                // line 122
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 122) == "radio")) {
                    // line 123
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 123);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 123) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\">";
                    // line 124
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 124);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <div id=\"input-custom-field";
                    // line 126
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 126);
                    echo "\">
                    ";
                    // line 127
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_value", [], "any", false, false, false, 127));
                    foreach ($context['_seq'] as $context["_key"] => $context["custom_field_value"]) {
                        // line 128
                        echo "                    <div class=\"radio\">
                      ";
                        // line 129
                        if (((($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = ($context["account_custom_field"] ?? null)) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 129)] ?? null) : null) && (twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 129) == (($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = ($context["account_custom_field"] ?? null)) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 129)] ?? null) : null)))) {
                            // line 130
                            echo "                      <label>
                        <input type=\"radio\" name=\"custom_field[";
                            // line 131
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 131);
                            echo "]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 131);
                            echo "\" checked=\"checked\" />
                        ";
                            // line 132
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 132);
                            echo "</label>
                      ";
                        } else {
                            // line 134
                            echo "                      <label>
                        <input type=\"radio\" name=\"custom_field[";
                            // line 135
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 135);
                            echo "]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 135);
                            echo "\" />
                        ";
                            // line 136
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 136);
                            echo "</label>
                      ";
                        }
                        // line 138
                        echo "                    </div>
                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 140
                    echo "                  </div>
                </div>
              </div>
              ";
                }
                // line 144
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 144) == "checkbox")) {
                    // line 145
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 145);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 145) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\">";
                    // line 146
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 146);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <div id=\"input-custom-field";
                    // line 148
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 148);
                    echo "\">
                    ";
                    // line 149
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_value", [], "any", false, false, false, 149));
                    foreach ($context['_seq'] as $context["_key"] => $context["custom_field_value"]) {
                        // line 150
                        echo "                    <div class=\"checkbox\">
                      ";
                        // line 151
                        if (((($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 = ($context["account_custom_field"] ?? null)) && is_array($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4) || $__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 instanceof ArrayAccess ? ($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 151)] ?? null) : null) && twig_in_filter(twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 151), (($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 = ($context["account_custom_field"] ?? null)) && is_array($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666) || $__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 instanceof ArrayAccess ? ($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 151)] ?? null) : null)))) {
                            // line 152
                            echo "                      <label>
                        <input type=\"checkbox\" name=\"custom_field[";
                            // line 153
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 153);
                            echo "][]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 153);
                            echo "\" checked=\"checked\" />
                        ";
                            // line 154
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 154);
                            echo "</label>
                      ";
                        } else {
                            // line 156
                            echo "                      <label>
                        <input type=\"checkbox\" name=\"custom_field[";
                            // line 157
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 157);
                            echo "][]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 157);
                            echo "\" />
                        ";
                            // line 158
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 158);
                            echo "</label>
                      ";
                        }
                        // line 160
                        echo "                    </div>
                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 162
                    echo "                  </div>
                </div>
              </div>
              ";
                }
                // line 166
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 166) == "text")) {
                    // line 167
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 167);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 167) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\" for=\"input-custom-field";
                    // line 168
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 168);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 168);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"custom_field[";
                    // line 170
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 170);
                    echo "]\" value=\"";
                    echo (((($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e = ($context["account_custom_field"] ?? null)) && is_array($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e) || $__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e instanceof ArrayAccess ? ($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 170)] ?? null) : null)) ? ((($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 = ($context["account_custom_field"] ?? null)) && is_array($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52) || $__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 instanceof ArrayAccess ? ($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 170)] ?? null) : null)) : (twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 170)));
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 170);
                    echo "\" id=\"input-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 170);
                    echo "\" class=\"form-control\" />
                </div>
              </div>
              ";
                }
                // line 174
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 174) == "textarea")) {
                    // line 175
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 175);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 175) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\" for=\"input-custom-field";
                    // line 176
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 176);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 176);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <textarea name=\"custom_field[";
                    // line 178
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 178);
                    echo "]\" rows=\"5\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 178);
                    echo "\" id=\"input-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 178);
                    echo "\" class=\"form-control\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 178);
                    echo "</textarea>
                </div>
              </div>
              ";
                }
                // line 182
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 182) == "file")) {
                    // line 183
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 183);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 183) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\">";
                    // line 184
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 184);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <button type=\"button\" id=\"button-custom-field";
                    // line 186
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 186);
                    echo "\" class=\"btn btn-default\"><i class=\"fa fa-upload\"></i> ";
                    echo ($context["button_upload"] ?? null);
                    echo "</button>
                  <input type=\"hidden\" name=\"custom_field[";
                    // line 187
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 187);
                    echo "]\" value=\"";
                    echo (((($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 = (($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 = ($context["account_custom_field"] ?? null)) && is_array($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386) || $__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 instanceof ArrayAccess ? ($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 187)] ?? null) : null)) && is_array($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136) || $__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 instanceof ArrayAccess ? ($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136["code"] ?? null) : null)) ? ((($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 = (($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae = ($context["account_custom_field"] ?? null)) && is_array($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae) || $__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae instanceof ArrayAccess ? ($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 187)] ?? null) : null)) && is_array($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9) || $__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 instanceof ArrayAccess ? ($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9["code"] ?? null) : null)) : (""));
                    echo "\" id=\"input-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 187);
                    echo "\" />
\t\t\t\t  <span>";
                    // line 188
                    echo (($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f = (($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40 = ($context["account_custom_field"] ?? null)) && is_array($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40) || $__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40 instanceof ArrayAccess ? ($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 188)] ?? null) : null)) && is_array($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f) || $__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f instanceof ArrayAccess ? ($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f["name"] ?? null) : null);
                    echo "</span>
                </div>
              </div>
              ";
                }
                // line 192
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 192) == "date")) {
                    // line 193
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 193);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 193) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\" for=\"input-custom-field";
                    // line 194
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 194);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 194);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <div class=\"input-group date\">
                    <input type=\"text\" name=\"custom_field[";
                    // line 197
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 197);
                    echo "]\" value=\"";
                    echo (((($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f = ($context["account_custom_field"] ?? null)) && is_array($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f) || $__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f instanceof ArrayAccess ? ($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 197)] ?? null) : null)) ? ((($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760 = ($context["account_custom_field"] ?? null)) && is_array($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760) || $__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760 instanceof ArrayAccess ? ($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 197)] ?? null) : null)) : (twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 197)));
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 197);
                    echo "\" data-date-format=\"YYYY-MM-DD\" id=\"input-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 197);
                    echo "\" class=\"form-control\" />
                    <span class=\"input-group-btn\">
                    <button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button>
                    </span></div>
                </div>
              </div>
              ";
                }
                // line 204
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 204) == "time")) {
                    // line 205
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 205);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 205) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\" for=\"input-custom-field";
                    // line 206
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 206);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 206);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <div class=\"input-group time\">
                    <input type=\"text\" name=\"custom_field[";
                    // line 209
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 209);
                    echo "]\" value=\"";
                    echo (((($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce = ($context["account_custom_field"] ?? null)) && is_array($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce) || $__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce instanceof ArrayAccess ? ($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 209)] ?? null) : null)) ? ((($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b = ($context["account_custom_field"] ?? null)) && is_array($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b) || $__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b instanceof ArrayAccess ? ($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 209)] ?? null) : null)) : (twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 209)));
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 209);
                    echo "\" data-date-format=\"HH:mm\" id=\"input-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 209);
                    echo "\" class=\"form-control\" />
                    <span class=\"input-group-btn\">
                    <button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button>
                    </span></div>
                </div>
              </div>
              ";
                }
                // line 216
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 216) == "datetime")) {
                    // line 217
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 217);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 217) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\" for=\"input-custom-field";
                    // line 218
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 218);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 218);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <div class=\"input-group datetime\">
                    <input type=\"text\" name=\"custom_field[";
                    // line 221
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 221);
                    echo "]\" value=\"";
                    echo (((($__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c = ($context["account_custom_field"] ?? null)) && is_array($__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c) || $__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c instanceof ArrayAccess ? ($__internal_73db8eef4d2582468dab79a6b09c77ce3b48675a610afd65a1f325b68804a60c[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 221)] ?? null) : null)) ? ((($__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972 = ($context["account_custom_field"] ?? null)) && is_array($__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972) || $__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972 instanceof ArrayAccess ? ($__internal_d8ad5934f1874c52fa2ac9a4dfae52038b39b8b03cfc82eeb53de6151d883972[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 221)] ?? null) : null)) : (twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 221)));
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 221);
                    echo "\" data-date-format=\"YYYY-MM-DD HH:mm\" id=\"input-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 221);
                    echo "\" class=\"form-control\" />
                    <span class=\"input-group-btn\">
                    <button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button>
                    </span></div>
                </div>
              </div>
              ";
                }
                // line 228
                echo "              ";
            }
            // line 229
            echo "              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 230
        echo "              <div class=\"text-right\">
                <button type=\"button\" id=\"button-customer\" data-loading-text=\"";
        // line 231
        echo ($context["text_loading"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-arrow-right\"></i> ";
        echo ($context["button_continue"] ?? null);
        echo "</button>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-cart\">
              <div class=\"table-responsive\">
                <table class=\"table table-bordered\">
                  <thead>
                    <tr>
                      <td class=\"text-left\">";
        // line 239
        echo ($context["column_product"] ?? null);
        echo "</td>
                      <td class=\"text-left\">";
        // line 240
        echo ($context["column_model"] ?? null);
        echo "</td>
                      <td class=\"text-right\">";
        // line 241
        echo ($context["column_quantity"] ?? null);
        echo "</td>
                      <td class=\"text-right\">";
        // line 242
        echo ($context["column_price"] ?? null);
        echo "</td>
                      <td class=\"text-right\">";
        // line 243
        echo ($context["column_total"] ?? null);
        echo "</td>
                      <td>";
        // line 244
        echo ($context["column_action"] ?? null);
        echo "</td>
                    </tr>
                  </thead>
                  <tbody id=\"cart\">
                    ";
        // line 248
        if ((($context["order_products"] ?? null) || ($context["order_vouchers"] ?? null))) {
            // line 249
            echo "                    ";
            $context["product_row"] = 0;
            // line 250
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["order_products"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["order_product"]) {
                // line 251
                echo "                    <tr>
                      <td class=\"text-left\">";
                // line 252
                echo twig_get_attribute($this->env, $this->source, $context["order_product"], "name", [], "any", false, false, false, 252);
                echo "<br />
                        <input type=\"hidden\" name=\"product[";
                // line 253
                echo ($context["product_row"] ?? null);
                echo "][product_id]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_product"], "product_id", [], "any", false, false, false, 253);
                echo "\" />
                        ";
                // line 254
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["order_product"], "option", [], "any", false, false, false, 254));
                foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                    // line 255
                    echo "                        - <small>";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 255);
                    echo ": ";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, false, 255);
                    echo "</small><br />
                        ";
                    // line 256
                    if ((((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 256) == "select") || (twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 256) == "radio")) || (twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 256) == "image"))) {
                        // line 257
                        echo "                        <input type=\"hidden\" name=\"product[";
                        echo ($context["product_row"] ?? null);
                        echo "][option][";
                        echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 257);
                        echo "]\" value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_value_id", [], "any", false, false, false, 257);
                        echo "\" />
                        ";
                    }
                    // line 259
                    echo "                        ";
                    if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 259) == "checkbox")) {
                        // line 260
                        echo "                        <input type=\"hidden\" name=\"product[";
                        echo ($context["product_row"] ?? null);
                        echo "][option][";
                        echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 260);
                        echo "][]\" value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_value_id", [], "any", false, false, false, 260);
                        echo "\" />
                        ";
                    }
                    // line 262
                    echo "                        ";
                    if (((((((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 262) == "text") || (twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 262) == "textarea")) || (twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 262) == "file")) || (twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 262) == "date")) || (twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 262) == "datetime")) || (twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 262) == "time"))) {
                        // line 263
                        echo "                        <input type=\"hidden\" name=\"product[";
                        echo ($context["product_row"] ?? null);
                        echo "][option][";
                        echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 263);
                        echo "]\" value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, false, 263);
                        echo "\" />
                        ";
                    }
                    // line 265
                    echo "                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                echo "</td>
                      <td class=\"text-left\">";
                // line 266
                echo twig_get_attribute($this->env, $this->source, $context["order_product"], "model", [], "any", false, false, false, 266);
                echo "</td>
                      <td class=\"text-right\">";
                // line 267
                echo twig_get_attribute($this->env, $this->source, $context["order_product"], "quantity", [], "any", false, false, false, 267);
                echo "
                        <input type=\"hidden\" name=\"product[";
                // line 268
                echo ($context["product_row"] ?? null);
                echo "][quantity]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_product"], "quantity", [], "any", false, false, false, 268);
                echo "\" /></td>
                      <td class=\"text-right\"></td>
                      <td class=\"text-right\"></td>
                      <td class=\"text-center\"></td>
                    </tr>
                    ";
                // line 273
                $context["product_row"] = (($context["product_row"] ?? null) + 1);
                // line 274
                echo "                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_product'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 275
            echo "                    ";
            $context["voucher_row"] = 0;
            // line 276
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["order_vouchers"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["order_voucher"]) {
                // line 277
                echo "                    <tr>
                      <td class=\"text-left\">";
                // line 278
                echo twig_get_attribute($this->env, $this->source, $context["order_voucher"], "description", [], "any", false, false, false, 278);
                echo "
                        <input type=\"hidden\" name=\"voucher[";
                // line 279
                echo ($context["voucher_row"] ?? null);
                echo "][voucher_id]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_voucher"], "voucher_id", [], "any", false, false, false, 279);
                echo "\" />
                        <input type=\"hidden\" name=\"voucher[";
                // line 280
                echo ($context["voucher_row"] ?? null);
                echo "][description]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_voucher"], "description", [], "any", false, false, false, 280);
                echo "\" />
                        <input type=\"hidden\" name=\"voucher[";
                // line 281
                echo ($context["voucher_row"] ?? null);
                echo "][code]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_voucher"], "code", [], "any", false, false, false, 281);
                echo "\" />
                        <input type=\"hidden\" name=\"voucher[";
                // line 282
                echo ($context["voucher_row"] ?? null);
                echo "][from_name]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_voucher"], "from_name", [], "any", false, false, false, 282);
                echo "\" />
                        <input type=\"hidden\" name=\"voucher[";
                // line 283
                echo ($context["voucher_row"] ?? null);
                echo "][from_email]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_voucher"], "from_email", [], "any", false, false, false, 283);
                echo "\" />
                        <input type=\"hidden\" name=\"voucher[";
                // line 284
                echo ($context["voucher_row"] ?? null);
                echo "][to_name]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_voucher"], "to_name", [], "any", false, false, false, 284);
                echo "\" />
                        <input type=\"hidden\" name=\"voucher[";
                // line 285
                echo ($context["voucher_row"] ?? null);
                echo "][to_email]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_voucher"], "to_email", [], "any", false, false, false, 285);
                echo "\" />
                        <input type=\"hidden\" name=\"voucher[";
                // line 286
                echo ($context["voucher_row"] ?? null);
                echo "][voucher_theme_id]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_voucher"], "voucher_theme_id", [], "any", false, false, false, 286);
                echo "\" />
                        <input type=\"hidden\" name=\"voucher[";
                // line 287
                echo ($context["voucher_row"] ?? null);
                echo "][message]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_voucher"], "message", [], "any", false, false, false, 287);
                echo "\" />
                        <input type=\"hidden\" name=\"voucher[";
                // line 288
                echo ($context["voucher_row"] ?? null);
                echo "][amount]\" value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_voucher"], "amount", [], "any", false, false, false, 288);
                echo "\" /></td>
                      <td class=\"text-left\"></td>
                      <td class=\"text-right\">1</td>
                      <td class=\"text-right\"></td>
                      <td class=\"text-right\"></td>
                      <td class=\"text-center\"></td>
                    </tr>
                    ";
                // line 295
                $context["voucher_row"] = (($context["voucher_row"] ?? null) + 1);
                // line 296
                echo "                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_voucher'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 297
            echo "                    ";
        } else {
            // line 298
            echo "                    <tr>
                      <td class=\"text-center\" colspan=\"6\">";
            // line 299
            echo ($context["text_no_results"] ?? null);
            echo "</td>
                    </tr>
                  </tbody>
                  ";
        }
        // line 303
        echo "                </table>
              </div>
              <ul class=\"nav nav-tabs nav-justified\">
                <li class=\"active\"><a href=\"#tab-product\" data-toggle=\"tab\">";
        // line 306
        echo ($context["tab_product"] ?? null);
        echo "</a></li>
                <li><a href=\"#tab-voucher\" data-toggle=\"tab\">";
        // line 307
        echo ($context["tab_voucher"] ?? null);
        echo "</a></li>
              </ul>
              <div class=\"tab-content\">
                <div class=\"tab-pane active\" id=\"tab-product\">
                  <fieldset>
                    <legend>";
        // line 312
        echo ($context["text_product"] ?? null);
        echo "</legend>
                    <div class=\"form-group\">
                      <label class=\"col-sm-2 control-label\" for=\"input-product\">";
        // line 314
        echo ($context["entry_product"] ?? null);
        echo "</label>
                      <div class=\"col-sm-10\">
                        <input type=\"text\" name=\"product\" value=\"\" id=\"input-product\" class=\"form-control\" />
                        <input type=\"hidden\" name=\"product_id\" value=\"\" />
                      </div>
                    </div>
                    <div class=\"form-group\">
                      <label class=\"col-sm-2 control-label\" for=\"input-quantity\">";
        // line 321
        echo ($context["entry_quantity"] ?? null);
        echo "</label>
                      <div class=\"col-sm-10\">
                        <input type=\"text\" name=\"quantity\" value=\"1\" id=\"input-quantity\" class=\"form-control\" />
                      </div>
                    </div>
                    <div id=\"option\"></div>
                  </fieldset>
                  <div class=\"text-right\">
                    <button type=\"button\" id=\"button-product-add\" data-loading-text=\"";
        // line 329
        echo ($context["text_loading"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus-circle\"></i> ";
        echo ($context["button_product_add"] ?? null);
        echo "</button>
                  </div>
                </div>
                <div class=\"tab-pane\" id=\"tab-voucher\">
                  <fieldset>
                    <legend>";
        // line 334
        echo ($context["text_voucher"] ?? null);
        echo "</legend>
                    <div class=\"form-group required\">
                      <label class=\"col-sm-2 control-label\" for=\"input-to-name\">";
        // line 336
        echo ($context["entry_to_name"] ?? null);
        echo "</label>
                      <div class=\"col-sm-10\">
                        <input type=\"text\" name=\"to_name\" value=\"\" id=\"input-to-name\" class=\"form-control\" />
                      </div>
                    </div>
                    <div class=\"form-group required\">
                      <label class=\"col-sm-2 control-label\" for=\"input-to-email\">";
        // line 342
        echo ($context["entry_to_email"] ?? null);
        echo "</label>
                      <div class=\"col-sm-10\">
                        <input type=\"text\" name=\"to_email\" value=\"\" id=\"input-to-email\" class=\"form-control\" />
                      </div>
                    </div>
                    <div class=\"form-group required\">
                      <label class=\"col-sm-2 control-label\" for=\"input-from-name\">";
        // line 348
        echo ($context["entry_from_name"] ?? null);
        echo "</label>
                      <div class=\"col-sm-10\">
                        <input type=\"text\" name=\"from_name\" value=\"\" id=\"input-from-name\" class=\"form-control\" />
                      </div>
                    </div>
                    <div class=\"form-group required\">
                      <label class=\"col-sm-2 control-label\" for=\"input-from-email\">";
        // line 354
        echo ($context["entry_from_email"] ?? null);
        echo "</label>
                      <div class=\"col-sm-10\">
                        <input type=\"text\" name=\"from_email\" value=\"\" id=\"input-from-email\" class=\"form-control\" />
                      </div>
                    </div>
                    <div class=\"form-group required\">
                      <label class=\"col-sm-2 control-label\" for=\"input-theme\">";
        // line 360
        echo ($context["entry_theme"] ?? null);
        echo "</label>
                      <div class=\"col-sm-10\">
                        <select name=\"voucher_theme_id\" id=\"input-theme\" class=\"form-control\">
                          ";
        // line 363
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["voucher_themes"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["voucher_theme"]) {
            // line 364
            echo "                          <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["voucher_theme"], "voucher_theme_id", [], "any", false, false, false, 364);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["voucher_theme"], "name", [], "any", false, false, false, 364);
            echo "</option>
                          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['voucher_theme'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 366
        echo "                        </select>
                      </div>
                    </div>
                    <div class=\"form-group\">
                      <label class=\"col-sm-2 control-label\" for=\"input-message\">";
        // line 370
        echo ($context["entry_message"] ?? null);
        echo "</label>
                      <div class=\"col-sm-10\">
                        <textarea name=\"message\" rows=\"5\" id=\"input-message\" class=\"form-control\"></textarea>
                      </div>
                    </div>
                    <div class=\"form-group required\">
                      <label class=\"col-sm-2 control-label\" for=\"input-amount\">";
        // line 376
        echo ($context["entry_amount"] ?? null);
        echo "</label>
                      <div class=\"col-sm-10\">
                        <input type=\"text\" name=\"amount\" value=\"";
        // line 378
        echo ($context["voucher_min"] ?? null);
        echo "\" id=\"input-amount\" class=\"form-control\" />
                      </div>
                    </div>
                  </fieldset>
                  <div class=\"text-right\">
                    <button type=\"button\" id=\"button-voucher-add\" data-loading-text=\"";
        // line 383
        echo ($context["text_loading"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus-circle\"></i> ";
        echo ($context["button_voucher_add"] ?? null);
        echo "</button>
                  </div>
                </div>
              </div>
              <br />
              <div class=\"row\">
                <div class=\"col-sm-6 text-left\">
                  <button type=\"button\" onclick=\"\$('a[href=\\'#tab-customer\\']').tab('show');\" class=\"btn btn-default\"><i class=\"fa fa-arrow-left\"></i> ";
        // line 390
        echo ($context["button_back"] ?? null);
        echo "</button>
                </div>
                <div class=\"col-sm-6 text-right\">
                  <button type=\"button\" id=\"button-cart\" class=\"btn btn-primary\"><i class=\"fa fa-arrow-right\"></i> ";
        // line 393
        echo ($context["button_continue"] ?? null);
        echo "</button>
                </div>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-payment\">
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-payment-address\">";
        // line 399
        echo ($context["entry_address"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"payment_address\" id=\"input-payment-address\" class=\"form-control\">
                    <option value=\"0\" selected=\"selected\">";
        // line 402
        echo ($context["text_none"] ?? null);
        echo "</option>
                    ";
        // line 403
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["addresses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["address"]) {
            // line 404
            echo "                    <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["address"], "address_id", [], "any", false, false, false, 404);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["address"], "firstname", [], "any", false, false, false, 404);
            echo " ";
            echo twig_get_attribute($this->env, $this->source, $context["address"], "lastname", [], "any", false, false, false, 404);
            echo ", ";
            echo twig_get_attribute($this->env, $this->source, $context["address"], "address_1", [], "any", false, false, false, 404);
            echo ", ";
            echo twig_get_attribute($this->env, $this->source, $context["address"], "city", [], "any", false, false, false, 404);
            echo ", ";
            echo twig_get_attribute($this->env, $this->source, $context["address"], "country", [], "any", false, false, false, 404);
            echo "</option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['address'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 406
        echo "                  </select>
                </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-payment-firstname\">";
        // line 410
        echo ($context["entry_firstname"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"firstname\" value=\"";
        // line 412
        echo ($context["payment_firstname"] ?? null);
        echo "\" id=\"input-payment-firstname\" class=\"form-control\" />
                </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-payment-lastname\">";
        // line 416
        echo ($context["entry_lastname"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"lastname\" value=\"";
        // line 418
        echo ($context["payment_lastname"] ?? null);
        echo "\" id=\"input-payment-lastname\" class=\"form-control\" />
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-payment-company\">";
        // line 422
        echo ($context["entry_company"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"company\" value=\"";
        // line 424
        echo ($context["payment_company"] ?? null);
        echo "\" id=\"input-payment-company\" class=\"form-control\" />
                </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-payment-address-1\">";
        // line 428
        echo ($context["entry_address_1"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"address_1\" value=\"";
        // line 430
        echo ($context["payment_address_1"] ?? null);
        echo "\" id=\"input-payment-address-1\" class=\"form-control\" />
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-payment-address-2\">";
        // line 434
        echo ($context["entry_address_2"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"address_2\" value=\"";
        // line 436
        echo ($context["payment_address_2"] ?? null);
        echo "\" id=\"input-payment-address-2\" class=\"form-control\" />
                </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-payment-city\">";
        // line 440
        echo ($context["entry_city"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"city\" value=\"";
        // line 442
        echo ($context["payment_city"] ?? null);
        echo "\" id=\"input-payment-city\" class=\"form-control\" />
                </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-payment-postcode\">";
        // line 446
        echo ($context["entry_postcode"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"postcode\" value=\"";
        // line 448
        echo ($context["payment_postcode"] ?? null);
        echo "\" id=\"input-payment-postcode\" class=\"form-control\" />
                </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-payment-country\">";
        // line 452
        echo ($context["entry_country"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"country_id\" id=\"input-payment-country\" class=\"form-control\">
                    <option value=\"\">";
        // line 455
        echo ($context["text_select"] ?? null);
        echo "</option>
                    ";
        // line 456
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["countries"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["country"]) {
            // line 457
            echo "                    ";
            if ((twig_get_attribute($this->env, $this->source, $context["country"], "country_id", [], "any", false, false, false, 457) == ($context["payment_country_id"] ?? null))) {
                // line 458
                echo "                    <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["country"], "country_id", [], "any", false, false, false, 458);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["country"], "name", [], "any", false, false, false, 458);
                echo "</option>
                    ";
            } else {
                // line 460
                echo "                    <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["country"], "country_id", [], "any", false, false, false, 460);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["country"], "name", [], "any", false, false, false, 460);
                echo "</option>
                    ";
            }
            // line 462
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['country'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 463
        echo "                  </select>
                </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-payment-zone\">";
        // line 467
        echo ($context["entry_zone"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"zone_id\" id=\"input-payment-zone\" class=\"form-control\">
                  </select>
                </div>
              </div>
              ";
        // line 473
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["custom_fields"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["custom_field"]) {
            // line 474
            echo "              ";
            if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 474) == "address")) {
                // line 475
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 475) == "select")) {
                    // line 476
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 476);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 476) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\" for=\"input-payment-custom-field";
                    // line 477
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 477);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 477);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"custom_field[";
                    // line 479
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 479);
                    echo "]\" id=\"input-payment-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 479);
                    echo "\" class=\"form-control\">
                    <option value=\"\">";
                    // line 480
                    echo ($context["text_select"] ?? null);
                    echo "</option>
                    ";
                    // line 481
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_value", [], "any", false, false, false, 481));
                    foreach ($context['_seq'] as $context["_key"] => $context["custom_field_value"]) {
                        // line 482
                        echo "                    ";
                        if (((($__internal_df39c71428eaf37baa1ea2198679e0077f3699bdd31bb5ba10d084710b9da216 = ($context["payment_custom_field"] ?? null)) && is_array($__internal_df39c71428eaf37baa1ea2198679e0077f3699bdd31bb5ba10d084710b9da216) || $__internal_df39c71428eaf37baa1ea2198679e0077f3699bdd31bb5ba10d084710b9da216 instanceof ArrayAccess ? ($__internal_df39c71428eaf37baa1ea2198679e0077f3699bdd31bb5ba10d084710b9da216[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 482)] ?? null) : null) && (twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 482) == (($__internal_bf0e189d688dc2ad611b50a437a32d3692fb6b8be90d2228617cfa6db44e75c0 = ($context["payment_custom_field"] ?? null)) && is_array($__internal_bf0e189d688dc2ad611b50a437a32d3692fb6b8be90d2228617cfa6db44e75c0) || $__internal_bf0e189d688dc2ad611b50a437a32d3692fb6b8be90d2228617cfa6db44e75c0 instanceof ArrayAccess ? ($__internal_bf0e189d688dc2ad611b50a437a32d3692fb6b8be90d2228617cfa6db44e75c0[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 482)] ?? null) : null)))) {
                            // line 483
                            echo "                    <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 483);
                            echo "\" selected=\"selected\">";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 483);
                            echo "</option>
                    ";
                        } else {
                            // line 485
                            echo "                    <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 485);
                            echo "\">";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 485);
                            echo "</option>
                    ";
                        }
                        // line 487
                        echo "                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 488
                    echo "                  </select>
                </div>
              </div>
              ";
                }
                // line 492
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 492) == "radio")) {
                    // line 493
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 493);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 493) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\">";
                    // line 494
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 494);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <div id=\"input-payment-custom-field";
                    // line 496
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 496);
                    echo "\">
                    ";
                    // line 497
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_value", [], "any", false, false, false, 497));
                    foreach ($context['_seq'] as $context["_key"] => $context["custom_field_value"]) {
                        // line 498
                        echo "                    <div class=\"radio\">
                      ";
                        // line 499
                        if (((($__internal_674c0abf302105af78b0a38907d86c5dd0028bdc3ee5f24bf52771a16487760c = ($context["payment_custom_field"] ?? null)) && is_array($__internal_674c0abf302105af78b0a38907d86c5dd0028bdc3ee5f24bf52771a16487760c) || $__internal_674c0abf302105af78b0a38907d86c5dd0028bdc3ee5f24bf52771a16487760c instanceof ArrayAccess ? ($__internal_674c0abf302105af78b0a38907d86c5dd0028bdc3ee5f24bf52771a16487760c[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 499)] ?? null) : null) && (twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 499) == (($__internal_dd839fbfcab68823c49af471c7df7659a500fe72e71b58d6b80d896bdb55e75f = ($context["payment_custom_field"] ?? null)) && is_array($__internal_dd839fbfcab68823c49af471c7df7659a500fe72e71b58d6b80d896bdb55e75f) || $__internal_dd839fbfcab68823c49af471c7df7659a500fe72e71b58d6b80d896bdb55e75f instanceof ArrayAccess ? ($__internal_dd839fbfcab68823c49af471c7df7659a500fe72e71b58d6b80d896bdb55e75f[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 499)] ?? null) : null)))) {
                            // line 500
                            echo "                      <label>
                        <input type=\"radio\" name=\"custom_field[";
                            // line 501
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 501);
                            echo "]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 501);
                            echo "\" checked=\"checked\" />
                        ";
                            // line 502
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 502);
                            echo "</label>
                      ";
                        } else {
                            // line 504
                            echo "                      <label>
                        <input type=\"radio\" name=\"custom_field[";
                            // line 505
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 505);
                            echo "]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 505);
                            echo "\" />
                        ";
                            // line 506
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 506);
                            echo "</label>
                      ";
                        }
                        // line 508
                        echo "                    </div>
                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 510
                    echo "                  </div>
                </div>
              </div>
              ";
                }
                // line 514
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 514) == "checkbox")) {
                    // line 515
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 515);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 515) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\">";
                    // line 516
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 516);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <div id=\"input-payment-custom-field";
                    // line 518
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 518);
                    echo "\">
                    ";
                    // line 519
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_value", [], "any", false, false, false, 519));
                    foreach ($context['_seq'] as $context["_key"] => $context["custom_field_value"]) {
                        // line 520
                        echo "                    <div class=\"checkbox\">
                      ";
                        // line 521
                        if (((($__internal_a7ed47878554bdc32b70e1ba5ccc67d2302196876fbf62b4c853b20cb9e029fc = ($context["payment_custom_field"] ?? null)) && is_array($__internal_a7ed47878554bdc32b70e1ba5ccc67d2302196876fbf62b4c853b20cb9e029fc) || $__internal_a7ed47878554bdc32b70e1ba5ccc67d2302196876fbf62b4c853b20cb9e029fc instanceof ArrayAccess ? ($__internal_a7ed47878554bdc32b70e1ba5ccc67d2302196876fbf62b4c853b20cb9e029fc[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 521)] ?? null) : null) && twig_in_filter(twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 521), (($__internal_e5d7b41e16b744b68da1e9bb49047b8028ced86c782900009b4b4029b83d4b55 = ($context["payment_custom_field"] ?? null)) && is_array($__internal_e5d7b41e16b744b68da1e9bb49047b8028ced86c782900009b4b4029b83d4b55) || $__internal_e5d7b41e16b744b68da1e9bb49047b8028ced86c782900009b4b4029b83d4b55 instanceof ArrayAccess ? ($__internal_e5d7b41e16b744b68da1e9bb49047b8028ced86c782900009b4b4029b83d4b55[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 521)] ?? null) : null)))) {
                            // line 522
                            echo "                      <label>
                        <input type=\"checkbox\" name=\"custom_field[";
                            // line 523
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 523);
                            echo "][]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 523);
                            echo "\" checked=\"checked\" />
                        ";
                            // line 524
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 524);
                            echo "</label>
                      ";
                        } else {
                            // line 526
                            echo "                      <label>
                        <input type=\"checkbox\" name=\"custom_field[";
                            // line 527
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 527);
                            echo "][]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 527);
                            echo "\" />
                        ";
                            // line 528
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 528);
                            echo "</label>
                      ";
                        }
                        // line 530
                        echo "                    </div>
                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 532
                    echo "                  </div>
                </div>
              </div>
              ";
                }
                // line 536
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 536) == "text")) {
                    // line 537
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 537);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 537) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\" for=\"input-payment-custom-field";
                    // line 538
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 538);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 538);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"custom_field[";
                    // line 540
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 540);
                    echo "]\" value=\"";
                    echo (((($__internal_9e93f398968fa0576dce82fd00f280e95c734ad3f84e7816ff09158ae224f5ba = ($context["payment_custom_field"] ?? null)) && is_array($__internal_9e93f398968fa0576dce82fd00f280e95c734ad3f84e7816ff09158ae224f5ba) || $__internal_9e93f398968fa0576dce82fd00f280e95c734ad3f84e7816ff09158ae224f5ba instanceof ArrayAccess ? ($__internal_9e93f398968fa0576dce82fd00f280e95c734ad3f84e7816ff09158ae224f5ba[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 540)] ?? null) : null)) ? ((($__internal_0795e3de58b6454b051261c0c2b5be48852e17f25b59d4aeef29fb07c614bd78 = ($context["payment_custom_field"] ?? null)) && is_array($__internal_0795e3de58b6454b051261c0c2b5be48852e17f25b59d4aeef29fb07c614bd78) || $__internal_0795e3de58b6454b051261c0c2b5be48852e17f25b59d4aeef29fb07c614bd78 instanceof ArrayAccess ? ($__internal_0795e3de58b6454b051261c0c2b5be48852e17f25b59d4aeef29fb07c614bd78[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 540)] ?? null) : null)) : (twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 540)));
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 540);
                    echo "\" id=\"input-payment-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 540);
                    echo "\" class=\"form-control\" />
                </div>
              </div>
              ";
                }
                // line 544
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 544) == "textarea")) {
                    // line 545
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 545);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 545) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\" for=\"input-payment-custom-field";
                    // line 546
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 546);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 546);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <textarea name=\"custom_field[";
                    // line 548
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 548);
                    echo "]\" rows=\"5\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 548);
                    echo "\" id=\"input-payment-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 548);
                    echo "\" class=\"form-control\">";
                    echo (((($__internal_fecb0565c93d0b979a95c352ff76e401e0ae0c73bb8d3b443c8c6133e1c190de = ($context["payment_custom_field"] ?? null)) && is_array($__internal_fecb0565c93d0b979a95c352ff76e401e0ae0c73bb8d3b443c8c6133e1c190de) || $__internal_fecb0565c93d0b979a95c352ff76e401e0ae0c73bb8d3b443c8c6133e1c190de instanceof ArrayAccess ? ($__internal_fecb0565c93d0b979a95c352ff76e401e0ae0c73bb8d3b443c8c6133e1c190de[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 548)] ?? null) : null)) ? ((($__internal_87570a635eac7f6e150744bd218085d17aff15d92d9c80a66d3b911e3355b828 = ($context["payment_custom_field"] ?? null)) && is_array($__internal_87570a635eac7f6e150744bd218085d17aff15d92d9c80a66d3b911e3355b828) || $__internal_87570a635eac7f6e150744bd218085d17aff15d92d9c80a66d3b911e3355b828 instanceof ArrayAccess ? ($__internal_87570a635eac7f6e150744bd218085d17aff15d92d9c80a66d3b911e3355b828[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 548)] ?? null) : null)) : (twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 548)));
                    echo "</textarea>
                </div>
              </div>
              ";
                }
                // line 552
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 552) == "file")) {
                    // line 553
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 553);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 553) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\">";
                    // line 554
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 554);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <button type=\"button\" id=\"button-payment-custom-field";
                    // line 556
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 556);
                    echo "\" data-loading-text=\"";
                    echo ($context["text_loading"] ?? null);
                    echo "\" class=\"btn btn-default\"><i class=\"fa fa-upload\"></i> ";
                    echo ($context["button_upload"] ?? null);
                    echo "</button>
                  <input type=\"hidden\" name=\"custom_field[";
                    // line 557
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 557);
                    echo "]\" value=\"";
                    echo (((($__internal_17b5b5f9aaeec4b528bfeed02b71f624021d6a52d927f441de2f2204d0e527cd = (($__internal_0db9a23306660395861a0528381e0668025e56a8a99f399e9ec23a4b392422d6 = ($context["payment_custom_field"] ?? null)) && is_array($__internal_0db9a23306660395861a0528381e0668025e56a8a99f399e9ec23a4b392422d6) || $__internal_0db9a23306660395861a0528381e0668025e56a8a99f399e9ec23a4b392422d6 instanceof ArrayAccess ? ($__internal_0db9a23306660395861a0528381e0668025e56a8a99f399e9ec23a4b392422d6[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 557)] ?? null) : null)) && is_array($__internal_17b5b5f9aaeec4b528bfeed02b71f624021d6a52d927f441de2f2204d0e527cd) || $__internal_17b5b5f9aaeec4b528bfeed02b71f624021d6a52d927f441de2f2204d0e527cd instanceof ArrayAccess ? ($__internal_17b5b5f9aaeec4b528bfeed02b71f624021d6a52d927f441de2f2204d0e527cd["code"] ?? null) : null)) ? ((($__internal_0a23ad2f11a348e49c87410947e20d5a4e711234ce49927662da5dddac687855 = (($__internal_0228c5445a74540c89ea8a758478d405796357800f8af831a7f7e1e2c0159d9b = ($context["payment_custom_field"] ?? null)) && is_array($__internal_0228c5445a74540c89ea8a758478d405796357800f8af831a7f7e1e2c0159d9b) || $__internal_0228c5445a74540c89ea8a758478d405796357800f8af831a7f7e1e2c0159d9b instanceof ArrayAccess ? ($__internal_0228c5445a74540c89ea8a758478d405796357800f8af831a7f7e1e2c0159d9b[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 557)] ?? null) : null)) && is_array($__internal_0a23ad2f11a348e49c87410947e20d5a4e711234ce49927662da5dddac687855) || $__internal_0a23ad2f11a348e49c87410947e20d5a4e711234ce49927662da5dddac687855 instanceof ArrayAccess ? ($__internal_0a23ad2f11a348e49c87410947e20d5a4e711234ce49927662da5dddac687855["code"] ?? null) : null)) : (""));
                    echo "\" id=\"input-payment-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 557);
                    echo "\" />
\t\t\t\t  <span>";
                    // line 558
                    echo (($__internal_6fb04c4457ec9ffa7dd6fd2300542be8b961b6e5f7858a80a282f47b43ddae5f = (($__internal_417a1a95b289c75779f33186a6dc0b71d01f257b68beae7dcb9d2d769acca0e0 = ($context["payment_custom_field"] ?? null)) && is_array($__internal_417a1a95b289c75779f33186a6dc0b71d01f257b68beae7dcb9d2d769acca0e0) || $__internal_417a1a95b289c75779f33186a6dc0b71d01f257b68beae7dcb9d2d769acca0e0 instanceof ArrayAccess ? ($__internal_417a1a95b289c75779f33186a6dc0b71d01f257b68beae7dcb9d2d769acca0e0[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 558)] ?? null) : null)) && is_array($__internal_6fb04c4457ec9ffa7dd6fd2300542be8b961b6e5f7858a80a282f47b43ddae5f) || $__internal_6fb04c4457ec9ffa7dd6fd2300542be8b961b6e5f7858a80a282f47b43ddae5f instanceof ArrayAccess ? ($__internal_6fb04c4457ec9ffa7dd6fd2300542be8b961b6e5f7858a80a282f47b43ddae5f["name"] ?? null) : null);
                    echo "</span>
                </div>
              </div>
              ";
                }
                // line 562
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 562) == "date")) {
                    // line 563
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 563);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 563) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\" for=\"input-payment-custom-field";
                    // line 564
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 564);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 564);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <div class=\"input-group date\">
                    <input type=\"text\" name=\"custom_field[";
                    // line 567
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 567);
                    echo "]\" value=\"";
                    echo (((($__internal_af3439635eb343262861f05093b3dcce5d4dae1e20a47bc25a2eef28135b0d55 = ($context["payment_custom_field"] ?? null)) && is_array($__internal_af3439635eb343262861f05093b3dcce5d4dae1e20a47bc25a2eef28135b0d55) || $__internal_af3439635eb343262861f05093b3dcce5d4dae1e20a47bc25a2eef28135b0d55 instanceof ArrayAccess ? ($__internal_af3439635eb343262861f05093b3dcce5d4dae1e20a47bc25a2eef28135b0d55[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 567)] ?? null) : null)) ? ((($__internal_b16f7904bcaaa7a87404cbf85addc7a8645dff94eef4e8ae7182b86e3638e76a = ($context["payment_custom_field"] ?? null)) && is_array($__internal_b16f7904bcaaa7a87404cbf85addc7a8645dff94eef4e8ae7182b86e3638e76a) || $__internal_b16f7904bcaaa7a87404cbf85addc7a8645dff94eef4e8ae7182b86e3638e76a instanceof ArrayAccess ? ($__internal_b16f7904bcaaa7a87404cbf85addc7a8645dff94eef4e8ae7182b86e3638e76a[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 567)] ?? null) : null)) : (twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 567)));
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 567);
                    echo "\" data-date-format=\"YYYY-MM-DD\" id=\"input-payment-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 567);
                    echo "\" class=\"form-control\" />
                    <span class=\"input-group-btn\">
                    <button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button>
                    </span></div>
                </div>
              </div>
              ";
                }
                // line 574
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 574) == "time")) {
                    // line 575
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 575);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 575) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\" for=\"input-payment-custom-field";
                    // line 576
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 576);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 576);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <div class=\"input-group time\">
                    <input type=\"text\" name=\"custom_field[";
                    // line 579
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 579);
                    echo "]\" value=\"";
                    echo (((($__internal_462377748602ccf3a44a10ced4240983cec8df1ad86ab53e582fcddddb98fc88 = ($context["payment_custom_field"] ?? null)) && is_array($__internal_462377748602ccf3a44a10ced4240983cec8df1ad86ab53e582fcddddb98fc88) || $__internal_462377748602ccf3a44a10ced4240983cec8df1ad86ab53e582fcddddb98fc88 instanceof ArrayAccess ? ($__internal_462377748602ccf3a44a10ced4240983cec8df1ad86ab53e582fcddddb98fc88[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 579)] ?? null) : null)) ? ((($__internal_be1db6a1ea9fa5c04c40f99df0ec5af053ca391863fc6256c5c4ee249724f758 = ($context["payment_custom_field"] ?? null)) && is_array($__internal_be1db6a1ea9fa5c04c40f99df0ec5af053ca391863fc6256c5c4ee249724f758) || $__internal_be1db6a1ea9fa5c04c40f99df0ec5af053ca391863fc6256c5c4ee249724f758 instanceof ArrayAccess ? ($__internal_be1db6a1ea9fa5c04c40f99df0ec5af053ca391863fc6256c5c4ee249724f758[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 579)] ?? null) : null)) : (twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 579)));
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 579);
                    echo "\" data-date-format=\"HH:mm\" id=\"input-payment-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 579);
                    echo "\" class=\"form-control\" />
                    <span class=\"input-group-btn\">
                    <button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button>
                    </span></div>
                </div>
              </div>
              ";
                }
                // line 586
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 586) == "datetime")) {
                    // line 587
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 587);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 587) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\" for=\"input-payment-custom-field";
                    // line 588
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 588);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 588);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <div class=\"input-group datetime\">
                    <input type=\"text\" name=\"custom_field[";
                    // line 591
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 591);
                    echo "]\" value=\"";
                    echo (((($__internal_6e6eda1691934a8f5855a3221f5a9f036391304a5cda73a3a2009f2961a84c35 = ($context["payment_custom_field"] ?? null)) && is_array($__internal_6e6eda1691934a8f5855a3221f5a9f036391304a5cda73a3a2009f2961a84c35) || $__internal_6e6eda1691934a8f5855a3221f5a9f036391304a5cda73a3a2009f2961a84c35 instanceof ArrayAccess ? ($__internal_6e6eda1691934a8f5855a3221f5a9f036391304a5cda73a3a2009f2961a84c35[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 591)] ?? null) : null)) ? ((($__internal_51c633083c79004f3cb5e9e2b2f3504f650f1561800582801028bcbcf733a06b = ($context["payment_custom_field"] ?? null)) && is_array($__internal_51c633083c79004f3cb5e9e2b2f3504f650f1561800582801028bcbcf733a06b) || $__internal_51c633083c79004f3cb5e9e2b2f3504f650f1561800582801028bcbcf733a06b instanceof ArrayAccess ? ($__internal_51c633083c79004f3cb5e9e2b2f3504f650f1561800582801028bcbcf733a06b[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 591)] ?? null) : null)) : (twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 591)));
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 591);
                    echo "\" data-date-format=\"YYYY-MM-DD HH:mm\" id=\"input-payment-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 591);
                    echo "\" class=\"form-control\" />
                    <span class=\"input-group-btn\">
                    <button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button>
                    </span></div>
                </div>
              </div>
              ";
                }
                // line 598
                echo "              ";
            }
            // line 599
            echo "              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 600
        echo "              <div class=\"row\">
                <div class=\"col-sm-6 text-left\">
                  <button type=\"button\" onclick=\"\$('a[href=\\'#tab-cart\\']').tab('show');\" class=\"btn btn-default\"><i class=\"fa fa-arrow-left\"></i> ";
        // line 602
        echo ($context["button_back"] ?? null);
        echo "</button>
                </div>
                <div class=\"col-sm-6 text-right\">
                  <button type=\"button\" id=\"button-payment-address\" data-loading-text=\"";
        // line 605
        echo ($context["text_loading"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-arrow-right\"></i> ";
        echo ($context["button_continue"] ?? null);
        echo "</button>
                </div>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-shipping\">
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-shipping-address\">";
        // line 611
        echo ($context["entry_address"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"shipping_address\" id=\"input-shipping-address\" class=\"form-control\">
                    <option value=\"0\" selected=\"selected\">";
        // line 614
        echo ($context["text_none"] ?? null);
        echo "</option>
                    ";
        // line 615
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["addresses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["address"]) {
            // line 616
            echo "                    <option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["address"], "address_id", [], "any", false, false, false, 616);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["address"], "firstname", [], "any", false, false, false, 616);
            echo " ";
            echo twig_get_attribute($this->env, $this->source, $context["address"], "lastname", [], "any", false, false, false, 616);
            echo ", ";
            echo twig_get_attribute($this->env, $this->source, $context["address"], "address_1", [], "any", false, false, false, 616);
            echo ", ";
            echo twig_get_attribute($this->env, $this->source, $context["address"], "city", [], "any", false, false, false, 616);
            echo ", ";
            echo twig_get_attribute($this->env, $this->source, $context["address"], "country", [], "any", false, false, false, 616);
            echo "</option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['address'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 618
        echo "                  </select>
                </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-shipping-firstname\">";
        // line 622
        echo ($context["entry_firstname"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"firstname\" value=\"";
        // line 624
        echo ($context["shipping_firstname"] ?? null);
        echo "\" id=\"input-shipping-firstname\" class=\"form-control\" />
                </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-shipping-lastname\">";
        // line 628
        echo ($context["entry_lastname"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"lastname\" value=\"";
        // line 630
        echo ($context["shipping_lastname"] ?? null);
        echo "\" id=\"input-shipping-lastname\" class=\"form-control\" />
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-shipping-company\">";
        // line 634
        echo ($context["entry_company"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"company\" value=\"";
        // line 636
        echo ($context["shipping_company"] ?? null);
        echo "\" id=\"input-shipping-company\" class=\"form-control\" />
                </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-shipping-address-1\">";
        // line 640
        echo ($context["entry_address_1"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"address_1\" value=\"";
        // line 642
        echo ($context["shipping_address_1"] ?? null);
        echo "\" id=\"input-shipping-address-1\" class=\"form-control\" />
                </div>
              </div>
              <div class=\"form-group\">
                <label class=\"col-sm-2 control-label\" for=\"input-shipping-address-2\">";
        // line 646
        echo ($context["entry_address_2"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"address_2\" value=\"";
        // line 648
        echo ($context["shipping_address_2"] ?? null);
        echo "\" id=\"input-shipping-address-2\" class=\"form-control\" />
                </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-shipping-city\">";
        // line 652
        echo ($context["entry_city"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"city\" value=\"";
        // line 654
        echo ($context["shipping_city"] ?? null);
        echo "\" id=\"input-shipping-city\" class=\"form-control\" />
                </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-shipping-postcode\">";
        // line 658
        echo ($context["entry_postcode"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"postcode\" value=\"";
        // line 660
        echo ($context["shipping_postcode"] ?? null);
        echo "\" id=\"input-shipping-postcode\" class=\"form-control\" />
                </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-shipping-country\">";
        // line 664
        echo ($context["entry_country"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"country_id\" id=\"input-shipping-country\" class=\"form-control\">
                    <option value=\"\">";
        // line 667
        echo ($context["text_select"] ?? null);
        echo "</option>
                    ";
        // line 668
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["countries"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["country"]) {
            // line 669
            echo "                    ";
            if ((twig_get_attribute($this->env, $this->source, $context["country"], "country_id", [], "any", false, false, false, 669) == ($context["shipping_country_id"] ?? null))) {
                // line 670
                echo "                    <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["country"], "country_id", [], "any", false, false, false, 670);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["country"], "name", [], "any", false, false, false, 670);
                echo "</option>
                    ";
            } else {
                // line 672
                echo "                    <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["country"], "country_id", [], "any", false, false, false, 672);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["country"], "name", [], "any", false, false, false, 672);
                echo "</option>
                    ";
            }
            // line 674
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['country'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 675
        echo "                  </select>
                </div>
              </div>
              <div class=\"form-group required\">
                <label class=\"col-sm-2 control-label\" for=\"input-shipping-zone\">";
        // line 679
        echo ($context["entry_zone"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"zone_id\" id=\"input-shipping-zone\" class=\"form-control\">
                  </select>
                </div>
              </div>
              ";
        // line 685
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["custom_fields"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["custom_field"]) {
            // line 686
            echo "              ";
            if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "location", [], "any", false, false, false, 686) == "address")) {
                // line 687
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 687) == "select")) {
                    // line 688
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 688);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 688) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\" for=\"input-shipping-custom-field";
                    // line 689
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 689);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 689);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <select name=\"custom_field[";
                    // line 691
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 691);
                    echo "]\" id=\"input-shipping-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 691);
                    echo "\" class=\"form-control\">
                    <option value=\"\">";
                    // line 692
                    echo ($context["text_select"] ?? null);
                    echo "</option>
                    ";
                    // line 693
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_value", [], "any", false, false, false, 693));
                    foreach ($context['_seq'] as $context["_key"] => $context["custom_field_value"]) {
                        // line 694
                        echo "                    ";
                        if (((($__internal_064553f1273f2ea50405f85092d06733f3f2fe5d0fc42fda135e1fdc91ff26ae = ($context["shipping_custom_field"] ?? null)) && is_array($__internal_064553f1273f2ea50405f85092d06733f3f2fe5d0fc42fda135e1fdc91ff26ae) || $__internal_064553f1273f2ea50405f85092d06733f3f2fe5d0fc42fda135e1fdc91ff26ae instanceof ArrayAccess ? ($__internal_064553f1273f2ea50405f85092d06733f3f2fe5d0fc42fda135e1fdc91ff26ae[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 694)] ?? null) : null) && (twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 694) == (($__internal_7bef02f75e2984f8c7fcd4fd7871e286c87c0fdcb248271a136b01ac6dd5dd54 = ($context["shipping_custom_field"] ?? null)) && is_array($__internal_7bef02f75e2984f8c7fcd4fd7871e286c87c0fdcb248271a136b01ac6dd5dd54) || $__internal_7bef02f75e2984f8c7fcd4fd7871e286c87c0fdcb248271a136b01ac6dd5dd54 instanceof ArrayAccess ? ($__internal_7bef02f75e2984f8c7fcd4fd7871e286c87c0fdcb248271a136b01ac6dd5dd54[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 694)] ?? null) : null)))) {
                            // line 695
                            echo "                    <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 695);
                            echo "\" selected=\"selected\">";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 695);
                            echo "</option>
                    ";
                        } else {
                            // line 697
                            echo "                    <option value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 697);
                            echo "\">";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 697);
                            echo "</option>
                    ";
                        }
                        // line 699
                        echo "                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 700
                    echo "                  </select>
                </div>
              </div>
              ";
                }
                // line 704
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 704) == "radio")) {
                    // line 705
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 705);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 705) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\">";
                    // line 706
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 706);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <div id=\"input-shipping-custom-field";
                    // line 708
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 708);
                    echo "\">
                    ";
                    // line 709
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_value", [], "any", false, false, false, 709));
                    foreach ($context['_seq'] as $context["_key"] => $context["custom_field_value"]) {
                        // line 710
                        echo "                    <div class=\"radio\">
                      ";
                        // line 711
                        if (((($__internal_d6ae6b41786cc4be7778386d06cb288c8e6ffd74e055cfed45d7a5c8854d0c8f = ($context["shipping_custom_field"] ?? null)) && is_array($__internal_d6ae6b41786cc4be7778386d06cb288c8e6ffd74e055cfed45d7a5c8854d0c8f) || $__internal_d6ae6b41786cc4be7778386d06cb288c8e6ffd74e055cfed45d7a5c8854d0c8f instanceof ArrayAccess ? ($__internal_d6ae6b41786cc4be7778386d06cb288c8e6ffd74e055cfed45d7a5c8854d0c8f[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 711)] ?? null) : null) && (twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 711) == (($__internal_1dcdec7ec31e102fbfe45103ea3599c92c8609311e43d40ca0d95d0369434327 = ($context["shipping_custom_field"] ?? null)) && is_array($__internal_1dcdec7ec31e102fbfe45103ea3599c92c8609311e43d40ca0d95d0369434327) || $__internal_1dcdec7ec31e102fbfe45103ea3599c92c8609311e43d40ca0d95d0369434327 instanceof ArrayAccess ? ($__internal_1dcdec7ec31e102fbfe45103ea3599c92c8609311e43d40ca0d95d0369434327[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 711)] ?? null) : null)))) {
                            // line 712
                            echo "                      <label>
                        <input type=\"radio\" name=\"custom_field[";
                            // line 713
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 713);
                            echo "]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 713);
                            echo "\" checked=\"checked\" />
                        ";
                            // line 714
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 714);
                            echo "</label>
                      ";
                        } else {
                            // line 716
                            echo "                      <label>
                        <input type=\"radio\" name=\"custom_field[";
                            // line 717
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 717);
                            echo "]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 717);
                            echo "\" />
                        ";
                            // line 718
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 718);
                            echo "</label>
                      ";
                        }
                        // line 720
                        echo "                    </div>
                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 722
                    echo "                  </div>
                </div>
              </div>
              ";
                }
                // line 726
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 726) == "checkbox")) {
                    // line 727
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 727);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 727) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\">";
                    // line 728
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 728);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <div id=\"input-shipping-custom-field";
                    // line 730
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 730);
                    echo "\">
                    ";
                    // line 731
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_value", [], "any", false, false, false, 731));
                    foreach ($context['_seq'] as $context["_key"] => $context["custom_field_value"]) {
                        // line 732
                        echo "                    <div class=\"checkbox\">
                      ";
                        // line 733
                        if (((($__internal_891ba2f942018e94e4bfa8069988f305bbaad7f54a64aeee069787f1084a9412 = ($context["shipping_custom_field"] ?? null)) && is_array($__internal_891ba2f942018e94e4bfa8069988f305bbaad7f54a64aeee069787f1084a9412) || $__internal_891ba2f942018e94e4bfa8069988f305bbaad7f54a64aeee069787f1084a9412 instanceof ArrayAccess ? ($__internal_891ba2f942018e94e4bfa8069988f305bbaad7f54a64aeee069787f1084a9412[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 733)] ?? null) : null) && twig_in_filter(twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 733), (($__internal_694b5f53081640f33aab1567e85e28c247e6a7c4674010716df6de8eae4819e9 = ($context["shipping_custom_field"] ?? null)) && is_array($__internal_694b5f53081640f33aab1567e85e28c247e6a7c4674010716df6de8eae4819e9) || $__internal_694b5f53081640f33aab1567e85e28c247e6a7c4674010716df6de8eae4819e9 instanceof ArrayAccess ? ($__internal_694b5f53081640f33aab1567e85e28c247e6a7c4674010716df6de8eae4819e9[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 733)] ?? null) : null)))) {
                            // line 734
                            echo "                      <label>
                        <input type=\"checkbox\" name=\"custom_field[";
                            // line 735
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 735);
                            echo "][]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 735);
                            echo "\" checked=\"checked\" />
                        ";
                            // line 736
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 736);
                            echo "</label>
                      ";
                        } else {
                            // line 738
                            echo "                      <label>
                        <input type=\"checkbox\" name=\"custom_field[";
                            // line 739
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 739);
                            echo "][]\" value=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "custom_field_value_id", [], "any", false, false, false, 739);
                            echo "\" />
                        ";
                            // line 740
                            echo twig_get_attribute($this->env, $this->source, $context["custom_field_value"], "name", [], "any", false, false, false, 740);
                            echo "</label>
                      ";
                        }
                        // line 742
                        echo "                    </div>
                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 744
                    echo "                  </div>
                </div>
              </div>
              ";
                }
                // line 748
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 748) == "text")) {
                    // line 749
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 749);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 749) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\" for=\"input-shipping-custom-field";
                    // line 750
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 750);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 750);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" name=\"custom_field[";
                    // line 752
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 752);
                    echo "]\" value=\"";
                    echo (((($__internal_91b272a21580197773f482962c8b92637a641a749832ee390d7d386a58d1912e = ($context["shipping_custom_field"] ?? null)) && is_array($__internal_91b272a21580197773f482962c8b92637a641a749832ee390d7d386a58d1912e) || $__internal_91b272a21580197773f482962c8b92637a641a749832ee390d7d386a58d1912e instanceof ArrayAccess ? ($__internal_91b272a21580197773f482962c8b92637a641a749832ee390d7d386a58d1912e[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 752)] ?? null) : null)) ? ((($__internal_7f8d0071642f16d6b4720f8eef58ffd71faf0c4d7a772c0eb6842d5e9d901ca5 = ($context["shipping_custom_field"] ?? null)) && is_array($__internal_7f8d0071642f16d6b4720f8eef58ffd71faf0c4d7a772c0eb6842d5e9d901ca5) || $__internal_7f8d0071642f16d6b4720f8eef58ffd71faf0c4d7a772c0eb6842d5e9d901ca5 instanceof ArrayAccess ? ($__internal_7f8d0071642f16d6b4720f8eef58ffd71faf0c4d7a772c0eb6842d5e9d901ca5[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 752)] ?? null) : null)) : (twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 752)));
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 752);
                    echo "\" id=\"input-shipping-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 752);
                    echo "\" class=\"form-control\" />
                </div>
              </div>
              ";
                }
                // line 756
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 756) == "textarea")) {
                    // line 757
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 757);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 757) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\" for=\"input-shipping-custom-field";
                    // line 758
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 758);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 758);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <textarea name=\"custom_field[";
                    // line 760
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 760);
                    echo "]\" rows=\"5\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 760);
                    echo "\" id=\"input-shipping-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 760);
                    echo "\" class=\"form-control\">";
                    echo (((($__internal_0aa0713b35e28227396d65db75a1a4277b081ff4e08585143330919af9d1bf0a = ($context["shipping_custom_field"] ?? null)) && is_array($__internal_0aa0713b35e28227396d65db75a1a4277b081ff4e08585143330919af9d1bf0a) || $__internal_0aa0713b35e28227396d65db75a1a4277b081ff4e08585143330919af9d1bf0a instanceof ArrayAccess ? ($__internal_0aa0713b35e28227396d65db75a1a4277b081ff4e08585143330919af9d1bf0a[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 760)] ?? null) : null)) ? ((($__internal_51b47659448148079c55eb5fc84ce5e7b27c8ff1fadeba243d0bf4a59f102eb4 = ($context["shipping_custom_field"] ?? null)) && is_array($__internal_51b47659448148079c55eb5fc84ce5e7b27c8ff1fadeba243d0bf4a59f102eb4) || $__internal_51b47659448148079c55eb5fc84ce5e7b27c8ff1fadeba243d0bf4a59f102eb4 instanceof ArrayAccess ? ($__internal_51b47659448148079c55eb5fc84ce5e7b27c8ff1fadeba243d0bf4a59f102eb4[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 760)] ?? null) : null)) : (twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 760)));
                    echo "</textarea>
                </div>
              </div>
              ";
                }
                // line 764
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 764) == "file")) {
                    // line 765
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 765);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 765) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\">";
                    // line 766
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 766);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <button type=\"button\" id=\"button-shipping-custom-field";
                    // line 768
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 768);
                    echo "\" data-loading-text=\"";
                    echo ($context["text_loading"] ?? null);
                    echo "\" class=\"btn btn-default\"><i class=\"fa fa-upload\"></i> ";
                    echo ($context["button_upload"] ?? null);
                    echo "</button>
                  <input type=\"hidden\" name=\"custom_field[";
                    // line 769
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 769);
                    echo "]\" value=\"";
                    echo (((($__internal_7954abe9e82b868b32e99deec50bc82d0cf006d569340d1981c528f484e4306d = (($__internal_edc3933374aa0ae65dd90505a315fe17c24a986a5b064b0f4774e7dc68df29b5 = ($context["shipping_custom_field"] ?? null)) && is_array($__internal_edc3933374aa0ae65dd90505a315fe17c24a986a5b064b0f4774e7dc68df29b5) || $__internal_edc3933374aa0ae65dd90505a315fe17c24a986a5b064b0f4774e7dc68df29b5 instanceof ArrayAccess ? ($__internal_edc3933374aa0ae65dd90505a315fe17c24a986a5b064b0f4774e7dc68df29b5[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 769)] ?? null) : null)) && is_array($__internal_7954abe9e82b868b32e99deec50bc82d0cf006d569340d1981c528f484e4306d) || $__internal_7954abe9e82b868b32e99deec50bc82d0cf006d569340d1981c528f484e4306d instanceof ArrayAccess ? ($__internal_7954abe9e82b868b32e99deec50bc82d0cf006d569340d1981c528f484e4306d["code"] ?? null) : null)) ? ((($__internal_78a78e2af552daad30f9bd5ea90c17811faa9f63aaaf1d1d527de70902fe2a7a = (($__internal_68329f830f66b3d66aa25264abe6d152d460842b92be66836c0d8febb9fe46da = ($context["shipping_custom_field"] ?? null)) && is_array($__internal_68329f830f66b3d66aa25264abe6d152d460842b92be66836c0d8febb9fe46da) || $__internal_68329f830f66b3d66aa25264abe6d152d460842b92be66836c0d8febb9fe46da instanceof ArrayAccess ? ($__internal_68329f830f66b3d66aa25264abe6d152d460842b92be66836c0d8febb9fe46da[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 769)] ?? null) : null)) && is_array($__internal_78a78e2af552daad30f9bd5ea90c17811faa9f63aaaf1d1d527de70902fe2a7a) || $__internal_78a78e2af552daad30f9bd5ea90c17811faa9f63aaaf1d1d527de70902fe2a7a instanceof ArrayAccess ? ($__internal_78a78e2af552daad30f9bd5ea90c17811faa9f63aaaf1d1d527de70902fe2a7a["code"] ?? null) : null)) : (""));
                    echo "\" id=\"input-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 769);
                    echo "\" />
\t\t\t\t  <span>";
                    // line 770
                    echo (($__internal_0c0a6bc8299d1416ae3339265b194ff43aaec7fc209979ab91c947804ef09b38 = (($__internal_c5373d6c112ec7cfa0d260a8ea49b75af689c74c186cb9e1d12f91be2f3451ec = ($context["shipping_custom_field"] ?? null)) && is_array($__internal_c5373d6c112ec7cfa0d260a8ea49b75af689c74c186cb9e1d12f91be2f3451ec) || $__internal_c5373d6c112ec7cfa0d260a8ea49b75af689c74c186cb9e1d12f91be2f3451ec instanceof ArrayAccess ? ($__internal_c5373d6c112ec7cfa0d260a8ea49b75af689c74c186cb9e1d12f91be2f3451ec[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 770)] ?? null) : null)) && is_array($__internal_0c0a6bc8299d1416ae3339265b194ff43aaec7fc209979ab91c947804ef09b38) || $__internal_0c0a6bc8299d1416ae3339265b194ff43aaec7fc209979ab91c947804ef09b38 instanceof ArrayAccess ? ($__internal_0c0a6bc8299d1416ae3339265b194ff43aaec7fc209979ab91c947804ef09b38["name"] ?? null) : null);
                    echo "</span>
                </div>
              </div>
              ";
                }
                // line 774
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 774) == "date")) {
                    // line 775
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 775);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 775) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\" for=\"input-shipping-custom-field";
                    // line 776
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 776);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 776);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <div class=\"input-group date\">
                    <input type=\"text\" name=\"custom_field[";
                    // line 779
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 779);
                    echo "]\" value=\"";
                    echo (((($__internal_a13b5858c5824edc0cf555cffe22c4f90468c22ef1115c74916647af2c9b8574 = ($context["shipping_custom_field"] ?? null)) && is_array($__internal_a13b5858c5824edc0cf555cffe22c4f90468c22ef1115c74916647af2c9b8574) || $__internal_a13b5858c5824edc0cf555cffe22c4f90468c22ef1115c74916647af2c9b8574 instanceof ArrayAccess ? ($__internal_a13b5858c5824edc0cf555cffe22c4f90468c22ef1115c74916647af2c9b8574[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 779)] ?? null) : null)) ? ((($__internal_8273200462706e912633c1bd12ca5fc5736d038390c29954112cb78d56c3075c = ($context["shipping_custom_field"] ?? null)) && is_array($__internal_8273200462706e912633c1bd12ca5fc5736d038390c29954112cb78d56c3075c) || $__internal_8273200462706e912633c1bd12ca5fc5736d038390c29954112cb78d56c3075c instanceof ArrayAccess ? ($__internal_8273200462706e912633c1bd12ca5fc5736d038390c29954112cb78d56c3075c[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 779)] ?? null) : null)) : (twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 779)));
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 779);
                    echo "\" data-date-format=\"YYYY-MM-DD\" id=\"input-shipping-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 779);
                    echo "\" class=\"form-control\" />
                    <span class=\"input-group-btn\">
                    <button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button>
                    </span></div>
                </div>
              </div>
              ";
                }
                // line 786
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 786) == "time")) {
                    // line 787
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 787);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 787) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\" for=\"input-shipping-custom-field";
                    // line 788
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 788);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 788);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <div class=\"input-group time\">
                    <input type=\"text\" name=\"custom_field[";
                    // line 791
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 791);
                    echo "]\" value=\"";
                    echo (((($__internal_ba7685baed7d294d6f9f021c094359707afc43c727e6a2d19ff1d176796bbda0 = ($context["shipping_custom_field"] ?? null)) && is_array($__internal_ba7685baed7d294d6f9f021c094359707afc43c727e6a2d19ff1d176796bbda0) || $__internal_ba7685baed7d294d6f9f021c094359707afc43c727e6a2d19ff1d176796bbda0 instanceof ArrayAccess ? ($__internal_ba7685baed7d294d6f9f021c094359707afc43c727e6a2d19ff1d176796bbda0[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 791)] ?? null) : null)) ? ((($__internal_101f955954d09941874d68c1bc31b2171b1313930c7c7163a30d4c0951b92adc = ($context["shipping_custom_field"] ?? null)) && is_array($__internal_101f955954d09941874d68c1bc31b2171b1313930c7c7163a30d4c0951b92adc) || $__internal_101f955954d09941874d68c1bc31b2171b1313930c7c7163a30d4c0951b92adc instanceof ArrayAccess ? ($__internal_101f955954d09941874d68c1bc31b2171b1313930c7c7163a30d4c0951b92adc[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 791)] ?? null) : null)) : (twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 791)));
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 791);
                    echo "\" data-date-format=\"HH:mm\" id=\"input-shipping-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 791);
                    echo "\" class=\"form-control\" />
                    <span class=\"input-group-btn\">
                    <button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button>
                    </span></div>
                </div>
              </div>
              ";
                }
                // line 798
                echo "              ";
                if ((twig_get_attribute($this->env, $this->source, $context["custom_field"], "type", [], "any", false, false, false, 798) == "datetime")) {
                    // line 799
                    echo "              <div class=\"form-group custom-field custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 799);
                    echo "\" data-sort=\"";
                    echo (twig_get_attribute($this->env, $this->source, $context["custom_field"], "sort_order", [], "any", false, false, false, 799) + 3);
                    echo "\">
                <label class=\"col-sm-2 control-label\" for=\"input-shipping-custom-field";
                    // line 800
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 800);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 800);
                    echo "</label>
                <div class=\"col-sm-10\">
                  <div class=\"input-group datetime\">
                    <input type=\"text\" name=\"custom_field[";
                    // line 803
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 803);
                    echo "]\" value=\"";
                    echo (((($__internal_d19b8970b34a70cf90f25bc70d063a8b0fc361c2ffc373a6176195b465bc0ccd = ($context["shipping_custom_field"] ?? null)) && is_array($__internal_d19b8970b34a70cf90f25bc70d063a8b0fc361c2ffc373a6176195b465bc0ccd) || $__internal_d19b8970b34a70cf90f25bc70d063a8b0fc361c2ffc373a6176195b465bc0ccd instanceof ArrayAccess ? ($__internal_d19b8970b34a70cf90f25bc70d063a8b0fc361c2ffc373a6176195b465bc0ccd[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 803)] ?? null) : null)) ? ((($__internal_7f22f462d0a079e9b28d4dd0209cce239cda0d0c81b8f79d4d6355c3a5eedc81 = ($context["shipping_custom_field"] ?? null)) && is_array($__internal_7f22f462d0a079e9b28d4dd0209cce239cda0d0c81b8f79d4d6355c3a5eedc81) || $__internal_7f22f462d0a079e9b28d4dd0209cce239cda0d0c81b8f79d4d6355c3a5eedc81 instanceof ArrayAccess ? ($__internal_7f22f462d0a079e9b28d4dd0209cce239cda0d0c81b8f79d4d6355c3a5eedc81[twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 803)] ?? null) : null)) : (twig_get_attribute($this->env, $this->source, $context["custom_field"], "value", [], "any", false, false, false, 803)));
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "name", [], "any", false, false, false, 803);
                    echo "\" data-date-format=\"YYYY-MM-DD HH:mm\" id=\"input-shipping-custom-field";
                    echo twig_get_attribute($this->env, $this->source, $context["custom_field"], "custom_field_id", [], "any", false, false, false, 803);
                    echo "\" class=\"form-control\" />
                    <span class=\"input-group-btn\">
                    <button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button>
                    </span></div>
                </div>
              </div>
              ";
                }
                // line 810
                echo "              ";
            }
            // line 811
            echo "              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_field'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 812
        echo "              <div class=\"row\">
                <div class=\"col-sm-6 text-left\">
                  <button type=\"button\" onclick=\"\$('a[href=\\'#tab-payment\\']').tab('show');\" class=\"btn btn-default\"><i class=\"fa fa-arrow-left\"></i> ";
        // line 814
        echo ($context["button_back"] ?? null);
        echo "</button>
                </div>
                <div class=\"col-sm-6 text-right\">
                  <button type=\"button\" id=\"button-shipping-address\" data-loading-text=\"";
        // line 817
        echo ($context["text_loading"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-arrow-right\"></i> ";
        echo ($context["button_continue"] ?? null);
        echo "</button>
                </div>
              </div>
            </div>
            <div class=\"tab-pane\" id=\"tab-total\">
              <div class=\"table-responsive\">
                <table class=\"table table-bordered\">
                  <thead>
                    <tr>
                      <td class=\"text-left\">";
        // line 826
        echo ($context["column_product"] ?? null);
        echo "</td>
                      <td class=\"text-left\">";
        // line 827
        echo ($context["column_model"] ?? null);
        echo "</td>
                      <td class=\"text-right\">";
        // line 828
        echo ($context["column_quantity"] ?? null);
        echo "</td>
                      <td class=\"text-right\">";
        // line 829
        echo ($context["column_price"] ?? null);
        echo "</td>
                      <td class=\"text-right\">";
        // line 830
        echo ($context["column_total"] ?? null);
        echo "</td>
                    </tr>
                  </thead>
                  <tbody id=\"total\">
                    <tr>
                      <td class=\"text-center\" colspan=\"5\">";
        // line 835
        echo ($context["text_no_results"] ?? null);
        echo "</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <fieldset>
                <legend>";
        // line 841
        echo ($context["text_order_detail"] ?? null);
        echo "</legend>
                <div class=\"form-group required\">
                  <label class=\"col-sm-2 control-label\" for=\"input-shipping-method\">";
        // line 843
        echo ($context["entry_shipping_method"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <div class=\"input-group\">
                      <select name=\"shipping_method\" id=\"input-shipping-method\" class=\"form-control\">
                        <option value=\"\">";
        // line 847
        echo ($context["text_select"] ?? null);
        echo "</option>
                        ";
        // line 848
        if (($context["shipping_code"] ?? null)) {
            // line 849
            echo "                        <option value=\"";
            echo ($context["shipping_code"] ?? null);
            echo "\" selected=\"selected\">";
            echo ($context["shipping_method"] ?? null);
            echo "</option>
                        ";
        }
        // line 851
        echo "                      </select>
                      <span class=\"input-group-btn\">
                      <button type=\"button\" id=\"button-shipping-method\" data-loading-text=\"";
        // line 853
        echo ($context["text_loading"] ?? null);
        echo "\" class=\"btn btn-primary\">";
        echo ($context["button_apply"] ?? null);
        echo "</button>
                      </span></div>
                  </div>
                </div>
                <div class=\"form-group required\">
                  <label class=\"col-sm-2 control-label\" for=\"input-payment-method\">";
        // line 858
        echo ($context["entry_payment_method"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <div class=\"input-group\">
                      <select name=\"payment_method\" id=\"input-payment-method\" class=\"form-control\">
                        <option value=\"\">";
        // line 862
        echo ($context["text_select"] ?? null);
        echo "</option>
                        ";
        // line 863
        if (($context["payment_code"] ?? null)) {
            // line 864
            echo "                        <option value=\"";
            echo ($context["payment_code"] ?? null);
            echo "\" selected=\"selected\">";
            echo ($context["payment_method"] ?? null);
            echo "</option>
                        ";
        }
        // line 866
        echo "                      </select>
                      <span class=\"input-group-btn\">
                      <button type=\"button\" id=\"button-payment-method\" data-loading-text=\"";
        // line 868
        echo ($context["text_loading"] ?? null);
        echo "\" class=\"btn btn-primary\">";
        echo ($context["button_apply"] ?? null);
        echo "</button>
                      </span></div>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-coupon\">";
        // line 873
        echo ($context["entry_coupon"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <div class=\"input-group\">
                      <input type=\"text\" name=\"coupon\" value=\"";
        // line 876
        echo ($context["coupon"] ?? null);
        echo "\" id=\"input-coupon\" class=\"form-control\" />
                      <span class=\"input-group-btn\">
                      <button type=\"button\" id=\"button-coupon\" data-loading-text=\"";
        // line 878
        echo ($context["text_loading"] ?? null);
        echo "\" class=\"btn btn-primary\">";
        echo ($context["button_apply"] ?? null);
        echo "</button>
                      </span></div>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-voucher\">";
        // line 883
        echo ($context["entry_voucher"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <div class=\"input-group\">
                      <input type=\"text\" name=\"voucher\" value=\"";
        // line 886
        echo ($context["voucher"] ?? null);
        echo "\" id=\"input-voucher\" data-loading-text=\"";
        echo ($context["text_loading"] ?? null);
        echo "\" class=\"form-control\" />
                      <span class=\"input-group-btn\">
                      <button type=\"button\" id=\"button-voucher\" data-loading-text=\"";
        // line 888
        echo ($context["text_loading"] ?? null);
        echo "\" class=\"btn btn-primary\">";
        echo ($context["button_apply"] ?? null);
        echo "</button>
                      </span></div>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-reward\">";
        // line 893
        echo ($context["entry_reward"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <div class=\"input-group\">
                      <input type=\"text\" name=\"reward\" value=\"";
        // line 896
        echo ($context["reward"] ?? null);
        echo "\" id=\"input-reward\" data-loading-text=\"";
        echo ($context["text_loading"] ?? null);
        echo "\" class=\"form-control\" />
                      <span class=\"input-group-btn\">
                      <button type=\"button\" id=\"button-reward\" data-loading-text=\"";
        // line 898
        echo ($context["text_loading"] ?? null);
        echo "\" class=\"btn btn-primary\">";
        echo ($context["button_apply"] ?? null);
        echo "</button>
                      </span></div>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-order-status\">";
        // line 903
        echo ($context["entry_order_status"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <select name=\"order_status_id\" id=\"input-order-status\" class=\"form-control\">
                      ";
        // line 906
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["order_statuses"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["order_status"]) {
            // line 907
            echo "                      ";
            if ((twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 907) == ($context["order_status_id"] ?? null))) {
                // line 908
                echo "                      <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 908);
                echo "\" selected=\"selected\">";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", [], "any", false, false, false, 908);
                echo "</option>
                      ";
            } else {
                // line 910
                echo "                      <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "order_status_id", [], "any", false, false, false, 910);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["order_status"], "name", [], "any", false, false, false, 910);
                echo "</option>
                      ";
            }
            // line 912
            echo "                      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 913
        echo "                    </select>
                    <input type=\"hidden\" name=\"order_id\" value=\"";
        // line 914
        echo ($context["order_id"] ?? null);
        echo "\" />
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-comment\">";
        // line 918
        echo ($context["entry_comment"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <textarea name=\"comment\" rows=\"5\" id=\"input-comment\" class=\"form-control\">";
        // line 920
        echo ($context["comment"] ?? null);
        echo "</textarea>
                  </div>
                </div>
                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-affiliate\">";
        // line 924
        echo ($context["entry_affiliate"] ?? null);
        echo "</label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"affiliate\" value=\"";
        // line 926
        echo ($context["affiliate"] ?? null);
        echo "\" id=\"input-affiliate\" class=\"form-control\" />
                    <input type=\"hidden\" name=\"affiliate_id\" value=\"";
        // line 927
        echo ($context["affiliate_id"] ?? null);
        echo "\" />
                  </div>
                </div>
              </fieldset>
              <div class=\"row\">
                <div class=\"col-sm-6 text-left\">
                  <button type=\"button\" onclick=\"\$('select[name=\\'shipping_method\\']').prop('disabled') ? \$('a[href=\\'#tab-payment\\']').tab('show') : \$('a[href=\\'#tab-shipping\\']').tab('show');\" class=\"btn btn-default\"><i class=\"fa fa-arrow-left\"></i> ";
        // line 933
        echo ($context["button_back"] ?? null);
        echo "</button>
                </div>
                <div class=\"col-sm-6 text-right\">
                  <button type=\"button\" id=\"button-refresh\" data-toggle=\"tooltip\" title=\"";
        // line 936
        echo ($context["button_refresh"] ?? null);
        echo "\" data-loading-text=\"";
        echo ($context["text_loading"] ?? null);
        echo "\" class=\"btn btn-warning\"><i class=\"fa fa-refresh\"></i></button>
                  <button type=\"button\" id=\"button-save\" class=\"btn btn-primary\"><i class=\"fa fa-check-circle\"></i> ";
        // line 937
        echo ($context["button_save"] ?? null);
        echo "</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type=\"text/javascript\"><!--
// Disable the tabs
\$('#order a[data-toggle=\\'tab\\']').on('click', function(e) {
\treturn false;
});

// Currency
\$('select[name=\\'currency\\']').on('change', function() {
\t\$.ajax({
\t\turl: '";
        // line 955
        echo ($context["catalog"] ?? null);
        echo "index.php?route=api/currency&api_token=";
        echo ($context["api_token"] ?? null);
        echo "&store_id=' + \$('select[name=\\'store_id\\'] option:selected').val(),
\t\ttype: 'post',
\t\tdata: 'currency=' + \$('select[name=\\'currency\\'] option:selected').val(),
\t\tdataType: 'json',
\t\tcrossDomain: true,
\t\tbeforeSend: function() {
\t\t\t\$('select[name=\\'currency\\']').prop('disabled', true);
\t\t},
\t\tcomplete: function() {
\t\t\t\$('select[name=\\'currency\\']').prop('disabled', false);
\t\t},
\t\tsuccess: function(json) {
\t\t\t\$('.alert-dismissible, .text-danger').remove();
\t\t\t\$('.form-group').removeClass('has-error');

\t\t\tif (json['error']) {
\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');

\t\t\t\t// Highlight any found errors
\t\t\t\t\$('select[name=\\'currency\\']').closest('.form-group').addClass('has-error');
\t\t\t}
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

\$('select[name=\\'currency\\']').trigger('change');

// Customer
\$('input[name=\\'customer\\']').autocomplete({
\t'source': function(request, response) {
\t\t\$.ajax({
\t\t\turl: 'index.php?route=customer/customer/autocomplete&user_token=";
        // line 989
        echo ($context["user_token"] ?? null);
        echo "&filter_name=' +  encodeURIComponent(request),
\t\t\tdataType: 'json',
\t\t\tsuccess: function(json) {
\t\t\t\tjson.unshift({
\t\t\t\t\tcustomer_id: '0',
\t\t\t\t\tcustomer_group_id: '";
        // line 994
        echo ($context["customer_group_id"] ?? null);
        echo "',
\t\t\t\t\tname: '";
        // line 995
        echo ($context["text_none"] ?? null);
        echo "',
\t\t\t\t\tcustomer_group: '',
\t\t\t\t\tfirstname: '',
\t\t\t\t\tlastname: '',
\t\t\t\t\temail: '',
\t\t\t\t\ttelephone: '',
\t\t\t\t\tcustom_field: [],
\t\t\t\t\taddress: []
\t\t\t\t});

\t\t\t\tresponse(\$.map(json, function(item) {
\t\t\t\t\treturn {
\t\t\t\t\t\tcategory: item['customer_group'],
\t\t\t\t\t\tlabel: item['name'],
\t\t\t\t\t\tvalue: item['customer_id'],
\t\t\t\t\t\tcustomer_group_id: item['customer_group_id'],
\t\t\t\t\t\tfirstname: item['firstname'],
\t\t\t\t\t\tlastname: item['lastname'],
\t\t\t\t\t\temail: item['email'],
\t\t\t\t\t\ttelephone: item['telephone'],
\t\t\t\t\t\tcustom_field: item['custom_field'],
\t\t\t\t\t\taddress: item['address']
\t\t\t\t\t}
\t\t\t\t}));
\t\t\t}
\t\t});
\t},
\t'select': function(item) {
\t\t// Reset all custom fields
\t\t\$('#tab-customer input[type=\\'text\\'], #tab-customer textarea').not('#tab-customer input[name=\\'customer\\'], #tab-customer input[name=\\'customer_id\\']').val('');
\t\t\$('#tab-customer select option').not(\$('#tab-customer select[name=\\'store_id\\'] option, #tab-customer select[name=\\'currency\\'] option')).removeAttr('selected');
\t\t\$('#tab-customer input[type=\\'checkbox\\'], #tab-customer input[type=\\'radio\\']').removeAttr('checked');

\t\t\$('#tab-customer input[name=\\'customer\\']').val(item['label']);
\t\t\$('#tab-customer input[name=\\'customer_id\\']').val(item['value']);
\t\t\$('#tab-customer select[name=\\'customer_group_id\\']').val(item['customer_group_id']);
\t\t\$('#tab-customer input[name=\\'firstname\\']').val(item['firstname']);
\t\t\$('#tab-customer input[name=\\'lastname\\']').val(item['lastname']);
\t\t\$('#tab-customer input[name=\\'email\\']').val(item['email']);
\t\t\$('#tab-customer input[name=\\'telephone\\']').val(item['telephone']);

\t\tfor (i in item.custom_field) {
\t\t\t\$('#tab-customer select[name=\\'custom_field[' + i + ']\\']').val(item.custom_field[i]);
\t\t\t\$('#tab-customer textarea[name=\\'custom_field[' + i + ']\\']').val(item.custom_field[i]);
\t\t\t\$('#tab-customer input[name^=\\'custom_field[' + i + ']\\'][type=\\'text\\']').val(item.custom_field[i]);
\t\t\t\$('#tab-customer input[name^=\\'custom_field[' + i + ']\\'][type=\\'hidden\\']').val(item.custom_field[i]);
\t\t\t\$('#tab-customer input[name^=\\'custom_field[' + i + ']\\'][type=\\'radio\\'][value=\\'' + item.custom_field[i] + '\\']').prop('checked', true);

\t\t\tif (item.custom_field[i]) {
\t\t\t\tfor (j = 0; j < item.custom_field[i].length; j++) {
\t\t\t\t\t\$('#tab-customer input[name^=\\'custom_field[' + i + ']\\'][type=\\'checkbox\\'][value=\\'' + item.custom_field[i][j] + '\\']').prop('checked', true);
\t\t\t\t}
\t\t\t}
\t\t}

\t\t\$('select[name=\\'customer_group_id\\']').trigger('change');

\t\thtml = '<option value=\"0\">";
        // line 1052
        echo ($context["text_none"] ?? null);
        echo "</option>';

\t\tfor (i in  item['address']) {
\t\t\thtml += '<option value=\"' + item['address'][i]['address_id'] + '\">' + item['address'][i]['firstname'] + ' ' + item['address'][i]['lastname'] + ', ' + item['address'][i]['address_1'] + ', ' + item['address'][i]['city'] + ', ' + item['address'][i]['country'] + '</option>';
\t\t}

\t\t\$('select[name=\\'payment_address\\']').html(html);
\t\t\$('select[name=\\'shipping_address\\']').html(html);
\t}
});

// Custom Fields
\$('select[name=\\'customer_group_id\\']').on('change', function() {
\t\$.ajax({
\t\turl: 'index.php?route=customer/customer/customfield&user_token=";
        // line 1066
        echo ($context["user_token"] ?? null);
        echo "&customer_group_id=' + this.value,
\t\tdataType: 'json',
\t\tsuccess: function(json) {
\t\t\t\$('.custom-field').hide();
\t\t\t\$('.custom-field').removeClass('required');

\t\t\tfor (i = 0; i < json.length; i++) {
\t\t\t\tcustom_field = json[i];

\t\t\t\t\$('.custom-field' + custom_field['custom_field_id']).show();

\t\t\t\tif (custom_field['required']) {
\t\t\t\t\t\$('.custom-field' + custom_field['custom_field_id']).addClass('required');
\t\t\t\t}
\t\t\t}
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

\$('select[name=\\'customer_group_id\\']').trigger('change');

\$('#button-customer').on('click', function() {
\t\$.ajax({
\t\turl: '";
        // line 1092
        echo ($context["catalog"] ?? null);
        echo "index.php?route=api/customer&api_token=";
        echo ($context["api_token"] ?? null);
        echo "&store_id=' + \$('select[name=\\'store_id\\'] option:selected').val(),
\t\ttype: 'post',
\t\tdata: \$('#tab-customer input[type=\\'text\\'], #tab-customer input[type=\\'hidden\\'], #tab-customer input[type=\\'radio\\']:checked, #tab-customer input[type=\\'checkbox\\']:checked, #tab-customer select, #tab-customer textarea'),
\t\tdataType: 'json',
\t\tcrossDomain: true,
\t\tbeforeSend: function() {
\t\t\t\$('#button-customer').button('loading');
\t\t},
\t\tcomplete: function() {
\t\t\t \$('#button-customer').button('reset');
\t\t},
\t\tsuccess: function(json) {
\t\t\t\$('.alert-dismissible, .text-danger').remove();
\t\t\t\$('.form-group').removeClass('has-error');

\t\t\tif (json['error']) {
\t\t\t\tif (json['error']['warning']) {
\t\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error']['warning'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');
\t\t\t\t}

\t\t\t\tfor (i in json['error']) {
\t\t\t\t\tvar element = \$('#input-' + i.replace('_', '-'));

\t\t\t\t\tif (element.parent().hasClass('input-group')) {
                   \t\t\$(element).parent().after('<div class=\"text-danger\">' + json['error'][i] + '</div>');
\t\t\t\t\t} else {
\t\t\t\t\t\t\$(element).after('<div class=\"text-danger\">' + json['error'][i] + '</div>');
\t\t\t\t\t}
\t\t\t\t}

\t\t\t\t// Highlight any found errors
\t\t\t\t\$('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');
\t\t\t} else {
                // Refresh products, vouchers and totals
                var request_1 = \$.ajax({
                    url: '";
        // line 1127
        echo ($context["catalog"] ?? null);
        echo "index.php?route=api/cart/add&api_token=";
        echo ($context["api_token"] ?? null);
        echo "&store_id=' + \$('select[name=\\'store_id\\'] option:selected').val(),
                    type: 'post',
                    data: \$('#cart input[name^=\\'product\\'][type=\\'text\\'], #cart input[name^=\\'product\\'][type=\\'hidden\\'], #cart input[name^=\\'product\\'][type=\\'radio\\']:checked, #cart input[name^=\\'product\\'][type=\\'checkbox\\']:checked, #cart select[name^=\\'product\\'], #cart textarea[name^=\\'product\\']'),
                    dataType: 'json',
                    crossDomain: true,
                    beforeSend: function() {
                        \$('#button-product-add').button('loading');
                    },
                    complete: function() {
                        \$('#button-product-add').button('reset');
                    },
                    success: function(json) {
                        \$('.alert-dismissible, .text-danger').remove();
                        \$('.form-group').removeClass('has-error');

                        if (json['error'] && json['error']['warning']) {
                            \$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error']['warning'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');
                        }
            \t\t},
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
                    }
                });

                var request_2 = request_1.then(function() {
                    \$.ajax({
                        url: '";
        // line 1153
        echo ($context["catalog"] ?? null);
        echo "index.php?route=api/voucher/add&api_token=";
        echo ($context["api_token"] ?? null);
        echo "&store_id=' + \$('select[name=\\'store_id\\'] option:selected').val(),
                        type: 'post',
                        data: \$('#cart input[name^=\\'voucher\\'][type=\\'text\\'], #cart input[name^=\\'voucher\\'][type=\\'hidden\\'], #cart input[name^=\\'voucher\\'][type=\\'radio\\']:checked, #cart input[name^=\\'voucher\\'][type=\\'checkbox\\']:checked, #cart select[name^=\\'voucher\\'], #cart textarea[name^=\\'voucher\\']'),
                        dataType: 'json',
                        crossDomain: true,
                        beforeSend: function() {
                            \$('#button-voucher-add').button('loading');
                        },
                        complete: function() {
                            \$('#button-voucher-add').button('reset');
                        },
                        success: function(json) {
                            \$('.alert-dismissible, .text-danger').remove();
                            \$('.form-group').removeClass('has-error');

                            if (json['error'] && json['error']['warning']) {
                                \$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error']['warning'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');
                            }
                \t\t},
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
                        }
                    });
                });

                request_2.done(function() {
                    \$('#button-refresh').trigger('click');

                    \$('a[href=\\'#tab-cart\\']').tab('show');
                });
\t\t\t}
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

\$('#tab-product input[name=\\'product\\']').autocomplete({
\t'source': function(request, response) {
\t\t\$.ajax({
\t\t\turl: 'index.php?route=catalog/product/autocomplete&user_token=";
        // line 1194
        echo ($context["user_token"] ?? null);
        echo "&filter_name=' +  encodeURIComponent(request),
\t\t\tdataType: 'json',
\t\t\tsuccess: function(json) {
\t\t\t\tresponse(\$.map(json, function(item) {
\t\t\t\t\treturn {
\t\t\t\t\t\tlabel: item['name'],
\t\t\t\t\t\tvalue: item['product_id'],
\t\t\t\t\t\tmodel: item['model'],
\t\t\t\t\t\toption: item['option'],
\t\t\t\t\t\tprice: item['price']
\t\t\t\t\t}
\t\t\t\t}));
\t\t\t}
\t\t});
\t},
\t'select': function(item) {
\t\t\$('#tab-product input[name=\\'product\\']').val(item['label']);
\t\t\$('#tab-product input[name=\\'product_id\\']').val(item['value']);

\t\tif (item['option'] != '') {
 \t\t\thtml  = '<fieldset>';
            html += '  <legend>";
        // line 1215
        echo ($context["entry_option"] ?? null);
        echo "</legend>';

\t\t\tfor (i = 0; i < item['option'].length; i++) {
\t\t\t\toption = item['option'][i];

\t\t\t\tif (option['type'] == 'select') {
\t\t\t\t\thtml += '<div class=\"form-group' + (option['required'] ? ' required' : '') + '\">';
\t\t\t\t\thtml += '  <label class=\"col-sm-2 control-label\" for=\"input-option' + option['product_option_id'] + '\">' + option['name'] + '</label>';
\t\t\t\t\thtml += '  <div class=\"col-sm-10\">';
\t\t\t\t\thtml += '    <select name=\"option[' + option['product_option_id'] + ']\" id=\"input-option' + option['product_option_id'] + '\" class=\"form-control\">';
\t\t\t\t\thtml += '      <option value=\"\">";
        // line 1225
        echo ($context["text_select"] ?? null);
        echo "</option>';

\t\t\t\t\tfor (j = 0; j < option['product_option_value'].length; j++) {
\t\t\t\t\t\toption_value = option['product_option_value'][j];

\t\t\t\t\t\thtml += '<option value=\"' + option_value['product_option_value_id'] + '\">' + option_value['name'];

\t\t\t\t\t\tif (option_value['price']) {
\t\t\t\t\t\t\thtml += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
\t\t\t\t\t\t}

\t\t\t\t\t\thtml += '</option>';
\t\t\t\t\t}

\t\t\t\t\thtml += '    </select>';
\t\t\t\t\thtml += '  </div>';
\t\t\t\t\thtml += '</div>';
\t\t\t\t}

\t\t\t\tif (option['type'] == 'radio') {
\t\t\t\t\thtml += '<div class=\"form-group' + (option['required'] ? ' required' : '') + '\">';
\t\t\t\t\thtml += '  <label class=\"col-sm-2 control-label\" for=\"input-option' + option['product_option_id'] + '\">' + option['name'] + '</label>';
\t\t\t\t\thtml += '  <div class=\"col-sm-10\">';
\t\t\t\t\thtml += '    <select name=\"option[' + option['product_option_id'] + ']\" id=\"input-option' + option['product_option_id'] + '\" class=\"form-control\">';
\t\t\t\t\thtml += '      <option value=\"\">";
        // line 1249
        echo ($context["text_select"] ?? null);
        echo "</option>';

\t\t\t\t\tfor (j = 0; j < option['product_option_value'].length; j++) {
\t\t\t\t\t\toption_value = option['product_option_value'][j];

\t\t\t\t\t\thtml += '<option value=\"' + option_value['product_option_value_id'] + '\">' + option_value['name'];

\t\t\t\t\t\tif (option_value['price']) {
\t\t\t\t\t\t\thtml += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
\t\t\t\t\t\t}

\t\t\t\t\t\thtml += '</option>';
\t\t\t\t\t}

\t\t\t\t\thtml += '    </select>';
\t\t\t\t\thtml += '  </div>';
\t\t\t\t\thtml += '</div>';
\t\t\t\t}

\t\t\t\tif (option['type'] == 'checkbox') {
\t\t\t\t\thtml += '<div class=\"form-group' + (option['required'] ? ' required' : '') + '\">';
\t\t\t\t\thtml += '  <label class=\"col-sm-2 control-label\">' + option['name'] + '</label>';
\t\t\t\t\thtml += '  <div class=\"col-sm-10\">';
\t\t\t\t\thtml += '    <div id=\"input-option' + option['product_option_id'] + '\">';

\t\t\t\t\tfor (j = 0; j < option['product_option_value'].length; j++) {
\t\t\t\t\t\toption_value = option['product_option_value'][j];

\t\t\t\t\t\thtml += '<div class=\"checkbox\">';

\t\t\t\t\t\thtml += '  <label><input type=\"checkbox\" name=\"option[' + option['product_option_id'] + '][]\" value=\"' + option_value['product_option_value_id'] + '\" /> ' + option_value['name'];

\t\t\t\t\t\tif (option_value['price']) {
\t\t\t\t\t\t\thtml += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
\t\t\t\t\t\t}

\t\t\t\t\t\thtml += '  </label>';
\t\t\t\t\t\thtml += '</div>';
\t\t\t\t\t}

\t\t\t\t\thtml += '    </div>';
\t\t\t\t\thtml += '  </div>';
\t\t\t\t\thtml += '</div>';
\t\t\t\t}

\t\t\t\tif (option['type'] == 'image') {
\t\t\t\t\thtml += '<div class=\"form-group' + (option['required'] ? ' required' : '') + '\">';
\t\t\t\t\thtml += '  <label class=\"col-sm-2 control-label\" for=\"input-option' + option['product_option_id'] + '\">' + option['name'] + '</label>';
\t\t\t\t\thtml += '  <div class=\"col-sm-10\">';
\t\t\t\t\thtml += '    <select name=\"option[' + option['product_option_id'] + ']\" id=\"input-option' + option['product_option_id'] + '\" class=\"form-control\">';
\t\t\t\t\thtml += '      <option value=\"\">";
        // line 1299
        echo ($context["text_select"] ?? null);
        echo "</option>';

\t\t\t\t\tfor (j = 0; j < option['product_option_value'].length; j++) {
\t\t\t\t\t\toption_value = option['product_option_value'][j];

\t\t\t\t\t\thtml += '<option value=\"' + option_value['product_option_value_id'] + '\">' + option_value['name'];

\t\t\t\t\t\tif (option_value['price']) {
\t\t\t\t\t\t\thtml += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
\t\t\t\t\t\t}

\t\t\t\t\t\thtml += '</option>';
\t\t\t\t\t}

\t\t\t\t\thtml += '    </select>';
\t\t\t\t\thtml += '  </div>';
\t\t\t\t\thtml += '</div>';
\t\t\t\t}

\t\t\t\tif (option['type'] == 'text') {
\t\t\t\t\thtml += '<div class=\"form-group' + (option['required'] ? ' required' : '') + '\">';
\t\t\t\t\thtml += '  <label class=\"col-sm-2 control-label\" for=\"input-option' + option['product_option_id'] + '\">' + option['name'] + '</label>';
\t\t\t\t\thtml += '  <div class=\"col-sm-10\"><input type=\"text\" name=\"option[' + option['product_option_id'] + ']\" value=\"' + option['value'] + '\" id=\"input-option' + option['product_option_id'] + '\" class=\"form-control\" /></div>';
\t\t\t\t\thtml += '</div>';
\t\t\t\t}

\t\t\t\tif (option['type'] == 'textarea') {
\t\t\t\t\thtml += '<div class=\"form-group' + (option['required'] ? ' required' : '') + '\">';
\t\t\t\t\thtml += '  <label class=\"col-sm-2 control-label\" for=\"input-option' + option['product_option_id'] + '\">' + option['name'] + '</label>';
\t\t\t\t\thtml += '  <div class=\"col-sm-10\"><textarea name=\"option[' + option['product_option_id'] + ']\" rows=\"5\" id=\"input-option' + option['product_option_id'] + '\" class=\"form-control\">' + option['value'] + '</textarea></div>';
\t\t\t\t\thtml += '</div>';
\t\t\t\t}

\t\t\t\tif (option['type'] == 'file') {
\t\t\t\t\thtml += '<div class=\"form-group' + (option['required'] ? ' required' : '') + '\">';
\t\t\t\t\thtml += '  <label class=\"col-sm-2 control-label\">' + option['name'] + '</label>';
\t\t\t\t\thtml += '  <div class=\"col-sm-10\">';
\t\t\t\t\thtml += '    <button type=\"button\" id=\"button-upload' + option['product_option_id'] + '\" data-loading-text=\"";
        // line 1336
        echo ($context["text_loading"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-upload\"></i> ";
        echo ($context["button_upload"] ?? null);
        echo "</button>';
\t\t\t\t\thtml += '    <input type=\"hidden\" name=\"option[' + option['product_option_id'] + ']\" value=\"' + option['value'] + '\" id=\"input-option' + option['product_option_id'] + '\" />';
\t\t\t\t\thtml += '  </div>';
\t\t\t\t\thtml += '</div>';
\t\t\t\t}

\t\t\t\tif (option['type'] == 'date') {
\t\t\t\t\thtml += '<div class=\"form-group' + (option['required'] ? ' required' : '') + '\">';
\t\t\t\t\thtml += '  <label class=\"col-sm-2 control-label\" for=\"input-option' + option['product_option_id'] + '\">' + option['name'] + '</label>';
\t\t\t\t\thtml += '  <div class=\"col-sm-3\"><div class=\"input-group date\"><input type=\"text\" name=\"option[' + option['product_option_id'] + ']\" value=\"' + option['value'] + '\" placeholder=\"' + option['name'] + '\" data-date-format=\"YYYY-MM-DD\" id=\"input-option' + option['product_option_id'] + '\" class=\"form-control\" /><span class=\"input-group-btn\"><button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button></span></div></div>';
\t\t\t\t\thtml += '</div>';
\t\t\t\t}

\t\t\t\tif (option['type'] == 'datetime') {
\t\t\t\t\thtml += '<div class=\"form-group' + (option['required'] ? ' required' : '') + '\">';
\t\t\t\t\thtml += '  <label class=\"col-sm-2 control-label\" for=\"input-option' + option['product_option_id'] + '\">' + option['name'] + '</label>';
\t\t\t\t\thtml += '  <div class=\"col-sm-3\"><div class=\"input-group datetime\"><input type=\"text\" name=\"option[' + option['product_option_id'] + ']\" value=\"' + option['value'] + '\" placeholder=\"' + option['name'] + '\" data-date-format=\"YYYY-MM-DD HH:mm\" id=\"input-option' + option['product_option_id'] + '\" class=\"form-control\" /><span class=\"input-group-btn\"><button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button></span></div></div>';
\t\t\t\t\thtml += '</div>';
\t\t\t\t}

\t\t\t\tif (option['type'] == 'time') {
\t\t\t\t\thtml += '<div class=\"form-group' + (option['required'] ? ' required' : '') + '\">';
\t\t\t\t\thtml += '  <label class=\"col-sm-2 control-label\" for=\"input-option' + option['product_option_id'] + '\">' + option['name'] + '</label>';
\t\t\t\t\thtml += '  <div class=\"col-sm-3\"><div class=\"input-group time\"><input type=\"text\" name=\"option[' + option['product_option_id'] + ']\" value=\"' + option['value'] + '\" placeholder=\"' + option['name'] + '\" data-date-format=\"HH:mm\" id=\"input-option' + option['product_option_id'] + '\" class=\"form-control\" /><span class=\"input-group-btn\"><button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button></span></div></div>';
\t\t\t\t\thtml += '</div>';
\t\t\t\t}
\t\t\t}

\t\t\thtml += '</fieldset>';

\t\t\t\$('#option').html(html);

\t\t\t\$('.date').datetimepicker({
\t\t\t\tlanguage: '";
        // line 1369
        echo ($context["datepicker"] ?? null);
        echo "',
\t\t\t\tpickTime: false
\t\t\t});

\t\t\t\$('.datetime').datetimepicker({
\t\t\t\tlanguage: '";
        // line 1374
        echo ($context["datepicker"] ?? null);
        echo "',
\t\t\t\tpickDate: true,
\t\t\t\tpickTime: true
\t\t\t});

\t\t\t\$('.time').datetimepicker({
\t\t\t\tlanguage: '";
        // line 1380
        echo ($context["datepicker"] ?? null);
        echo "',
\t\t\t\tpickDate: false
\t\t\t});
\t\t} else {
\t\t\t\$('#option').html('');
\t\t}
\t}
});

\$('#button-product-add').on('click', function() {
\t\$.ajax({
\t\turl: '";
        // line 1391
        echo ($context["catalog"] ?? null);
        echo "index.php?route=api/cart/add&api_token=";
        echo ($context["api_token"] ?? null);
        echo "&store_id=' + \$('select[name=\\'store_id\\'] option:selected').val(),
\t\ttype: 'post',
\t\tdata: \$('#tab-product input[name=\\'product_id\\'], #tab-product input[name=\\'quantity\\'], #tab-product input[name^=\\'option\\'][type=\\'text\\'], #tab-product input[name^=\\'option\\'][type=\\'hidden\\'], #tab-product input[name^=\\'option\\'][type=\\'radio\\']:checked, #tab-product input[name^=\\'option\\'][type=\\'checkbox\\']:checked, #tab-product select[name^=\\'option\\'], #tab-product textarea[name^=\\'option\\']'),
\t\tdataType: 'json',
\t\tcrossDomain: true,
\t\tbeforeSend: function() {
\t\t\t\$('#button-product-add').button('loading');
\t\t},
\t\tcomplete: function() {
\t\t\t\$('#button-product-add').button('reset');
\t\t},
\t\tsuccess: function(json) {
\t\t\t\$('.alert-dismissible, .text-danger').remove();
\t\t\t\$('.form-group').removeClass('has-error');

\t\t\tif (json['error']) {
\t\t\t\tif (json['error']['warning']) {
\t\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error']['warning'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');
\t\t\t\t}

\t\t\t\tif (json['error']['option']) {
\t\t\t\t\tfor (i in json['error']['option']) {
\t\t\t\t\t\tvar element = \$('#input-option' + i.replace('_', '-'));

\t\t\t\t\t\tif (element.parent().hasClass('input-group')) {
\t\t\t\t\t\t\t\$(element).parent().after('<div class=\"text-danger\">' + json['error']['option'][i] + '</div>');
\t\t\t\t\t\t} else {
\t\t\t\t\t\t\t\$(element).after('<div class=\"text-danger\">' + json['error']['option'][i] + '</div>');
\t\t\t\t\t\t}
\t\t\t\t\t}
\t\t\t\t}

\t\t\t\tif (json['error']['store']) {
\t\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error']['store'] + '</div>');
\t\t\t\t}

\t\t\t\t// Highlight any found errors
\t\t\t\t\$('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');
\t\t\t} else {
\t\t\t\t// Refresh products, vouchers and totals
\t\t\t\t\$('#button-refresh').trigger('click');
\t\t\t}
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

// Voucher
\$('#button-voucher-add').on('click', function() {
\t\$.ajax({
\t\turl: '";
        // line 1443
        echo ($context["catalog"] ?? null);
        echo "index.php?route=api/voucher/add&api_token=";
        echo ($context["api_token"] ?? null);
        echo "&store_id=' + \$('select[name=\\'store_id\\'] option:selected').val(),
\t\ttype: 'post',
\t\tdata: \$('#tab-voucher input[type=\\'text\\'], #tab-voucher input[type=\\'hidden\\'], #tab-voucher input[type=\\'radio\\']:checked, #tab-voucher input[type=\\'checkbox\\']:checked, #tab-voucher select, #tab-voucher textarea'),
\t\tdataType: 'json',
\t\tcrossDomain: true,
\t\tbeforeSend: function() {
\t\t\t\$('#button-voucher-add').button('loading');
\t\t},
\t\tcomplete: function() {
\t\t\t\$('#button-voucher-add').button('reset');
\t\t},
\t\tsuccess: function(json) {
\t\t\t\$('.alert-dismissible, .text-danger').remove();
\t\t\t\$('.form-group').removeClass('has-error');

\t\t\tif (json['error']) {
\t\t\t\tif (json['error']['warning']) {
\t\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error']['warning'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');
\t\t\t\t}

\t\t\t\tfor (i in json['error']) {
\t\t\t\t\tvar element = \$('#input-' + i.replace('_', '-'));

\t\t\t\t\tif (element.parent().hasClass('input-group')) {
\t\t\t\t\t\t\$(element).parent().after('<div class=\"text-danger\">' + json['error'][i] + '</div>');
\t\t\t\t\t} else {
\t\t\t\t\t\t\$(element).after('<div class=\"text-danger\">' + json['error'][i] + '</div>');
\t\t\t\t\t}
\t\t\t\t}

\t\t\t\t// Highlight any found errors
\t\t\t\t\$('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');
\t\t\t} else {
\t\t\t\t\$('input[name=\\'from_name\\']').val('');
\t\t\t\t\$('input[name=\\'from_email\\']').val('');
\t\t\t\t\$('input[name=\\'to_name\\']').val('');
\t\t\t\t\$('input[name=\\'to_email\\']').val('');
\t\t\t\t\$('textarea[name=\\'message\\']').val('');
\t\t\t\t\$('input[name=\\'amount\\']').val('";
        // line 1481
        echo twig_escape_filter($this->env, ($context["voucher_min"] ?? null), "js");
        echo "');

\t\t\t\t// Refresh products, vouchers and totals
\t\t\t\t\$('#button-refresh').trigger('click');
\t\t\t}
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

\$('#cart').delegate('.btn-danger', 'click', function() {
\tvar node = this;

\t\$.ajax({
\t\turl: '";
        // line 1497
        echo ($context["catalog"] ?? null);
        echo "index.php?route=api/cart/remove&api_token=";
        echo ($context["api_token"] ?? null);
        echo "&store_id=' + \$('select[name=\\'store_id\\'] option:selected').val(),
\t\ttype: 'post',
\t\tdata: 'key=' + encodeURIComponent(this.value),
\t\tdataType: 'json',
\t\tcrossDomain: true,
\t\tbeforeSend: function() {
\t\t\t\$(node).button('loading');
\t\t},
\t\tcomplete: function() {
\t\t\t\$(node).button('reset');
\t\t},
\t\tsuccess: function(json) {
\t\t\t\$('.alert-dismissible, .text-danger').remove();

\t\t\t// Check for errors
\t\t\tif (json['error']) {
\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');
\t\t\t} else {
\t\t\t\t// Refresh products, vouchers and totals
\t\t\t\t\$('#button-refresh').trigger('click');
\t\t\t}
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

\$('#cart').delegate('.btn-primary', 'click', function() {
    var node = this;

    // Refresh products, vouchers and totals
    \$.ajax({
        url: '";
        // line 1530
        echo ($context["catalog"] ?? null);
        echo "index.php?route=api/cart/add&api_token=";
        echo ($context["api_token"] ?? null);
        echo "&store_id=' + \$('select[name=\\'store_id\\'] option:selected').val(),
        type: 'post',
        data: \$('#cart input[name^=\\'product\\'][type=\\'text\\'], #cart input[name^=\\'product\\'][type=\\'hidden\\'], #cart input[name^=\\'product\\'][type=\\'radio\\']:checked, #cart input[name^=\\'product\\'][type=\\'checkbox\\']:checked, #cart select[name^=\\'product\\'], #cart textarea[name^=\\'product\\']'),
        dataType: 'json',
        crossDomain: true,
        beforeSend: function() {
            \$(node).button('loading');
        },
        complete: function() {
            \$(node).button('reset');
        },
        success: function(json) {
            \$('.alert-dismissible, .text-danger').remove();
            \$('.form-group').removeClass('has-error');

            if (json['error'] && json['error']['warning']) {
                \$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error']['warning'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');
            }

            if (json['success']) {
\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ' + json['success'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');
\t\t\t}
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
        }
    }).done(function() {
        \$('#button-refresh').trigger('click');
    });
});

\$('#button-cart').on('click', function() {
\t\$('a[href=\\'#tab-payment\\']').tab('show');
});

// Payment Address
\$('select[name=\\'payment_address\\']').on('change', function() {
\t\$.ajax({
\t\turl: 'index.php?route=customer/customer/address&user_token=";
        // line 1568
        echo ($context["user_token"] ?? null);
        echo "&address_id=' + this.value,
\t\tdataType: 'json',
\t\tbeforeSend: function() {
\t\t\t\$('select[name=\\'payment_address\\']').prop('disabled', true);
\t\t},
\t\tcomplete: function() {
\t\t\t\$('select[name=\\'payment_address\\']').prop('disabled', false);
\t\t},
\t\tsuccess: function(json) {
\t\t\t// Reset all fields
\t\t\t\$('#tab-payment input[type=\\'text\\'], #tab-payment input[type=\\'text\\'], #tab-payment textarea').val('');
\t\t\t\$('#tab-payment select option').not('#tab-payment select[name=\\'payment_address\\']').removeAttr('selected');
\t\t\t\$('#tab-payment input[type=\\'checkbox\\'], #tab-payment input[type=\\'radio\\']').removeAttr('checked');

\t\t\t\$('#tab-payment input[name=\\'firstname\\']').val(json['firstname']);
\t\t\t\$('#tab-payment input[name=\\'lastname\\']').val(json['lastname']);
\t\t\t\$('#tab-payment input[name=\\'company\\']').val(json['company']);
\t\t\t\$('#tab-payment input[name=\\'address_1\\']').val(json['address_1']);
\t\t\t\$('#tab-payment input[name=\\'address_2\\']').val(json['address_2']);
\t\t\t\$('#tab-payment input[name=\\'city\\']').val(json['city']);
\t\t\t\$('#tab-payment input[name=\\'postcode\\']').val(json['postcode']);
\t\t\t\$('#tab-payment select[name=\\'country_id\\']').val(json['country_id']);

\t\t\tpayment_zone_id = json['zone_id'];

\t\t\tfor (i in json['custom_field']) {
\t\t\t\t\$('#tab-payment select[name=\\'custom_field[' + i + ']\\']').val(json['custom_field'][i]);
\t\t\t\t\$('#tab-payment textarea[name=\\'custom_field[' + i + ']\\']').val(json['custom_field'][i]);
\t\t\t\t\$('#tab-payment input[name^=\\'custom_field[' + i + ']\\'][type=\\'text\\']').val(json['custom_field'][i]);
\t\t\t\t\$('#tab-payment input[name^=\\'custom_field[' + i + ']\\'][type=\\'hidden\\']').val(json['custom_field'][i]);
\t\t\t\t\$('#tab-payment input[name^=\\'custom_field[' + i + ']\\'][type=\\'radio\\'][value=\\'' + json['custom_field'][i] + '\\']').prop('checked', true);
\t\t\t\t\$('#tab-payment input[name^=\\'custom_field[' + i + ']\\'][type=\\'checkbox\\'][value=\\'' + json['custom_field'][i] + '\\']').prop('checked', true);

\t\t\t\tif (json['custom_field'][i] instanceof Array) {
\t\t\t\t\tfor (j = 0; j < json['custom_field'][i].length; j++) {
\t\t\t\t\t\t\$('#tab-payment input[name^=\\'custom_field[' + i + ']\\'][type=\\'checkbox\\'][value=\\'' + json['custom_field'][i][j] + '\\']').prop('checked', true);
\t\t\t\t\t}
\t\t\t\t}
\t\t\t}

\t\t\t\$('#tab-payment select[name=\\'country_id\\']').trigger('change');
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

var payment_zone_id = '";
        // line 1616
        echo ($context["payment_zone_id"] ?? null);
        echo "';

\$('#tab-payment select[name=\\'country_id\\']').on('change', function() {
\t\$.ajax({
\t\turl: 'index.php?route=localisation/country/country&user_token=";
        // line 1620
        echo ($context["user_token"] ?? null);
        echo "&country_id=' + this.value,
\t\tdataType: 'json',
\t\tbeforeSend: function() {
\t\t\t\$('#tab-payment select[name=\\'country_id\\']').after(' <i class=\"fa fa-circle-o-notch fa-spin\"></i>');
\t\t},
\t\tcomplete: function() {
\t\t\t\$('#tab-payment .fa-spin').remove();
\t\t},
\t\tsuccess: function(json) {
\t\t\tif (json['postcode_required'] == '1') {
\t\t\t\t\$('#tab-payment input[name=\\'postcode\\']').closest('.form-group').addClass('required');
\t\t\t} else {
\t\t\t\t\$('#tab-payment input[name=\\'postcode\\']').closest('.form-group').removeClass('required');
\t\t\t}

\t\t\thtml = '<option value=\"\">";
        // line 1635
        echo ($context["text_select"] ?? null);
        echo "</option>';

\t\t\tif (json['zone'] && json['zone'] != '') {
\t\t\t\tfor (i = 0; i < json['zone'].length; i++) {
        \t\t\thtml += '<option value=\"' + json['zone'][i]['zone_id'] + '\"';

\t\t\t\t\tif (json['zone'][i]['zone_id'] == payment_zone_id) {
\t      \t\t\t\thtml += ' selected=\"selected\"';
\t    \t\t\t}

\t    \t\t\thtml += '>' + json['zone'][i]['name'] + '</option>';
\t\t\t\t}
\t\t\t} else {
\t\t\t\thtml += '<option value=\"0\" selected=\"selected\">";
        // line 1648
        echo ($context["text_none"] ?? null);
        echo "</option>';
\t\t\t}

\t\t\t\$('#tab-payment select[name=\\'zone_id\\']').html(html);
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

\$('#tab-payment select[name=\\'country_id\\']').trigger('change');

\$('#button-payment-address').on('click', function() {
\t\$.ajax({
\t\turl: '";
        // line 1663
        echo ($context["catalog"] ?? null);
        echo "index.php?route=api/payment/address&api_token=";
        echo ($context["api_token"] ?? null);
        echo "&store_id=' + \$('select[name=\\'store_id\\'] option:selected').val(),
\t\ttype: 'post',
\t\tdata: \$('#tab-payment input[type=\\'text\\'], #tab-payment input[type=\\'hidden\\'], #tab-payment input[type=\\'radio\\']:checked, #tab-payment input[type=\\'checkbox\\']:checked, #tab-payment select, #tab-payment textarea'),
\t\tdataType: 'json',
\t\tcrossDomain: true,
\t\tbeforeSend: function() {
\t\t\t\$('#button-payment-address').button('loading');
\t\t},
\t\tcomplete: function() {
\t\t\t\$('#button-payment-address').button('reset');
\t\t},
\t\tsuccess: function(json) {
\t\t\t\$('.alert-dismissible, .text-danger').remove();
\t\t\t\$('.form-group').removeClass('has-error');

\t\t\t// Check for errors
\t\t\tif (json['error']) {
\t\t\t\tif (json['error']['warning']) {
\t\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error']['warning'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');
\t\t\t\t}

\t\t\t\tfor (i in json['error']) {
\t\t\t\t\tvar element = \$('#input-payment-' + i.replace('_', '-'));

\t\t\t\t\tif (\$(element).parent().hasClass('input-group')) {
\t\t\t\t\t\t\$(element).parent().after('<div class=\"text-danger\">' + json['error'][i] + '</div>');
\t\t\t\t\t} else {
\t\t\t\t\t\t\$(element).after('<div class=\"text-danger\">' + json['error'][i] + '</div>');
\t\t\t\t\t}
\t\t\t\t}

\t\t\t\t// Highlight any found errors
\t\t\t\t\$('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');
\t\t\t} else {
\t\t\t\t// Payment Methods
\t\t\t\t\$.ajax({
\t\t\t\t\turl: '";
        // line 1699
        echo ($context["catalog"] ?? null);
        echo "index.php?route=api/payment/methods&api_token=";
        echo ($context["api_token"] ?? null);
        echo "&store_id=' + \$('select[name=\\'store_id\\'] option:selected').val(),
\t\t\t\t\tdataType: 'json',
\t\t\t\t\tcrossDomain: true,
\t\t\t\t\tbeforeSend: function() {
\t\t\t\t\t\t\$('#button-payment-address').button('loading');
\t\t\t\t\t},
\t\t\t\t\tcomplete: function() {
\t\t\t\t\t\t\$('#button-payment-address').button('reset');
\t\t\t\t\t},
\t\t\t\t\tsuccess: function(json) {
\t\t\t\t\t\tif (json['error']) {
\t\t\t\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');
\t\t\t\t\t\t} else {
\t\t\t\t\t\t\thtml = '<option value=\"\">";
        // line 1712
        echo ($context["text_select"] ?? null);
        echo "</option>';

\t\t\t\t\t\t\tif (json['payment_methods']) {
\t\t\t\t\t\t\t\tfor (i in json['payment_methods']) {
\t\t\t\t\t\t\t\t\tif (json['payment_methods'][i]['code'] == \$('select[name=\\'payment_method\\'] option:selected').val()) {
\t\t\t\t\t\t\t\t\t\thtml += '<option value=\"' + json['payment_methods'][i]['code'] + '\" selected=\"selected\">' + json['payment_methods'][i]['title'] + '</option>';
\t\t\t\t\t\t\t\t\t} else {
\t\t\t\t\t\t\t\t\t\thtml += '<option value=\"' + json['payment_methods'][i]['code'] + '\">' + json['payment_methods'][i]['title'] + '</option>';
\t\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t}

\t\t\t\t\t\t\t\$('select[name=\\'payment_method\\']').html(html);
\t\t\t\t\t\t}
\t\t\t\t\t},
\t\t\t\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\t\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t\t\t\t}
\t\t\t\t}).done(function() {
                    // Refresh products, vouchers and totals
    \t\t\t\t\$('#button-refresh').trigger('click');

    \t\t\t\t// If shipping required got to shipping tab else total tabs
    \t\t\t\tif (\$('select[name=\\'shipping_method\\']').prop('disabled')) {
    \t\t\t\t\t\$('a[href=\\'#tab-total\\']').tab('show');
    \t\t\t\t} else {
    \t\t\t\t\t\$('a[href=\\'#tab-shipping\\']').tab('show');
    \t\t\t\t}
                });
\t\t\t}
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

// Shipping Address
\$('select[name=\\'shipping_address\\']').on('change', function() {
\t\$.ajax({
\t\turl: 'index.php?route=customer/customer/address&user_token=";
        // line 1752
        echo ($context["user_token"] ?? null);
        echo "&address_id=' + this.value,
\t\tdataType: 'json',
\t\tbeforeSend: function() {
\t\t\t\$('select[name=\\'shipping_address\\']').prop('disabled', true);
\t\t},
\t\tcomplete: function() {
\t\t\t\$('select[name=\\'shipping_address\\']').prop('disabled', false);
\t\t},
\t\tsuccess: function(json) {
\t\t\t// Reset all fields
\t\t\t\$('#tab-shipping input[type=\\'text\\'], #tab-shipping input[type=\\'text\\'], #tab-shipping textarea').val('');
\t\t\t\$('#tab-shipping select option').not('#tab-shipping select[name=\\'shipping_address\\']').removeAttr('selected');
\t\t\t\$('#tab-shipping input[type=\\'checkbox\\'], #tab-shipping input[type=\\'radio\\']').removeAttr('checked');

\t\t\t\$('#tab-shipping input[name=\\'firstname\\']').val(json['firstname']);
\t\t\t\$('#tab-shipping input[name=\\'lastname\\']').val(json['lastname']);
\t\t\t\$('#tab-shipping input[name=\\'company\\']').val(json['company']);
\t\t\t\$('#tab-shipping input[name=\\'address_1\\']').val(json['address_1']);
\t\t\t\$('#tab-shipping input[name=\\'address_2\\']').val(json['address_2']);
\t\t\t\$('#tab-shipping input[name=\\'city\\']').val(json['city']);
\t\t\t\$('#tab-shipping input[name=\\'postcode\\']').val(json['postcode']);
\t\t\t\$('#tab-shipping select[name=\\'country_id\\']').val(json['country_id']);

\t\t\tshipping_zone_id = json['zone_id'];

\t\t\tfor (i in json['custom_field']) {
\t\t\t\t\$('#tab-shipping select[name=\\'custom_field[' + i + ']\\']').val(json['custom_field'][i]);
\t\t\t\t\$('#tab-shipping textarea[name=\\'custom_field[' + i + ']\\']').val(json['custom_field'][i]);
\t\t\t\t\$('#tab-shipping input[name^=\\'custom_field[' + i + ']\\'][type=\\'text\\']').val(json['custom_field'][i]);
\t\t\t\t\$('#tab-shipping input[name^=\\'custom_field[' + i + ']\\'][type=\\'hidden\\']').val(json['custom_field'][i]);
\t\t\t\t\$('#tab-shipping input[name^=\\'custom_field[' + i + ']\\'][type=\\'radio\\'][value=\\'' + json['custom_field'][i] + '\\']').prop('checked', true);
\t\t\t\t\$('#tab-shipping input[name^=\\'custom_field[' + i + ']\\'][type=\\'checkbox\\'][value=\\'' + json['custom_field'][i] + '\\']').prop('checked', true);

\t\t\t\tif (json['custom_field'][i] instanceof Array) {
\t\t\t\t\tfor (j = 0; j < json['custom_field'][i].length; j++) {
\t\t\t\t\t\t\$('#tab-shipping input[name^=\\'custom_field[' + i + ']\\'][type=\\'checkbox\\'][value=\\'' + json['custom_field'][i][j] + '\\']').prop('checked', true);
\t\t\t\t\t}
\t\t\t\t}
\t\t\t}

\t\t\t\$('#tab-shipping select[name=\\'country_id\\']').trigger('change');
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

var shipping_zone_id = '";
        // line 1800
        echo ($context["shipping_zone_id"] ?? null);
        echo "';

\$('#tab-shipping select[name=\\'country_id\\']').on('change', function() {
\t\$.ajax({
\t\turl: 'index.php?route=localisation/country/country&user_token=";
        // line 1804
        echo ($context["user_token"] ?? null);
        echo "&country_id=' + this.value,
\t\tdataType: 'json',
\t\tbeforeSend: function() {
\t\t\t\$('#tab-shipping select[name=\\'country_id\\']').prop('disabled', true);
\t\t},
\t\tcomplete: function() {
\t\t\t\$('#tab-shipping select[name=\\'country_id\\']').prop('disabled', false);
\t\t},
\t\tsuccess: function(json) {
\t\t\tif (json['postcode_required'] == '1') {
\t\t\t\t\$('#tab-shipping input[name=\\'postcode\\']').closest('.form-group').addClass('required');
\t\t\t} else {
\t\t\t\t\$('#tab-shipping input[name=\\'postcode\\']').closest('.form-group').removeClass('required');
\t\t\t}

\t\t\thtml = '<option value=\"\">";
        // line 1819
        echo ($context["text_select"] ?? null);
        echo "</option>';

\t\t\tif (json['zone'] && json['zone'] != '') {
\t\t\t\tfor (i = 0; i < json['zone'].length; i++) {
        \t\t\thtml += '<option value=\"' + json['zone'][i]['zone_id'] + '\"';

\t\t\t\t\tif (json['zone'][i]['zone_id'] == shipping_zone_id) {
\t      \t\t\t\thtml += ' selected=\"selected\"';
\t    \t\t\t}

\t    \t\t\thtml += '>' + json['zone'][i]['name'] + '</option>';
\t\t\t\t}
\t\t\t} else {
\t\t\t\thtml += '<option value=\"0\" selected=\"selected\">";
        // line 1832
        echo ($context["text_none"] ?? null);
        echo "</option>';
\t\t\t}

\t\t\t\$('#tab-shipping select[name=\\'zone_id\\']').html(html);
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

\$('#tab-shipping select[name=\\'country_id\\']').trigger('change');

\$('#button-shipping-address').on('click', function() {
\t\$.ajax({
\t\turl: '";
        // line 1847
        echo ($context["catalog"] ?? null);
        echo "index.php?route=api/shipping/address&api_token=";
        echo ($context["api_token"] ?? null);
        echo "&store_id=' + \$('select[name=\\'store_id\\'] option:selected').val(),
\t\ttype: 'post',
\t\tdata: \$('#tab-shipping input[type=\\'text\\'], #tab-shipping input[type=\\'hidden\\'], #tab-shipping input[type=\\'radio\\']:checked, #tab-shipping input[type=\\'checkbox\\']:checked, #tab-shipping select, #tab-shipping textarea'),
\t\tdataType: 'json',
\t\tcrossDomain: true,
\t\tbeforeSend: function() {
\t\t\t\$('#button-shipping-address').button('loading');
\t\t},
\t\tcomplete: function() {
\t\t\t\$('#button-shipping-address').button('reset');
\t\t},
\t\tsuccess: function(json) {
\t\t\t\$('.alert-dismissible, .text-danger').remove();
\t\t\t\$('.form-group').removeClass('has-error');

\t\t\t// Check for errors
\t\t\tif (json['error']) {
\t\t\t\tif (json['error']['warning']) {
\t\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error']['warning'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');
\t\t\t\t}

\t\t\t\tfor (i in json['error']) {
\t\t\t\t\tvar element = \$('#input-shipping-' + i.replace('_', '-'));

\t\t\t\t\tif (\$(element).parent().hasClass('input-group')) {
\t\t\t\t\t\t\$(element).parent().after('<div class=\"text-danger\">' + json['error'][i] + '</div>');
\t\t\t\t\t} else {
\t\t\t\t\t\t\$(element).after('<div class=\"text-danger\">' + json['error'][i] + '</div>');
\t\t\t\t\t}
\t\t\t\t}

\t\t\t\t// Highlight any found errors
\t\t\t\t\$('.text-danger').parentsUntil('.form-group').parent().addClass('has-error');
\t\t\t} else {
\t\t\t\t// Shipping Methods
\t\t\t\tvar request = \$.ajax({
\t\t\t\t\turl: '";
        // line 1883
        echo ($context["catalog"] ?? null);
        echo "index.php?route=api/shipping/methods&api_token=";
        echo ($context["api_token"] ?? null);
        echo "&store_id=' + \$('select[name=\\'store_id\\'] option:selected').val(),
\t\t\t\t\tdataType: 'json',
\t\t\t\t\tbeforeSend: function() {
\t\t\t\t\t\t\$('#button-shipping-address').button('loading');
\t\t\t\t\t},
\t\t\t\t\tcomplete: function() {
\t\t\t\t\t\t\$('#button-shipping-address').button('reset');
\t\t\t\t\t},
\t\t\t\t\tsuccess: function(json) {
\t\t\t\t\t\tif (json['error']) {
\t\t\t\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');
\t\t\t\t\t\t} else {
\t\t\t\t\t\t\t// Shipping Methods
\t\t\t\t\t\t\thtml = '<option value=\"\">";
        // line 1896
        echo ($context["text_select"] ?? null);
        echo "</option>';

\t\t\t\t\t\t\tif (json['shipping_methods']) {
\t\t\t\t\t\t\t\tfor (i in json['shipping_methods']) {
\t\t\t\t\t\t\t\t\thtml += '<optgroup label=\"' + json['shipping_methods'][i]['title'] + '\">';

\t\t\t\t\t\t\t\t\tif (!json['shipping_methods'][i]['error']) {
\t\t\t\t\t\t\t\t\t\tfor (j in json['shipping_methods'][i]['quote']) {
\t\t\t\t\t\t\t\t\t\t\tif (json['shipping_methods'][i]['quote'][j]['code'] == \$('select[name=\\'shipping_method\\'] option:selected').val()) {
\t\t\t\t\t\t\t\t\t\t\t\thtml += '<option value=\"' + json['shipping_methods'][i]['quote'][j]['code'] + '\" selected=\"selected\">' + json['shipping_methods'][i]['quote'][j]['title'] + ' - ' + json['shipping_methods'][i]['quote'][j]['text'] + '</option>';
\t\t\t\t\t\t\t\t\t\t\t} else {
\t\t\t\t\t\t\t\t\t\t\t\thtml += '<option value=\"' + json['shipping_methods'][i]['quote'][j]['code'] + '\">' + json['shipping_methods'][i]['quote'][j]['title'] + ' - ' + json['shipping_methods'][i]['quote'][j]['text'] + '</option>';
\t\t\t\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t\t} else {
\t\t\t\t\t\t\t\t\t\thtml += '<option value=\"\" style=\"color: #F00;\" disabled=\"disabled\">' + json['shipping_methods'][i]['error'] + '</option>';
\t\t\t\t\t\t\t\t\t}

\t\t\t\t\t\t\t\t\thtml += '</optgroup>';
\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t}

\t\t\t\t\t\t\t\$('select[name=\\'shipping_method\\']').html(html);
\t\t\t\t\t\t}
\t\t\t\t\t},
\t\t\t\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\t\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t\t\t\t}
\t\t\t\t}).done(function() {
\t\t\t\t    // Refresh products, vouchers and totals
\t\t\t\t    \$('#button-refresh').trigger('click');

                    \$('a[href=\\'#tab-total\\']').tab('show');
                });
\t\t\t}
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

// Shipping Method
\$('#button-shipping-method').on('click', function() {
\t\$.ajax({
\t\turl: '";
        // line 1941
        echo ($context["catalog"] ?? null);
        echo "index.php?route=api/shipping/method&api_token=";
        echo ($context["api_token"] ?? null);
        echo "&store_id=' + \$('select[name=\\'store_id\\'] option:selected').val(),
\t\ttype: 'post',
\t\tdata: 'shipping_method=' + \$('select[name=\\'shipping_method\\'] option:selected').val(),
\t\tdataType: 'json',
\t\tcrossDomain: true,
\t\tbeforeSend: function() {
\t\t\t\$('#button-shipping-method').button('loading');
\t\t},
\t\tcomplete: function() {
\t\t\t\$('#button-shipping-method').button('reset');
\t\t},
\t\tsuccess: function(json) {
\t\t\t\$('.alert-dismissible, .text-danger').remove();
\t\t\t\$('.form-group').removeClass('has-error');

\t\t\tif (json['error']) {
\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');

\t\t\t\t// Highlight any found errors
\t\t\t\t\$('select[name=\\'shipping_method\\']').closest('.form-group').addClass('has-error');
\t\t\t}

\t\t\tif (json['success']) {
\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ' + json['success'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');

\t\t\t\t// Refresh products, vouchers and totals
\t\t\t\t\$('#button-refresh').trigger('click');
\t\t\t}
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

// Payment Method
\$('#button-payment-method').on('click', function() {
\t\$.ajax({
\t\turl: '";
        // line 1979
        echo ($context["catalog"] ?? null);
        echo "index.php?route=api/payment/method&api_token=";
        echo ($context["api_token"] ?? null);
        echo "&store_id=' + \$('select[name=\\'store_id\\'] option:selected').val(),
\t\ttype: 'post',
\t\tdata: 'payment_method=' + \$('select[name=\\'payment_method\\'] option:selected').val(),
\t\tdataType: 'json',
\t\tcrossDomain: true,
\t\tbeforeSend: function() {
\t\t\t\$('#button-payment-method').button('loading');
\t\t},
\t\tcomplete: function() {
\t\t\t\$('#button-payment-method').button('reset');
\t\t},
\t\tsuccess: function(json) {
\t\t\t\$('.alert-dismissible, .text-danger').remove();
\t\t\t\$('.form-group').removeClass('has-error');

\t\t\tif (json['error']) {
\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');

\t\t\t\t// Highlight any found errors
\t\t\t\t\$('select[name=\\'payment_method\\']').closest('.form-group').addClass('has-error');
\t\t\t}

\t\t\tif (json['success']) {
\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ' + json['success'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');

\t\t\t\t// Refresh products, vouchers and totals
\t\t\t\t\$('#button-refresh').trigger('click');
\t\t\t}
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

// Coupon
\$('#button-coupon').on('click', function() {
\t\$.ajax({
\t\turl: '";
        // line 2017
        echo ($context["catalog"] ?? null);
        echo "index.php?route=api/coupon&api_token=";
        echo ($context["api_token"] ?? null);
        echo "&store_id=' + \$('select[name=\\'store_id\\'] option:selected').val(),
\t\ttype: 'post',
\t\tdata: 'coupon=' + \$('input[name=\\'coupon\\']').val(),
\t\tdataType: 'json',
\t\tcrossDomain: true,
\t\tbeforeSend: function() {
\t\t\t\$('#button-coupon').button('loading');
\t\t},
\t\tcomplete: function() {
\t\t\t\$('#button-coupon').button('reset');
\t\t},
\t\tsuccess: function(json) {
\t\t\t\$('.alert-dismissible, .text-danger').remove();
\t\t\t\$('.form-group').removeClass('has-error');

\t\t\tif (json['error']) {
\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');

\t\t\t\t// Highlight any found errors
\t\t\t\t\$('input[name=\\'coupon\\']').closest('.form-group').addClass('has-error');
\t\t\t}

\t\t\tif (json['success']) {
\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ' + json['success'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');

\t\t\t\t// Refresh products, vouchers and totals
\t\t\t\t\$('#button-refresh').trigger('click');
\t\t\t}
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

// Voucher
\$('#button-voucher').on('click', function() {
\t\$.ajax({
\t\turl: '";
        // line 2055
        echo ($context["catalog"] ?? null);
        echo "index.php?route=api/voucher&api_token=";
        echo ($context["api_token"] ?? null);
        echo "&store_id=' + \$('select[name=\\'store_id\\'] option:selected').val(),
\t\ttype: 'post',
\t\tdata: 'voucher=' + \$('input[name=\\'voucher\\']').val(),
\t\tdataType: 'json',
\t\tcrossDomain: true,
\t\tbeforeSend: function() {
\t\t\t\$('#button-voucher').button('loading');
\t\t},
\t\tcomplete: function() {
\t\t\t\$('#button-voucher').button('reset');
\t\t},
\t\tsuccess: function(json) {
\t\t\t\$('.alert-dismissible, .text-danger').remove();
\t\t\t\$('.form-group').removeClass('has-error');

\t\t\tif (json['error']) {
\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');

\t\t\t\t// Highlight any found errors
\t\t\t\t\$('input[name=\\'voucher\\']').closest('.form-group').addClass('has-error');
\t\t\t}

\t\t\tif (json['success']) {
\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ' + json['success'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');

\t\t\t\t// Refresh products, vouchers and totals
\t\t\t\t\$('#button-refresh').trigger('click');
\t\t\t}
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

// Reward
\$('#button-reward').on('click', function() {
\t\$.ajax({
\t\turl: '";
        // line 2093
        echo ($context["catalog"] ?? null);
        echo "index.php?route=api/reward&api_token=";
        echo ($context["api_token"] ?? null);
        echo "&store_id=' + \$('select[name=\\'store_id\\'] option:selected').val(),
\t\ttype: 'post',
\t\tdata: 'reward=' + \$('input[name=\\'reward\\']').val(),
\t\tdataType: 'json',
\t\tcrossDomain: true,
\t\tbeforeSend: function() {
\t\t\t\$('#button-reward').button('loading');
\t\t},
\t\tcomplete: function() {
\t\t\t\$('#button-reward').button('reset');
\t\t},
\t\tsuccess: function(json) {
\t\t\t\$('.alert-dismissible, .text-danger').remove();
\t\t\t\$('.form-group').removeClass('has-error');

\t\t\tif (json['error']) {
\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');

\t\t\t\t// Highlight any found errors
\t\t\t\t\$('input[name=\\'reward\\']').closest('.form-group').addClass('has-error');
\t\t\t}

\t\t\tif (json['success']) {
\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ' + json['success'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');

\t\t\t\t// Refresh products, vouchers and totals
\t\t\t\t\$('#button-refresh').trigger('click');
\t\t\t}
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

// Affiliate
\$('input[name=\\'affiliate\\']').autocomplete({
\t'source': function(request, response) {
\t\t\$.ajax({
\t\t\turl: 'index.php?route=customer/customer/autocomplete&user_token=";
        // line 2132
        echo ($context["user_token"] ?? null);
        echo "&filter_affiliate=1&filter_name=' +  encodeURIComponent(request),
\t\t\tdataType: 'json',
\t\t\tsuccess: function(json) {
\t\t\t\tjson.unshift({
\t\t\t\t\tcustomer_id: 0,
\t\t\t\t\tname: '";
        // line 2137
        echo ($context["text_none"] ?? null);
        echo "'
\t\t\t\t});

\t\t\t\tresponse(\$.map(json, function(item) {
\t\t\t\t\treturn {
\t\t\t\t\t\tlabel: item['name'],
\t\t\t\t\t\tvalue: item['customer_id']
\t\t\t\t\t}
\t\t\t\t}));
\t\t\t}
\t\t});
\t},
\t'select': function(item) {
\t\t\$('input[name=\\'affiliate\\']').val(item['label']);
\t\t\$('input[name=\\'affiliate_id\\']').val(item['value']);
\t}
});

// Checkout
\$('#button-save').on('click', function() {
\tif (\$('input[name=\\'order_id\\']').val() == 0) {
\t\tvar url = '";
        // line 2158
        echo ($context["catalog"] ?? null);
        echo "index.php?route=api/order/add&api_token=";
        echo ($context["api_token"] ?? null);
        echo "&store_id=' + \$('select[name=\\'store_id\\'] option:selected').val();
\t} else {
\t\tvar url = '";
        // line 2160
        echo ($context["catalog"] ?? null);
        echo "index.php?route=api/order/edit&api_token=";
        echo ($context["api_token"] ?? null);
        echo "&store_id=' + \$('select[name=\\'store_id\\'] option:selected').val() + '&order_id=' + \$('input[name=\\'order_id\\']').val();
\t}

\t\$.ajax({
\t\turl: url,
\t\ttype: 'post',
\t\tdata: \$('select[name=\\'payment_method\\'] option:selected, select[name=\\'shipping_method\\'] option:selected,  #tab-total select[name=\\'order_status_id\\'], #tab-total select, textarea[name=\\'comment\\'], input[name=\\'affiliate_id\\']'),
\t\tdataType: 'json',
\t\tcrossDomain: true,
\t\tbeforeSend: function() {
\t\t\t\$('#button-save').button('loading');
\t\t},
\t\tcomplete: function() {
\t\t\t\$('#button-save').button('reset');
\t\t},
\t\tsuccess: function(json) {
\t\t\t\$('.alert-dismissible, .text-danger').remove();

\t\t\tif (json['error']) {
\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');
\t\t\t}

\t\t\tif (json['success']) {
\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ' + json['success'] + '  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');
            }

\t\t\tif (json['order_id']) {
\t\t\t\t\$('input[name=\\'order_id\\']').val(json['order_id']);
\t\t\t}
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});

\$('#content').delegate('button[id^=\\'button-upload\\'], button[id^=\\'button-custom-field\\'], button[id^=\\'button-payment-custom-field\\'], button[id^=\\'button-shipping-custom-field\\']', 'click', function() {
\tvar node = this;

\t\$('#form-upload').remove();

\t\$('body').prepend('<form enctype=\"multipart/form-data\" id=\"form-upload\" style=\"display: none;\"><input type=\"file\" name=\"file\" /></form>');

\t\$('#form-upload input[name=\\'file\\']').trigger('click');

\tif (typeof timer != 'undefined') {
    \tclearInterval(timer);
\t}

\ttimer = setInterval(function() {
\t\tif (\$('#form-upload input[name=\\'file\\']').val() != '') {
\t\t\tclearInterval(timer);

\t\t\t\$.ajax({
\t\t\t\turl: 'index.php?route=tool/upload/upload&user_token=";
        // line 2214
        echo ($context["user_token"] ?? null);
        echo "',
\t\t\t\ttype: 'post',
\t\t\t\tdataType: 'json',
\t\t\t\tdata: new FormData(\$('#form-upload')[0]),
\t\t\t\tcache: false,
\t\t\t\tcontentType: false,
\t\t\t\tprocessData: false,
\t\t\t\tbeforeSend: function() {
\t\t\t\t\t\$(node).button('loading');
\t\t\t\t},
\t\t\t\tcomplete: function() {
\t\t\t\t\t\$(node).button('reset');
\t\t\t\t},
\t\t\t\tsuccess: function(json) {
\t\t\t\t\t\$(node).parent().find('.text-danger').remove();

\t\t\t\t\tif (json['error']) {
\t\t\t\t\t\t\$(node).parent().find('input[type=\\'hidden\\']').after('<div class=\"text-danger\">' + json['error'] + '</div>');
\t\t\t\t\t}

\t\t\t\t\tif (json['success']) {
\t\t\t\t\t\talert(json['success']);
\t\t\t\t\t}

\t\t\t\t\tif (json['code']) {
\t\t\t\t\t\t\$(node).parent().find('input[type=\\'hidden\\']').val(json['code']);
\t\t\t\t\t}
\t\t\t\t},
\t\t\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t\t\t}
\t\t\t});
\t\t}
\t}, 500);
});

\$('.date').datetimepicker({
\tlanguage: '";
        // line 2251
        echo ($context["datepicker"] ?? null);
        echo "',
\tpickTime: false
});

\$('.datetime').datetimepicker({
\tlanguage: '";
        // line 2256
        echo ($context["datepicker"] ?? null);
        echo "',
\tpickDate: true,
\tpickTime: true
});

\$('.time').datetimepicker({
\tlanguage: '";
        // line 2262
        echo ($context["datepicker"] ?? null);
        echo "',
\tpickDate: false
});
//--></script>
  <script type=\"text/javascript\"><!--
// Sort the custom fields
\$('#tab-customer .form-group[data-sort]').detach().each(function() {
\tif (\$(this).attr('data-sort') >= 0 && \$(this).attr('data-sort') <= \$('#tab-customer .form-group').length) {
\t\t\$('#tab-customer .form-group').eq(\$(this).attr('data-sort')).before(this);
\t}

\tif (\$(this).attr('data-sort') > \$('#tab-customer .form-group').length) {
\t\t\$('#tab-customer .form-group:last').after(this);
\t}

\tif (\$(this).attr('data-sort') < -\$('#tab-customer .form-group').length) {
\t\t\$('#tab-customer .form-group:first').before(this);
\t}
});

// Sort the custom fields
\$('#tab-payment .form-group[data-sort]').detach().each(function() {
\tif (\$(this).attr('data-sort') >= 0 && \$(this).attr('data-sort') <= \$('#tab-payment .form-group').length) {
\t\t\$('#tab-payment .form-group').eq(\$(this).attr('data-sort')).before(this);
\t}

\tif (\$(this).attr('data-sort') > \$('#tab-payment .form-group').length) {
\t\t\$('#tab-payment .form-group:last').after(this);
\t}

\tif (\$(this).attr('data-sort') < -\$('#tab-payment .form-group').length) {
\t\t\$('#tab-payment .form-group:first').before(this);
\t}
});

\$('#tab-shipping .form-group[data-sort]').detach().each(function() {
\tif (\$(this).attr('data-sort') >= 0 && \$(this).attr('data-sort') <= \$('#tab-shipping .form-group').length) {
\t\t\$('#tab-shipping .form-group').eq(\$(this).attr('data-sort')).before(this);
\t}

\tif (\$(this).attr('data-sort') > \$('#tab-shipping .form-group').length) {
\t\t\$('#tab-shipping .form-group:last').after(this);
\t}

\tif (\$(this).attr('data-sort') < -\$('#tab-shipping .form-group').length) {
\t\t\$('#tab-shipping .form-group:first').before(this);
\t}
});

// Add all products to the cart using the api
\$('#button-refresh').on('click', function() {
\t\$.ajax({
\t\turl: '";
        // line 2314
        echo ($context["catalog"] ?? null);
        echo "index.php?route=api/cart/products&api_token=";
        echo ($context["api_token"] ?? null);
        echo "&store_id=' + \$('select[name=\\'store_id\\'] option:selected').val(),
\t\tdataType: 'json',
\t\tcrossDomain: true,
\t\tbeforeSend: function() {
\t\t\t\$('#button-refresh').button('loading');
\t\t},
\t\tcomplete: function() {
\t\t\t\$('#button-refresh').button('reset');
\t\t},\t\t
\t\tsuccess: function(json) {
\t\t\t\$('.alert-dismissible').remove();

\t\t\t// Check for errors
\t\t\tif (json['error']) {
\t\t\t\tif (json['error']['warning']) {
\t\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error']['warning'] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');
\t\t\t\t}

\t\t\t\tif (json['error']['stock']) {
\t\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error']['stock'] + '</div>');
\t\t\t\t}

\t\t\t\tif (json['error']['minimum']) {
\t\t\t\t\tfor (i in json['error']['minimum']) {
\t\t\t\t\t\t\$('#content > .container-fluid').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ' + json['error']['minimum'][i] + ' <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>');
\t\t\t\t\t}
\t\t\t\t}
\t\t\t}

\t\t\tvar shipping = false;

\t\t\thtml = '';

\t\t\tif (json['products'].length) {
\t\t\t\tfor (i = 0; i < json['products'].length; i++) {
\t\t\t\t\tproduct = json['products'][i];

\t\t\t\t\thtml += '<tr>';
\t\t\t\t\thtml += '  <td class=\"text-left\">' + product['name'] + ' ' + (!product['stock'] ? '<span class=\"text-danger\">***</span>' : '') + '<br />';
\t\t\t\t\thtml += '  <input type=\"hidden\" name=\"product[' + i + '][product_id]\" value=\"' + product['product_id'] + '\" />';

\t\t\t\t\tif (product['option']) {
\t\t\t\t\t\tfor (j = 0; j < product['option'].length; j++) {
\t\t\t\t\t\t\toption = product['option'][j];

\t\t\t\t\t\t\thtml += '  - <small>' + option['name'] + ': ' + option['value'] + '</small><br />';

\t\t\t\t\t\t\tif (option['type'] == 'select' || option['type'] == 'radio' || option['type'] == 'image') {
\t\t\t\t\t\t\t\thtml += '<input type=\"hidden\" name=\"product[' + i + '][option][' + option['product_option_id'] + ']\" value=\"' + option['product_option_value_id'] + '\" />';
\t\t\t\t\t\t\t}

\t\t\t\t\t\t\tif (option['type'] == 'checkbox') {
\t\t\t\t\t\t\t\thtml += '<input type=\"hidden\" name=\"product[' + i + '][option][' + option['product_option_id'] + '][]\" value=\"' + option['product_option_value_id'] + '\" />';
\t\t\t\t\t\t\t}

\t\t\t\t\t\t\tif (option['type'] == 'text' || option['type'] == 'textarea' || option['type'] == 'file' || option['type'] == 'date' || option['type'] == 'datetime' || option['type'] == 'time') {
\t\t\t\t\t\t\t\thtml += '<input type=\"hidden\" name=\"product[' + i + '][option][' + option['product_option_id'] + ']\" value=\"' + option['value'] + '\" />';
\t\t\t\t\t\t\t}
\t\t\t\t\t\t}
\t\t\t\t\t}

\t\t\t\t\thtml += '</td>';
\t\t\t\t\thtml += '  <td class=\"text-left\">' + product['model'] + '</td>';
\t\t\t\t\thtml += '  <td class=\"text-right\"><div class=\"input-group btn-block\" style=\"max-width: 200px;\"><input type=\"text\" name=\"product[' + i + '][quantity]\" value=\"' + product['quantity'] + '\" class=\"form-control\" /><span class=\"input-group-btn\"><button type=\"button\" data-toggle=\"tooltip\" title=\"";
        // line 2377
        echo ($context["button_refresh"] ?? null);
        echo "\" data-loading-text=\"";
        echo ($context["text_loading"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-refresh\"></i></button></span></div></td>';
                    html += '  <td class=\"text-right\">' + product['price'] + '</td>';
\t\t\t\t\thtml += '  <td class=\"text-right\">' + product['total'] + '</td>';
\t\t\t\t\thtml += '  <td class=\"text-center\" style=\"width: 3px;\"><button type=\"button\" value=\"' + product['cart_id'] + '\" data-toggle=\"tooltip\" title=\"";
        // line 2380
        echo ($context["button_remove"] ?? null);
        echo "\" data-loading-text=\"";
        echo ($context["text_loading"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>';
\t\t\t\t\thtml += '</tr>';

\t\t\t\t\tif (product['shipping'] != 0) {
\t\t\t\t\t\tshipping = true;
\t\t\t\t\t}
\t\t\t\t}
\t\t\t}

\t\t\tif (!shipping) {
\t\t\t\t\$('select[name=\\'shipping_method\\'] option').removeAttr('selected');
\t\t\t\t\$('select[name=\\'shipping_method\\']').prop('disabled', true);
\t\t\t\t\$('#button-shipping-method').prop('disabled', true);
\t\t\t} else {
\t\t\t\t\$('select[name=\\'shipping_method\\']').prop('disabled', false);
\t\t\t\t\$('#button-shipping-method').prop('disabled', false);
\t\t\t}

\t\t\tif (json['vouchers'].length) {
\t\t\t\tfor (i in json['vouchers']) {
\t\t\t\t\tvoucher = json['vouchers'][i];

\t\t\t\t\thtml += '<tr>';
\t\t\t\t\thtml += '  <td class=\"text-left\">' + voucher['description'];
                    html += '    <input type=\"hidden\" name=\"voucher[' + i + '][code]\" value=\"' + voucher['code'] + '\" />';
\t\t\t\t\thtml += '    <input type=\"hidden\" name=\"voucher[' + i + '][description]\" value=\"' + voucher['description'] + '\" />';
                    html += '    <input type=\"hidden\" name=\"voucher[' + i + '][from_name]\" value=\"' + voucher['from_name'] + '\" />';
                    html += '    <input type=\"hidden\" name=\"voucher[' + i + '][from_email]\" value=\"' + voucher['from_email'] + '\" />';
                    html += '    <input type=\"hidden\" name=\"voucher[' + i + '][to_name]\" value=\"' + voucher['to_name'] + '\" />';
                    html += '    <input type=\"hidden\" name=\"voucher[' + i + '][to_email]\" value=\"' + voucher['to_email'] + '\" />';
                    html += '    <input type=\"hidden\" name=\"voucher[' + i + '][voucher_theme_id]\" value=\"' + voucher['voucher_theme_id'] + '\" />';
                    html += '    <input type=\"hidden\" name=\"voucher[' + i + '][message]\" value=\"' + voucher['message'] + '\" />';
                    html += '    <input type=\"hidden\" name=\"voucher[' + i + '][amount]\" value=\"' + voucher['amount'] + '\" />';
\t\t\t\t\thtml += '  </td>';
\t\t\t\t\thtml += '  <td class=\"text-left\"></td>';
\t\t\t\t\thtml += '  <td class=\"text-right\">1</td>';
\t\t\t\t\thtml += '  <td class=\"text-right\">' + voucher['price'] + '</td>';
\t\t\t\t\thtml += '  <td class=\"text-right\">' + voucher['price'] + '</td>';
\t\t\t\t\thtml += '  <td class=\"text-center\" style=\"width: 3px;\"><button type=\"button\" value=\"' + voucher['code'] + '\" data-toggle=\"tooltip\" title=\"";
        // line 2418
        echo ($context["button_remove"] ?? null);
        echo "\" data-loading-text=\"";
        echo ($context["text_loading"] ?? null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>';
\t\t\t\t\thtml += '</tr>';
\t\t\t\t}
\t\t\t}

\t\t\tif (!json['products'].length && !json['vouchers'].length) {
\t\t\t\thtml += '<tr>';
\t\t\t\thtml += '  <td colspan=\"6\" class=\"text-center\">";
        // line 2425
        echo ($context["text_no_results"] ?? null);
        echo "</td>';
\t\t\t\thtml += '</tr>';
\t\t\t}

\t\t\t\$('#cart').html(html);

\t\t\t// Totals
\t\t\thtml = '';

\t\t\tif (json['products'].length) {
\t\t\t\tfor (i = 0; i < json['products'].length; i++) {
\t\t\t\t\tproduct = json['products'][i];

\t\t\t\t\thtml += '<tr>';
\t\t\t\t\thtml += '  <td class=\"text-left\">' + product['name'] + ' ' + (!product['stock'] ? '<span class=\"text-danger\">***</span>' : '') + '<br />';

\t\t\t\t\tif (product['option']) {
\t\t\t\t\t\tfor (j = 0; j < product['option'].length; j++) {
\t\t\t\t\t\t\toption = product['option'][j];

\t\t\t\t\t\t\thtml += '  - <small>' + option['name'] + ': ' + option['value'] + '</small><br />';
\t\t\t\t\t\t}
\t\t\t\t\t}

\t\t\t\t\thtml += '  </td>';
\t\t\t\t\thtml += '  <td class=\"text-left\">' + product['model'] + '</td>';
\t\t\t\t\thtml += '  <td class=\"text-right\">' + product['quantity'] + '</td>';
\t\t\t\t\thtml += '  <td class=\"text-right\">' + product['price'] + '</td>';
\t\t\t\t\thtml += '  <td class=\"text-right\">' + product['total'] + '</td>';
\t\t\t\t\thtml += '</tr>';
\t\t\t\t}
\t\t\t}

\t\t\tif (json['vouchers'].length) {
\t\t\t\tfor (i in json['vouchers']) {
\t\t\t\t\tvoucher = json['vouchers'][i];

\t\t\t\t\thtml += '<tr>';
\t\t\t\t\thtml += '  <td class=\"text-left\">' + voucher['description'] + '</td>';
\t\t\t\t\thtml += '  <td class=\"text-left\"></td>';
\t\t\t\t\thtml += '  <td class=\"text-right\">1</td>';
\t\t\t\t\thtml += '  <td class=\"text-right\">' + voucher['amount'] + '</td>';
\t\t\t\t\thtml += '  <td class=\"text-right\">' + voucher['amount'] + '</td>';
\t\t\t\t\thtml += '</tr>';
\t\t\t\t}
\t\t\t}

\t\t\tif (json['totals'].length) {
\t\t\t\tfor (i in json['totals']) {
\t\t\t\t\ttotal = json['totals'][i];

\t\t\t\t\thtml += '<tr>';
\t\t\t\t\thtml += '  <td class=\"text-right\" colspan=\"4\">' + total['title'] + ':</td>';
\t\t\t\t\thtml += '  <td class=\"text-right\">' + total['text'] + '</td>';
\t\t\t\t\thtml += '</tr>';
\t\t\t\t}
\t\t\t}

\t\t\tif (!json['totals'].length && !json['products'].length && !json['vouchers'].length) {
\t\t\t\thtml += '<tr>';
\t\t\t\thtml += '  <td colspan=\"5\" class=\"text-center\">";
        // line 2485
        echo ($context["text_no_results"] ?? null);
        echo "</td>';
\t\t\t\thtml += '</tr>';
\t\t\t}

\t\t\t\$('#total').html(html);
\t\t},
\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t}
\t});
});
//--></script></div>
";
        // line 2497
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "sale/order_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  4412 => 2497,  4397 => 2485,  4334 => 2425,  4322 => 2418,  4279 => 2380,  4271 => 2377,  4203 => 2314,  4148 => 2262,  4139 => 2256,  4131 => 2251,  4091 => 2214,  4032 => 2160,  4025 => 2158,  4001 => 2137,  3993 => 2132,  3949 => 2093,  3906 => 2055,  3863 => 2017,  3820 => 1979,  3777 => 1941,  3729 => 1896,  3711 => 1883,  3670 => 1847,  3652 => 1832,  3636 => 1819,  3618 => 1804,  3611 => 1800,  3560 => 1752,  3517 => 1712,  3499 => 1699,  3458 => 1663,  3440 => 1648,  3424 => 1635,  3406 => 1620,  3399 => 1616,  3348 => 1568,  3305 => 1530,  3267 => 1497,  3248 => 1481,  3205 => 1443,  3148 => 1391,  3134 => 1380,  3125 => 1374,  3117 => 1369,  3079 => 1336,  3039 => 1299,  2986 => 1249,  2959 => 1225,  2946 => 1215,  2922 => 1194,  2876 => 1153,  2845 => 1127,  2805 => 1092,  2776 => 1066,  2759 => 1052,  2699 => 995,  2695 => 994,  2687 => 989,  2648 => 955,  2627 => 937,  2621 => 936,  2615 => 933,  2606 => 927,  2602 => 926,  2597 => 924,  2590 => 920,  2585 => 918,  2578 => 914,  2575 => 913,  2569 => 912,  2561 => 910,  2553 => 908,  2550 => 907,  2546 => 906,  2540 => 903,  2530 => 898,  2523 => 896,  2517 => 893,  2507 => 888,  2500 => 886,  2494 => 883,  2484 => 878,  2479 => 876,  2473 => 873,  2463 => 868,  2459 => 866,  2451 => 864,  2449 => 863,  2445 => 862,  2438 => 858,  2428 => 853,  2424 => 851,  2416 => 849,  2414 => 848,  2410 => 847,  2403 => 843,  2398 => 841,  2389 => 835,  2381 => 830,  2377 => 829,  2373 => 828,  2369 => 827,  2365 => 826,  2351 => 817,  2345 => 814,  2341 => 812,  2335 => 811,  2332 => 810,  2316 => 803,  2308 => 800,  2301 => 799,  2298 => 798,  2282 => 791,  2274 => 788,  2267 => 787,  2264 => 786,  2248 => 779,  2240 => 776,  2233 => 775,  2230 => 774,  2223 => 770,  2215 => 769,  2207 => 768,  2202 => 766,  2195 => 765,  2192 => 764,  2179 => 760,  2172 => 758,  2165 => 757,  2162 => 756,  2149 => 752,  2142 => 750,  2135 => 749,  2132 => 748,  2126 => 744,  2119 => 742,  2114 => 740,  2108 => 739,  2105 => 738,  2100 => 736,  2094 => 735,  2091 => 734,  2089 => 733,  2086 => 732,  2082 => 731,  2078 => 730,  2073 => 728,  2066 => 727,  2063 => 726,  2057 => 722,  2050 => 720,  2045 => 718,  2039 => 717,  2036 => 716,  2031 => 714,  2025 => 713,  2022 => 712,  2020 => 711,  2017 => 710,  2013 => 709,  2009 => 708,  2004 => 706,  1997 => 705,  1994 => 704,  1988 => 700,  1982 => 699,  1974 => 697,  1966 => 695,  1963 => 694,  1959 => 693,  1955 => 692,  1949 => 691,  1942 => 689,  1935 => 688,  1932 => 687,  1929 => 686,  1925 => 685,  1916 => 679,  1910 => 675,  1904 => 674,  1896 => 672,  1888 => 670,  1885 => 669,  1881 => 668,  1877 => 667,  1871 => 664,  1864 => 660,  1859 => 658,  1852 => 654,  1847 => 652,  1840 => 648,  1835 => 646,  1828 => 642,  1823 => 640,  1816 => 636,  1811 => 634,  1804 => 630,  1799 => 628,  1792 => 624,  1787 => 622,  1781 => 618,  1762 => 616,  1758 => 615,  1754 => 614,  1748 => 611,  1737 => 605,  1731 => 602,  1727 => 600,  1721 => 599,  1718 => 598,  1702 => 591,  1694 => 588,  1687 => 587,  1684 => 586,  1668 => 579,  1660 => 576,  1653 => 575,  1650 => 574,  1634 => 567,  1626 => 564,  1619 => 563,  1616 => 562,  1609 => 558,  1601 => 557,  1593 => 556,  1588 => 554,  1581 => 553,  1578 => 552,  1565 => 548,  1558 => 546,  1551 => 545,  1548 => 544,  1535 => 540,  1528 => 538,  1521 => 537,  1518 => 536,  1512 => 532,  1505 => 530,  1500 => 528,  1494 => 527,  1491 => 526,  1486 => 524,  1480 => 523,  1477 => 522,  1475 => 521,  1472 => 520,  1468 => 519,  1464 => 518,  1459 => 516,  1452 => 515,  1449 => 514,  1443 => 510,  1436 => 508,  1431 => 506,  1425 => 505,  1422 => 504,  1417 => 502,  1411 => 501,  1408 => 500,  1406 => 499,  1403 => 498,  1399 => 497,  1395 => 496,  1390 => 494,  1383 => 493,  1380 => 492,  1374 => 488,  1368 => 487,  1360 => 485,  1352 => 483,  1349 => 482,  1345 => 481,  1341 => 480,  1335 => 479,  1328 => 477,  1321 => 476,  1318 => 475,  1315 => 474,  1311 => 473,  1302 => 467,  1296 => 463,  1290 => 462,  1282 => 460,  1274 => 458,  1271 => 457,  1267 => 456,  1263 => 455,  1257 => 452,  1250 => 448,  1245 => 446,  1238 => 442,  1233 => 440,  1226 => 436,  1221 => 434,  1214 => 430,  1209 => 428,  1202 => 424,  1197 => 422,  1190 => 418,  1185 => 416,  1178 => 412,  1173 => 410,  1167 => 406,  1148 => 404,  1144 => 403,  1140 => 402,  1134 => 399,  1125 => 393,  1119 => 390,  1107 => 383,  1099 => 378,  1094 => 376,  1085 => 370,  1079 => 366,  1068 => 364,  1064 => 363,  1058 => 360,  1049 => 354,  1040 => 348,  1031 => 342,  1022 => 336,  1017 => 334,  1007 => 329,  996 => 321,  986 => 314,  981 => 312,  973 => 307,  969 => 306,  964 => 303,  957 => 299,  954 => 298,  951 => 297,  945 => 296,  943 => 295,  931 => 288,  925 => 287,  919 => 286,  913 => 285,  907 => 284,  901 => 283,  895 => 282,  889 => 281,  883 => 280,  877 => 279,  873 => 278,  870 => 277,  865 => 276,  862 => 275,  856 => 274,  854 => 273,  844 => 268,  840 => 267,  836 => 266,  828 => 265,  818 => 263,  815 => 262,  805 => 260,  802 => 259,  792 => 257,  790 => 256,  783 => 255,  779 => 254,  773 => 253,  769 => 252,  766 => 251,  761 => 250,  758 => 249,  756 => 248,  749 => 244,  745 => 243,  741 => 242,  737 => 241,  733 => 240,  729 => 239,  716 => 231,  713 => 230,  707 => 229,  704 => 228,  688 => 221,  680 => 218,  673 => 217,  670 => 216,  654 => 209,  646 => 206,  639 => 205,  636 => 204,  620 => 197,  612 => 194,  605 => 193,  602 => 192,  595 => 188,  587 => 187,  581 => 186,  576 => 184,  569 => 183,  566 => 182,  553 => 178,  546 => 176,  539 => 175,  536 => 174,  523 => 170,  516 => 168,  509 => 167,  506 => 166,  500 => 162,  493 => 160,  488 => 158,  482 => 157,  479 => 156,  474 => 154,  468 => 153,  465 => 152,  463 => 151,  460 => 150,  456 => 149,  452 => 148,  447 => 146,  440 => 145,  437 => 144,  431 => 140,  424 => 138,  419 => 136,  413 => 135,  410 => 134,  405 => 132,  399 => 131,  396 => 130,  394 => 129,  391 => 128,  387 => 127,  383 => 126,  378 => 124,  371 => 123,  368 => 122,  362 => 118,  356 => 117,  348 => 115,  340 => 113,  337 => 112,  333 => 111,  329 => 110,  323 => 109,  316 => 107,  309 => 106,  306 => 105,  303 => 104,  299 => 103,  293 => 100,  288 => 98,  281 => 94,  276 => 92,  269 => 88,  264 => 86,  257 => 82,  252 => 80,  246 => 76,  240 => 75,  232 => 73,  224 => 71,  221 => 70,  217 => 69,  211 => 66,  204 => 62,  198 => 61,  193 => 59,  187 => 55,  181 => 54,  173 => 52,  165 => 50,  162 => 49,  158 => 48,  152 => 45,  146 => 41,  140 => 40,  132 => 38,  124 => 36,  121 => 35,  117 => 34,  111 => 31,  103 => 26,  99 => 25,  95 => 24,  91 => 23,  87 => 22,  79 => 17,  71 => 11,  60 => 9,  56 => 8,  51 => 6,  45 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "sale/order_form.twig", "");
    }
}
