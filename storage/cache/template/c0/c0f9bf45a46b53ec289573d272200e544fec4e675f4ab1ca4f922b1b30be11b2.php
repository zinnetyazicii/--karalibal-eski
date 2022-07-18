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

/* journal3/template/journal3/blog/post.twig */
class __TwigTemplate_74bc75ca4ac10ad2f519de3fb064f667aa60a230e7ffbe88e7d13e6ce0e7c6fe extends \Twig\Template
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
<ul class=\"breadcrumb\">
  ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 4
            echo "  <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 4);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 4);
            echo "</a></li>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 6
        echo "</ul>
";
        // line 7
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 7), "get", [0 => "pageTitlePosition"], "method", false, false, false, 7) == "top")) {
            // line 8
            echo "  <h1 class=\"title page-title\"><span>";
            echo ($context["post_name"] ?? null);
            echo "</span></h1>
";
        }
        // line 10
        echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "loadController", [0 => "journal3/layout", 1 => "top"], "method", false, false, false, 10);
        echo "
<div class=\"container blog-post\">
  <div class=\"row\">";
        // line 12
        echo ($context["column_left"] ?? null);
        echo "
    <div id=\"content\">
      ";
        // line 14
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 14), "get", [0 => "pageTitlePosition"], "method", false, false, false, 14) == "default")) {
            // line 15
            echo "        <h1 class=\"title page-title\">";
            echo ($context["post_name"] ?? null);
            echo "</h1>
      ";
        }
        // line 17
        echo "      ";
        echo ($context["content_top"] ?? null);
        echo "
      <div class=\"post-details\">
        <div class=\"post-image\">
          ";
        // line 20
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 20), "get", [0 => "datePosition"], "method", false, false, false, 20) == "image")) {
            // line 21
            echo "            <span class=\"p-date p-date-image\">";
            echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "blog_date", [0 => ($context["post_date"] ?? null)], "method", false, false, false, 21);
            echo "</span>
          ";
        }
        // line 23
        echo "          <img src=\"";
        echo ($context["post_image"] ?? null);
        echo "\" ";
        if (($context["post_image2x"] ?? null)) {
            echo " srcset=\"";
            echo ($context["post_image"] ?? null);
            echo " 1x, ";
            echo ($context["post_image2x"] ?? null);
            echo " 2x\" ";
        }
        echo " width=\"";
        echo ($context["image_width"] ?? null);
        echo "\" height=\"";
        echo ($context["image_height"] ?? null);
        echo "\" alt=\"";
        echo ($context["post_name"] ?? null);
        echo "\" title=\"";
        echo ($context["post_name"] ?? null);
        echo "\"/>
        </div>
        <div class=\"post-stats\">
          ";
        // line 26
        if (($context["post_author"] ?? null)) {
            // line 27
            echo "            <span class=\"p-posted\">";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 27), "get", [0 => "blogPostedByText"], "method", false, false, false, 27);
            echo "</span>
            <span class=\"p-author\">";
            // line 28
            echo ($context["post_author"] ?? null);
            echo "</span>
          ";
        }
        // line 30
        echo "          ";
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 30), "get", [0 => "datePosition"], "method", false, false, false, 30) == "default")) {
            // line 31
            echo "            <span class=\"p-date p-date-default\">";
            echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "blog_date", [0 => ($context["post_date"] ?? null)], "method", false, false, false, 31);
            echo "</span>
          ";
        }
        // line 33
        echo "          <span class=\"p-comment\">";
        echo twig_length_filter($this->env, ($context["comments"] ?? null));
        echo " ";
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 33), "get", [0 => "blogCommentsText"], "method", false, false, false, 33);
        echo "</span>
          <span class=\"p-view\">";
        // line 34
        echo ($context["post_views"] ?? null);
        echo " ";
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 34), "get", [0 => "blogViewsText"], "method", false, false, false, 34);
        echo "</span>
          ";
        // line 35
        if (($context["post_categories"] ?? null)) {
            // line 36
            echo "            <span class=\"p-category\">
          ";
            // line 37
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["post_categories"] ?? null));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                // line 38
                echo "            <a href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 38);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 38);
                echo "</a>
            ";
                // line 39
                if ( !twig_get_attribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 39)) {
                    // line 40
                    echo "            <span>, </span>
          ";
                }
                // line 42
                echo "          ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 43
            echo "          </span>
          ";
        }
        // line 45
        echo "        </div>
        <div class=\"post-content\">
          ";
        // line 47
        echo ($context["post_content"] ?? null);
        echo "
        </div>
        ";
        // line 49
        if (($context["post_tags"] ?? null)) {
            // line 50
            echo "          <div class=\"tags\">
            <span class=\"tags-title\">";
            // line 51
            echo ($context["text_tags"] ?? null);
            echo "</span>
            ";
            // line 52
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["post_tags"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                // line 53
                echo "              <a href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["tag"], "href", [], "any", false, false, false, 53);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["tag"], "name", [], "any", false, false, false, 53);
                echo "</a><b>,</b>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 55
            echo "          </div>
        ";
        }
        // line 57
        echo "      </div>

      ";
        // line 59
        echo ($context["content_bottom"] ?? null);
        echo "

      ";
        // line 61
        if (($context["allow_comments"] ?? null)) {
            // line 62
            echo "        <div class=\"post-comments\">
          ";
            // line 63
            if ((twig_length_filter($this->env, ($context["comments"] ?? null)) > 0)) {
                // line 64
                echo "            <h3 class=\"title\">";
                echo twig_length_filter($this->env, ($context["comments"] ?? null));
                echo " ";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 64), "get", [0 => "blogCommentsText"], "method", false, false, false, 64);
                echo "</h3>
          ";
            }
            // line 66
            echo "          ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["comments"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
                // line 67
                echo "            <div class=\"post-comment\" data-comment-id=\"";
                echo twig_get_attribute($this->env, $this->source, $context["comment"], "comment_id", [], "any", false, false, false, 67);
                echo "\" data-has-form=\"false\">
              <img class=\"user-avatar\" src=\"https://s.gravatar.com/avatar/";
                // line 68
                echo twig_get_attribute($this->env, $this->source, $context["comment"], "avatar", [], "any", false, false, false, 68);
                echo "?s=";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 68), "get", [0 => "postCommentImageSize"], "method", false, false, false, 68);
                echo "\" width=\"";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 68), "get", [0 => "postCommentImageSize"], "method", false, false, false, 68);
                echo "\" height=\"";
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 68), "get", [0 => "postCommentImageSize"], "method", false, false, false, 68);
                echo "\" alt=\"\">
              <div class=\"comment\">
                <div class=\"user-name\">";
                // line 70
                echo twig_get_attribute($this->env, $this->source, $context["comment"], "name", [], "any", false, false, false, 70);
                echo ":</div>
                <div class=\"user-data\">
                  <div>
                    <span class=\"user-date p-date\">";
                // line 73
                echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "blog_date", [0 => twig_get_attribute($this->env, $this->source, $context["comment"], "date", [], "any", false, false, false, 73)], "method", false, false, false, 73);
                echo "</span>
                    <span class=\"user-time p-time\">";
                // line 74
                echo twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["comment"], "date", [], "any", false, false, false, 74), ($context["time_format"] ?? null));
                echo "</span>
                  </div>
                  ";
                // line 76
                if (twig_get_attribute($this->env, $this->source, $context["comment"], "website", [], "any", false, false, false, 76)) {
                    // line 77
                    echo "                    <span class=\"user-site p-site\"><a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["comment"], "website", [], "any", false, false, false, 77);
                    echo "\" target=\"_blank\">";
                    echo twig_get_attribute($this->env, $this->source, $context["comment"], "website", [], "any", false, false, false, 77);
                    echo "</a></span>
                  ";
                }
                // line 79
                echo "                </div>
                <a class=\"btn reply-btn\">";
                // line 80
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 80), "get", [0 => "blogReplyText"], "method", false, false, false, 80);
                echo "</a>
                <p>";
                // line 81
                echo twig_get_attribute($this->env, $this->source, $context["comment"], "comment", [], "any", false, false, false, 81);
                echo "</p>
                ";
                // line 82
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["comment"], "replies", [], "any", false, false, false, 82));
                foreach ($context['_seq'] as $context["_key"] => $context["reply"]) {
                    // line 83
                    echo "                  <div class=\"post-reply\">
                    <img class=\"user-avatar\" src=\"https://s.gravatar.com/avatar/";
                    // line 84
                    echo twig_get_attribute($this->env, $this->source, $context["comment"], "avatar", [], "any", false, false, false, 84);
                    echo "?s=";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 84), "get", [0 => "postCommentImageSize"], "method", false, false, false, 84);
                    echo "\" width=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 84), "get", [0 => "postCommentImageSize"], "method", false, false, false, 84);
                    echo "\" height=\"";
                    echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 84), "get", [0 => "postCommentImageSize"], "method", false, false, false, 84);
                    echo "\" alt=\"\">
                    <div class=\"comment\">
                      <div class=\"user-name\">";
                    // line 86
                    echo twig_get_attribute($this->env, $this->source, $context["reply"], "name", [], "any", false, false, false, 86);
                    echo ":</div>
                      <div class=\"user-data\">
                        <div>
                          <span class=\"user-date p-date\">";
                    // line 89
                    echo twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "blog_date", [0 => twig_get_attribute($this->env, $this->source, $context["reply"], "date", [], "any", false, false, false, 89)], "method", false, false, false, 89);
                    echo "</span>
                          <span class=\"user-time p-time\">";
                    // line 90
                    echo twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["reply"], "date", [], "any", false, false, false, 90), ($context["time_format"] ?? null));
                    echo "</span>
                        </div>
                        ";
                    // line 92
                    if (twig_get_attribute($this->env, $this->source, $context["reply"], "website", [], "any", false, false, false, 92)) {
                        // line 93
                        echo "                          <span class=\"user-site p-site\"><a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["reply"], "website", [], "any", false, false, false, 93);
                        echo "\" target=\"_blank\">";
                        echo twig_get_attribute($this->env, $this->source, $context["reply"], "website", [], "any", false, false, false, 93);
                        echo "</a></span>
                        ";
                    }
                    // line 95
                    echo "                      </div>
                      <p>";
                    // line 96
                    echo twig_get_attribute($this->env, $this->source, $context["reply"], "comment", [], "any", false, false, false, 96);
                    echo "</p>
                    </div>
                  </div>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['reply'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 100
                echo "              </div>
            </div>
          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['comment'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 103
            echo "          <div class=\"comment-form\">
            <h3 class=\"title\">";
            // line 104
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 104), "get", [0 => "blogLeaveCommentText"], "method", false, false, false, 104);
            echo "</h3>
            <form method=\"post\" enctype=\"multipart/form-data\" class=\"form-horizontal\">
              <fieldset>
                <div class=\"form-group required\">
                  <label class=\"col-sm-2 control-label\" for=\"input-name\">";
            // line 108
            echo ($context["entry_name"] ?? null);
            echo "</label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"name\" value=\"";
            // line 110
            echo ($context["default_name"] ?? null);
            echo "\" id=\"input-name\" class=\"form-control\"/>
                  </div>
                </div>

                <div class=\"form-group required\">
                  <label class=\"col-sm-2 control-label\" for=\"input-email\">";
            // line 115
            echo ($context["entry_email"] ?? null);
            echo "</label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"email\" value=\"";
            // line 117
            echo ($context["default_email"] ?? null);
            echo "\" id=\"input-email\" class=\"form-control\"/>

                  </div>
                </div>

                <div class=\"form-group\">
                  <label class=\"col-sm-2 control-label\" for=\"input-website\">";
            // line 123
            echo ($context["entry_website"] ?? null);
            echo "</label>
                  <div class=\"col-sm-10\">
                    <input type=\"text\" name=\"website\" value=\"";
            // line 125
            echo ($context["default_website"] ?? null);
            echo "\" id=\"input-website\" class=\"form-control\"/>
                  </div>
                </div>

                <div class=\"form-group required\">
                  <label class=\"col-sm-2 control-label\" for=\"input-comment\">";
            // line 130
            echo ($context["text_comment"] ?? null);
            echo "</label>
                  <div class=\"col-sm-10\">
                    <textarea name=\"comment\" rows=\"10\" id=\"input-comment\" class=\"form-control\">";
            // line 132
            echo ($context["default_comment"] ?? null);
            echo "</textarea>
                  </div>
                </div>
              </fieldset>
              <div class=\"buttons\">
                <div class=\"pull-right\">
                  <button type=\"button\" class=\"btn comment-submit\">";
            // line 138
            echo ($context["button_submit"] ?? null);
            echo "</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      ";
        }
        // line 145
        echo "
    </div>
    ";
        // line 147
        echo ($context["column_right"] ?? null);
        echo "
  </div>
  ";
        // line 149
        if (($context["allow_comments"] ?? null)) {
            // line 150
            echo "    <script type=\"text/javascript\">
      function generateComment(\$form, cls, \$appendTo, callback) {
        \$form.find('.has-error').removeClass('has-error');

        \$.post('index.php?route=journal3/blog/comment&post_id=";
            // line 154
            echo ($context["post_id"] ?? null);
            echo "', \$form.serializeArray(), function (response) {
          if (response.status === 'success') {
            if (response.response.data) {
              var html = '';

              html += '<div class=\"' + cls + '\" data-comment-id=\"' + response.response.data.comment_id + '\" data-has-form=\"false\">';
              html += ' <img class=\"user-avatar\" src=\"https://s.gravatar.com/avatar/' + response.response.data.avatar + '?s=";
            // line 160
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 160), "get", [0 => "postCommentImageSize"], "method", false, false, false, 160);
            echo "\" width=\"";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 160), "get", [0 => "postCommentImageSize"], "method", false, false, false, 160);
            echo "\" height=\"";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 160), "get", [0 => "postCommentImageSize"], "method", false, false, false, 160);
            echo "\" alt=\"\">';
              html += ' <div class=\"comment\">';
              html += '   <div class=\"user-name\">' + response.response.data.name + ':</div>';
              html += '   <div class=\"user-data\">';
              html += '     <div>';
              html += '       <span class=\"user-date p-date\">' + response.response.data.date + '</span>';
              html += '       <span class=\"user-time p-time\">' + response.response.data.time + '</span>';
              html += '     </div>';
              html += '     <span class=\"user-site p-site\"><a href=\"' + response.response.data.website + '\" target=\"_blank\">' + response.response.data.website + '</a></span>';
              html += '   </div>';

              if (cls === 'post-comment') {
                html += ' <a class=\"btn reply-btn\">";
            // line 172
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 172), "get", [0 => "blogReplyText"], "method", false, false, false, 172);
            echo "</a>';
              }

              html += ' <p>' + response.response.data.comment + '</p>';
              html += '</div>';

              \$appendTo.before(html);
            }

            callback && callback(response.response.message);
          }

          if (response.status === 'error') {
            \$.each(response.response.errors, function (field) {
              \$form.find('[name=\"' + field + '\"]').closest('.form-group').addClass('has-error');
            });
          }
        }, 'json');
      }

      \$(document).delegate('.reply-btn', 'click', function () {
        var \$comment = \$(this).closest('.post-comment');

        if (\$comment.attr('data-has-form') === 'false') {
          var \$form = \$('.post-comments form').clone();
          \$form.find('.has-error').removeClass('has-error');
          \$form.append('<input type=\"hidden\" name=\"parent_id\" value=\"' + \$comment.attr('data-comment-id') + '\" />');
          \$form.find('button').removeClass('comment-submit').addClass('reply-submit');
          \$comment.find('> .comment').append('<div class=\"reply-form\"><h3 class=\"title\">' + '";
            // line 200
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["j3"] ?? null), "settings", [], "any", false, false, false, 200), "get", [0 => "blogLeaveReplyText"], "method", false, false, false, 200);
            echo "' + '</h3><div class=\"comment-form\"><div><form class=\"form-horizontal\">' + \$form.html() + '</form></div></div></div>');
          \$comment.attr('data-has-form', 'true');
        } else {
          \$comment.find('.reply-form').remove();
          \$comment.attr('data-has-form', 'false');
        }
      });

      \$(document).delegate('form .comment-submit', 'click', function () {
        var \$form = \$(this).closest('form');
        var \$comment_form = \$('.comment-form');

        generateComment(\$form, 'post-comment', \$comment_form, function (message) {
          \$comment_form.before('<div class=\"success\">' + message + '</div>');
          setTimeout(function () {
            \$('.post-comments .success').slideUp(400, function () {
              \$(this).remove();
            });
          }, 1500);
          \$form[0].reset();
        });
      });

      \$(document).delegate('form .reply-submit', 'click', function () {
        var \$form = \$(this).closest('form');
        var \$reply_form = \$(this).closest('.post-comment').find('.reply-form');

        generateComment(\$form, 'post-reply', \$reply_form, function (message) {
          \$reply_form.before('<div class=\"success\">' + message + '</div>');
          setTimeout(function () {
            \$('.post-comments .success').slideUp(400, function () {
              \$(this).remove();
            });
          }, 1500);
          \$form.closest('.post-comment').attr('data-has-form', 'false');
          \$reply_form.remove();
        });
      });
    </script>
  ";
        }
        // line 240
        echo "</div>
