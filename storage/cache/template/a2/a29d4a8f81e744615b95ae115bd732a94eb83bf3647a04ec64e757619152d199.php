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

/* journal3/template/journal3/module/blocks.twig */
class __TwigTemplate_1022bf1c89eb2ae20aac5d2b20a7eaf9c7f52706673b9aa62dc2caeb207905f1 extends \Twig\Template
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
        // line 36
        $macros["self"] = $this->macros["self"] = $this;
        // line 37
        echo "<div class=\"";
        echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => ($context["classes"] ?? null)], "method", false, false, false, 37);
        echo "\">
  ";
        // line 38
        if (($context["title"] ?? null)) {
            // line 39
            echo "    <h3 class=\"title module-title\">";
            echo ($context["title"] ?? null);
            echo "</h3>
  ";
        }
        // line 41
        echo "  <div class=\"module-body\">
  ";
        // line 43
        echo "  ";
        if (((($context["display"] ?? null) == "grid") &&  !($context["carousel"] ?? null))) {
            // line 44
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 45
                echo "      <div class=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "classes", [], "any", false, false, false, 45)], "method", false, false, false, 45);
                echo "\">
        ";
                // line 46
                echo twig_call_macro($macros["self"], "macro_renderBlocksItem", [$context["item"], $context], 46, $context, $this->getSourceContext());
                echo "
      </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 49
            echo "  ";
        }
        // line 50
        echo "  ";
        // line 51
        echo "  ";
        if (((($context["display"] ?? null) == "grid") && ($context["carousel"] ?? null))) {
            // line 52
            echo "    <div class=\"swiper\" data-items-per-row='";
            echo json_encode(($context["itemsPerRow"] ?? null), twig_constant("JSON_FORCE_OBJECT"));
            echo "' data-options='";
            echo json_encode(($context["carouselOptions"] ?? null), twig_constant("JSON_FORCE_OBJECT"));
            echo "'>
      <div class=\"swiper-container\" ";
            // line 53
            if (twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "isRTL", [], "method", false, false, false, 53)) {
                echo "dir=\"rtl\"";
            }
            echo ">
        <div class=\"swiper-wrapper\">
          ";
            // line 55
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 56
                echo "            <div class=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "classes", [], "any", false, false, false, 56)], "method", false, false, false, 56);
                echo "\">
              ";
                // line 57
                echo twig_call_macro($macros["self"], "macro_renderBlocksItem", [$context["item"], $context], 57, $context, $this->getSourceContext());
                echo "
            </div>
          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 60
            echo "        </div>
      </div>
      <div class=\"swiper-buttons\">
        <div class=\"swiper-button-prev\"></div>
        <div class=\"swiper-button-next\"></div>
      </div>
      <div class=\"swiper-pagination\"></div>
    </div>
  ";
        }
        // line 69
        echo "  ";
        // line 70
        echo "  ";
        if ((($context["display"] ?? null) == "tabs")) {
            // line 71
            echo "    <div class=\"tabs-container\">
      <ul class=\"nav nav-tabs\">
        ";
            // line 73
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 74
                echo "          <li class=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "tab_classes", [], "any", false, false, false, 74)], "method", false, false, false, 74);
                echo "\">
            ";
                // line 75
                if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 75), "href", [], "any", false, false, false, 75)) {
                    // line 76
                    echo "              <a href=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 76), "href", [], "any", false, false, false, 76);
                    echo "\" ";
                    echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "linkAttrs", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 76)], "method", false, false, false, 76);
                    echo ">";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 76);
                    echo "</a>
            ";
                } else {
                    // line 78
                    echo "              <a href=\"#";
                    echo ($context["id"] ?? null);
                    echo "-tab-";
                    echo twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 78);
                    echo "\" data-toggle=\"tab\">";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 78);
                    echo "</a>
            ";
                }
                // line 80
                echo "          </li>
        ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 82
            echo "      </ul>
      <div class=\"tab-content\">
        ";
            // line 84
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 85
                echo "          ";
                if ( !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 85), "href", [], "any", false, false, false, 85)) {
                    // line 86
                    echo "            <div class=\"";
                    echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "classes", [], "any", false, false, false, 86)], "method", false, false, false, 86);
                    echo "\" id=\"";
                    echo ($context["id"] ?? null);
                    echo "-tab-";
                    echo twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 86);
                    echo "\">
              ";
                    // line 87
                    echo twig_call_macro($macros["self"], "macro_renderBlocksItem", [$context["item"], $context], 87, $context, $this->getSourceContext());
                    echo "
            </div>
          ";
                }
                // line 90
                echo "        ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 91
            echo "      </div>
    </div>
  ";
        }
        // line 94
        echo "  ";
        // line 95
        echo "  ";
        if ((($context["display"] ?? null) == "accordion")) {
            // line 96
            echo "    <div class=\"panel-group\" id=\"";
            echo ($context["id"] ?? null);
            echo "-collapse\">
      ";
            // line 97
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 98
                echo "        <div class=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "classes", [], "any", false, false, false, 98)], "method", false, false, false, 98);
                echo "\">
          <div class=\"panel-heading\">
            <h4 class=\"panel-title\">
              <a href=\"#";
                // line 101
                echo ($context["id"] ?? null);
                echo "-collapse-";
                echo twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 101);
                echo "\" class=\"accordion-toggle collapsed\" data-toggle=\"collapse\" data-parent=\"#";
                echo ($context["id"] ?? null);
                echo "-collapse\" aria-expanded=\"false\">
                ";
                // line 102
                echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 102);
                echo "
                <i class=\"fa fa-caret-down\"></i>
              </a>
            </h4>
          </div>
          <div class=\"";
                // line 107
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "panel_classes", [], "any", false, false, false, 107)], "method", false, false, false, 107);
                echo "\" id=\"";
                echo ($context["id"] ?? null);
                echo "-collapse-";
                echo twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 107);
                echo "\">
            <div class=\"panel-body\">
              ";
                // line 109
                echo twig_call_macro($macros["self"], "macro_renderBlocksItem", [$context["item"], $context], 109, $context, $this->getSourceContext());
                echo "
            </div>
          </div>
        </div>
      ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 114
            echo "    </div>
  ";
        }
        // line 116
        echo "  </div>
