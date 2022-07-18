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

/* extension/advertise/google_steps.twig */
class __TwigTemplate_0cc1d68373cf800a69723dcc77120090097c4850eb01eee5382a2d3f3ed32a7f extends \Twig\Template
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
        echo "<div class=\"stepper\">
    <input class=\"stepper__input\" id=\"stepper-3-0\" name=\"stepper-3\" type=\"radio\" ";
        // line 2
        echo (((($context["current_step"] ?? null) >= 1)) ? ("checked") : (""));
        echo "/>
    <div class=\"stepper__step\">
        <label class=\"stepper__button\">";
        // line 4
        echo ($context["step_connect"] ?? null);
        echo "</label>
    </div>
    <input class=\"stepper__input\" id=\"stepper-3-1\" name=\"stepper-3\" type=\"radio\" ";
        // line 6
        echo (((($context["current_step"] ?? null) >= 2)) ? ("checked") : (""));
        echo "/>
    <div class=\"stepper__step\">
        <label class=\"stepper__button\">";
        // line 8
        echo ($context["step_merchant_account"] ?? null);
        echo "</label>
    </div>
    <input class=\"stepper__input\" id=\"stepper-3-2\" name=\"stepper-3\" type=\"radio\" ";
        // line 10
        echo (((($context["current_step"] ?? null) >= 3)) ? ("checked") : (""));
        echo "/>
    <div class=\"stepper__step\">
        <label class=\"stepper__button\">";
        // line 12
        echo ($context["step_campaigns"] ?? null);
        echo "</label>
    </div>
    <input class=\"stepper__input\" id=\"stepper-3-3\" name=\"stepper-3\" type=\"radio\" ";
        // line 14
        echo (((($context["current_step"] ?? null) >= 4)) ? ("checked") : (""));
        echo "/>
    <div class=\"stepper__step\">
        <label class=\"stepper__button\">";
        // line 16
        echo ($context["step_shipping_taxes"] ?? null);
        echo "</label>
    </div>
    <input class=\"stepper__input\" id=\"stepper-3-4\" name=\"stepper-3\" type=\"radio\" ";
        // line 18
        echo (((($context["current_step"] ?? null) >= 5)) ? ("checked") : (""));
        echo "/>
    <div class=\"stepper__step\">
        <label class=\"stepper__button\">";
        // line 20
        echo ($context["step_mapping"] ?? null);
        echo "</label>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "extension/advertise/google_steps.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  85 => 20,  80 => 18,  75 => 16,  70 => 14,  65 => 12,  60 => 10,  55 => 8,  50 => 6,  45 => 4,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/advertise/google_steps.twig", "");
    }
}
