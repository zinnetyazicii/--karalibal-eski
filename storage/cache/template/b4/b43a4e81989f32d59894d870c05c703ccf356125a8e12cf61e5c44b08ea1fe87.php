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

/* journal3/template/journal3/module/header_notice.twig */
class __TwigTemplate_bcd10a6ea3d2bcaeb6d9faa2204e6bf8711cd81393dec010925d4fb9cf4b8434 extends \Twig\Template
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
        echo "<div class=\"notice-module ";
        echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => ($context["classes"] ?? null)], "method", false, false, false, 1);
        echo "\" data-options='";
        echo json_encode(($context["options"] ?? null));
        echo "'>
  <div class=\"module-body\">
    <div class=\"hn-body\">
      <div class=\"hn-content\">";
        // line 4
        echo ($context["content"] ?? null);
        echo "</div>
    </div>
    ";
        // line 6
        if (($context["closeButton"] ?? null)) {
            // line 7
            echo "      <div class=\"header-notice-close-button\">
        ";
            // line 8
            if (twig_get_attribute($this->env, $this->source, ($context["closeLink"] ?? null), "href", [], "any", false, false, false, 8)) {
                // line 9
                echo "          <a class=\"btn hn-close\" href=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["closeLink"] ?? null), "href", [], "any", false, false, false, 9);
                echo "\" ";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "linkAttrs", [0 => ($context["closeLink"] ?? null)], "method", false, false, false, 9);
                echo ">
            ";
                // line 10
                if (($context["closeText"] ?? null)) {
                    // line 11
                    echo "              <span class=\"btn-text\">";
                    echo ($context["closeText"] ?? null);
                    echo "</span>
            ";
                }
                // line 13
                echo "          </a>
        ";
            } else {
                // line 15
                echo "          <button class=\"btn hn-close\">
            ";
                // line 16
                if (($context["closeText"] ?? null)) {
                    // line 17
                    echo "              <span class=\"btn-text\">";
                    echo ($context["closeText"] ?? null);
                    echo "</span>
            ";
                }
                // line 19
                echo "          </button>
        ";
            }
            // line 21
            echo "      </div>
    ";
        }
        // line 23
        echo "  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/module/header_notice.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 23,  92 => 21,  88 => 19,  82 => 17,  80 => 16,  77 => 15,  73 => 13,  67 => 11,  65 => 10,  58 => 9,  56 => 8,  53 => 7,  51 => 6,  46 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/module/header_notice.twig", "");
    }
}
