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

/* journal3/template/journal3/module/links_menu.twig */
class __TwigTemplate_5203eac2f79032d3dd62faaed1fc5cbb0fe830850f682f9413f11e261006bb44 extends \Twig\Template
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
        // line 21
        $macros["self"] = $this->macros["self"] = $this;
        // line 22
        if (($context["items"] ?? null)) {
            // line 23
            echo "  <div class=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => ($context["classes"] ?? null)], "method", false, false, false, 23);
            echo "\">
    ";
            // line 24
            if (($context["title"] ?? null)) {
                // line 25
                echo "      <h3 class=\"title module-title\">";
                echo ($context["title"] ?? null);
                echo "</h3>
    ";
            }
            // line 27
            echo "    <ul class=\"module-body\">
      ";
            // line 28
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 29
                echo "        ";
                echo twig_call_macro($macros["self"], "macro_renderLinksMenu", [($context["j3"] ?? null), $context["item"]], 29, $context, $this->getSourceContext());
                echo "
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 31
            echo "    </ul>
  </div>
";
        }
    }

    // line 1
    public function macro_renderLinksMenu($__j3__ = null, $__item__ = null, $__display__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "j3" => $__j3__,
            "item" => $__item__,
            "display" => $__display__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 2
            echo "  ";
            $macros["self"] = $this;
            // line 3
            echo "  <li class=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "classes", [], "any", false, false, false, 3)], "method", false, false, false, 3);
            echo "\">
    ";
            // line 4
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 4), "href", [], "any", false, false, false, 4)) {
                // line 5
                echo "      <a href=\"";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 5), "href", [], "any", false, false, false, 5);
                echo "\" ";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "linkAttrs", [0 => twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 5)], "method", false, false, false, 5);
                echo ">
        ";
                // line 6
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "countBadge", [0 => twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "title", [], "any", false, false, false, 6), 1 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 6), "total", [], "any", false, false, false, 6), 2 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 6), "classes", [], "any", false, false, false, 6)], "method", false, false, false, 6);
                echo "
        ";
                // line 7
                if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "label", [], "any", false, false, false, 7)) {
                    // line 8
                    echo "          <span class=\"menu-label\">";
                    echo twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "label", [], "any", false, false, false, 8);
                    echo "</span>
        ";
                }
                // line 10
                echo "      </a>
    ";
            } else {
                // line 12
                echo "      <a>
        ";
                // line 13
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "countBadge", [0 => twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "title", [], "any", false, false, false, 13), 1 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 13), "total", [], "any", false, false, false, 13), 2 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 13), "classes", [], "any", false, false, false, 13)], "method", false, false, false, 13);
                echo "
        ";
                // line 14
                if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "label", [], "any", false, false, false, 14)) {
                    // line 15
                    echo "          <span class=\"menu-label\">";
                    echo twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "label", [], "any", false, false, false, 15);
                    echo "</span>
        ";
                }
                // line 17
                echo "      </a>
    ";
            }
            // line 19
            echo "  </li>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/module/links_menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  144 => 19,  140 => 17,  134 => 15,  132 => 14,  128 => 13,  125 => 12,  121 => 10,  115 => 8,  113 => 7,  109 => 6,  102 => 5,  100 => 4,  95 => 3,  92 => 2,  77 => 1,  70 => 31,  61 => 29,  57 => 28,  54 => 27,  48 => 25,  46 => 24,  41 => 23,  39 => 22,  37 => 21,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/module/links_menu.twig", "");
    }
}
