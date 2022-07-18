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

/* journal3/template/journal3/module/main_menu.twig */
class __TwigTemplate_aa80efa69640945d93d2974423332e555eb599969a9fbb31e7d7401eb35e8e76 extends \Twig\Template
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
        // line 33
        $macros["self"] = $this->macros["self"] = $this;
        // line 34
        if (($context["items"] ?? null)) {
            // line 35
            echo "  ";
            $context["isMobile"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "document", [], "any", false, false, false, 35), "hasClass", [0 => "mobile-header-active"], "method", false, false, false, 35);
            // line 36
            echo "  ";
            if (($context["first"] ?? null)) {
                // line 37
                echo "  <div class=\"menu-trigger menu-item main-menu-item\"><ul class=\"j-menu\"><li><a>";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 37), "get", [0 => "menuTriggerText"], "method", false, false, false, 37);
                echo "</a></li></ul></div>
  ";
            }
            // line 39
            echo "  <div id=\"";
            echo ($context["id"] ?? null);
            echo "\" class=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => ($context["classes"] ?? null)], "method", false, false, false, 39);
            echo "\">
    <ul class=\"j-menu\">";
            // line 40
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 41
                echo "      ";
                $context["cid"] = twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "uniqueId", [0 => "collapse-"], "method", false, false, false, 41);
                // line 42
                echo "      <li class=\"";
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "classes", [], "any", false, false, false, 42)], "method", false, false, false, 42);
                echo " ";
                if ((($context["isMobile"] ?? null) && twig_get_attribute($this->env, $this->source, $context["item"], "isOpen", [], "any", false, false, false, 42))) {
                    echo "open";
                }
                echo "\" ";
                if (twig_get_attribute($this->env, $this->source, $context["item"], "isOpen", [], "any", false, false, false, 42)) {
                    echo "data-is-open";
                }
                echo ">
        ";
                // line 43
                if (twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 43)) {
                    // line 44
                    echo "          ";
                    if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 44), "href", [], "any", false, false, false, 44)) {
                        // line 45
                        echo "            <a href=\"";
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 45), "href", [], "any", false, false, false, 45);
                        echo "\" ";
                        echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "linkAttrs", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 45)], "method", false, false, false, 45);
                        echo " ";
                        if ((($context["display"] ?? null) == "dropdown")) {
                            echo " class=\"dropdown-toggle\" data-toggle=\"dropdown\" ";
                        } else {
                            echo " class=\"collapse-toggle\"";
                        }
                        echo ">
              ";
                        // line 46
                        echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "countBadge", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 46), 1 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 46), "total", [], "any", false, false, false, 46), 2 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 46), "classes", [], "any", false, false, false, 46)], "method", false, false, false, 46);
                        echo "
              <span class=\"open-menu collapsed\" data-toggle=\"collapse\" data-target=\"#";
                        // line 47
                        echo ($context["cid"] ?? null);
                        echo "\" ";
                        if ((($context["isMobile"] ?? null) && twig_get_attribute($this->env, $this->source, $context["item"], "isOpen", [], "any", false, false, false, 47))) {
                            echo "aria-expanded=\"true\"";
                        }
                        echo "><i class=\"fa fa-plus\"></i></span>
              ";
                        // line 48
                        if (twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 48)) {
                            // line 49
                            echo "                <span class=\"menu-label\">";
                            echo twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 49);
                            echo "</span>
              ";
                        }
                        // line 51
                        echo "            </a>
          ";
                    } else {
                        // line 53
                        echo "            <a ";
                        if ((($context["display"] ?? null) == "dropdown")) {
                            echo " class=\"dropdown-toggle\" data-toggle=\"dropdown\" ";
                        } else {
                            echo " class=\"collapse-toggle\"";
                        }
                        echo ">
              ";
                        // line 54
                        echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "countBadge", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 54), 1 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 54), "total", [], "any", false, false, false, 54), 2 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 54), "classes", [], "any", false, false, false, 54)], "method", false, false, false, 54);
                        echo "
              <span class=\"open-menu collapsed\" data-toggle=\"collapse\" data-target=\"#";
                        // line 55
                        echo ($context["cid"] ?? null);
                        echo "\" ";
                        if ((($context["isMobile"] ?? null) && twig_get_attribute($this->env, $this->source, $context["item"], "isOpen", [], "any", false, false, false, 55))) {
                            echo "aria-expanded=\"true\"";
                        }
                        echo "><i class=\"fa fa-plus\"></i></span>
              ";
                        // line 56
                        if (twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 56)) {
                            // line 57
                            echo "                <span class=\"menu-label\">";
                            echo twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 57);
                            echo "</span>
              ";
                        }
                        // line 59
                        echo "            </a>
          ";
                    }
                    // line 61
                    echo "          ";
                    if ((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 61) == "multilevel")) {
                        // line 62
                        echo "            <div class=\"";
                        echo (((($context["display"] ?? null) == "dropdown")) ? ("dropdown-menu j-dropdown") : ("collapse"));
                        echo " ";
                        if ((($context["isMobile"] ?? null) && twig_get_attribute($this->env, $this->source, $context["item"], "isOpen", [], "any", false, false, false, 62))) {
                            echo "in";
                        }
                        echo "\" id=\"";
                        echo ($context["cid"] ?? null);
                        echo "\">
              <ul class=\"j-menu\">
                ";
                        // line 64
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 64));
                        foreach ($context['_seq'] as $context["_key"] => $context["subitem"]) {
                            // line 65
                            echo "                  ";
                            echo twig_call_macro($macros["self"], "macro_renderMenu", [($context["j3"] ?? null), $context["subitem"], ($context["display"] ?? null)], 65, $context, $this->getSourceContext());
                            echo "
                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subitem'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 67
                        echo "              </ul>
            </div>
          ";
                    }
                    // line 70
                    echo "          ";
                    if ((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 70) == "megamenu")) {
                        // line 71
                        echo "            <div class=\"";
                        echo (((($context["display"] ?? null) == "dropdown")) ? ("dropdown-menu j-dropdown") : ("collapse"));
                        echo " ";
                        if ((($context["isMobile"] ?? null) && twig_get_attribute($this->env, $this->source, $context["item"], "isOpen", [], "any", false, false, false, 71))) {
                            echo "in";
                        }
                        echo "\" id=\"";
                        echo ($context["cid"] ?? null);
                        echo "\">
              <div class=\"mega-menu-content\">";
                        // line 72
                        echo twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 72);
                        echo "</div>
            </div>
          ";
                    }
                    // line 75
                    echo "          ";
                    if ((twig_get_attribute($this->env, $this->source, $context["item"], "type", [], "any", false, false, false, 75) == "flyout")) {
                        // line 76
                        echo "            <div class=\"";
                        echo (((($context["display"] ?? null) == "dropdown")) ? ("dropdown-menu j-dropdown") : ("collapse"));
                        echo " ";
                        if ((($context["isMobile"] ?? null) && twig_get_attribute($this->env, $this->source, $context["item"], "isOpen", [], "any", false, false, false, 76))) {
                            echo "in";
                        }
                        echo "\" id=\"";
                        echo ($context["cid"] ?? null);
                        echo "\">
              ";
                        // line 77
                        echo twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 77);
                        echo "
            </div>
          ";
                    }
                    // line 80
                    echo "        ";
                } else {
                    // line 81
                    echo "          ";
                    if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 81), "href", [], "any", false, false, false, 81)) {
                        // line 82
                        echo "            <a href=\"";
                        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 82), "href", [], "any", false, false, false, 82);
                        echo "\" ";
                        echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "linkAttrs", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 82)], "method", false, false, false, 82);
                        echo ">
              ";
                        // line 83
                        echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "countBadge", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 83), 1 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 83), "total", [], "any", false, false, false, 83), 2 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 83), "classes", [], "any", false, false, false, 83)], "method", false, false, false, 83);
                        echo "
              ";
                        // line 84
                        if (twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 84)) {
                            // line 85
                            echo "                <span class=\"menu-label\">";
                            echo twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 85);
                            echo "</span>
              ";
                        }
                        // line 87
                        echo "            </a>
          ";
                    } else {
                        // line 89
                        echo "            <a>
              ";
                        // line 90
                        echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "countBadge", [0 => twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 90), 1 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 90), "total", [], "any", false, false, false, 90), 2 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 90), "classes", [], "any", false, false, false, 90)], "method", false, false, false, 90);
                        echo "
              ";
                        // line 91
                        if (twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 91)) {
                            // line 92
                            echo "                <span class=\"menu-label\">";
                            echo twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 92);
                            echo "</span>
              ";
                        }
                        // line 94
                        echo "            </a>
          ";
                    }
                    // line 96
                    echo "        ";
                }
                // line 97
                echo "      </li>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 99
            echo "    </ul>
  </div>
