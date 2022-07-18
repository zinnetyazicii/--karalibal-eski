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

/* journal3/template/journal3/module/blog_comments.twig */
class __TwigTemplate_fdd6a70eef853ae01181850d2785aa17285734677988f0d90ab57c2a5d3eb6f3 extends \Twig\Template
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
        if (($context["items"] ?? null)) {
            // line 2
            echo "  <div class=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => ($context["classes"] ?? null)], "method", false, false, false, 2);
            echo "\">
    ";
            // line 3
            if (($context["title"] ?? null)) {
                // line 4
                echo "      <h3 class=\"title module-title\">";
                echo ($context["title"] ?? null);
                echo "</h3>
    ";
            }
            // line 6
            echo "    <div class=\"module-body\">
      ";
            // line 7
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 8
                echo "        <div class=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "classes", [], "any", false, false, false, 8)], "method", false, false, false, 8);
                echo "\">
          <a class=\"side-image\" href=\"";
                // line 9
                echo twig_get_attribute($this->env, $this->source, $context["item"], "href", [], "any", false, false, false, 9);
                echo "\">
            <img src=\"https://s.gravatar.com/avatar/";
                // line 10
                echo twig_get_attribute($this->env, $this->source, $context["item"], "avatar", [], "any", false, false, false, 10);
                echo "?s=";
                echo ($context["imageSize"] ?? null);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "subtitle", [], "any", false, false, false, 10);
                echo "\" width=\"";
                echo ($context["imageSize"] ?? null);
                echo "\" height=\"";
                echo ($context["imageSize"] ?? null);
                echo "\"/>
          </a>
          <div class=\"side-details\">
            <a class=\"side-title\" href=\"";
                // line 13
                echo twig_get_attribute($this->env, $this->source, $context["item"], "href", [], "any", false, false, false, 13);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 13);
                echo "</a>
            <div class=\"side-subtitle\">
              <span>";
                // line 15
                echo twig_get_attribute($this->env, $this->source, $context["item"], "subtitle", [], "any", false, false, false, 15);
                echo "</span>
            </div>
          </div>
        </div>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 20
            echo "    </div>
  </div>
";
        }
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/module/blog_comments.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  100 => 20,  89 => 15,  82 => 13,  68 => 10,  64 => 9,  59 => 8,  55 => 7,  52 => 6,  46 => 4,  44 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/module/blog_comments.twig", "");
    }
}
