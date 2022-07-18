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

/* journal3/template/journal3/module/blog_posts.twig */
class __TwigTemplate_62b641090c703f7ca634ab472d7ff332245e8f36eea6b5b84bce41fd1a3a6f87 extends \Twig\Template
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
  <div class=\"module-body\">
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
                echo twig_call_macro($macros["self"], "macro_renderPostsItem", [$context["item"], $context], 33, $context, $this->getSourceContext());
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
            echo "      <div class=\"tab-container\">
      <ul class=\"nav nav-tabs\">
        ";
            // line 41
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
                // line 42
                echo "          <li class=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "tab_classes", [], "any", false, false, false, 42)], "method", false, false, false, 42);
                echo "\">
            <a href=\"#";
                // line 43
                echo ($context["id"] ?? null);
                echo "-tab-";
                echo twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 43);
                echo "\" data-toggle=\"tab\">";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 43);
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
            // line 46
            echo "      </ul>
      <div class=\"tab-content\">
        ";
            // line 48
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
                // line 49
                echo "          <div class=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "classes", [], "any", false, false, false, 49)], "method", false, false, false, 49);
                echo "\" id=\"";
                echo ($context["id"] ?? null);
                echo "-tab-";
                echo twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 49);
                echo "\">
            ";
                // line 50
                echo twig_call_macro($macros["self"], "macro_renderPostsItem", [$context["item"], $context], 50, $context, $this->getSourceContext());
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
            // line 53
            echo "      </div>
      </div>
    ";
        }
        // line 56
        echo "    ";
        // line 57
        echo "    ";
        if ((($context["sectionsDisplay"] ?? null) == "accordion")) {
            // line 58
            echo "      <div class=\"panel-group\" id=\"";
            echo ($context["id"] ?? null);
            echo "-collapse\">
        ";
            // line 59
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
                // line 60
                echo "          <div class=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "classes", [], "any", false, false, false, 60)], "method", false, false, false, 60);
                echo "\">
            <div class=\"panel-heading\">
              <h4 class=\"panel-title\">
                <a href=\"#";
                // line 63
                echo ($context["id"] ?? null);
                echo "-collapse-";
                echo twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 63);
                echo "\" class=\"accordion-toggle collapsed\" data-toggle=\"collapse\" data-parent=\"#";
                echo ($context["id"] ?? null);
                echo "-collapse\" aria-expanded=\"false\">
                  ";
                // line 64
                echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 64);
                echo "
                  <i class=\"fa fa-caret-down\"></i>
                </a>
              </h4>
            </div>
            <div class=\"";
                // line 69
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "panel_classes", [], "any", false, false, false, 69)], "method", false, false, false, 69);
                echo "\" id=\"";
                echo ($context["id"] ?? null);
                echo "-collapse-";
                echo twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 69);
                echo "\">
              <div class=\"panel-body\">
                ";
                // line 71
                echo twig_call_macro($macros["self"], "macro_renderPostsItem", [$context["item"], $context], 71, $context, $this->getSourceContext());
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
            // line 76
            echo "      </div>
    ";
        }
        // line 78
        echo "    ";
        // line 79
        echo "    ";
        if ((($context["sectionsDisplay"] ?? null) == "isotope")) {
            // line 80
            echo "      <ul class=\"nav nav-tabs\">
        ";
            // line 81
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
                // line 82
                echo "          <li class=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "tab_classes", [], "any", false, false, false, 82)], "method", false, false, false, 82);
                echo "\">
            <a data-filter=\".";
                // line 83
                echo ($context["id"] ?? null);
                echo "-section-";
                echo twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 83);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 83);
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
            // line 86
            echo "      </ul>
      <div class=\"post-";
            // line 87
            echo ($context["display"] ?? null);
            echo " isotope-grid\">
        ";
            // line 88
            $this->loadTemplate((("journal3/template/journal3/post_" . ($context["display"] ?? null)) . ".twig"), "journal3/template/journal3/module/blog_posts.twig", 88)->display($context);
            // line 89
            echo "      </div>
    ";
        }
        // line 91
        echo "  </div>
</div>
";
    }

    // line 1
    public function macro_renderPostsItem($__item__ = null, $__context__ = null, ...$__varargs__)
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
            $context["posts"] = twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "posts", [], "any", false, false, false, 3);
            // line 4
            echo "  ";
            if (twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "carousel", [], "any", false, false, false, 4)) {
                // line 5
                echo "    <div class=\"swiper\" ";
                if ((twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "display", [], "any", false, false, false, 5) == "grid")) {
                    echo "data-items-per-row='";
                    echo json_encode(twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "itemsPerRow", [], "any", false, false, false, 5), twig_constant("JSON_FORCE_OBJECT"));
                    echo "'";
                }
                echo " data-options='";
                echo json_encode(twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "carouselOptions", [], "any", false, false, false, 5), twig_constant("JSON_FORCE_OBJECT"));
                echo "'>
      <div class=\"swiper-container\" ";
                // line 6
                if (twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "isRTL", [], "method", false, false, false, 6)) {
                    echo "dir=\"rtl\"";
                }
                echo ">
        <div class=\"swiper-wrapper post-";
                // line 7
                echo twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "display", [], "any", false, false, false, 7);
                echo "\">
          ";
                // line 8
                $this->loadTemplate((("journal3/template/journal3/post_" . twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "display", [], "any", false, false, false, 8)) . ".twig"), "journal3/template/journal3/module/blog_posts.twig", 8)->display(twig_array_merge($context, ($context["context"] ?? null)));
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
                echo "    <div class=\"post-";
                echo twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "display", [], "any", false, false, false, 18);
                echo "\">
      ";
                // line 19
                $this->loadTemplate((("journal3/template/journal3/post_" . twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "display", [], "any", false, false, false, 19)) . ".twig"), "journal3/template/journal3/module/blog_posts.twig", 19)->display(twig_array_merge($context, ($context["context"] ?? null)));
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
        return "journal3/template/journal3/module/blog_posts.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  399 => 20,  397 => 19,  392 => 18,  381 => 9,  379 => 8,  375 => 7,  369 => 6,  358 => 5,  355 => 4,  352 => 3,  349 => 2,  335 => 1,  329 => 91,  325 => 89,  323 => 88,  319 => 87,  316 => 86,  295 => 83,  290 => 82,  273 => 81,  270 => 80,  267 => 79,  265 => 78,  261 => 76,  242 => 71,  233 => 69,  225 => 64,  217 => 63,  210 => 60,  193 => 59,  188 => 58,  185 => 57,  183 => 56,  178 => 53,  161 => 50,  152 => 49,  135 => 48,  131 => 46,  110 => 43,  105 => 42,  88 => 41,  84 => 39,  81 => 38,  79 => 37,  76 => 36,  66 => 33,  60 => 31,  58 => 30,  53 => 29,  48 => 28,  45 => 27,  39 => 24,  37 => 23,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/module/blog_posts.twig", "");
    }
}
