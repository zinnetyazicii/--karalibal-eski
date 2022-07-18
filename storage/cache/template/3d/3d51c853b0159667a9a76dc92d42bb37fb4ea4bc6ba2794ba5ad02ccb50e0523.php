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

/* journal3/template/information/contact.twig */
class __TwigTemplate_ca54d38426cdf86781a20e6e00773c1eeb889b499007d8a03ae2975d7bb8f1c6 extends \Twig\Template
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
<div id=\"information-contact\" class=\"container\">
  <div class=\"row\">";
        // line 12
        echo ($context["column_left"] ?? null);
        echo "
    ";
        // line 13
        if ((($context["column_left"] ?? null) && ($context["column_right"] ?? null))) {
            // line 14
            echo "    ";
            $context["class"] = "col-sm-6";
            // line 15
            echo "    ";
        } elseif ((($context["column_left"] ?? null) || ($context["column_right"] ?? null))) {
            // line 16
            echo "    ";
            $context["class"] = "col-sm-9";
            // line 17
            echo "    ";
        } else {
            // line 18
            echo "    ";
            $context["class"] = "col-sm-12";
            // line 19
            echo "    ";
        }
        // line 20
        echo "    <div id=\"content\" class=\"";
        echo ($context["class"] ?? null);
        echo "\">
      ";
        // line 21
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 21), "get", [0 => "pageTitlePosition"], "method", false, false, false, 21) == "default")) {
            // line 22
            echo "        <h1 class=\"title page-title\">";
            echo ($context["heading_title"] ?? null);
            echo "</h1>
      ";
        }
        // line 24
        echo "      ";
        echo ($context["content_top"] ?? null);
        echo "
      <h2 class=\"title location-title\">";
        // line 25
        echo ($context["text_location"] ?? null);
        echo "</h2>
      <div class=\"panel panel-default our-location\">
        <div class=\"panel-body\">
          <div class=\"row store-data\">
            ";
        // line 29
        if (($context["image"] ?? null)) {
            // line 30
            echo "            <div class=\"col-sm-3 store-image\"><img src=\"";
            echo ($context["image"] ?? null);
            echo "\" alt=\"";
            echo ($context["store"] ?? null);
            echo "\" title=\"";
            echo ($context["store"] ?? null);
            echo "\" class=\"img-thumbnail\" /></div>
            ";
        }
        // line 32
        echo "            <div class=\"col-sm-3 store-address\"><strong>";
        echo ($context["store"] ?? null);
        echo "</strong><br />
              <address>
              ";
        // line 34
        echo ($context["address"] ?? null);
        echo "
              </address>
              ";
        // line 36
        if (($context["geocode"] ?? null)) {
            // line 37
            echo "              <a href=\"https://maps.google.com/maps?q=";
            echo twig_urlencode_filter(($context["geocode"] ?? null));
            echo "&hl=";
            echo ($context["geocode_hl"] ?? null);
            echo "&t=m&z=15\" target=\"_blank\" class=\"btn btn-info\"><i class=\"fa fa-map-marker\"></i> ";
            echo ($context["button_map"] ?? null);
            echo "</a>
              ";
        }
        // line 39
        echo "            </div>
            <div class=\"col-sm-3 store-tel\"><strong>";
        // line 40
        echo ($context["text_telephone"] ?? null);
        echo "</strong><br>
              ";
        // line 41
        echo ($context["telephone"] ?? null);
        echo "<br />
              <br />
              ";
        // line 43
        if (($context["fax"] ?? null)) {
            // line 44
            echo "                <div class=\"store-fax\">
                  <strong>";
            // line 45
            echo ($context["text_fax"] ?? null);
            echo "</strong><br>
                  ";
            // line 46
            echo ($context["fax"] ?? null);
            echo "
                </div>
              ";
        }
        // line 49
        echo "            </div>
            <div class=\"col-sm-3 store-info\">
              ";
        // line 51
        if (($context["open"] ?? null)) {
            // line 52
            echo "                <div class=\"store-hours\">
                  <strong>";
            // line 53
            echo ($context["text_open"] ?? null);
            echo "</strong><br />
                  ";
            // line 54
            echo ($context["open"] ?? null);
            echo "<br />
                </div>
              <br />
              ";
        }
        // line 58
        echo "              ";
        if (($context["comment"] ?? null)) {
            // line 59
            echo "                <div class=\"store-comment\">
                  <strong>";
            // line 60
            echo ($context["text_comment"] ?? null);
            echo "</strong><br />
                  ";
            // line 61
            echo ($context["comment"] ?? null);
            echo "
                </div>
              ";
        }
        // line 64
        echo "            </div>
          </div>
        </div>
      </div>
      ";
        // line 68
        if (($context["locations"] ?? null)) {
            // line 69
            echo "      <h2 class=\"title stores-title\">";
            echo ($context["text_store"] ?? null);
            echo "</h2>
      <div class=\"panel-group other-stores\" id=\"accordion\">
        ";
            // line 71
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["locations"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["location"]) {
                // line 72
                echo "        <div class=\"panel panel-default\">
          <div class=\"panel-heading\">
            <h4 class=\"panel-title\"><a href=\"#collapse-location";
                // line 74
                echo twig_get_attribute($this->env, $this->source, $context["location"], "location_id", [], "any", false, false, false, 74);
                echo "\" class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\">";
                echo twig_get_attribute($this->env, $this->source, $context["location"], "name", [], "any", false, false, false, 74);
                echo " <i class=\"fa fa-caret-down\"></i></a></h4>
          </div>
          <div class=\"panel-collapse collapse\" id=\"collapse-location";
                // line 76
                echo twig_get_attribute($this->env, $this->source, $context["location"], "location_id", [], "any", false, false, false, 76);
                echo "\">
            <div class=\"panel-body\">
              <div class=\"row store-data\">
                ";
                // line 79
                if (twig_get_attribute($this->env, $this->source, $context["location"], "image", [], "any", false, false, false, 79)) {
                    // line 80
                    echo "                <div class=\"col-sm-3 store-image\"><img src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["location"], "image", [], "any", false, false, false, 80);
                    echo "\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["location"], "name", [], "any", false, false, false, 80);
                    echo "\" title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["location"], "name", [], "any", false, false, false, 80);
                    echo "\" class=\"img-thumbnail\" /></div>
                ";
                }
                // line 82
                echo "                <div class=\"col-sm-3 store-address\"><strong>";
                echo twig_get_attribute($this->env, $this->source, $context["location"], "name", [], "any", false, false, false, 82);
                echo "</strong><br />
                  <address>
                  ";
                // line 84
                echo twig_get_attribute($this->env, $this->source, $context["location"], "address", [], "any", false, false, false, 84);
                echo "
                  </address>
                  ";
                // line 86
                if (twig_get_attribute($this->env, $this->source, $context["location"], "geocode", [], "any", false, false, false, 86)) {
                    // line 87
                    echo "                  <a href=\"https://maps.google.com/maps?q=";
                    echo twig_urlencode_filter(twig_get_attribute($this->env, $this->source, $context["location"], "geocode", [], "any", false, false, false, 87));
                    echo "&hl=";
                    echo ($context["geocode_hl"] ?? null);
                    echo "&t=m&z=15\" target=\"_blank\" class=\"btn btn-info\"><i class=\"fa fa-map-marker\"></i> ";
                    echo ($context["button_map"] ?? null);
                    echo "</a>
                  ";
                }
                // line 89
                echo "                </div>
                <div class=\"col-sm-3 store-tel\"> <strong>";
                // line 90
                echo ($context["text_telephone"] ?? null);
                echo "</strong><br>
                  ";
                // line 91
                echo twig_get_attribute($this->env, $this->source, $context["location"], "telephone", [], "any", false, false, false, 91);
                echo "<br />
                  <br />
                  <div class=\"store-fax\">
                  ";
                // line 94
                if (twig_get_attribute($this->env, $this->source, $context["location"], "fax", [], "any", false, false, false, 94)) {
                    // line 95
                    echo "                  <strong>";
                    echo ($context["text_fax"] ?? null);
                    echo "</strong><br>
                  ";
                    // line 96
                    echo twig_get_attribute($this->env, $this->source, $context["location"], "fax", [], "any", false, false, false, 96);
                    echo "
                  ";
                }
                // line 98
                echo "                  </div>
                </div>
                <div class=\"col-sm-3 store-info\">
                  ";
                // line 101
                if (twig_get_attribute($this->env, $this->source, $context["location"], "open", [], "any", false, false, false, 101)) {
                    // line 102
                    echo "                  <div class=\"store-hours\">
                  <strong>";
                    // line 103
                    echo ($context["text_open"] ?? null);
                    echo "</strong><br />
                  ";
                    // line 104
                    echo twig_get_attribute($this->env, $this->source, $context["location"], "open", [], "any", false, false, false, 104);
                    echo "<br />
                  </div>
                  <br />
                  ";
                }
                // line 108
                echo "                  <div class=\"store-comment\">
                  ";
                // line 109
                if (twig_get_attribute($this->env, $this->source, $context["location"], "comment", [], "any", false, false, false, 109)) {
                    // line 110
                    echo "                  <strong>";
                    echo ($context["text_comment"] ?? null);
                    echo "</strong><br />
                  ";
                    // line 111
                    echo twig_get_attribute($this->env, $this->source, $context["location"], "comment", [], "any", false, false, false, 111);
                    echo "
                  ";
                }
                // line 113
                echo "                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['location'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 120
            echo "      </div>
      ";
        }
        // line 122
        echo "      ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 122), "get", [0 => "contactFormStatus"], "method", false, false, false, 122)) {
            // line 123
            echo "      <form action=\"";
            echo ($context["action"] ?? null);
            echo "\" method=\"post\" enctype=\"multipart/form-data\" class=\"form-horizontal\">
        <fieldset>
          <legend>";
            // line 125
            echo ($context["text_contact"] ?? null);
            echo "</legend>
          <div class=\"form-group required\">
            <label class=\"col-sm-2 control-label\" for=\"input-name\">";
            // line 127
            echo ($context["entry_name"] ?? null);
            echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"name\" value=\"";
            // line 129
            echo ($context["name"] ?? null);
            echo "\" id=\"input-name\" class=\"form-control\" />
              ";
            // line 130
            if (($context["error_name"] ?? null)) {
                // line 131
                echo "              <div class=\"text-danger\">";
                echo ($context["error_name"] ?? null);
                echo "</div>
              ";
            }
            // line 133
            echo "            </div>
          </div>
          <div class=\"form-group required\">
            <label class=\"col-sm-2 control-label\" for=\"input-email\">";
            // line 136
            echo ($context["entry_email"] ?? null);
            echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"email\" value=\"";
            // line 138
            echo ($context["email"] ?? null);
            echo "\" id=\"input-email\" class=\"form-control\" />
              ";
            // line 139
            if (($context["error_email"] ?? null)) {
                // line 140
                echo "              <div class=\"text-danger\">";
                echo ($context["error_email"] ?? null);
                echo "</div>
              ";
            }
            // line 142
            echo "            </div>
          </div>
          <div class=\"form-group required\">
            <label class=\"col-sm-2 control-label\" for=\"input-enquiry\">";
            // line 145
            echo ($context["entry_enquiry"] ?? null);
            echo "</label>
            <div class=\"col-sm-10\">
              <textarea name=\"enquiry\" rows=\"10\" id=\"input-enquiry\" class=\"form-control\">";
            // line 147
            echo ($context["enquiry"] ?? null);
            echo "</textarea>
              ";
            // line 148
            if (($context["error_enquiry"] ?? null)) {
                // line 149
                echo "              <div class=\"text-danger\">";
                echo ($context["error_enquiry"] ?? null);
                echo "</div>
              ";
            }
            // line 151
            echo "            </div>
          </div>
          ";
            // line 153
            echo ($context["captcha"] ?? null);
            echo "
        </fieldset>
        <div class=\"buttons\">
          <div class=\"pull-right\">
            <button class=\"btn btn-primary\" type=\"submit\"><span>";
            // line 157
            echo ($context["button_submit"] ?? null);
            echo "</span></button>
          </div>
        </div>
      </form>
      ";
        }
        // line 162
        echo "      ";
        echo ($context["content_bottom"] ?? null);
        echo "</div>
    ";
        // line 163
        echo ($context["column_right"] ?? null);
        echo "</div>
