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

/* journal3/template/journal3/module/side_products.twig */
class __TwigTemplate_c6a8b40450aea8b3adc5cbdecd370b64806262b796e3c242476df1845743c3b9 extends \Twig\Template
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
        echo "<div class=\"";
        echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => ($context["classes"] ?? null)], "method", false, false, false, 24);
        echo "\">
  <div class=\"module-body side-products-";
        // line 25
        echo ($context["sectionsDisplay"] ?? null);
        echo "\">
    ";
        // line 27
        echo "    ";
        if ((($context["sectionsDisplay"] ?? null) == "blocks")) {
            // line 28
            echo "      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 29
                echo "        <div class=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "classes", [], "any", false, false, false, 29)], "method", false, false, false, 29);
                echo "\">
          ";
                // line 30
                if (twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 30)) {
                    // line 31
                    echo "            <h3 class=\"title module-title\">";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 31);
                    echo "</h3>
          ";
                }
                // line 33
                echo "          ";
                echo twig_call_macro($macros["self"], "macro_renderSideProductsItem", [$context["item"], $context], 33, $context, $this->getSourceContext());
                echo "
        </div>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 36
            echo "    ";
        }
        // line 37
        echo "    ";
        // line 38
        echo "    ";
        if ((($context["sectionsDisplay"] ?? null) == "tabs")) {
            // line 39
            echo "      <ul class=\"nav nav-tabs\">
        ";
            // line 40
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
                // line 41
                echo "          <li class=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "tab_classes", [], "any", false, false, false, 41)], "method", false, false, false, 41);
                echo "\">
            <a href=\"#";
                // line 42
                echo ($context["id"] ?? null);
                echo "-tab-";
                echo twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 42);
                echo "\" data-toggle=\"tab\">";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 42);
                echo "</a>
          </li>
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
            // line 45
            echo "      </ul>
      <div class=\"tab-content\">
        ";
            // line 47
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
                // line 48
                echo "          <div class=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "classes", [], "any", false, false, false, 48)], "method", false, false, false, 48);
                echo "\" id=\"";
                echo ($context["id"] ?? null);
                echo "-tab-";
                echo twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 48);
                echo "\">
            ";
                // line 49
                echo twig_call_macro($macros["self"], "macro_renderSideProductsItem", [$context["item"], $context], 49, $context, $this->getSourceContext());
                echo "
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
            // line 52
            echo "      </div>
    ";
        }
        // line 54
        echo "    ";
        // line 55
        echo "    ";
        if ((($context["sectionsDisplay"] ?? null) == "accordion")) {
            // line 56
            echo "      <div class=\"panel-group\" id=\"";
            echo ($context["id"] ?? null);
            echo "-collapse\">
        ";
            // line 57
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
                // line 58
                echo "          <div class=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "classes", [], "any", false, false, false, 58)], "method", false, false, false, 58);
                echo "\">
            <div class=\"panel-heading\">
              <h4 class=\"panel-title\">
                <a href=\"#";
                // line 61
                echo ($context["id"] ?? null);
                echo "-collapse-";
                echo twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 61);
                echo "\" class=\"accordion-toggle collapsed\" data-toggle=\"collapse\" data-parent=\"#";
                echo ($context["id"] ?? null);
                echo "-collapse\" aria-expanded=\"false\">
                  ";
                // line 62
                echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 62);
                echo "
                  <i class=\"fa fa-caret-down\"></i>
                </a>
              </h4>
            </div>
            <div class=\"";
                // line 67
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "panel_classes", [], "any", false, false, false, 67)], "method", false, false, false, 67);
                echo "\" id=\"";
                echo ($context["id"] ?? null);
                echo "-collapse-";
                echo twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 67);
                echo "\">
              <div class=\"panel-body\">
                ";
                // line 69
                echo twig_call_macro($macros["self"], "macro_renderSideProductsItem", [$context["item"], $context], 69, $context, $this->getSourceContext());
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
            // line 74
            echo "      </div>
    ";
        }
        // line 76
        echo "  </div>
</div>
";
    }

    // line 1
    public function macro_renderSideProductsItem($__item__ = null, $__context__ = null, ...$__varargs__)
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
            echo "  ";
            $context["products"] = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "products", [], "any", false, false, false, 3);
            // line 4
            echo "  ";
            if (twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "carousel", [], "any", false, false, false, 4)) {
                // line 5
                echo "    <div class=\"swiper\" data-items-per-row='";
                echo json_encode(twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "itemsPerRow", [], "any", false, false, false, 5), twig_constant("JSON_FORCE_OBJECT"));
                echo "' data-options='";
                echo json_encode(twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "carouselOptions", [], "any", false, false, false, 5), twig_constant("JSON_FORCE_OBJECT"));
                echo "'>
      <div class=\"swiper-container\" ";
                // line 6
                if (twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "isRTL", [], "method", false, false, false, 6)) {
                    echo "dir=\"rtl\"";
                }
                echo ">
        <div class=\"swiper-wrapper side-products\">
          ";
                // line 8
                $this->loadTemplate("journal3/template/journal3/side_products.twig", "journal3/template/journal3/module/side_products.twig", 8)->display(twig_array_merge($context, ($context["context"] ?? null)));
                // line 9
                echo "        </div>
      </div>
      <div class=\"swiper-buttons\">
        <div class=\"swiper-button-prev\"></div>
        <div class=\"swiper-button-next\"></div>
      </div>
      <div class=\"swiper-pagination\"></div>
    </div>
  ";
            } else {
                // line 18
                echo "    <div class=\"side-products\">
      ";
                // line 19
                $this->loadTemplate("journal3/template/journal3/side_products.twig", "journal3/template/journal3/module/side_products.twig", 19)->display(twig_array_merge($context, ($context["context"] ?? null)));
                // line 20
                echo "    </div>
  ";
            }

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/module/side_products.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  327 => 20,  325 => 19,  322 => 18,  311 => 9,  309 => 8,  302 => 6,  295 => 5,  292 => 4,  289 => 3,  286 => 2,  272 => 1,  266 => 76,  262 => 74,  243 => 69,  234 => 67,  226 => 62,  218 => 61,  211 => 58,  194 => 57,  189 => 56,  186 => 55,  184 => 54,  180 => 52,  163 => 49,  154 => 48,  137 => 47,  133 => 45,  112 => 42,  107 => 41,  90 => 40,  87 => 39,  84 => 38,  82 => 37,  79 => 36,  69 => 33,  63 => 31,  61 => 30,  56 => 29,  51 => 28,  48 => 27,  44 => 25,  39 => 24,  37 => 23,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/module/side_products.twig", "");
    }
}
