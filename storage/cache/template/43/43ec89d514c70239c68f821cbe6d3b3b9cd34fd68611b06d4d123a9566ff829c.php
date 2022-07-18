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

/* journal3/template/journal3/module/button.twig */
class __TwigTemplate_73eac6dbbefdf31d4d6c7bddd3b231452738171ecac89c0ff4074c76b9a97030 extends \Twig\Template
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
        echo "<div class=\"";
        echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => ($context["classes"] ?? null)], "method", false, false, false, 1);
        echo "\">
  ";
        // line 2
        if (twig_get_attribute($this->env, $this->source, ($context["link"] ?? null), "href", [], "any", false, false, false, 2)) {
            // line 3
            echo "    <a class=\"btn\" href=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["link"] ?? null), "href", [], "any", false, false, false, 3);
            echo "\" ";
            echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "linkAttrs", [0 => ($context["link"] ?? null)], "method", false, false, false, 3);
            echo ">";
            echo ($context["title"] ?? null);
            echo "</a>
  ";
        } else {
            // line 5
            echo "    <a class=\"btn\">";
            echo ($context["title"] ?? null);
            echo "</a>
  ";
        }
        // line 7
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/module/button.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 7,  54 => 5,  44 => 3,  42 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/module/button.twig", "");
    }
}
