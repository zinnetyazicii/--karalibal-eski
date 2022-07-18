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

/* journal3/template/journal3/module/banners.twig */
class __TwigTemplate_4298debb30b454b860e2dc54ade61712db4d16350d279f0fe541814ea1d185ec extends \Twig\Template
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
        // line 25
        $macros["self"] = $this->macros["self"] = $this;
        // line 26
        echo "<div id=\"";
        echo ($context["id"] ?? null);
        echo "\" class=\"";
        echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => ($context["classes"] ?? null)], "method", false, false, false, 26);
        echo "\">
  ";
        // line 27
        if (($context["title"] ?? null)) {
            // line 28
            echo "    <h3 class=\"title module-title\">";
            echo ($context["title"] ?? null);
            echo "</h3>
  ";
        }
        // line 30
        echo "  <div class=\"module-body\">
    ";
        // line 32
        echo "    ";
        if ( !($context["carousel"] ?? null)) {
            // line 33
            echo "      ";
            echo twig_call_macro($macros["self"], "macro_renderBanner", [($context["j3"] ?? null), $context], 33, $context, $this->getSourceContext());
            echo "
    ";
        }
        // line 35
        echo "    ";
        // line 36
        echo "    ";
        if (($context["carousel"] ?? null)) {
            // line 37
            echo "      <div class=\"swiper\" data-items-per-row='";
            echo json_encode(($context["itemsPerRow"] ?? null), twig_constant("JSON_FORCE_OBJECT"));
            echo "' data-options='";
            echo json_encode(($context["carouselOptions"] ?? null));
            echo "'>
        <div class=\"swiper-container\" ";
            // line 38
            if (twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "isRTL", [], "method", false, false, false, 38)) {
                echo "dir=\"rtl\"";
            }
            echo ">
          <div class=\"swiper-wrapper\">
            ";
            // line 40
            echo twig_call_macro($macros["self"], "macro_renderBanner", [($context["j3"] ?? null), $context], 40, $context, $this->getSourceContext());
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
        // line 50
        echo "  </div>
</div>
";
    }

    // line 1
    public function macro_renderBanner($__j3__ = null, $__context__ = null, ...$__varargs__)
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
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "items", [], "any", false, false, false, 4));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 5
                echo "    <div class=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "classes", [], "any", false, false, false, 5)], "method", false, false, false, 5);
                echo "\">
      <a ";
                // line 6
                if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 6), "href", [], "any", false, false, false, 6)) {
                    echo "href=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 6), "href", [], "any", false, false, false, 6);
                    echo "\"";
                }
                echo " ";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "linkAttrs", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 6)], "method", false, false, false, 6);
                echo ">
        ";
                // line 7
                if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 7), "get", [0 => "performanceLazyLoadImagesStatus"], "method", false, false, false, 7) && twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "lazyLoad", [], "any", false, false, false, 7))) {
                    // line 8
                    echo "          <img src=\"";
                    echo twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "dummy_image", [], "any", false, false, false, 8);
                    echo "\" data-src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, false, 8);
                    echo "\" ";
                    if (twig_get_attribute($this->env, $this->source, $context["item"], "image2x", [], "any", false, false, false, 8)) {
                        echo "data-srcset=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, false, 8);
                        echo " 1x, ";
                        echo twig_get_attribute($this->env, $this->source, $context["item"], "image2x", [], "any", false, false, false, 8);
                        echo " 2x\" ";
                    }
                    echo " alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "alt", [], "any", false, false, false, 8);
                    echo "\" width=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "imageDimensions", [], "any", false, false, false, 8), "width", [], "any", false, false, false, 8);
                    echo "\" height=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "imageDimensions", [], "any", false, false, false, 8), "height", [], "any", false, false, false, 8);
                    echo "\" class=\"lazyload\"/>
        ";
                } else {
                    // line 10
                    echo "          <img src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, false, 10);
                    echo "\" ";
                    if (twig_get_attribute($this->env, $this->source, $context["item"], "image2x", [], "any", false, false, false, 10)) {
                        echo "srcset=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["item"], "image", [], "any", false, false, false, 10);
                        echo " 1x, ";
                        echo twig_get_attribute($this->env, $this->source, $context["item"], "image2x", [], "any", false, false, false, 10);
                        echo " 2x\" ";
                    }
                    echo " alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "alt", [], "any", false, false, false, 10);
                    echo "\" width=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "imageDimensions", [], "any", false, false, false, 10), "width", [], "any", false, false, false, 10);
                    echo "\" height=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "imageDimensions", [], "any", false, false, false, 10), "height", [], "any", false, false, false, 10);
                    echo "\"/>
        ";
                }
                // line 12
                echo "        ";
                if (twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 12)) {
                    // line 13
                    echo "        <div class=\"banner-text banner-caption\"><span>";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 13);
                    echo "</span></div>
        ";
                }
                // line 15
                echo "        ";
                if (twig_get_attribute($this->env, $this->source, $context["item"], "title2", [], "any", false, false, false, 15)) {
                    // line 16
                    echo "        <div class=\"banner-text banner-caption-2\"><span>";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "title2", [], "any", false, false, false, 16);
                    echo "</span></div>
        ";
                }
                // line 18
                echo "      </a>
      ";
                // line 19
                if (twig_get_attribute($this->env, $this->source, $context["item"], "title3", [], "any", false, false, false, 19)) {
                    // line 20
                    echo "      <div class=\"banner-caption-3\"><span>";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "title3", [], "any", false, false, false, 20);
                    echo "</span></div>
      ";
                }
                // line 22
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
        return "journal3/template/journal3/module/banners.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  217 => 22,  211 => 20,  209 => 19,  206 => 18,  200 => 16,  197 => 15,  191 => 13,  188 => 12,  168 => 10,  146 => 8,  144 => 7,  134 => 6,  129 => 5,  124 => 4,  121 => 3,  118 => 2,  104 => 1,  98 => 50,  85 => 40,  78 => 38,  71 => 37,  68 => 36,  66 => 35,  60 => 33,  57 => 32,  54 => 30,  48 => 28,  46 => 27,  39 => 26,  37 => 25,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/module/banners.twig", "");
    }
}