";
        }
    }

    // line 1
    public function macro_renderMenu($__j3__ = null, $__item__ = null, $__display__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "j3" => $__j3__,
            "item" => $__item__,
            "display" => $__display__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 2
            echo "  ";
            $macros["self"] = $this;
            // line 3
            echo "  ";
            $context["cid"] = twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "uniqueId", [0 => "collapse-"], "method", false, false, false, 3);
            // line 4
            echo "  <li class=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "classes", [0 => twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "classes", [], "any", false, false, false, 4)], "method", false, false, false, 4);
            echo "\">
    ";
            // line 5
            if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "items", [], "any", false, false, false, 5)) {
                // line 6
                echo "      ";
                if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 6), "href", [], "any", false, false, false, 6)) {
                    // line 7
                    echo "        <a href=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 7), "href", [], "any", false, false, false, 7);
                    echo "\" ";
                    echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "linkAttrs", [0 => twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 7)], "method", false, false, false, 7);
                    echo " ";
                    if ((($context["display"] ?? null) == "dropdown")) {
                        echo " class=\"dropdown-toggle\" data-toggle=\"dropdown\" ";
                    } else {
                        echo " class=\"collapse-toggle\"";
                    }
                    echo ">
          ";
                    // line 8
                    echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "countBadge", [0 => twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "title", [], "any", false, false, false, 8), 1 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 8), "total", [], "any", false, false, false, 8), 2 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 8), "classes", [], "any", false, false, false, 8)], "method", false, false, false, 8);
                    echo "
          <span class=\"open-menu collapsed\" data-toggle=\"collapse\" data-target=\"#";
                    // line 9
                    echo ($context["cid"] ?? null);
                    echo "\"><i class=\"fa fa-plus\"></i></span>
        </a>
      ";
                } else {
                    // line 12
                    echo "        <a ";
                    if ((($context["display"] ?? null) == "dropdown")) {
                        echo " class=\"dropdown-toggle\" data-toggle=\"dropdown\" ";
                    } else {
                        echo " class=\"collapse-toggle\"";
                    }
                    echo ">
          ";
                    // line 13
                    echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "countBadge", [0 => twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "title", [], "any", false, false, false, 13), 1 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 13), "total", [], "any", false, false, false, 13), 2 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 13), "classes", [], "any", false, false, false, 13)], "method", false, false, false, 13);
                    echo "
          <span class=\"open-menu collapsed\" data-toggle=\"collapse\" data-target=\"#";
                    // line 14
                    echo ($context["cid"] ?? null);
                    echo "\"><i class=\"fa fa-plus\"></i></span>
        </a>
      ";
                }
                // line 17
                echo "     <div class=\"";
                echo (((($context["display"] ?? null) == "dropdown")) ? ("dropdown-menu j-dropdown") : ("collapse"));
                echo "\" id=\"";
                echo ($context["cid"] ?? null);
                echo "\">
       <ul class=\"j-menu\">
         ";
                // line 19
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "items", [], "any", false, false, false, 19));
                foreach ($context['_seq'] as $context["_key"] => $context["subitem"]) {
                    // line 20
                    echo "           ";
                    echo twig_call_macro($macros["self"], "macro_renderMenu", [($context["j3"] ?? null), $context["subitem"], ($context["display"] ?? null)], 20, $context, $this->getSourceContext());
                    echo "
         ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subitem'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 22
                echo "       </ul>
     </div>
    ";
            } else {
                // line 25
                echo "      ";
                if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 25), "href", [], "any", false, false, false, 25)) {
                    // line 26
                    echo "        <a href=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 26), "href", [], "any", false, false, false, 26);
                    echo "\" ";
                    echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "linkAttrs", [0 => twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 26)], "method", false, false, false, 26);
                    echo ">";
                    echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "countBadge", [0 => twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "title", [], "any", false, false, false, 26), 1 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 26), "total", [], "any", false, false, false, 26), 2 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 26), "classes", [], "any", false, false, false, 26)], "method", false, false, false, 26);
                    echo "</a>
      ";
                } else {
                    // line 28
                    echo "        <a>";
                    echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "countBadge", [0 => twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "title", [], "any", false, false, false, 28), 1 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 28), "total", [], "any", false, false, false, 28), 2 => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "link", [], "any", false, false, false, 28), "classes", [], "any", false, false, false, 28)], "method", false, false, false, 28);
                    echo "</a>
      ";
                }
                // line 30
                echo "    ";
            }
            // line 31
            echo "  </li>
