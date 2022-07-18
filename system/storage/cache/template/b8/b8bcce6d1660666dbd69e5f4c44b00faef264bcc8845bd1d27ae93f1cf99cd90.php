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

/* extension/theme/default.twig */
class __TwigTemplate_94fd4f9c62922c321f5a9ab223be993c78c566f8ba5f5baeec8bdc5b1e40ee18 extends \Twig\Template
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
        <button type=\"submit\" form=\"form-theme\" data-toggle=\"tooltip\" title=\"";
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
  <div class=\"container-fluid\">
    ";
        // line 17
        if (($context["error_warning"] ?? null)) {
            // line 18
            echo "    <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 22
        echo "    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i> ";
        // line 24
        echo ($context["text_edit"] ?? null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
        <form action=\"";
        // line 27
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-theme\" class=\"form-horizontal\">
          <fieldset>
            <legend>";
        // line 29
        echo ($context["text_general"] ?? null);
        echo "</legend>
            <div class=\"form-group\">
              <label class=\"col-sm-2 control-label\" for=\"input-directory\"><span data-toggle=\"tooltip\" title=\"";
        // line 31
        echo ($context["help_directory"] ?? null);
        echo "\">";
        echo ($context["entry_directory"] ?? null);
        echo "</span></label>
              <div class=\"col-sm-10\">
                <select name=\"theme_default_directory\" id=\"input-directory\" class=\"form-control\">
                  ";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["directories"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["directory"]) {
            // line 35
            echo "                  ";
            if (($context["directory"] == ($context["theme_default_directory"] ?? null))) {
                // line 36
                echo "                  <option value=\"";
                echo $context["directory"];
                echo "\" selected=\"selected\">";
                echo $context["directory"];
                echo "</option>
                  ";
            } else {
                // line 38
                echo "                  <option value=\"";
                echo $context["directory"];
                echo "\">";
                echo $context["directory"];
                echo "</option>
                  ";
            }
            // line 40
            echo "                  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['directory'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 41
        echo "                </select>
              </div>
            </div>
            <div class=\"form-group\">
              <label class=\"col-sm-2 control-label\" for=\"input-status\">";
        // line 45
        echo ($context["entry_status"] ?? null);
        echo "</label>
              <div class=\"col-sm-10\">
                <select name=\"theme_default_status\" id=\"input-status\" class=\"form-control\">
                  ";
        // line 48
        if (($context["theme_default_status"] ?? null)) {
            // line 49
            echo "                  <option value=\"1\" selected=\"selected\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
                  <option value=\"0\">";
            // line 50
            echo ($context["text_disabled"] ?? null);
            echo "</option>
                  ";
        } else {
            // line 52
            echo "                  <option value=\"1\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
                  <option value=\"0\" selected=\"selected\">";
            // line 53
            echo ($context["text_disabled"] ?? null);
            echo "</option>
                  ";
        }
        // line 55
        echo "                </select>
              </div>
            </div>
          </fieldset>
          <fieldset>
            <legend>";
        // line 60
        echo ($context["text_product"] ?? null);
        echo "</legend>
            <div class=\"form-group required\">
              <label class=\"col-sm-2 control-label\" for=\"input-catalog-limit\"><span data-toggle=\"tooltip\" title=\"";
        // line 62
        echo ($context["help_product_limit"] ?? null);
        echo "\">";
        echo ($context["entry_product_limit"] ?? null);
        echo "</span></label>
              <div class=\"col-sm-10\">
                <input type=\"text\" name=\"theme_default_product_limit\" value=\"";
        // line 64
        echo ($context["theme_default_product_limit"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_product_limit"] ?? null);
        echo "\" id=\"input-catalog-limit\" class=\"form-control\" />
                ";
        // line 65
        if (($context["error_product_limit"] ?? null)) {
            // line 66
            echo "                <div class=\"text-danger\">";
            echo ($context["error_product_limit"] ?? null);
            echo "</div>
                ";
        }
        // line 68
        echo "              </div>
            </div>
            <div class=\"form-group required\">
              <label class=\"col-sm-2 control-label\" for=\"input-description-limit\"><span data-toggle=\"tooltip\" title=\"";
        // line 71
        echo ($context["help_product_description_length"] ?? null);
        echo "\">";
        echo ($context["entry_product_description_length"] ?? null);
        echo "</span></label>
              <div class=\"col-sm-10\">
                <input type=\"text\" name=\"theme_default_product_description_length\" value=\"";
        // line 73
        echo ($context["theme_default_product_description_length"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_product_description_length"] ?? null);
        echo "\" id=\"input-description-limit\" class=\"form-control\" />
                ";
        // line 74
        if (($context["error_product_description_length"] ?? null)) {
            // line 75
            echo "                <div class=\"text-danger\">";
            echo ($context["error_product_description_length"] ?? null);
            echo "</div>
                ";
        }
        // line 77
        echo "              </div>
            </div>
          </fieldset>
          <fieldset>
            <legend>";
        // line 81
        echo ($context["text_image"] ?? null);
        echo "</legend>
            <div class=\"form-group required\">
              <label class=\"col-sm-2 control-label\" for=\"input-image-category-width\">";
        // line 83
        echo ($context["entry_image_category"] ?? null);
        echo "</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"theme_default_image_category_width\" value=\"";
        // line 87
        echo ($context["theme_default_image_category_width"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_width"] ?? null);
        echo "\" id=\"input-image-category-width\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"theme_default_image_category_height\" value=\"";
        // line 90
        echo ($context["theme_default_image_category_height"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_height"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                </div>
                ";
        // line 93
        if (($context["error_image_category"] ?? null)) {
            // line 94
            echo "                <div class=\"text-danger\">";
            echo ($context["error_image_category"] ?? null);
            echo "</div>
                ";
        }
        // line 96
        echo "              </div>
            </div>
            <div class=\"form-group required\">
              <label class=\"col-sm-2 control-label\" for=\"input-image-thumb-width\">";
        // line 99
        echo ($context["entry_image_thumb"] ?? null);
        echo "</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"theme_default_image_thumb_width\" value=\"";
        // line 103
        echo ($context["theme_default_image_thumb_width"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_width"] ?? null);
        echo "\" id=\"input-image-thumb-width\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"theme_default_image_thumb_height\" value=\"";
        // line 106
        echo ($context["theme_default_image_thumb_height"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_height"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                </div>
                ";
        // line 109
        if (($context["error_image_thumb"] ?? null)) {
            // line 110
            echo "                <div class=\"text-danger\">";
            echo ($context["error_image_thumb"] ?? null);
            echo "</div>
                ";
        }
        // line 112
        echo "              </div>
            </div>
            <div class=\"form-group required\">
              <label class=\"col-sm-2 control-label\" for=\"input-image-popup-width\">";
        // line 115
        echo ($context["entry_image_popup"] ?? null);
        echo "</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"theme_default_image_popup_width\" value=\"";
        // line 119
        echo ($context["theme_default_image_popup_width"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_width"] ?? null);
        echo "\" id=\"input-image-popup-width\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"theme_default_image_popup_height\" value=\"";
        // line 122
        echo ($context["theme_default_image_popup_height"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_height"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                </div>
                ";
        // line 125
        if (($context["error_image_popup"] ?? null)) {
            // line 126
            echo "                <div class=\"text-danger\">";
            echo ($context["error_image_popup"] ?? null);
            echo "</div>
                ";
        }
        // line 128
        echo "              </div>
            </div>
            <div class=\"form-group required\">
              <label class=\"col-sm-2 control-label\" for=\"input-image-product-width\">";
        // line 131
        echo ($context["entry_image_product"] ?? null);
        echo "</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"theme_default_image_product_width\" value=\"";
        // line 135
        echo ($context["theme_default_image_product_width"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_width"] ?? null);
        echo "\" id=\"input-image-product-width\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"theme_default_image_product_height\" value=\"";
        // line 138
        echo ($context["theme_default_image_product_height"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_height"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                </div>
                ";
        // line 141
        if (($context["error_image_product"] ?? null)) {
            // line 142
            echo "                <div class=\"text-danger\">";
            echo ($context["error_image_product"] ?? null);
            echo "</div>
                ";
        }
        // line 144
        echo "              </div>
            </div>
            <div class=\"form-group required\">
              <label class=\"col-sm-2 control-label\" for=\"input-image-additional-width\">";
        // line 147
        echo ($context["entry_image_additional"] ?? null);
        echo "</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"theme_default_image_additional_width\" value=\"";
        // line 151
        echo ($context["theme_default_image_additional_width"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_width"] ?? null);
        echo "\" id=\"input-image-additional-width\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"theme_default_image_additional_height\" value=\"";
        // line 154
        echo ($context["theme_default_image_additional_height"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_height"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                </div>
                ";
        // line 157
        if (($context["error_image_additional"] ?? null)) {
            // line 158
            echo "                <div class=\"text-danger\">";
            echo ($context["error_image_additional"] ?? null);
            echo "</div>
                ";
        }
        // line 160
        echo "              </div>
            </div>
            <div class=\"form-group required\">
              <label class=\"col-sm-2 control-label\" for=\"input-image-related\">";
        // line 163
        echo ($context["entry_image_related"] ?? null);
        echo "</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"theme_default_image_related_width\" value=\"";
        // line 167
        echo ($context["theme_default_image_related_width"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_width"] ?? null);
        echo "\" id=\"input-image-related\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"theme_default_image_related_height\" value=\"";
        // line 170
        echo ($context["theme_default_image_related_height"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_height"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                </div>
                ";
        // line 173
        if (($context["error_image_related"] ?? null)) {
            // line 174
            echo "                <div class=\"text-danger\">";
            echo ($context["error_image_related"] ?? null);
            echo "</div>
                ";
        }
        // line 176
        echo "              </div>
            </div>
            <div class=\"form-group required\">
              <label class=\"col-sm-2 control-label\" for=\"input-image-compare\">";
        // line 179
        echo ($context["entry_image_compare"] ?? null);
        echo "</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"theme_default_image_compare_width\" value=\"";
        // line 183
        echo ($context["theme_default_image_compare_width"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_width"] ?? null);
        echo "\" id=\"input-image-compare\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"theme_default_image_compare_height\" value=\"";
        // line 186
        echo ($context["theme_default_image_compare_height"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_height"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                </div>
                ";
        // line 189
        if (($context["error_image_compare"] ?? null)) {
            // line 190
            echo "                <div class=\"text-danger\">";
            echo ($context["error_image_compare"] ?? null);
            echo "</div>
                ";
        }
        // line 192
        echo "              </div>
            </div>
            <div class=\"form-group required\">
              <label class=\"col-sm-2 control-label\" for=\"input-image-wishlist\">";
        // line 195
        echo ($context["entry_image_wishlist"] ?? null);
        echo "</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"theme_default_image_wishlist_width\" value=\"";
        // line 199
        echo ($context["theme_default_image_wishlist_width"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_width"] ?? null);
        echo "\" id=\"input-image-wishlist\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"theme_default_image_wishlist_height\" value=\"";
        // line 202
        echo ($context["theme_default_image_wishlist_height"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_height"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                </div>
                ";
        // line 205
        if (($context["error_image_wishlist"] ?? null)) {
            // line 206
            echo "                <div class=\"text-danger\">";
            echo ($context["error_image_wishlist"] ?? null);
            echo "</div>
                ";
        }
        // line 208
        echo "              </div>
            </div>
            <div class=\"form-group required\">
              <label class=\"col-sm-2 control-label\" for=\"input-image-cart\">";
        // line 211
        echo ($context["entry_image_cart"] ?? null);
        echo "</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"theme_default_image_cart_width\" value=\"";
        // line 215
        echo ($context["theme_default_image_cart_width"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_width"] ?? null);
        echo "\" id=\"input-image-cart\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"theme_default_image_cart_height\" value=\"";
        // line 218
        echo ($context["theme_default_image_cart_height"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_height"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                </div>
                ";
        // line 221
        if (($context["error_image_cart"] ?? null)) {
            // line 222
            echo "                <div class=\"text-danger\">";
            echo ($context["error_image_cart"] ?? null);
            echo "</div>
                ";
        }
        // line 224
        echo "              </div>
            </div>
            <div class=\"form-group required\">
              <label class=\"col-sm-2 control-label\" for=\"input-image-location\">";
        // line 227
        echo ($context["entry_image_location"] ?? null);
        echo "</label>
              <div class=\"col-sm-10\">
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"theme_default_image_location_width\" value=\"";
        // line 231
        echo ($context["theme_default_image_location_width"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_width"] ?? null);
        echo "\" id=\"input-image-location\" class=\"form-control\" />
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" name=\"theme_default_image_location_height\" value=\"";
        // line 234
        echo ($context["theme_default_image_location_height"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_height"] ?? null);
        echo "\" class=\"form-control\" />
                  </div>
                </div>
                ";
        // line 237
        if (($context["error_image_location"] ?? null)) {
            // line 238
            echo "                <div class=\"text-danger\">";
            echo ($context["error_image_location"] ?? null);
            echo "</div>
                ";
        }
        // line 240
        echo "              </div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
";
        // line 248
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "extension/theme/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  618 => 248,  608 => 240,  602 => 238,  600 => 237,  592 => 234,  584 => 231,  577 => 227,  572 => 224,  566 => 222,  564 => 221,  556 => 218,  548 => 215,  541 => 211,  536 => 208,  530 => 206,  528 => 205,  520 => 202,  512 => 199,  505 => 195,  500 => 192,  494 => 190,  492 => 189,  484 => 186,  476 => 183,  469 => 179,  464 => 176,  458 => 174,  456 => 173,  448 => 170,  440 => 167,  433 => 163,  428 => 160,  422 => 158,  420 => 157,  412 => 154,  404 => 151,  397 => 147,  392 => 144,  386 => 142,  384 => 141,  376 => 138,  368 => 135,  361 => 131,  356 => 128,  350 => 126,  348 => 125,  340 => 122,  332 => 119,  325 => 115,  320 => 112,  314 => 110,  312 => 109,  304 => 106,  296 => 103,  289 => 99,  284 => 96,  278 => 94,  276 => 93,  268 => 90,  260 => 87,  253 => 83,  248 => 81,  242 => 77,  236 => 75,  234 => 74,  228 => 73,  221 => 71,  216 => 68,  210 => 66,  208 => 65,  202 => 64,  195 => 62,  190 => 60,  183 => 55,  178 => 53,  173 => 52,  168 => 50,  163 => 49,  161 => 48,  155 => 45,  149 => 41,  143 => 40,  135 => 38,  127 => 36,  124 => 35,  120 => 34,  112 => 31,  107 => 29,  102 => 27,  96 => 24,  92 => 22,  84 => 18,  82 => 17,  76 => 13,  65 => 11,  61 => 10,  56 => 8,  50 => 7,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/theme/default.twig", "");
    }
}
