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

/* extension/advertise/google_connect.twig */
class __TwigTemplate_798b86406a255aef3f5a0a75d404b5517b445207da3a2589a320775cd2312977 extends \Twig\Template
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
        echo ($context["steps"] ?? null);
        echo "
        <div class=\"alert alert-info alert-dismissible\" role=\"alert\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"";
        // line 21
        echo ($context["text_close"] ?? null);
        echo "\"><span aria-hidden=\"true\"><i class=\"fa fa-close\"></i></span></button>
            <i class=\"fa fa-info-circle\" aria-hidden=\"true\"></i>&nbsp;";
        // line 22
        echo ($context["text_connect_intro"] ?? null);
        echo "
        </div>
        ";
        // line 24
        if (($context["success"] ?? null)) {
            // line 25
            echo "            <div class=\"alert alert-success alert-dismissible\" role=\"alert\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"";
            // line 26
            echo ($context["text_close"] ?? null);
            echo "\"><span aria-hidden=\"true\"><i class=\"fa fa-close\"></i></span></button>
                <i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i>&nbsp;";
            // line 27
            echo ($context["success"] ?? null);
            echo "
            </div>
        ";
        }
        // line 30
        echo "        ";
        if (($context["error"] ?? null)) {
            // line 31
            echo "            <div class=\"alert alert-danger alert-dismissible\" role=\"alert\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"";
            // line 32
            echo ($context["text_close"] ?? null);
            echo "\"><span aria-hidden=\"true\"><i class=\"fa fa-close\"></i></span></button>
                <i class=\"fa fa-exclamation-triangle\" aria-hidden=\"true\"></i>&nbsp;";
            // line 33
            echo ($context["error"] ?? null);
            echo "
            </div>
        ";
        }
        // line 36
        echo "        <div class=\"panel panel-default\">
            <div class=\"panel-heading\">
                <h3 class=\"panel-title\"><i class=\"fa fa-plug\"></i>&nbsp;<span>";
        // line 38
        echo ($context["text_panel_connect"] ?? null);
        echo "</span></h3>
            </div>
            <div class=\"panel-body\">
                <form action=\"";
        // line 41
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form\" class=\"form-horizontal\">
                    <fieldset>
                        <legend>";
        // line 43
        echo ($context["text_extension_settings"] ?? null);
        echo "</legend>
                        <div class=\"form-group\">
                            <label for=\"select-status\" class=\"col-sm-2 control-label\">";
        // line 45
        echo ($context["text_status"] ?? null);
        echo "</label>
                            <div class=\"col-sm-10\">
                                <select name=\"advertise_google_status\" id=\"select-status\" class=\"form-control\">
                                    <option value=\"1\" selected>";
        // line 48
        echo ($context["text_enabled"] ?? null);
        echo "</option>
                                    <option value=\"0\">";
        // line 49
        echo ($context["text_disabled"] ?? null);
        echo "</option>
                                </select>
                            </div>
                        </div>
                        <div class=\"form-group required\">
                            <label for=\"input-app-id\" class=\"col-sm-2 control-label\">";
        // line 54
        echo ($context["text_app_id"] ?? null);
        echo "</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" id=\"input-app-id\" class=\"form-control\" name=\"advertise_google_app_id\" autocomplete=\"off\" value=\"";
        // line 56
        echo ($context["advertise_google_app_id"] ?? null);
        echo "\" />
                                ";
        // line 57
        if (($context["error_app_id"] ?? null)) {
            // line 58
            echo "                                    <div class=\"text-danger\">";
            echo ($context["error_app_id"] ?? null);
            echo "</div>
                                ";
        }
        // line 60
        echo "                            </div>
                        </div>
                        <div class=\"form-group required\">
                            <label for=\"input-app-secret\" class=\"col-sm-2 control-label\">";
        // line 63
        echo ($context["text_app_secret"] ?? null);
        echo "</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" id=\"input-app-secret\" class=\"form-control\" name=\"advertise_google_app_secret\" autocomplete=\"off\" value=\"";
        // line 65
        echo ($context["advertise_google_app_secret"] ?? null);
        echo "\" />
                                ";
        // line 66
        if (($context["error_app_secret"] ?? null)) {
            // line 67
            echo "                                    <div class=\"text-danger\">";
            echo ($context["error_app_secret"] ?? null);
            echo "</div>
                                ";
        }
        // line 69
        echo "                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>";
        // line 73
        echo ($context["text_cron_settings"] ?? null);
        echo "</legend>
                        <div class=\"alert alert-info\"><i class=\"fa fa-info-circle\"></i> ";
        // line 74
        echo ($context["text_cron_info"] ?? null);
        echo "</div>
                        <div class=\"form-group\">
                            <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" data-original-title=\"";
        // line 76
        echo ($context["help_local_cron"] ?? null);
        echo "\">";
        echo ($context["text_local_cron"] ?? null);
        echo "</span></label>
                            <div class=\"col-sm-10\">
                                <input readonly type=\"text\" class=\"form-control\" value=\"";
        // line 78
        echo ($context["advertise_google_cron_command"] ?? null);
        echo "\" />
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" data-original-title=\"";
        // line 82
        echo ($context["help_remote_cron"] ?? null);
        echo "\">";
        echo ($context["text_remote_cron"] ?? null);
        echo "</span></label>
                            <div class=\"col-sm-10\">
                                <div class=\"input-group\">
                                    <input readonly type=\"text\" name=\"advertise_google_cron_url\" id=\"input_advertise_google_cron_url\" class=\"form-control\" value=\"\" />
                                    <div data-toggle=\"tooltip\" data-original-title=\"";
        // line 86
        echo ($context["text_refresh_token"] ?? null);
        echo "\" class=\"input-group-addon btn btn-primary\" id=\"refresh-cron-token\">
                                        <i class=\"fa fa-refresh\"></i>
                                    </div>
                                </div>
                                <input id=\"input_advertise_google_cron_token\" type=\"hidden\" name=\"advertise_google_cron_token\" value=\"";
        // line 90
        echo ($context["advertise_google_cron_token"] ?? null);
        echo "\" />
                            </div>
                        </div>
                        <div class=\"form-group required\">
                            <label class=\"col-sm-2 control-label\" for=\"checkbox_advertise_google_cron_acknowledge\">";
        // line 94
        echo ($context["entry_setup_confirmation"] ?? null);
        echo "</label>
                            <div class=\"col-sm-10\">
                                <label class=\"checkbox-inline\">
                                    <input id=\"checkbox_advertise_google_cron_acknowledge\" type=\"checkbox\" value=\"1\" ";
        // line 97
        if (($context["advertise_google_cron_acknowledge"] ?? null)) {
            echo " checked ";
        }
        echo " name=\"advertise_google_cron_acknowledge\" /> ";
        echo ($context["text_acknowledge_cron"] ?? null);
        echo "
                                </label>

                                ";
        // line 100
        if (($context["error_cron_acknowledge"] ?? null)) {
            // line 101
            echo "                                    <div class=\"text-danger\">";
            echo ($context["error_cron_acknowledge"] ?? null);
            echo "</div>
                                ";
        }
        // line 103
        echo "                            </div>
                        </div>
                        <div class=\"form-group\">
                            <label class=\"control-label col-sm-2\" for=\"dropdown_advertise_google_cron_email_status\"><span data-toggle=\"tooltip\" data-original-title=\"";
        // line 106
        echo ($context["help_cron_email_status"] ?? null);
        echo "\">";
        echo ($context["text_cron_email_status"] ?? null);
        echo "</span></label>
                            <div class=\"col-sm-10\">
                                <select id=\"dropdown_advertise_google_cron_email_status\" name=\"advertise_google_cron_email_status\" class=\"form-control\">
                                    <option value=\"1\" ";
        // line 109
        if ((($context["advertise_google_cron_email_status"] ?? null) == "1")) {
            echo " selected ";
        }
        echo ">";
        echo ($context["text_enabled"] ?? null);
        echo "</option>
                                    <option value=\"0\" ";
        // line 110
        if ((($context["advertise_google_cron_email_status"] ?? null) == "0")) {
            echo " selected ";
        }
        echo ">";
        echo ($context["text_disabled"] ?? null);
        echo "</option>
                                </select>
                            </div>
                        </div>
                        <div class=\"form-group required\">
                            <label class=\"col-sm-2 control-label\" for=\"input_advertise_google_cron_email\"><span data-toggle=\"tooltip\" data-original-title=\"";
        // line 115
        echo ($context["help_cron_email"] ?? null);
        echo "\">";
        echo ($context["text_cron_email"] ?? null);
        echo "</span></label>
                            <div class=\"col-sm-10\">
                                <input id=\"input_advertise_google_cron_email\" name=\"advertise_google_cron_email\" type=\"text\" class=\"form-control\" value=\"";
        // line 117
        echo ($context["advertise_google_cron_email"] ?? null);
        echo "\"/>
                                ";
        // line 118
        if (($context["error_cron_email"] ?? null)) {
            // line 119
            echo "                                    <div class=\"text-danger\">";
            echo ($context["error_cron_email"] ?? null);
            echo "</div>
                                ";
        }
        // line 121
        echo "                            </div>
                        </div>
                    </fieldset>
                    <div class=\"pull-right\">
                        <button type=\"submit\" class=\"btn btn-primary btn-block\" id=\"connect\">";
        // line 125
        echo ($context["button_connect"] ?? null);
        echo "</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type=\"text/javascript\">