";

            return ('' === $tmp = ob_get_contents()) ? '' : new Markup($tmp, $this->env->getCharset());
        } finally {
            ob_end_clean();
        }
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/module/main_menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  414 => 31,  411 => 30,  405 => 28,  395 => 26,  392 => 25,  387 => 22,  378 => 20,  374 => 19,  366 => 17,  360 => 14,  356 => 13,  347 => 12,  341 => 9,  337 => 8,  324 => 7,  321 => 6,  319 => 5,  314 => 4,  311 => 3,  308 => 2,  293 => 1,  286 => 99,  279 => 97,  276 => 96,  272 => 94,  266 => 92,  264 => 91,  260 => 90,  257 => 89,  253 => 87,  247 => 85,  245 => 84,  241 => 83,  234 => 82,  231 => 81,  228 => 80,  222 => 77,  211 => 76,  208 => 75,  202 => 72,  191 => 71,  188 => 70,  183 => 67,  174 => 65,  170 => 64,  158 => 62,  155 => 61,  151 => 59,  145 => 57,  143 => 56,  135 => 55,  131 => 54,  122 => 53,  118 => 51,  112 => 49,  110 => 48,  102 => 47,  98 => 46,  85 => 45,  82 => 44,  80 => 43,  67 => 42,  64 => 41,  60 => 40,  53 => 39,  47 => 37,  44 => 36,  41 => 35,  39 => 34,  37 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/module/main_menu.twig", "");
    }
}
