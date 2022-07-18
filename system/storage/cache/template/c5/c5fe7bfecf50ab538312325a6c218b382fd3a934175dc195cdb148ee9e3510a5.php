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

/* journal3/js.twig */
class __TwigTemplate_bc27e9f53cc4f61693103925ebf86d1636b001fba4e93f837ad98b4fe98813c5 extends \Twig\Template
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
        $context['_seq'] = twig_ensure_traversable(($context["data"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["value"]) {
            // line 2
            if (twig_test_iterable($context["value"])) {
                // line 3
                echo "window['_oc_";
                echo $context["key"];
                echo "'] = ";
                echo json_encode($context["value"]);
                echo ";
";
            } elseif (preg_match("/^\\d+\$/",             // line 4
$context["value"])) {
                // line 5
                echo "window['_oc_";
                echo $context["key"];
                echo "'] = ";
                echo $context["value"];
                echo ";
";
            } else {
                // line 7
                echo "window['_oc_";
                echo $context["key"];
                echo "'] = '";
                echo $context["value"];
                echo "';
";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 10
        echo "\$('html').addClass('oc3');
";
    }

    public function getTemplateName()
    {
        return "journal3/js.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 10,  60 => 7,  52 => 5,  50 => 4,  43 => 3,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/js.twig", "");
    }
}
