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

/* journal3/template/journal3/side_products.twig */
class __TwigTemplate_caed1be5a887f0d007e30fa07a27333503d14f10dd95f1d60b27cc5b70c42cd6 extends \Twig\Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["products"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 2
            echo "  ";
            $context["classes"] = twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => ["out-of-stock" =>  !twig_get_attribute($this->env, $this->source,             // line 3
$context["product"], "quantity", [], "any", false, false, false, 3), "has-zero-price" =>  !twig_get_attribute($this->env, $this->source,             // line 4
$context["product"], "price_value", [], "any", false, false, false, 4)]], "method", false, false, false, 2);
            // line 6
            echo "  <div class=\"product-layout ";
            echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["product"], "classes", [], "any", false, false, false, 6)], "method", false, false, false, 6);
            echo " ";
            echo ($context["classes"] ?? null);
            echo "\">
    <div class=\"side-product\">
      <div class=\"image\">
        <a href=\"";
            // line 9
            echo twig_get_attribute($this->env, $this->source, $context["product"], "href", [], "any", false, false, false, 9);
            echo "\" class=\"product-img\">
          ";
            // line 10
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 10), "get", [0 => "performanceLazyLoadImagesStatus"], "method", false, false, false, 10)) {
                // line 11
                echo "            <img src=\"";
                echo ($context["dummy_image"] ?? null);
                echo "\" data-src=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "thumb", [], "any", false, false, false, 11);
                echo "\" ";
                if (twig_get_attribute($this->env, $this->source, $context["product"], "thumb2x", [], "any", false, false, false, 11)) {
                    echo "data-srcset=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "thumb", [], "any", false, false, false, 11);
                    echo " 1x, ";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "thumb2x", [], "any", false, false, false, 11);
                    echo " 2x\" ";
                }
                echo " width=\"";
                echo ($context["image_width"] ?? null);
                echo "\" height=\"";
                echo ($context["image_height"] ?? null);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 11);
                echo "\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 11);
                echo "\" class=\"img-first lazyload\"/>
          ";
            } else {
                // line 13
                echo "            <img src=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "thumb", [], "any", false, false, false, 13);
                echo "\" ";
                if (twig_get_attribute($this->env, $this->source, $context["product"], "thumb2x", [], "any", false, false, false, 13)) {
                    echo "srcset=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "thumb", [], "any", false, false, false, 13);
                    echo " 1x, ";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "thumb2x", [], "any", false, false, false, 13);
                    echo " 2x\" ";
                }
                echo " width=\"";
                echo ($context["image_width"] ?? null);
                echo "\" height=\"";
                echo ($context["image_height"] ?? null);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 13);
                echo "\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 13);
                echo "\" class=\"img-first\"/>
          ";
            }
            // line 15
            echo "        </a>

        ";
            // line 17
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 17), "get", [0 => "quickviewStatus"], "method", false, false, false, 17)) {
                // line 18
                echo "          <div class=\"quickview-button\">
            <a class=\"btn btn-quickview\" ";
                // line 19
                if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 19), "getIn", [0 => "SideProductQuickviewTooltipStatus", 1 => $context], "method", false, false, false, 19)) {
                    echo "data-toggle=\"tooltip\" data-tooltip-class=\"";
                    echo ("module-side_products-" . ($context["module_id"] ?? null));
                    echo " quickview-tooltip\" data-placement=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 19), "getIn", [0 => "SideProductQuickviewTooltipPosition", 1 => $context], "method", false, false, false, 19);
                    echo "\" title=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 19), "get", [0 => "quickviewText"], "method", false, false, false, 19);
                    echo "\"";
                }
                echo " onclick=\"quickview('";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 19);
                echo "')\"><span class=\"btn-text\">";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 19), "get", [0 => "quickviewText"], "method", false, false, false, 19);
                echo "</span></a>
          </div>
        ";
            }
            // line 22
            echo "      </div>

      <div class=\"caption\">
        <div class=\"name\"><a href=\"";
            // line 25
            echo twig_get_attribute($this->env, $this->source, $context["product"], "href", [], "any", false, false, false, 25);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 25);
            echo "</a></div>

        ";
            // line 27
            if (twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 27)) {
                // line 28
                echo "          <div class=\"price\">
            ";
                // line 29
                if (twig_get_attribute($this->env, $this->source, $context["product"], "special", [], "any", false, false, false, 29)) {
                    // line 30
                    echo "              <span class=\"price-new\">";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "special", [], "any", false, false, false, 30);
                    echo "</span> <span class=\"price-old\">";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 30);
                    echo "</span>
            ";
                } else {
                    // line 32
                    echo "              <span class=\"price-normal\">";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 32);
                    echo "</span>
            ";
                }
                // line 34
                echo "          </div>
          ";
                // line 35
                if (twig_get_attribute($this->env, $this->source, $context["product"], "tax", [], "any", false, false, false, 35)) {
                    // line 36
                    echo "            <div class=\"price-tax\">";
                    echo ($context["text_tax"] ?? null);
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "tax", [], "any", false, false, false, 36);
                    echo "</div>
          ";
                }
                // line 38
                echo "        ";
            }
            // line 39
            echo "
        ";
            // line 40
            if (twig_get_attribute($this->env, $this->source, $context["product"], "rating", [], "any", false, false, false, 40)) {
                // line 41
                echo "          <div class=\"rating\">
            <div class=\"rating-stars\">
              ";
                // line 43
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(1, 5));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 44
                    echo "                ";
                    if ((twig_get_attribute($this->env, $this->source, $context["product"], "rating", [], "any", false, false, false, 44) < $context["i"])) {
                        // line 45
                        echo "                  <span class=\"fa fa-stack\"><i class=\"fa fa-star-o fa-stack-2x\"></i></span>
                ";
                    } else {
                        // line 47
                        echo "                  <span class=\"fa fa-stack\"><i class=\"fa fa-star fa-stack-2x\"></i><i class=\"fa fa-star-o fa-stack-2x\"></i></span>
                ";
                    }
                    // line 49
                    echo "              ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 50
                echo "            </div>
          </div>
        ";
            } else {
                // line 53
                echo "          <div class=\"rating no-rating\">
            <div class=\"rating-stars\">
              ";
                // line 55
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(1, 5));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 56
                    echo "                ";
                    if ((twig_get_attribute($this->env, $this->source, $context["product"], "rating", [], "any", false, false, false, 56) < $context["i"])) {
                        // line 57
                        echo "                  <span class=\"fa fa-stack\"><i class=\"fa fa-star-o fa-stack-2x\"></i></span>
                ";
                    } else {
                        // line 59
                        echo "                  <span class=\"fa fa-stack\"><i class=\"fa fa-star fa-stack-2x\"></i><i class=\"fa fa-star-o fa-stack-2x\"></i></span>
                ";
                    }
                    // line 61
                    echo "              ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 62
                echo "            </div>
          </div>
        ";
            }
            // line 65
            echo "
        ";
            // line 66
            if (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 66), "get", [0 => "catalogCartStatus"], "method", false, false, false, 66) || twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 66), "get", [0 => "catalogWishlistStatus"], "method", false, false, false, 66)) || twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 66), "get", [0 => "catalogCompareStatus"], "method", false, false, false, 66))) {
                // line 67
                echo "          <div class=\"button-group\">
            ";
                // line 68
                if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 68), "get", [0 => "catalogCartStatus"], "method", false, false, false, 68)) {
                    // line 69
                    echo "              <a class=\"btn btn-cart\" ";
                    if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 69), "getIn", [0 => "SideProductCartTooltipStatus", 1 => $context], "method", false, false, false, 69)) {
                        echo " data-toggle=\"tooltip\" data-tooltip-class=\"";
                        echo ("module-side_products-" . ($context["module_id"] ?? null));
                        echo " cart-tooltip\" data-placement=\"";
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 69), "getIn", [0 => "SideProductCartTooltipPosition", 1 => $context], "method", false, false, false, 69);
                        echo "\" title=\"";
                        echo ($context["button_cart"] ?? null);
                        echo "\" ";
                    }
                    echo " onclick=\"cart.add('";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 69);
                    echo "', \$(this).closest('.product-thumb').find('.button-group input[name=\\'quantity\\']').val());\" data-loading-text=\"<span class='btn-text'>";
                    echo ($context["button_cart"] ?? null);
                    echo "</span>\"><span class=\"btn-text\">";
                    echo ($context["button_cart"] ?? null);
                    echo "</span></a>
            ";
                }
                // line 71
                echo "            ";
                if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 71), "get", [0 => "catalogWishlistStatus"], "method", false, false, false, 71)) {
                    // line 72
                    echo "              <a class=\"btn btn-wishlist\" ";
                    if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 72), "getIn", [0 => "SideProductWishlistTooltipStatus", 1 => $context], "method", false, false, false, 72)) {
                        echo " data-toggle=\"tooltip\" data-tooltip-class=\"";
                        echo ("module-side_products-" . ($context["module_id"] ?? null));
                        echo " wishlist-tooltip\" data-placement=\"";
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 72), "getIn", [0 => "SideProductWishlistTooltipPosition", 1 => $context], "method", false, false, false, 72);
                        echo "\" title=\"";
                        echo ($context["button_wishlist"] ?? null);
                        echo "\" ";
                    }
                    echo " onclick=\"wishlist.add('";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 72);
                    echo "')\"><span class=\"btn-text\">";
                    echo ($context["button_wishlist"] ?? null);
                    echo "</span></a>
            ";
                }
                // line 74
                echo "            ";
                if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 74), "get", [0 => "catalogCompareStatus"], "method", false, false, false, 74)) {
                    // line 75
                    echo "              <a class=\"btn btn-compare\" ";
                    if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 75), "getIn", [0 => "SideProductCompareTooltipStatus", 1 => $context], "method", false, false, false, 75)) {
                        echo " data-toggle=\"tooltip\" data-tooltip-class=\"";
                        echo ("module-side_products-" . ($context["module_id"] ?? null));
                        echo " compare-tooltip\" data-placement=\"";
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 75), "getIn", [0 => "SideProductCompareTooltipPosition", 1 => $context], "method", false, false, false, 75);
                        echo "\" title=\"";
                        echo ($context["button_compare"] ?? null);
                        echo "\" ";
                    }
                    echo " onclick=\"compare.add('";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 75);
                    echo "')\"><span class=\"btn-text\">";
                    echo ($context["button_compare"] ?? null);
                    echo "</span></a>
            ";
                }
                // line 77
                echo "          </div>
        ";
            }
            // line 79
            echo "
      </div>
    </div>
  </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/side_products.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  323 => 79,  319 => 77,  301 => 75,  298 => 74,  280 => 72,  277 => 71,  257 => 69,  255 => 68,  252 => 67,  250 => 66,  247 => 65,  242 => 62,  236 => 61,  232 => 59,  228 => 57,  225 => 56,  221 => 55,  217 => 53,  212 => 50,  206 => 49,  202 => 47,  198 => 45,  195 => 44,  191 => 43,  187 => 41,  185 => 40,  182 => 39,  179 => 38,  172 => 36,  170 => 35,  167 => 34,  161 => 32,  153 => 30,  151 => 29,  148 => 28,  146 => 27,  139 => 25,  134 => 22,  116 => 19,  113 => 18,  111 => 17,  107 => 15,  85 => 13,  61 => 11,  59 => 10,  55 => 9,  46 => 6,  44 => 4,  43 => 3,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/side_products.twig", "C:\\wamp64\\www\\catalog\\view\\theme\\journal3\\template\\journal3\\side_products.twig");
    }
}
