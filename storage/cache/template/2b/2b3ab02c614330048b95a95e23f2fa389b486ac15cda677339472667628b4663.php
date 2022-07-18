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

/* journal3/template/journal3/side_posts.twig */
class __TwigTemplate_cee9d45b22f3e5b9d46e0f024bbb03c75cc68615fb007b9878c9455ee894ae3f extends \Twig\Template
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
        $context['_seq'] = twig_ensure_traversable(($context["posts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
            // line 2
            echo "  <div class=\"post-layout ";
            echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["post"], "classes", [], "any", false, false, false, 2)], "method", false, false, false, 2);
            echo "\">
    <div class=\"post-thumb\">
      <div class=\"image\">
        <a href=\"";
            // line 5
            echo twig_get_attribute($this->env, $this->source, $context["post"], "href", [], "any", false, false, false, 5);
            echo "\">
          ";
            // line 6
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 6), "get", [0 => "performanceLazyLoadImagesStatus"], "method", false, false, false, 6)) {
                // line 7
                echo "            <img src=\"";
                echo ($context["dummy_image"] ?? null);
                echo "\" data-src=\"";
                echo twig_get_attribute($this->env, $this->source, $context["post"], "thumb", [], "any", false, false, false, 7);
                echo "\" ";
                if (twig_get_attribute($this->env, $this->source, $context["post"], "thumb2x", [], "any", false, false, false, 7)) {
                    echo "data-srcset=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["post"], "thumb", [], "any", false, false, false, 7);
                    echo " 1x, ";
                    echo twig_get_attribute($this->env, $this->source, $context["post"], "thumb2x", [], "any", false, false, false, 7);
                    echo " 2x\" ";
                }
                echo " width=\"";
                echo ($context["image_width"] ?? null);
                echo "\" height=\"";
                echo ($context["image_height"] ?? null);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["post"], "name", [], "any", false, false, false, 7);
                echo "\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["post"], "name", [], "any", false, false, false, 7);
                echo "\" class=\"img-responsive lazyload\"/>
          ";
            } else {
                // line 9
                echo "            <img src=\"";
                echo twig_get_attribute($this->env, $this->source, $context["post"], "thumb", [], "any", false, false, false, 9);
                echo "\" ";
                if (twig_get_attribute($this->env, $this->source, $context["post"], "thumb2x", [], "any", false, false, false, 9)) {
                    echo "data-srcset=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["post"], "thumb", [], "any", false, false, false, 9);
                    echo " 1x, ";
                    echo twig_get_attribute($this->env, $this->source, $context["post"], "thumb2x", [], "any", false, false, false, 9);
                    echo " 2x\" ";
                }
                echo " width=\"";
                echo ($context["image_width"] ?? null);
                echo "\" height=\"";
                echo ($context["image_height"] ?? null);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["post"], "name", [], "any", false, false, false, 9);
                echo "\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["post"], "name", [], "any", false, false, false, 9);
                echo "\" class=\"img-responsive\"/>
          ";
            }
            // line 11
            echo "        </a>
      </div>

      <div class=\"caption\">

        <div class=\"name\"><a href=\"";
            // line 16
            echo twig_get_attribute($this->env, $this->source, $context["post"], "href", [], "any", false, false, false, 16);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["post"], "name", [], "any", false, false, false, 16);
            echo "</a></div>

        <div class=\"post-stats\">
          <span class=\"p-date\">";
            // line 19
            echo twig_get_attribute($this->env, $this->source, $context["post"], "date", [], "any", false, false, false, 19);
            echo "</span>
          <span class=\"p-comment\">";
            // line 20
            echo twig_get_attribute($this->env, $this->source, $context["post"], "comments", [], "any", false, false, false, 20);
            echo "</span>
        </div>

      </div>
    </div>
  </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/side_posts.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  119 => 20,  115 => 19,  107 => 16,  100 => 11,  78 => 9,  54 => 7,  52 => 6,  48 => 5,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/side_posts.twig", "C:\\wamp64\\www\\catalog\\view\\theme\\journal3\\template\\journal3\\side_posts.twig");
    }
}
