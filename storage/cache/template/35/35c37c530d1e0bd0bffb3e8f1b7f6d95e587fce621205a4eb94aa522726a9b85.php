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

/* journal3/template/journal3/module/gallery.twig */
class __TwigTemplate_59a1c048c15ee5334ffca45eaa553ed535a5dee5c32afd1f1bb4a03b3e576786 extends \Twig\Template
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
        // line 23
        $macros["self"] = $this->macros["self"] = $this;
        // line 24
        echo "<div id=\"";
        echo ($context["id"] ?? null);
        echo "\" class=\"";
        echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => ($context["classes"] ?? null)], "method", false, false, false, 24);
        echo "\">
  ";
        // line 25
        if (($context["title"] ?? null)) {
            // line 26
            echo "    <h3 class=\"title module-title\">";
            echo ($context["title"] ?? null);
            echo "</h3>
  ";
        }
        // line 28
        echo "  <div class=\"module-body\">
    ";
        // line 29
        if (($context["button"] ?? null)) {
            // line 30
            echo "      <a class=\"btn open-btn\" data-gallery=\"#";
            echo ($context["id"] ?? null);
            echo " .lightgallery\" data-index=\"0\">";
            echo ($context["buttonText"] ?? null);
            echo "</a>
    ";
        } else {
            // line 32
            echo "      ";
            // line 33
            echo "      ";
            if ( !($context["carousel"] ?? null)) {
                // line 34
                echo "        ";
                echo twig_call_macro($macros["self"], "macro_renderGallery", [($context["j3"] ?? null), $context], 34, $context, $this->getSourceContext());
                echo "
      ";
            }
            // line 36
            echo "      ";
            // line 37
            echo "      ";
            if (($context["carousel"] ?? null)) {
                // line 38
                echo "        <div class=\"swiper\" data-items-per-row='";
                echo json_encode(($context["itemsPerRow"] ?? null), twig_constant("JSON_FORCE_OBJECT"));
                echo "' data-options='";
                echo json_encode(($context["carouselOptions"] ?? null));
                echo "'>
          <div class=\"swiper-container\" ";
                // line 39
                if (twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "isRTL", [], "method", false, false, false, 39)) {
                    echo "dir=\"rtl\"";
                }
                echo ">
            <div class=\"swiper-wrapper\">
              ";
                // line 41
                echo twig_call_macro($macros["self"], "macro_renderGallery", [($context["j3"] ?? null), $context], 41, $context, $this->getSourceContext());
                echo "
            </div>
          </div>
          <div class=\"swiper-buttons\">
            <div class=\"swiper-button-prev\"></div>
            <div class=\"swiper-button-next\"></div>
          </div>
          <div class=\"swiper-pagination\"></div>
        </div>
      ";
            }
            // line 51
            echo "    ";
        }
        // line 52
        echo "  </div>
  <div class=\"lightgallery\" data-images='";
        // line 53
        echo twig_escape_filter($this->env, json_encode(($context["images"] ?? null)));
        echo "' data-options='";
        echo json_encode(($context["options"] ?? null));
        echo "'></div>
</div>
";
    }

    // line 1
    public function macro_renderGallery($__j3__ = null, $__context__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "j3" => $__j3__,
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
            echo "  ";
            $context["index"] = 0;
            // line 4
            echo "  ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "items", [], "any", false, false, false, 4), 0, twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "thumbsLimit", [], "any", false, false, false, 4)));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 5
                echo "    <div class=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "classes", [], "any", false, false, false, 5)], "method", false, false, false, 5);
                echo "\">
      <a ";
                // line 6
                if ((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 6) == "link")) {
                    echo "href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "popup", [], "any", false, false, false, 6);
                    echo "\" ";
                    echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "linkAttrs", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 6)], "method", false, false, false, 6);
                } else {
                    echo "data-gallery=\"#";
                    echo twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "id", [], "any", false, false, false, 6);
                    echo " .lightgallery\" data-index=\"";
                    echo ($context["index"] ?? null);
                    echo "\"";
                    $context["index"] = (($context["index"] ?? null) + 1);
                }
                echo " title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "alt", [], "any", false, false, false, 6);
                echo "\">
        <span class=\"gallery-image\">
          ";
                // line 8
                if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 8), "get", [0 => "performanceLazyLoadImagesStatus"], "method", false, false, false, 8)) {
                    // line 9
                    echo "            <img src=\"";
                    echo twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "dummy_image", [], "any", false, false, false, 9);
                    echo "\" data-src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "thumb", [], "any", false, false, false, 9);
                    echo "\" ";
                    if (twig_get_attribute($this->env, $this->source, $context["item"], "thumb2x", [], "any", false, false, false, 9)) {
                        echo "data-srcset=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["item"], "thumb", [], "any", false, false, false, 9);
                        echo " 1x, ";
                        echo twig_get_attribute($this->env, $this->source, $context["item"], "thumb2x", [], "any", false, false, false, 9);
                        echo " 2x\"";
                    }
                    echo " alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "alt", [], "any", false, false, false, 9);
                    echo "\" width=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "thumbDimensions", [], "any", false, false, false, 9), "width", [], "any", false, false, false, 9);
                    echo "\" height=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "thumbDimensions", [], "any", false, false, false, 9), "height", [], "any", false, false, false, 9);
                    echo "\" class=\"lazyload\"/>
          ";
                } else {
                    // line 11
                    echo "            <img src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "thumb", [], "any", false, false, false, 11);
                    echo "\" ";
                    if (twig_get_attribute($this->env, $this->source, $context["item"], "thumb2x", [], "any", false, false, false, 11)) {
                        echo "srcset=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["item"], "thumb", [], "any", false, false, false, 11);
                        echo " 1x, ";
                        echo twig_get_attribute($this->env, $this->source, $context["item"], "thumb2x", [], "any", false, false, false, 11);
                        echo " 2x\"";
                    }
                    echo " alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "alt", [], "any", false, false, false, 11);
                    echo "\" width=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "thumbDimensions", [], "any", false, false, false, 11), "width", [], "any", false, false, false, 11);
                    echo "\" height=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "thumbDimensions", [], "any", false, false, false, 11), "height", [], "any", false, false, false, 11);
                    echo "\"/>
          ";
                }
                // line 13
                echo "        </span>
      </a>
      ";
                // line 15
                if (twig_get_attribute($this->env, $this->source, $context["item"], "alt", [], "any", false, false, false, 15)) {
                    // line 16
                    echo "        <span class=\"gallery-image-caption\">
          ";
                    // line 17
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "alt", [], "any", false, false, false, 17);
                    echo "
        </span>
      ";
                }
                // line 20
                echo "    </div>
  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/module/gallery.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  233 => 20,  227 => 17,  224 => 16,  222 => 15,  218 => 13,  198 => 11,  176 => 9,  174 => 8,  155 => 6,  150 => 5,  145 => 4,  142 => 3,  139 => 2,  125 => 1,  116 => 53,  113 => 52,  110 => 51,  97 => 41,  90 => 39,  83 => 38,  80 => 37,  78 => 36,  72 => 34,  69 => 33,  67 => 32,  59 => 30,  57 => 29,  54 => 28,  48 => 26,  46 => 25,  39 => 24,  37 => 23,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/module/gallery.twig", "");
    }
}