</div>
";
        // line 165
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "journal3/template/information/contact.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  471 => 165,  466 => 163,  461 => 162,  453 => 157,  446 => 153,  442 => 151,  436 => 149,  434 => 148,  430 => 147,  425 => 145,  420 => 142,  414 => 140,  412 => 139,  408 => 138,  403 => 136,  398 => 133,  392 => 131,  390 => 130,  386 => 129,  381 => 127,  376 => 125,  370 => 123,  367 => 122,  363 => 120,  351 => 113,  346 => 111,  341 => 110,  339 => 109,  336 => 108,  329 => 104,  325 => 103,  322 => 102,  320 => 101,  315 => 98,  310 => 96,  305 => 95,  303 => 94,  297 => 91,  293 => 90,  290 => 89,  280 => 87,  278 => 86,  273 => 84,  267 => 82,  257 => 80,  255 => 79,  249 => 76,  242 => 74,  238 => 72,  234 => 71,  228 => 69,  226 => 68,  220 => 64,  214 => 61,  210 => 60,  207 => 59,  204 => 58,  197 => 54,  193 => 53,  190 => 52,  188 => 51,  184 => 49,  178 => 46,  174 => 45,  171 => 44,  169 => 43,  164 => 41,  160 => 40,  157 => 39,  147 => 37,  145 => 36,  140 => 34,  134 => 32,  124 => 30,  122 => 29,  115 => 25,  110 => 24,  104 => 22,  102 => 21,  97 => 20,  94 => 19,  91 => 18,  88 => 17,  85 => 16,  82 => 15,  79 => 14,  77 => 13,  73 => 12,  68 => 10,  62 => 8,  60 => 7,  57 => 6,  46 => 4,  42 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/information/contact.twig", "");
    }
}
