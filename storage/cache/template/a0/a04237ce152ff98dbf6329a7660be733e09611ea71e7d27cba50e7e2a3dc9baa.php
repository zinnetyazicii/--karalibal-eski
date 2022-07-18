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

/* customer/customer_approval_list.twig */
class __TwigTemplate_793326c6b0cf1f8f353c3fcd5111269460770b8a840d637ca8e90837d2b7bdfb extends \Twig\Template
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
        echo "<div class=\"table-responsive\">
  <table class=\"table table-bordered table-hover\">
    <thead>
      <tr>
        <td class=\"text-left\">";
        // line 5
        echo ($context["column_name"] ?? null);
        echo "</td>
        <td class=\"text-left\">";
        // line 6
        echo ($context["column_email"] ?? null);
        echo "</td>
        <td class=\"text-left\">";
        // line 7
        echo ($context["column_customer_group"] ?? null);
        echo "</td>
        <td class=\"text-left\">";
        // line 8
        echo ($context["column_type"] ?? null);
        echo "</td>
        <td class=\"text-left\">";
        // line 9
        echo ($context["column_date_added"] ?? null);
        echo "</td>
        <td class=\"text-right\">";
        // line 10
        echo ($context["column_action"] ?? null);
        echo "</td>
      </tr>
    </thead>
    <tbody>
    ";
        // line 14
        if (($context["customer_approvals"] ?? null)) {
            // line 15
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["customer_approvals"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["customer_approval"]) {
                // line 16
                echo "    <tr>
      <td class=\"text-left\">";
                // line 17
                echo twig_get_attribute($this->env, $this->source, $context["customer_approval"], "name", [], "any", false, false, false, 17);
                echo "</td>
      <td class=\"text-left\">";
                // line 18
                echo twig_get_attribute($this->env, $this->source, $context["customer_approval"], "email", [], "any", false, false, false, 18);
                echo "</td>
      <td class=\"text-left\">";
                // line 19
                echo twig_get_attribute($this->env, $this->source, $context["customer_approval"], "customer_group", [], "any", false, false, false, 19);
                echo "</td>
      <td class=\"text-left\">";
                // line 20
                echo twig_get_attribute($this->env, $this->source, $context["customer_approval"], "type", [], "any", false, false, false, 20);
                echo "</td>
      <td class=\"text-left\">";
                // line 21
                echo twig_get_attribute($this->env, $this->source, $context["customer_approval"], "date_added", [], "any", false, false, false, 21);
                echo "</td>
      <td class=\"text-right\"><a href=\"";
                // line 22
                echo twig_get_attribute($this->env, $this->source, $context["customer_approval"], "approve", [], "any", false, false, false, 22);
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_approve"] ?? null);
                echo "\" class=\"btn btn-success\"><i class=\"fa fa-thumbs-o-up\"></i></a> <a href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["customer_approval"], "deny", [], "any", false, false, false, 22);
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_deny"] ?? null);
                echo "\" class=\"btn btn-danger\"><i class=\"fa fa-thumbs-o-down\"></i></a> <a href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["customer_approval"], "edit", [], "any", false, false, false, 22);
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_edit"] ?? null);
                echo "\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i></a></td>
    </tr>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['customer_approval'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 25
            echo "    ";
        } else {
            // line 26
            echo "    <tr>
      <td class=\"text-center\" colspan=\"6\">";
            // line 27
            echo ($context["text_no_results"] ?? null);
            echo "</td>
    </tr>
    ";
        }
        // line 30
        echo "    </tbody>
  </table>
</div>
<div class=\"row\">
  <div class=\"col-sm-6 text-left\">";
        // line 34
        echo ($context["pagination"] ?? null);
        echo "</div>
  <div class=\"col-sm-6 text-right\">";
        // line 35
        echo ($context["results"] ?? null);
        echo "</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "customer/customer_approval_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  141 => 35,  137 => 34,  131 => 30,  125 => 27,  122 => 26,  119 => 25,  100 => 22,  96 => 21,  92 => 20,  88 => 19,  84 => 18,  80 => 17,  77 => 16,  72 => 15,  70 => 14,  63 => 10,  59 => 9,  55 => 8,  51 => 7,  47 => 6,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "customer/customer_approval_list.twig", "");
    }
}
