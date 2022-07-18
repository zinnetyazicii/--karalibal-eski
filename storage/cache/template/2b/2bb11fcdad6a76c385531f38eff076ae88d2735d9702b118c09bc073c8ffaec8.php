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

/* journal3/template/journal3/blog/posts.twig */
class __TwigTemplate_4b7e7405b6fe42557f4a11291d43f9515a1f7a544ed4c45dd40bef0ab83cc147 extends \Twig\Template
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
        echo ($context["header"] ?? null);
        echo "
<ul class=\"breadcrumb\">
  ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 4
            echo "  <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 4);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 4);
            echo "</a></li>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 6
        echo "</ul>
";
        // line 7
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 7), "get", [0 => "pageTitlePosition"], "method", false, false, false, 7) == "top")) {
            // line 8
            echo "  <h1 class=\"title page-title\">
    <span >
      ";
            // line 10
            echo ($context["heading_title"] ?? null);
            echo "
      ";
            // line 11
            if (($context["feed_url"] ?? null)) {
                // line 12
                echo "        <a class=\"blog-feed\" href=\"";
                echo ($context["feed_url"] ?? null);
                echo "\" target=\"_blank\"><span class=\"feed-text\">";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 12), "get", [0 => "blogFeedText"], "method", false, false, false, 12);
                echo "</span></a>
      ";
            }
            // line 14
            echo "    </span>
  </h1>
";
        }
        // line 17
        echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "loadController", [0 => "journal3/layout", 1 => "top"], "method", false, false, false, 17);
        echo "
<div class=\"container blog-home\">
  <div class=\"row\">";
        // line 19
        echo ($context["column_left"] ?? null);
        echo "
    <div id=\"content\">
      ";
        // line 21
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 21), "get", [0 => "pageTitlePosition"], "method", false, false, false, 21) == "default")) {
            // line 22
            echo "        <h1 class=\"title page-title\">
          ";
            // line 23
            echo ($context["heading_title"] ?? null);
            echo "
          ";
            // line 24
            if (($context["feed_url"] ?? null)) {
                // line 25
                echo "            <a class=\"blog-feed\" href=\"";
                echo ($context["feed_url"] ?? null);
                echo "\" target=\"_blank\"><span class=\"feed-text\">";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 25), "get", [0 => "blogFeedText"], "method", false, false, false, 25);
                echo "</span></a>
          ";
            }
            // line 27
            echo "        </h1>
      ";
        }
        // line 29
        echo "      ";
        echo ($context["content_top"] ?? null);
        echo "
      ";
        // line 30
        if (($context["category_description"] ?? null)) {
            // line 31
            echo "      <div class=\"category-description\">";
            echo ($context["category_description"] ?? null);
            echo "</div>
      ";
        }
        // line 33
        echo "      ";
        if (($context["posts"] ?? null)) {
            // line 34
            echo "        <div class=\"main-posts post-";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 34), "get", [0 => "globalPostView"], "method", false, false, false, 34);
            echo "\">
          ";
            // line 35
            $this->loadTemplate("journal3/template/journal3/post_grid.twig", "journal3/template/journal3/blog/posts.twig", 35)->display($context);
            // line 36
            echo "        </div>
        <div class=\"row pagination-results\">
          <div class=\"col-sm-6 text-left\">";
            // line 38
            echo ($context["pagination"] ?? null);
            echo "</div>
          <div class=\"col-sm-6 text-right\">";
            // line 39
            echo ($context["results"] ?? null);
            echo "</div>
        </div>
      ";
        } else {
            // line 42
            echo "        <p>";
            echo ($context["text_empty"] ?? null);
            echo "</p>
        <div class=\"buttons\">
          <div class=\"pull-right\"><a href=\"";
            // line 44
            echo ($context["continue"] ?? null);
            echo "\" class=\"btn btn-primary\">";
            echo ($context["button_continue"] ?? null);
            echo "</a></div>
        </div>
      ";
        }
        // line 47
        echo "      ";
        echo ($context["content_bottom"] ?? null);
        echo "</div>
    ";
        // line 48
        echo ($context["column_right"] ?? null);
        echo "</div>
</div>
";
        // line 50
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/blog/posts.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  179 => 50,  174 => 48,  169 => 47,  161 => 44,  155 => 42,  149 => 39,  145 => 38,  141 => 36,  139 => 35,  134 => 34,  131 => 33,  125 => 31,  123 => 30,  118 => 29,  114 => 27,  106 => 25,  104 => 24,  100 => 23,  97 => 22,  95 => 21,  90 => 19,  85 => 17,  80 => 14,  72 => 12,  70 => 11,  66 => 10,  62 => 8,  60 => 7,  57 => 6,  46 => 4,  42 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/blog/posts.twig", "");
    }
}
