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

/* journal3/template/journal3/module/accordion_menu.twig */
class __TwigTemplate_a7c0ec2b714befe2d1b5dabfc38c013ec8f566b47279d400b031c86da7ed6afc extends \Twig\Template
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
        // line 39
        $macros["self"] = $this->macros["self"] = $this;
        // line 40
        echo "<div class=\"";
        echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => ($context["classes"] ?? null)], "method", false, false, false, 40);
        echo "\">
  ";
        // line 41
        if (($context["title"] ?? null)) {
            // line 42
            echo "    <h3 class=\"title module-title\">";
            echo ($context["title"] ?? null);
            echo "</h3>
  ";
        }
        // line 44
        echo "  <ul class=\"j-menu\">
    ";
        // line 45
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 46
            echo "      ";
            echo twig_call_macro($macros["self"], "macro_renderAccordionMenu", [($context["j3"] ?? null), $context["item"]], 46, $context, $this->getSourceContext());
            echo "
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 48
        echo "  </ul>
</div>
";
    }

    // line 1
    public function macro_renderAccordionMenu($__j3__ = null, $__item__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "j3" => $__j3__,
            "item" => $__item__,
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
            echo twig_replace_filter(twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "classes", [], "any", false, false, false, 3)], "method", false, false, false, 3), ["dropdown" => ""]);
            echo "\">
    ";
            // line 4
            $context["id"] = twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "uniqueId", [0 => "collapse-"], "method", false, false, false, 4);
            // line 5
            echo "    ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 5), "href", [], "any", false, false, false, 5)) {
                // line 6
                echo "      <a href=\"";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 6), "href", [], "any", false, false, false, 6);
                echo "\" ";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "linkAttrs", [0 => twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 6)], "method", false, false, false, 6);
                echo ">
        ";
                // line 7
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "countBadge", [0 => twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "title", [], "any", false, false, false, 7), 1 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 7), "total", [], "any", false, false, false, 7), 2 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 7), "classes", [], "any", false, false, false, 7)], "method", false, false, false, 7);
                echo "
        ";
                // line 8
                if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "items", [], "any", false, false, false, 8)) {
                    // line 9
                    echo "          ";
                    if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isOpen", [], "any", false, false, false, 9)) {
                        // line 10
                        echo "            <span class=\"open-menu\" data-toggle=\"collapse\" data-target=\"#";
                        echo ($context["id"] ?? null);
                        echo "\" aria-expanded=\"true\" role=\"heading\"><i class=\"fa fa-plus\"></i></span>
          ";
                    } else {
                        // line 12
                        echo "            <span class=\"open-menu collapsed\" data-toggle=\"collapse\" data-target=\"#";
                        echo ($context["id"] ?? null);
                        echo "\" role=\"heading\"><i class=\"fa fa-plus\"></i></span>
          ";
                    }
                    // line 14
                    echo "        ";
                }
                // line 15
                echo "      </a>
    ";
            } else {
                // line 17
                echo "      <a>
        ";
                // line 18
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "countBadge", [0 => twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "title", [], "any", false, false, false, 18), 1 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 18), "total", [], "any", false, false, false, 18), 2 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 18), "classes", [], "any", false, false, false, 18)], "method", false, false, false, 18);
                echo "
        ";
                // line 19
                if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "items", [], "any", false, false, false, 19)) {
                    // line 20
                    echo "          ";
                    if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isOpen", [], "any", false, false, false, 20)) {
                        // line 21
                        echo "            <span class=\"open-menu\" data-toggle=\"collapse\" data-target=\"#";
                        echo ($context["id"] ?? null);
                        echo "\" aria-expanded=\"true\" role=\"heading\"><i class=\"fa fa-plus\"></i></span>
          ";
                    } else {
                        // line 23
                        echo "            <span class=\"open-menu collapsed\" data-toggle=\"collapse\" data-target=\"#";
                        echo ($context["id"] ?? null);
                        echo "\" role=\"heading\"><i class=\"fa fa-plus\"></i></span>
          ";
                    }
                    // line 25
                    echo "        ";
                }
                // line 26
                echo "      </a>
    ";
            }
            // line 28
            echo "    ";
            if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "items", [], "any", false, false, false, 28)) {
                // line 29
                echo "      <div class=\"collapse ";
                if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "isOpen", [], "any", false, false, false, 29)) {
                    echo "in";
                }
                echo "\" id=\"";
                echo ($context["id"] ?? null);
                echo "\">
        <ul class=\"j-menu\">
          ";
                // line 31
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "items", [], "any", false, false, false, 31));
                foreach ($context['_seq'] as $context["_key"] => $context["subitem"]) {
                    // line 32
                    echo "            ";
                    echo twig_call_macro($macros["self"], "macro_renderAccordionMenu", [($context["j3"] ?? null), $context["subitem"]], 32, $context, $this->getSourceContext());
                    echo "
          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subitem'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 34
                echo "        </ul>
      </div>
    ";
            }
            // line 37
            echo "  </li>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/module/accordion_menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  198 => 37,  193 => 34,  184 => 32,  180 => 31,  170 => 29,  167 => 28,  163 => 26,  160 => 25,  154 => 23,  148 => 21,  145 => 20,  143 => 19,  139 => 18,  136 => 17,  132 => 15,  129 => 14,  123 => 12,  117 => 10,  114 => 9,  112 => 8,  108 => 7,  101 => 6,  98 => 5,  96 => 4,  91 => 3,  88 => 2,  74 => 1,  68 => 48,  59 => 46,  55 => 45,  52 => 44,  46 => 42,  44 => 41,  39 => 40,  37 => 39,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/module/accordion_menu.twig", "");
    }
}
