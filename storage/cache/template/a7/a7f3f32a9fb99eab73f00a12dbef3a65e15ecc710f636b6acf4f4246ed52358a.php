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

/* journal3/template/journal3/module/newsletter.twig */
class __TwigTemplate_0f6f0b0ab0a2c005f6b3dd801d4e5e373cb83eb28173914fb3e518cdc71b57d8 extends \Twig\Template
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
        if (($context["title"] ?? null)) {
            // line 3
            echo "    <h3 class=\"title module-title\">";
            echo ($context["title"] ?? null);
            echo "</h3>
  ";
        }
        // line 5
        echo "  <div class=\"module-body\">
    ";
        // line 6
        if (($context["text"] ?? null)) {
            // line 7
            echo "      <div class=\"newsletter-text\">";
            echo ($context["text"] ?? null);
            echo "</div>
    ";
        }
        // line 9
        echo "    <div class=\"newsletter-form\">
      <form action=\"";
        // line 10
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" class=\"form-horizontal\">
        <div class=\"input-group\">
          <input type=\"text\" name=\"email\" placeholder=\"";
        // line 12
        echo ($context["placeholder"] ?? null);
        echo "\" class=\"form-control newsletter-email\"/>
          <span class=\"input-group-btn\">
              <button type=\"submit\" class=\"btn btn-primary\" ";
        // line 14
        if (((($context["buttonType"] ?? null) == "icon") && ($context["tooltipStatus"] ?? null))) {
            echo "data-toggle=\"tooltip\" data-tooltip-class=\"newsletter-tooltip-";
            echo ($context["module_id"] ?? null);
            echo "\" data-placement=\"";
            echo ($context["tooltipPosition"] ?? null);
            echo "\" title=\"";
            echo ($context["tooltipText"] ?? null);
            echo "\"";
        }
        echo " data-loading-text=\"<span>";
        echo ($context["buttonText"] ?? null);
        echo "</span>\"><span>";
        echo ($context["buttonText"] ?? null);
        echo "</span></button>
            </span>
        </div>
        ";
        // line 17
        if (($context["captcha"] ?? null)) {
            // line 18
            echo "        <div class=\"input-captcha\">";
            echo ($context["captcha"] ?? null);
            echo "</div>
        ";
        }
        // line 20
        echo "        ";
        if (($context["agree_data"] ?? null)) {
            // line 21
            echo "          <div class=\"checkbox\">
            <label>
              <input type=\"checkbox\" name=\"agree\" value=\"1\"/>
              ";
            // line 24
            echo twig_get_attribute($this->env, $this->source, ($context["agree_data"] ?? null), "text", [], "any", false, false, false, 24);
            echo "
            </label>
          </div>
        ";
        }
        // line 28
        echo "      </form>
    </div>
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/module/newsletter.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  115 => 28,  108 => 24,  103 => 21,  100 => 20,  94 => 18,  92 => 17,  74 => 14,  69 => 12,  64 => 10,  61 => 9,  55 => 7,  53 => 6,  50 => 5,  44 => 3,  42 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/module/newsletter.twig", "");
    }
}
