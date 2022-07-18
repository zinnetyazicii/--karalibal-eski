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

/* extension/advertise/google_checklist.twig */
class __TwigTemplate_fe8e102255125b4941da4836785dce98628d5f48fd9d312447684e17be362639 extends \Twig\Template
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
";
        // line 2
        echo ($context["column_left"] ?? null);
        echo "
<div id=\"content\">
    <div class=\"page-header\">
        <div class=\"container-fluid\">
            <div class=\"pull-right\">
                <a href=\"";
        // line 7
        echo ($context["text_video_tutorial_url_install"] ?? null);
        echo "\" target=\"_blank\" class=\"btn btn-info\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_video_tutorial_install"] ?? null);
        echo "\"><i class=\"fa fa-video-camera\"></i></a>
                <a href=\"";
        // line 8
        echo ($context["cancel"] ?? null);
        echo "\" class=\"btn btn-default\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_cancel"] ?? null);
        echo "\"><i class=\"fa fa-reply\"></i></a>
            </div> 
            <h1>";
        // line 10
        echo ($context["heading_title"] ?? null);
        echo "</h1>
            <ul class=\"breadcrumb\">
                ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 13
            echo "                <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 13);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 13);
            echo "</a></li>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "            </ul>
        </div>
    </div>
    <div class=\"container-fluid\">
        ";
        // line 19
        if (($context["success"] ?? null)) {
            // line 20
            echo "            <div class=\"alert alert-success alert-dismissible\" role=\"alert\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"";
            // line 21
            echo ($context["text_close"] ?? null);
            echo "\"><span aria-hidden=\"true\"><i class=\"fa fa-close\"></i></span></button>
                <i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>&nbsp;";
            // line 22
            echo ($context["success"] ?? null);
            echo "
            </div>
        ";
        }
        // line 25
        echo "        ";
        if (($context["error"] ?? null)) {
            // line 26
            echo "            <div class=\"alert alert-danger alert-dismissible\" role=\"alert\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"";
            // line 27
            echo ($context["text_close"] ?? null);
            echo "\"><span aria-hidden=\"true\"><i class=\"fa fa-close\"></i></span></button>
                <i class=\"fa fa-exclamation-triangle\" aria-hidden=\"true\"></i>&nbsp;";
            // line 28
            echo ($context["error"] ?? null);
            echo "
            </div>
        ";
        }
        // line 31
        echo "        <div class=\"panel panel-default\">
            <div class=\"panel-heading\">
                <h3 class=\"panel-title\"><i class=\"fa fa-list-ol\"></i>&nbsp;<span>";
        // line 33
        echo ($context["text_panel_heading"] ?? null);
        echo "</span></h3>
            </div>
            <div class=\"panel-body\">
                <form action=\"";
        // line 36
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form\" class=\"form-horizontal\">
                    <input type=\"hidden\" name=\"advertise_google_checklist_confirmed\" value=\"1\" />

                    <div class=\"alert alert-info\">
                        ";
        // line 40
        echo ($context["text_checklist_intro"] ?? null);
        echo "
                    </div>

                    <div class=\"table-responsive\">
                        <table class=\"table table-bordered table-hover\">
                            <tbody>
                                <tr>
                                    <td class=\"text-center td-pointer\"><input type=\"checkbox\" name=\"acknowledge[0]\" /></td>
                                    <td class=\"text-left\">";
        // line 48
        echo ($context["text_checklist_acknowledge_0"] ?? null);
        echo "</td>
                                </tr>
                                <tr>
                                    <td class=\"text-center td-pointer\"><input type=\"checkbox\" name=\"acknowledge[1]\" /></td>
                                    <td class=\"text-left\">";
        // line 52
        echo ($context["text_checklist_acknowledge_1"] ?? null);
        echo "</td>
                                </tr>
                                <tr>
                                    <td class=\"text-center td-pointer\"><input type=\"checkbox\" name=\"acknowledge[2]\" /></td>
                                    <td class=\"text-left\">";
        // line 56
        echo ($context["text_checklist_acknowledge_2"] ?? null);
        echo "</td>
                                </tr>
                                <tr>
                                    <td class=\"text-center td-pointer\"><input type=\"checkbox\" name=\"acknowledge[3]\" /></td>
                                    <td class=\"text-left\">";
        // line 60
        echo ($context["text_checklist_acknowledge_3"] ?? null);
        echo "</td>
                                </tr>
                                <tr>
                                    <td class=\"text-center td-pointer\"><input type=\"checkbox\" name=\"acknowledge[4]\" /></td>
                                    <td class=\"text-left\">";
        // line 64
        echo ($context["text_checklist_acknowledge_4"] ?? null);
        echo "</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class=\"pull-right\">
                        <button type=\"submit\" class=\"btn btn-primary\">";
        // line 71
        echo ($context["button_proceed"] ?? null);
        echo "</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style type=\"text/css\">
    .td-pointer {
        cursor: pointer;
    }
</style>
<script type=\"text/javascript\">
(function(\$) {
    \$('input[name^=acknowledge]').change(function(e) {
        \$(this).closest('tr').toggleClass('success', \$(this).is(':checked'));

        \$('button[type=\"submit\"]').attr('disabled', \$('input[name^=acknowledge]:not(:checked)').length > 0);
    }).trigger('change');

    \$('input[name^=acknowledge]').closest('td').click(function(e) {
        if (\$(e.target).is('input')) {
            return;
        }

        var checkbox = \$(this).find('input[name^=acknowledge]').first();

        \$(checkbox).prop('checked', !\$(checkbox).prop('checked')).trigger('change');
    });
})(jQuery);
</script>
";
        // line 102
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "extension/advertise/google_checklist.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  219 => 102,  185 => 71,  175 => 64,  168 => 60,  161 => 56,  154 => 52,  147 => 48,  136 => 40,  129 => 36,  123 => 33,  119 => 31,  113 => 28,  109 => 27,  106 => 26,  103 => 25,  97 => 22,  93 => 21,  90 => 20,  88 => 19,  82 => 15,  71 => 13,  67 => 12,  62 => 10,  55 => 8,  49 => 7,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/advertise/google_checklist.twig", "");
    }
}