";
        // line 241
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "journal3/template/journal3/blog/post.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  589 => 241,  586 => 240,  543 => 200,  512 => 172,  493 => 160,  484 => 154,  478 => 150,  476 => 149,  471 => 147,  467 => 145,  457 => 138,  448 => 132,  443 => 130,  435 => 125,  430 => 123,  421 => 117,  416 => 115,  408 => 110,  403 => 108,  396 => 104,  393 => 103,  385 => 100,  375 => 96,  372 => 95,  364 => 93,  362 => 92,  357 => 90,  353 => 89,  347 => 86,  336 => 84,  333 => 83,  329 => 82,  325 => 81,  321 => 80,  318 => 79,  310 => 77,  308 => 76,  303 => 74,  299 => 73,  293 => 70,  282 => 68,  277 => 67,  272 => 66,  264 => 64,  262 => 63,  259 => 62,  257 => 61,  252 => 59,  248 => 57,  244 => 55,  233 => 53,  229 => 52,  225 => 51,  222 => 50,  220 => 49,  215 => 47,  211 => 45,  207 => 43,  193 => 42,  189 => 40,  187 => 39,  180 => 38,  163 => 37,  160 => 36,  158 => 35,  152 => 34,  145 => 33,  139 => 31,  136 => 30,  131 => 28,  126 => 27,  124 => 26,  101 => 23,  95 => 21,  93 => 20,  86 => 17,  80 => 15,  78 => 14,  73 => 12,  68 => 10,  62 => 8,  60 => 7,  57 => 6,  46 => 4,  42 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "journal3/template/journal3/blog/post.twig", "");
    }
}