</div>
";
    }

    // line 1
    public function macro_renderBlocksItem($__item__ = null, $__context__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "item" => $__item__,
            "context" => $__context__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 2
            echo "  ";
            $macros["self"] = $this;
            // line 3
            echo "  <div class=\"block-body expand-block\">
    ";
            // line 4
            if (((twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "display", [], "any", false, false, false, 4) == "grid") && twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "title", [], "any", false, false, false, 4))) {
                // line 5
                echo "      <h3 class=\"title module-title block-title\">";
                echo twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "title", [], "any", false, false, false, 5);
                echo "</h3>
    ";
            }
            // line 7
            echo "    ";
            if ((twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "header", [], "any", false, false, false, 7) == "image")) {
                // line 8
                echo "      ";
                if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "j3", [], "any", false, false, false, 8), "settings", [], "any", false, false, false, 8), "get", [0 => "performanceLazyLoadImagesStatus"], "method", false, false, false, 8) && twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "lazyLoad", [], "any", false, false, false, 8))) {
                    // line 9
                    echo "        <div class=\"block-header\"><img src=\"";
                    echo twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "dummy_image", [], "any", false, false, false, 9);
                    echo "\" data-src=\"";
                    echo twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "image", [], "any", false, false, false, 9);
                    echo "\" ";
                    if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "image2x", [], "any", false, false, false, 9)) {
                        echo "data-srcset=\"";
                        echo twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "image", [], "any", false, false, false, 9);
                        echo " 1x, ";
                        echo twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "image2x", [], "any", false, false, false, 9);
                        echo " 2x\" ";
                    }
                    echo " alt=\"";
                    echo twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "alt", [], "any", false, false, false, 9);
                    echo "\" width=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "imageDimensions", [], "any", false, false, false, 9), "width", [], "any", false, false, false, 9);
                    echo "\" height=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "imageDimensions", [], "any", false, false, false, 9), "height", [], "any", false, false, false, 9);
                    echo "\" class=\"block-image lazyload\"/></div>
      ";
                } else {
                    // line 11
                    echo "        <div class=\"block-header\"><img src=\"";
                    echo twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "image", [], "any", false, false, false, 11);
                    echo "\" ";
                    if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "image2x", [], "any", false, false, false, 11)) {
                        echo "srcset=\"";
                        echo twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "image", [], "any", false, false, false, 11);
                        echo " 1x, ";
                        echo twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "image2x", [], "any", false, false, false, 11);
                        echo " 2x\" ";
                    }
                    echo " alt=\"";
                    echo twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "alt", [], "any", false, false, false, 11);
                    echo "\" width=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "imageDimensions", [], "any", false, false, false, 11), "width", [], "any", false, false, false, 11);
                    echo "\" height=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "imageDimensions", [], "any", false, false, false, 11), "height", [], "any", false, false, false, 11);
                    echo "\" class=\"block-image\"/></div>
      ";
                }
                // line 13
                echo "    ";
            } elseif ((twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "header", [], "any", false, false, false, 13) == "icon")) {
                // line 14
                echo "      <div class=\"block-header\"><i class=\"icon icon-block\"></i></div>
    ";
            } elseif ((twig_get_attribute($this->env, $this->source,             // line 15
($context["item"] ?? null), "header", [], "any", false, false, false, 15) == "text")) {
                // line 16
                echo "      <div class=\"block-header\"><span class=\"block-header-text\">";
                echo twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "text", [], "any", false, false, false, 16);
                echo "</span></div>
    ";
            }
            // line 18
            echo "    <div class=\"block-wrapper\">
      <div class=\"block-content ";
            // line 19
            if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "expandButton", [], "any", false, false, false, 19)) {
                echo "expand-content";
            }
            echo " block-";
            echo twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "contentType", [], "any", false, false, false, 19);
            echo "\">
        ";
            // line 20
            if ((twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "contentType", [], "any", false, false, false, 20) == "map")) {
                // line 21
                echo "        <div class=\"journal-loading\"><i class=\"fa fa-spinner fa-spin\"></i></div>
        ";
            }
            // line 23
            echo "        ";
            echo twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "content", [], "any", false, false, false, 23);
            echo "
        ";
            // line 24
            if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "expandButton", [], "any", false, false, false, 24)) {
                // line 25
                echo "          <div class=\"block-expand-overlay\"><a class=\"block-expand btn\"></a></div>
        ";
            }
            // line 27
            echo "      </div>
      ";
            // line 28
            if ((twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "footer", [], "any", false, false, false, 28) == "text")) {
                // line 29
                echo "        <div class=\"block-footer\">";
                echo twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "footerText", [], "any", false, false, false, 29);
                echo "</div>
      ";
            } elseif ((twig_get_attribute($this->env, $this->source,             // line 30
($context["item"] ?? null), "footer", [], "any", false, false, false, 30) == "button")) {
                // line 31
                echo "        <div class=\"block-footer\"><a class=\"btn\" href=\"";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "footerButtonLink", [], "any", false, false, false, 31), "href", [], "any", false, false, false, 31);
                echo "\" ";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "j3", [], "any", false, false, false, 31), "linkAttrs", [0 => twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "footerButtonLink", [], "any", false, false, false, 31)], "method", false, false, false, 31);
                echo ">";
                echo twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "footerButton", [], "any", false, false, false, 31);
                echo "</a></div>
      ";
            }
            // line 33
            echo "    </div>
  </div>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/module/blocks.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  482 => 33,  472 => 31,  470 => 30,  465 => 29,  463 => 28,  460 => 27,  456 => 25,  454 => 24,  449 => 23,  445 => 21,  443 => 20,  435 => 19,  432 => 18,  426 => 16,  424 => 15,  421 => 14,  418 => 13,  398 => 11,  376 => 9,  373 => 8,  370 => 7,  364 => 5,  362 => 4,  359 => 3,  356 => 2,  342 => 1,  336 => 116,  332 => 114,  313 => 109,  304 => 107,  296 => 102,  288 => 101,  281 => 98,  264 => 97,  259 => 96,  256 => 95,  254 => 94,  249 => 91,  235 => 90,  229 => 87,  220 => 86,  217 => 85,  200 => 84,  196 => 82,  181 => 80,  171 => 78,  161 => 76,  159 => 75,  154 => 74,  137 => 73,  133 => 71,  130 => 70,  128 => 69,  117 => 60,  108 => 57,  103 => 56,  99 => 55,  92 => 53,  85 => 52,  82 => 51,  80 => 50,  77 => 49,  68 => 46,  63 => 45,  58 => 44,  55 => 43,  52 => 41,  46 => 39,  44 => 38,  39 => 37,  37 => 36,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/module/blocks.twig", "");
    }
}