(function(\$) {
    var selector = {
        save: '#connect',
        form: '#form'
    }

    var randomString = function() {
        return (Math.random() * 100).toString(16).replace('.', '');
    }

    var setCronUrl = function() {
        \$('#input_advertise_google_cron_url').val(
            \"";
        // line 145
        echo ($context["advertise_google_cron_url"] ?? null);
        echo "\".replace('{CRON_TOKEN}', \$('#input_advertise_google_cron_token').val())
        );
    }

    \$(document).on('click', selector.save, function(e) {
        e.preventDefault();
        e.stopPropagation();

        \$(selector.save).text('";
        // line 153
        echo ($context["text_connecting"] ?? null);
        echo "').attr('disabled', true);

        \$(selector.form).submit();
    });

    \$(document).ready(function() {
        setCronUrl();
    });

    \$('#refresh-cron-token').click(function() {
        \$('#input_advertise_google_cron_token').val(randomString() + randomString());
        setCronUrl();
    });
})(jQuery);
</script>
";
        // line 168
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "extension/advertise/google_connect.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  396 => 168,  378 => 153,  367 => 145,  344 => 125,  338 => 121,  332 => 119,  330 => 118,  326 => 117,  319 => 115,  307 => 110,  299 => 109,  291 => 106,  286 => 103,  280 => 101,  278 => 100,  268 => 97,  262 => 94,  255 => 90,  248 => 86,  239 => 82,  232 => 78,  225 => 76,  220 => 74,  216 => 73,  210 => 69,  204 => 67,  202 => 66,  198 => 65,  193 => 63,  188 => 60,  182 => 58,  180 => 57,  176 => 56,  171 => 54,  163 => 49,  159 => 48,  153 => 45,  148 => 43,  143 => 41,  137 => 38,  133 => 36,  127 => 33,  123 => 32,  120 => 31,  117 => 30,  111 => 27,  107 => 26,  104 => 25,  102 => 24,  97 => 22,  93 => 21,  88 => 19,  82 => 15,  71 => 13,  67 => 12,  62 => 10,  55 => 8,  49 => 7,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/advertise/google_connect.twig", "");
    }
}
