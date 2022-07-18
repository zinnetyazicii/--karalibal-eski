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

/* journal3/template/journal3/module/form.twig */
class __TwigTemplate_fddbccd49856679224b2dd7883f7d75d166cadbf4e857637507b848b17ab737e extends \Twig\Template
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
        $context["id"] = twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "uniqueId", [0 => "field-"], "method", false, false, false, 1);
        // line 2
        echo "<div class=\"";
        echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => ($context["classes"] ?? null)], "method", false, false, false, 2);
        echo "\">
  ";
        // line 3
        if (($context["title"] ?? null)) {
            // line 4
            echo "    <h3 class=\"title module-title\">";
            echo ($context["title"] ?? null);
            echo "</h3>
  ";
        }
        // line 6
        echo "  <div class=\"module-body\">
    <form action=\"";
        // line 7
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" class=\"form-horizontal\" data-language=\"";
        echo ($context["datepicker"] ?? null);
        echo "\">
      <fieldset>
        ";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
        foreach ($context['_seq'] as $context["index"] => $context["item"]) {
            // line 10
            echo "          ";
            if ((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 10) == "legend")) {
                // line 11
                echo "            <legend>";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 11);
                echo "</legend>
          ";
            }
            // line 13
            echo "
          ";
            // line 14
            if ((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 14) == "select")) {
                // line 15
                echo "            <div class=\"form-group custom-field ";
                if (twig_get_attribute($this->env, $this->source, $context["item"], "required", [], "any", false, false, false, 15)) {
                    echo "required";
                }
                echo "\">
              <label class=\"col-sm-2 control-label\" for=\"";
                // line 16
                echo ($context["id"] ?? null);
                echo "-";
                echo $context["index"];
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 16);
                echo "</label>
              <div class=\"col-sm-10\">
                <select name=\"item[";
                // line 18
                echo $context["index"];
                echo "]\" id=\"";
                echo ($context["id"] ?? null);
                echo "-";
                echo $context["index"];
                echo "\" class=\"form-control\">
                  <option value=\"\">";
                // line 19
                echo twig_get_attribute($this->env, $this->source, $context["item"], "placeholder", [], "any", false, false, false, 19);
                echo "</option>
                  ";
                // line 20
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 20));
                foreach ($context['_seq'] as $context["_key"] => $context["subitem"]) {
                    // line 21
                    echo "                    <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["subitem"], "label", [], "any", false, false, false, 21);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["subitem"], "label", [], "any", false, false, false, 21);
                    echo "</option>
                  ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subitem'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 23
                echo "                </select>
              </div>
            </div>
          ";
            }
            // line 27
            echo "
          ";
            // line 28
            if ((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 28) == "radio")) {
                // line 29
                echo "            <div class=\"form-group custom-field ";
                if (twig_get_attribute($this->env, $this->source, $context["item"], "required", [], "any", false, false, false, 29)) {
                    echo "required";
                }
                echo "\">
              <label class=\"col-sm-2 control-label\">";
                // line 30
                echo twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 30);
                echo "</label>
              <div class=\"col-sm-10\">
                ";
                // line 32
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 32));
                foreach ($context['_seq'] as $context["_key"] => $context["subitem"]) {
                    // line 33
                    echo "                  <div class=\"radio\">
                    <label>
                      <input type=\"radio\" name=\"item[";
                    // line 35
                    echo $context["index"];
                    echo "]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["subitem"], "label", [], "any", false, false, false, 35);
                    echo "\"/>
                      ";
                    // line 36
                    echo twig_get_attribute($this->env, $this->source, $context["subitem"], "label", [], "any", false, false, false, 36);
                    echo "</label>
                  </div>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subitem'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 39
                echo "              </div>
            </div>
          ";
            }
            // line 42
            echo "
          ";
            // line 43
            if ((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 43) == "checkbox")) {
                // line 44
                echo "            <div class=\"form-group custom-field ";
                if (twig_get_attribute($this->env, $this->source, $context["item"], "required", [], "any", false, false, false, 44)) {
                    echo "required";
                }
                echo "\">
              <label class=\"col-sm-2 control-label\">";
                // line 45
                echo twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 45);
                echo "</label>
              <div class=\"col-sm-10\">
                ";
                // line 47
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 47));
                foreach ($context['_seq'] as $context["_key"] => $context["subitem"]) {
                    // line 48
                    echo "                  <div class=\"checkbox\">
                    <label>
                      <input type=\"checkbox\" name=\"item[";
                    // line 50
                    echo $context["index"];
                    echo "][]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["subitem"], "label", [], "any", false, false, false, 50);
                    echo "\"/>
                      ";
                    // line 51
                    echo twig_get_attribute($this->env, $this->source, $context["subitem"], "label", [], "any", false, false, false, 51);
                    echo "</label>
                  </div>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subitem'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 54
                echo "              </div>
            </div>
          ";
            }
            // line 57
            echo "
          ";
            // line 58
            if (((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 58) == "text") || (twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 58) == "name"))) {
                // line 59
                echo "            <div class=\"form-group custom-field ";
                if (twig_get_attribute($this->env, $this->source, $context["item"], "required", [], "any", false, false, false, 59)) {
                    echo "required";
                }
                echo "\">
              <label class=\"col-sm-2 control-label\" for=\"";
                // line 60
                echo ($context["id"] ?? null);
                echo "-";
                echo $context["index"];
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 60);
                echo "</label>
              <div class=\"col-sm-10\">
                <input type=\"text\" name=\"item[";
                // line 62
                echo $context["index"];
                echo "]\" value=\"\" placeholder=\"";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "placeholder", [], "any", false, false, false, 62);
                echo "\" id=\"";
                echo ($context["id"] ?? null);
                echo "-";
                echo $context["index"];
                echo "\" class=\"form-control\"/>
              </div>
            </div>
          ";
            }
            // line 66
            echo "
          ";
            // line 67
            if ((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 67) == "email")) {
                // line 68
                echo "            <div class=\"form-group custom-field ";
                if (twig_get_attribute($this->env, $this->source, $context["item"], "required", [], "any", false, false, false, 68)) {
                    echo "required";
                }
                echo "\">
              <label class=\"col-sm-2 control-label\" for=\"";
                // line 69
                echo ($context["id"] ?? null);
                echo "-";
                echo $context["index"];
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 69);
                echo "</label>
              <div class=\"col-sm-10\">
                <input type=\"email\" name=\"item[";
                // line 71
                echo $context["index"];
                echo "]\" value=\"\" placeholder=\"";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "placeholder", [], "any", false, false, false, 71);
                echo "\" id=\"";
                echo ($context["id"] ?? null);
                echo "-";
                echo $context["index"];
                echo "\" class=\"form-control\"/>
              </div>
            </div>
          ";
            }
            // line 75
            echo "
          ";
            // line 76
            if ((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 76) == "tel")) {
                // line 77
                echo "            <div class=\"form-group custom-field ";
                if (twig_get_attribute($this->env, $this->source, $context["item"], "required", [], "any", false, false, false, 77)) {
                    echo "required";
                }
                echo "\">
              <label class=\"col-sm-2 control-label\" for=\"";
                // line 78
                echo ($context["id"] ?? null);
                echo "-";
                echo $context["index"];
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 78);
                echo "</label>
              <div class=\"col-sm-10\">
                <input type=\"tel\" name=\"item[";
                // line 80
                echo $context["index"];
                echo "]\" value=\"\" placeholder=\"";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "placeholder", [], "any", false, false, false, 80);
                echo "\" id=\"";
                echo ($context["id"] ?? null);
                echo "-";
                echo $context["index"];
                echo "\" class=\"form-control\"/>
              </div>
            </div>
          ";
            }
            // line 84
            echo "
          ";
            // line 85
            if ((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 85) == "textarea")) {
                // line 86
                echo "            <div class=\"form-group custom-field ";
                if (twig_get_attribute($this->env, $this->source, $context["item"], "required", [], "any", false, false, false, 86)) {
                    echo "required";
                }
                echo "\">
              <label class=\"col-sm-2 control-label\" for=\"";
                // line 87
                echo ($context["id"] ?? null);
                echo "-";
                echo $context["index"];
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 87);
                echo "</label>
              <div class=\"col-sm-10\">
                <textarea name=\"item[";
                // line 89
                echo $context["index"];
                echo "]\" rows=\"5\" placeholder=\"";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "placeholder", [], "any", false, false, false, 89);
                echo "\" id=\"";
                echo ($context["id"] ?? null);
                echo "-";
                echo $context["index"];
                echo "\" class=\"form-control\"></textarea>
              </div>
            </div>
          ";
            }
            // line 93
            echo "
          ";
            // line 94
            if ((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 94) == "file")) {
                // line 95
                echo "          <div class=\"form-group custom-field ";
                if (twig_get_attribute($this->env, $this->source, $context["item"], "required", [], "any", false, false, false, 95)) {
                    echo "required";
                }
                echo "\">
            <label class=\"col-sm-2 control-label\" for=\"form-upload-";
                // line 96
                echo ($context["id"] ?? null);
                echo "-";
                echo $context["index"];
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 96);
                echo "</label>
            <div class=\"col-sm-10\">
              <button type=\"button\" id=\"form-upload-";
                // line 98
                echo ($context["id"] ?? null);
                echo "-";
                echo $context["index"];
                echo "\" data-loading-text=\"";
                echo ($context["text_loading"] ?? null);
                echo "\" class=\"btn btn-default upload-btn\"><i class=\"fa fa-upload\"></i> ";
                echo ($context["button_upload"] ?? null);
                echo "</button>
              <input type=\"hidden\" name=\"item[";
                // line 99
                echo $context["index"];
                echo "]\" value=\"\" id=\"";
                echo ($context["id"] ?? null);
                echo "-";
                echo $context["index"];
                echo "\" class=\"form-control\"/>
            </div>
          </div>
          ";
            }
            // line 103
            echo "
          ";
            // line 104
            if ((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 104) == "date")) {
                // line 105
                echo "            <div class=\"form-group custom-field ";
                if (twig_get_attribute($this->env, $this->source, $context["item"], "required", [], "any", false, false, false, 105)) {
                    echo "required";
                }
                echo "\">
              <label class=\"col-sm-2 control-label\" for=\"";
                // line 106
                echo ($context["id"] ?? null);
                echo "-";
                echo $context["index"];
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 106);
                echo "</label>
              <div class=\"col-sm-10\">
                <div class=\"input-group date\" data-picker-class=\"module-form-";
                // line 108
                echo ($context["module_id"] ?? null);
                echo "\">
                  <input type=\"text\" name=\"item[";
                // line 109
                echo $context["index"];
                echo "]\" value=\"\" placeholder=\"";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 109);
                echo "\" data-date-format=\"YYYY-MM-DD\" id=\"";
                echo ($context["id"] ?? null);
                echo "-";
                echo $context["index"];
                echo "\" class=\"form-control\"/>
                  <div class=\"input-group-btn\">
                    <button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button>
                  </div>
                </div>
              </div>
            </div>
          ";
            }
            // line 117
            echo "
          ";
            // line 118
            if ((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 118) == "time")) {
                // line 119
                echo "            <div class=\"form-group custom-field ";
                if (twig_get_attribute($this->env, $this->source, $context["item"], "required", [], "any", false, false, false, 119)) {
                    echo "required";
                }
                echo "\">
              <label class=\"col-sm-2 control-label\" for=\"";
                // line 120
                echo ($context["id"] ?? null);
                echo "-";
                echo $context["index"];
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 120);
                echo "</label>
              <div class=\"col-sm-10\">
                <div class=\"input-group time\" data-picker-class=\"module-form-";
                // line 122
                echo ($context["module_id"] ?? null);
                echo "\">
                  <input type=\"text\" name=\"item[";
                // line 123
                echo $context["index"];
                echo "]\" value=\"\" placeholder=\"";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 123);
                echo "\" data-date-format=\"HH:mm\" id=\"";
                echo ($context["id"] ?? null);
                echo "-";
                echo $context["index"];
                echo "\" class=\"form-control\"/>
                  <div class=\"input-group-btn\">
                    <button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button>
                  </div>
                </div>
              </div>
            </div>
          ";
            }
            // line 131
            echo "
          ";
            // line 132
            if ((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 132) == "datetime")) {
                // line 133
                echo "            <div class=\"form-group custom-field ";
                if (twig_get_attribute($this->env, $this->source, $context["item"], "required", [], "any", false, false, false, 133)) {
                    echo "required";
                }
                echo "\">
              <label class=\"col-sm-2 control-label\" for=\"";
                // line 134
                echo ($context["id"] ?? null);
                echo "-";
                echo $context["index"];
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 134);
                echo "</label>
              <div class=\"col-sm-10\">
                <div class=\"input-group datetime\" data-picker-class=\"module-form-";
                // line 136
                echo ($context["module_id"] ?? null);
                echo "\">
                  <input type=\"text\" name=\"item[";
                // line 137
                echo $context["index"];
                echo "]\" value=\"\" placeholder=\"";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 137);
                echo "\" data-date-format=\"YYYY-MM-DD HH:mm\" id=\"";
                echo ($context["id"] ?? null);
                echo "-";
                echo $context["index"];
                echo "\" class=\"form-control\"/>
                  <div class=\"input-group-btn\">
                    <button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button>
                  </div>
                </div>
              </div>
            </div>
          ";
            }
            // line 145
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['index'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 146
        echo "        ";
        if (($context["captcha"] ?? null)) {
            // line 147
            echo "        <div class=\"form-group captcha\">
          ";
            // line 148
            echo ($context["captcha"] ?? null);
            echo "
        </div>
        ";
        }
        // line 151
        echo "        ";
        if (($context["agree_data"] ?? null)) {
            // line 152
            echo "          <div class=\"checkbox\">
            <label>
              <input type=\"checkbox\" name=\"agree\" value=\"1\"/>
              ";
            // line 155
            echo twig_get_attribute($this->env, $this->source, ($context["agree_data"] ?? null), "text", [], "any", false, false, false, 155);
            echo "
            </label>
          </div>
        ";
        }
        // line 159
        echo "      </fieldset>
      <div class=\"buttons\">
        <div class=\"pull-right\">
          <button type=\"submit\" class=\"btn btn-primary\"  data-loading-text=\"<span>";
        // line 162
        echo ($context["button_submit"] ?? null);
        echo "</span>\"><span>";
        echo ($context["button_submit"] ?? null);
        echo "</span></button>
        </div>
      </div>
    </form>
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/module/form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  561 => 162,  556 => 159,  549 => 155,  544 => 152,  541 => 151,  535 => 148,  532 => 147,  529 => 146,  523 => 145,  506 => 137,  502 => 136,  493 => 134,  486 => 133,  484 => 132,  481 => 131,  464 => 123,  460 => 122,  451 => 120,  444 => 119,  442 => 118,  439 => 117,  422 => 109,  418 => 108,  409 => 106,  402 => 105,  400 => 104,  397 => 103,  386 => 99,  376 => 98,  367 => 96,  360 => 95,  358 => 94,  355 => 93,  342 => 89,  333 => 87,  326 => 86,  324 => 85,  321 => 84,  308 => 80,  299 => 78,  292 => 77,  290 => 76,  287 => 75,  274 => 71,  265 => 69,  258 => 68,  256 => 67,  253 => 66,  240 => 62,  231 => 60,  224 => 59,  222 => 58,  219 => 57,  214 => 54,  205 => 51,  199 => 50,  195 => 48,  191 => 47,  186 => 45,  179 => 44,  177 => 43,  174 => 42,  169 => 39,  160 => 36,  154 => 35,  150 => 33,  146 => 32,  141 => 30,  134 => 29,  132 => 28,  129 => 27,  123 => 23,  112 => 21,  108 => 20,  104 => 19,  96 => 18,  87 => 16,  80 => 15,  78 => 14,  75 => 13,  69 => 11,  66 => 10,  62 => 9,  55 => 7,  52 => 6,  46 => 4,  44 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/module/form.twig", "");
    }
}
