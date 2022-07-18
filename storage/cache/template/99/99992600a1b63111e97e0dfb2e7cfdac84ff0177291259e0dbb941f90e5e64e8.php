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

/* journal3/template/journal3/module/popup.twig */
class __TwigTemplate_242ff80311cabf282886c59e2542b88144851a13b8008fc49102cf7a6245a3af extends \Twig\Template
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
        if (($context["iframe"] ?? null)) {
            // line 2
            echo "  ";
            if ((($context["contentType"] ?? null) == "image")) {
                // line 3
                echo "    <div class=\"popup-content\">
      <img src=\"";
                // line 4
                echo ($context["image"] ?? null);
                echo "\" alt=\"\" width=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["imageDimensions"] ?? null), "width", [], "any", false, false, false, 4);
                echo "\" height=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["imageDimensions"] ?? null), "height", [], "any", false, false, false, 4);
                echo "\"/>
    </div>
  ";
            } elseif ((            // line 6
($context["contentType"] ?? null) == "text")) {
                // line 7
                echo "    <div class=\"popup-content\">
      ";
                // line 8
                echo ($context["text"] ?? null);
                echo "
    </div>
  ";
            } else {
                // line 11
                echo "    ";
                echo ($context["content"] ?? null);
                echo "
  ";
            }
        } else {
            // line 14
            echo "  <div class=\"popup-wrapper ";
            echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => ($context["classes"] ?? null)], "method", false, false, false, 14);
            echo "\" data-options='";
            echo json_encode(($context["options"] ?? null));
            echo "'>
    <div class=\"popup-container\">
      ";
            // line 16
            if (($context["closeButton"] ?? null)) {
                // line 17
                echo "        <button class=\"btn popup-close\"></button>
      ";
            }
            // line 19
            echo "      <div class=\"popup-body\">
        <div class=\"popup-inner-body\">
          ";
            // line 21
            if (($context["headerText"] ?? null)) {
                // line 22
                echo "            <div class=\"title popup-header\">";
                echo ($context["headerText"] ?? null);
                echo "</div>
          ";
            }
            // line 24
            echo "          ";
            if ((($context["ajax"] ?? null) && (($context["contentType"] ?? null) == "grid"))) {
                // line 25
                echo "            <div class=\"journal-loading\"><i class=\"fa fa-spinner fa-spin\"></i></div>
            <iframe src=\"index.php?route=journal3/popup/page&module_id=";
                // line 26
                echo ($context["module_id"] ?? null);
                echo "&popup=module\" width=\"100%\" height=\"100%\" frameborder=\"0\" onload=\"this.height = this.contentWindow.document.querySelector('.site-wrapper').offsetHeight; \$(this).prev('.journal-loading').hide();\"></iframe>
          ";
            } elseif ((            // line 27
($context["contentType"] ?? null) == "image")) {
                // line 28
                echo "            <div class=\"popup-content\">
              <img src=\"";
                // line 29
                echo ($context["image"] ?? null);
                echo "\" alt=\"\" width=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["imageDimensions"] ?? null), "width", [], "any", false, false, false, 29);
                echo "\" height=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["imageDimensions"] ?? null), "height", [], "any", false, false, false, 29);
                echo "\"/>
            </div>
          ";
            } elseif ((            // line 31
($context["contentType"] ?? null) == "text")) {
                // line 32
                echo "            <div class=\"popup-content\">
              ";
                // line 33
                echo ($context["text"] ?? null);
                echo "
            </div>
          ";
            } else {
                // line 36
                echo "            ";
                echo ($context["content"] ?? null);
                echo "
          ";
            }
            // line 38
            echo "
          ";
            // line 39
            if (($context["footer"] ?? null)) {
                // line 40
                echo "            <div class=\"popup-footer\">
              ";
                // line 41
                if ((($context["button1"] ?? null) || ($context["button2"] ?? null))) {
                    // line 42
                    echo "                <div class=\"popup-buttons\">
                  ";
                    // line 43
                    if (($context["button1"] ?? null)) {
                        // line 44
                        echo "                    <a class=\"btn btn-popup btn-popup-1\"";
                        if (twig_get_attribute($this->env, $this->source, ($context["button1Link"] ?? null), "href", [], "any", false, false, false, 44)) {
                            echo " href=\"";
                            echo twig_get_attribute($this->env, $this->source, ($context["button1Link"] ?? null), "href", [], "any", false, false, false, 44);
                            echo "\"";
                        }
                        echo "><span class=\"btn-text\">";
                        echo ($context["button1Text"] ?? null);
                        echo "</span></a>
                  ";
                    }
                    // line 46
                    echo "
                  ";
                    // line 47
                    if (($context["button2"] ?? null)) {
                        // line 48
                        echo "                    <a class=\"btn btn-popup btn-popup-2\"";
                        if (twig_get_attribute($this->env, $this->source, ($context["button2Link"] ?? null), "href", [], "any", false, false, false, 48)) {
                            echo " href=\"";
                            echo twig_get_attribute($this->env, $this->source, ($context["button2Link"] ?? null), "href", [], "any", false, false, false, 48);
                            echo "\"";
                        }
                        echo "><span class=\"btn-text\">";
                        echo ($context["button2Text"] ?? null);
                        echo "</span></a>
                  ";
                    }
                    // line 50
                    echo "                </div>
              ";
                }
                // line 52
                echo "              ";
                if (( !($context["ajax"] ?? null) && ($context["doNotShowAgain"] ?? null))) {
                    // line 53
                    echo "                <label class=\"popup-dont-show\">
                  <input type=\"checkbox\" ";
                    // line 54
                    if (($context["doNotShowAgainChecked"] ?? null)) {
                        echo "checked";
                    }
                    echo "/>
                  <span>";
                    // line 55
                    echo ($context["doNotShowAgainText"] ?? null);
                    echo "</span>
                </label>
              ";
                }
                // line 58
                echo "            </div>
          ";
            }
            // line 60
            echo "        </div>
      </div>
    </div>
    <div class=\"popup-bg ";
            // line 63
            if (($context["closeButton"] ?? null)) {
                echo "popup-bg-closable";
            }
            echo "\"></div>
  </div>
";
        }
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/module/popup.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  214 => 63,  209 => 60,  205 => 58,  199 => 55,  193 => 54,  190 => 53,  187 => 52,  183 => 50,  171 => 48,  169 => 47,  166 => 46,  154 => 44,  152 => 43,  149 => 42,  147 => 41,  144 => 40,  142 => 39,  139 => 38,  133 => 36,  127 => 33,  124 => 32,  122 => 31,  113 => 29,  110 => 28,  108 => 27,  104 => 26,  101 => 25,  98 => 24,  92 => 22,  90 => 21,  86 => 19,  82 => 17,  80 => 16,  72 => 14,  65 => 11,  59 => 8,  56 => 7,  54 => 6,  45 => 4,  42 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/module/popup.twig", "");
    }
}
