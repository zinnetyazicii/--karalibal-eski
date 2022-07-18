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

/* journal3/template/journal3/blog/feed.twig */
class __TwigTemplate_403ec6674b18b74a5089c095fc1a343cd0d86cf7635a3a7d48f3a7f3d49904dd extends \Twig\Template
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
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
<rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\">
  <channel>
    <atom:link href=\"";
        // line 4
        echo ($context["feed_link"] ?? null);
        echo "\" rel=\"self\" type=\"application/rss+xml\"/>
    <title>";
        // line 5
        echo ($context["title"] ?? null);
        echo "</title>
    <link>";
        // line 6
        echo ($context["blog_link"] ?? null);
        echo "</link>
    <description>";
        // line 7
        echo ($context["meta_description"] ?? null);
        echo "</description>

    ";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["posts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
            // line 10
            echo "      <item>
        <title>";
            // line 11
            echo twig_get_attribute($this->env, $this->source, $context["post"], "name", [], "any", false, false, false, 11);
            echo "</title>
        ";
            // line 12
            if (twig_get_attribute($this->env, $this->source, $context["post"], "author", [], "any", false, false, false, 12)) {
                // line 13
                echo "          <author>";
                echo twig_get_attribute($this->env, $this->source, $context["post"], "author", [], "any", false, false, false, 13);
                echo "</author>
        ";
            }
            // line 15
            echo "        <pubDate>";
            echo twig_get_attribute($this->env, $this->source, $context["post"], "date", [], "any", false, false, false, 15);
            echo "</pubDate>
        <link>";
            // line 16
            echo twig_get_attribute($this->env, $this->source, $context["post"], "href", [], "any", false, false, false, 16);
            echo "</link>
        <guid>";
            // line 17
            echo twig_get_attribute($this->env, $this->source, $context["post"], "href", [], "any", false, false, false, 17);
            echo "</guid>
        <description>
          <![CDATA[
          ";
            // line 20
            if (twig_get_attribute($this->env, $this->source, $context["post"], "thumb", [], "any", false, false, false, 20)) {
                // line 21
                echo "            <p><img src=\"";
                echo twig_get_attribute($this->env, $this->source, $context["post"], "thumb", [], "any", false, false, false, 21);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["post"], "name", [], "any", false, false, false, 21);
                echo "\"/></p>
          ";
            }
            // line 23
            echo "          ";
            echo twig_get_attribute($this->env, $this->source, $context["post"], "description", [], "any", false, false, false, 23);
            echo "
          <a href=\"";
            // line 24
            echo twig_get_attribute($this->env, $this->source, $context["post"], "href", [], "any", false, false, false, 24);
            echo "\">Read More</a>
          ]]>
        </description>
      </item>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "
  </channel>
</rss>
";
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/blog/feed.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  119 => 29,  108 => 24,  103 => 23,  95 => 21,  93 => 20,  87 => 17,  83 => 16,  78 => 15,  72 => 13,  70 => 12,  66 => 11,  63 => 10,  59 => 9,  54 => 7,  50 => 6,  46 => 5,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/blog/feed.twig", "");
    }
}
