<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* modules/contrib/blazy/templates/blazy.html.twig */
class __TwigTemplate_4cf637c7431388290c4861a16d87a011 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'blazy_player' => [$this, 'block_blazy_player'],
            'blazy_media' => [$this, 'block_blazy_media'],
            'blazy_content' => [$this, 'block_blazy_content'],
            'blazy_caption' => [$this, 'block_blazy_caption'],
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 66
        $context["classes"] = [((        // line 67
($context["content"] ?? null)) ? ("media--rendered") : ("")), ((CoreExtension::getAttribute($this->env, $this->source,         // line 68
($context["blazies"] ?? null), "namespace", [], "any", false, false, true, 68)) ? (("media--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "namespace", [], "any", false, false, true, 68), 68, $this->source)))) : ("")), ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 69
($context["blazies"] ?? null), "media", [], "any", false, false, true, 69), "provider", [], "any", false, false, true, 69)) ? (("media--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "media", [], "any", false, false, true, 69), "provider", [], "any", false, false, true, 69), 69, $this->source)))) : ("")), ((CoreExtension::getAttribute($this->env, $this->source,         // line 70
($context["settings"] ?? null), "media_switch", [], "any", false, false, true, 70)) ? (("media--switch media--switch--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "media_switch", [], "any", false, false, true, 70), 70, $this->source)))) : ("")), ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 71
($context["blazies"] ?? null), "use", [], "any", false, false, true, 71), "player", [], "any", false, false, true, 71)) ? ("media--player") : ("")), ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 72
($context["blazies"] ?? null), "media", [], "any", false, false, true, 72), "bundle", [], "any", false, false, true, 72)) ? (("media--bundle--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "media", [], "any", false, false, true, 72), "bundle", [], "any", false, false, true, 72), 72, $this->source)))) : ("")), ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 73
($context["blazies"] ?? null), "media", [], "any", false, false, true, 73), "type", [], "any", false, false, true, 73)) ? (("media--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "media", [], "any", false, false, true, 73), "type", [], "any", false, false, true, 73), 73, $this->source)))) : ("")), (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 74
($context["blazies"] ?? null), "resimage", [], "any", false, false, true, 74), "id", [], "any", false, false, true, 74) &&  !($context["content"] ?? null))) ? ("media--responsive") : ("")), ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 75
($context["blazies"] ?? null), "is", [], "any", false, false, true, 75), "svg", [], "any", false, false, true, 75)) ? ("media--svg") : ("")), ((CoreExtension::getAttribute($this->env, $this->source,         // line 76
($context["settings"] ?? null), "ratio", [], "any", false, false, true, 76)) ? (("media--ratio media--ratio--" . $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "ratio", [], "any", false, false, true, 76), 76, $this->source))) : ("")), ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 77
($context["blazies"] ?? null), "use", [], "any", false, false, true, 77), "loader", [], "any", false, false, true, 77)) ? ("is-b-loading") : ("")), ((CoreExtension::getAttribute($this->env, $this->source,         // line 78
($context["settings"] ?? null), "classes", [], "any", false, false, true, 78)) ? (\Drupal\Component\Utility\Html::getClass(Twig\Extension\CoreExtension::join($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "classes", [], "any", false, false, true, 78), 78, $this->source), " "))) : (""))];
        // line 81
        if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "use", [], "any", false, false, true, 81), "player", [], "any", false, false, true, 81)) {
            // line 82
            yield "  ";
            $context["attributes"] = CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "setAttribute", ["aria-live", "polite"], "method", false, false, true, 82);
            // line 83
            yield "
  ";
            // line 84
            $context["label"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "media", [], "any", false, false, true, 84), "label", [], "any", false, false, true, 84);
            // line 85
            yield "  ";
            $context["play_title"] = t("Load and play video.");
            // line 86
            yield "  ";
            $context["close_title"] = t("Stop and close video.");
            // line 87
            yield "
  ";
            // line 88
            if (($context["label"] ?? null)) {
                // line 89
                yield "    ";
                $context["play_title"] = t("Load and play the video \"@label\".", ["@label" => $this->sandbox->ensureToStringAllowed(($context["label"] ?? null), 89, $this->source)]);
                // line 90
                yield "    ";
                $context["close_title"] = t("Stop and close the video \"@label\".", ["@label" => $this->sandbox->ensureToStringAllowed(($context["label"] ?? null), 90, $this->source)]);
                // line 91
                yield "  ";
            }
            // line 92
            yield "
  ";
            // line 93
            $context["play_button_attributes"] = $this->extensions['Drupal\Core\Template\TwigExtension']->createAttribute(["aria-label" => $this->sandbox->ensureToStringAllowed(            // line 94
($context["play_title"] ?? null), 94, $this->source), "class" => ["media__icon", "media__icon--play"], "data-b-provider" => $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,             // line 96
($context["blazies"] ?? null), "media", [], "any", false, false, true, 96), "provider", [], "any", false, false, true, 96), 96, $this->source), "data-b-token" => $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,             // line 97
($context["blazies"] ?? null), "media", [], "any", false, false, true, 97), "token", [], "any", false, false, true, 97), 97, $this->source), "data-b-url" => $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,             // line 98
($context["blazies"] ?? null), "media", [], "any", false, false, true, 98), "embed_url", [], "any", false, false, true, 98), 98, $this->source), "data-iframe-title" => $this->sandbox->ensureToStringAllowed(            // line 99
($context["label"] ?? null), 99, $this->source), "title" => $this->sandbox->ensureToStringAllowed(            // line 100
($context["play_title"] ?? null), 100, $this->source), "type" => "button"]);
            // line 103
            yield "
  ";
            // line 104
            $context["close_button_attributes"] = $this->extensions['Drupal\Core\Template\TwigExtension']->createAttribute(["aria-label" => $this->sandbox->ensureToStringAllowed(            // line 105
($context["close_title"] ?? null), 105, $this->source), "class" => ["media__icon", "media__icon--close"], "title" => $this->sandbox->ensureToStringAllowed(            // line 107
($context["close_title"] ?? null), 107, $this->source), "type" => "button"]);
        }
        // line 111
        $context["player"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 112
            yield "  ";
            yield from $this->unwrap()->yieldBlock('blazy_player', $context, $blocks);
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 121
        $context["media"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 122
            yield from $this->unwrap()->yieldBlock('blazy_media', $context, $blocks);
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 136
        $context["blazy"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 137
            yield from $this->unwrap()->yieldBlock('blazy_content', $context, $blocks);
            // line 152
            yield "
  ";
            // line 154
            $context["IS_INLINE"] =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "inline", [], "any", false, false, true, 154));
            // line 155
            $context["IS_OVERLAY"] =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "overlay", [], "any", false, false, true, 155));
            // line 157
            if ((($context["IS_INLINE"] ?? null) || ($context["IS_OVERLAY"] ?? null))) {
                // line 158
                yield from $this->unwrap()->yieldBlock('blazy_caption', $context, $blocks);
            }
            // line 182
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["postscript"] ?? null), 182, $this->source), "html", null, true);
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 184
        if (($context["wrapper_attributes"] ?? null)) {
            // line 185
            $context["wrapper_tag"] = (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "item", [], "any", false, true, true, 185), "wrapper_tag", [], "any", true, true, true, 185) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "item", [], "any", false, true, true, 185), "wrapper_tag", [], "any", false, false, true, 185)))) ? (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "item", [], "any", false, true, true, 185), "wrapper_tag", [], "any", false, false, true, 185)) : ("div"));
            // line 186
            yield "<";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["wrapper_tag"] ?? null), 186, $this->source), "html", null, true);
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["wrapper_attributes"] ?? null), 186, $this->source), "html", null, true);
            yield ">";
            // line 187
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["blazy"] ?? null), 187, $this->source), "html", null, true);
            // line 188
            yield "</";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["wrapper_tag"] ?? null), 188, $this->source), "html", null, true);
            yield ">
";
        } else {
            // line 190
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["blazy"] ?? null), 190, $this->source), "html", null, true);
        }
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["content", "blazies", "settings", "captions", "postscript", "wrapper_attributes", "iframe", "preface", "image", "noscript", "overlay", "icon", "media_attributes", "url", "url_attributes", "caption_wrapper_attributes", "caption_attributes", "caption_content_attributes"]);        yield from [];
    }

    // line 112
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_blazy_player(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 113
        yield "    ";
        if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "use", [], "any", false, false, true, 113), "player", [], "any", false, false, true, 113)) {
            // line 114
            yield "      <button";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["close_button_attributes"] ?? null), 114, $this->source), "html", null, true);
            yield "></button>
      <button";
            // line 115
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["play_button_attributes"] ?? null), 115, $this->source), "html", null, true);
            yield "></button>
    ";
        } else {
            // line 117
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["iframe"] ?? null), 117, $this->source), "html", null, true);
        }
        // line 119
        yield "  ";
        yield from [];
    }

    // line 122
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_blazy_media(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 123
        yield "    <div";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 123), 123, $this->source), "html", null, true);
        yield ">";
        // line 124
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["preface"] ?? null), 124, $this->source), "html", null, true);
        // line 125
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["image"] ?? null), 125, $this->source), "html", null, true);
        // line 127
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["noscript"] ?? null), 127, $this->source), "html", null, true);
        // line 129
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content"] ?? null), 129, $this->source), "html", null, true);
        // line 130
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["overlay"] ?? null), 130, $this->source), "html", null, true);
        // line 131
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["player"] ?? null), 131, $this->source), "html", null, true);
        // line 132
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["icon"] ?? null), 132, $this->source), "html", null, true);
        // line 133
        yield "</div>";
        yield from [];
    }

    // line 137
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_blazy_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 138
        if (($context["media_attributes"] ?? null)) {
            yield "<div";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["media_attributes"] ?? null), 138, $this->source), "html", null, true);
            yield ">";
        }
        // line 139
        if ((($context["url"] ?? null) &&  !CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["blazies"] ?? null), "use", [], "any", false, false, true, 139), "player", [], "any", false, false, true, 139))) {
            // line 140
            yield "<a href=\"";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["url"] ?? null), 140, $this->source), "html", null, true);
            yield "\"";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["url_attributes"] ?? null), 140, $this->source), "html", null, true);
            yield ">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["media"] ?? null), 140, $this->source), "html", null, true);
            yield "</a>
        ";
            // line 142
            if ((($context["captions"] ?? null) &&  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "lightbox", [], "any", false, false, true, 142)))) {
                // line 143
                yield "<div class=\"litebox__caption visually-hidden\">";
                // line 144
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "lightbox", [], "any", false, false, true, 144), 144, $this->source), "html", null, true);
                // line 145
                yield "</div>";
            }
        } else {
            // line 148
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["media"] ?? null), 148, $this->source), "html", null, true);
        }
        // line 150
        if (($context["media_attributes"] ?? null)) {
            yield "</div>";
        }
        yield from [];
    }

    // line 158
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_blazy_caption(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 159
        $context["caption_tag"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "tag", [], "any", true, true, true, 159) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "tag", [], "any", false, false, true, 159)))) ? (CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "tag", [], "any", false, false, true, 159)) : ("div"));
        // line 160
        $context["cw_tag"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "wrapper_tag", [], "any", true, true, true, 160) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "wrapper_tag", [], "any", false, false, true, 160)))) ? (CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "wrapper_tag", [], "any", false, false, true, 160)) : ("div"));
        // line 161
        $context["IS_CATEGORY"] =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "category", [], "any", false, false, true, 161));
        // line 163
        if (($context["caption_wrapper_attributes"] ?? null)) {
            yield "<";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["cw_tag"] ?? null), 163, $this->source), "html", null, true);
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["caption_wrapper_attributes"] ?? null), 163, $this->source), "html", null, true);
            yield ">";
        }
        // line 165
        yield "<";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["caption_tag"] ?? null), 165, $this->source), "html", null, true);
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["caption_attributes"] ?? null), 165, $this->source), "html", null, true);
        yield ">";
        // line 166
        if (($context["IS_OVERLAY"] ?? null)) {
            // line 167
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "overlay", [], "any", false, false, true, 167), 167, $this->source), "html", null, true);
            // line 168
            if (($context["IS_INLINE"] ?? null)) {
                yield "<div";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["caption_content_attributes"] ?? null), 168, $this->source), "html", null, true);
                yield ">";
            }
        }
        // line 171
        if (($context["IS_INLINE"] ?? null)) {
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "inline", [], "any", false, false, true, 171), 171, $this->source), "html", null, true);
        }
        // line 173
        if ((($context["IS_INLINE"] ?? null) && ($context["IS_OVERLAY"] ?? null))) {
            yield "</div>";
        }
        // line 174
        yield "</";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["caption_tag"] ?? null), 174, $this->source), "html", null, true);
        yield ">";
        // line 176
        if (($context["IS_CATEGORY"] ?? null)) {
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["captions"] ?? null), "category", [], "any", false, false, true, 176), 176, $this->source), "html", null, true);
        }
        // line 178
        if (($context["caption_wrapper_attributes"] ?? null)) {
            yield "</";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["cw_tag"] ?? null), 178, $this->source), "html", null, true);
            yield ">";
        }
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/contrib/blazy/templates/blazy.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  322 => 178,  318 => 176,  314 => 174,  310 => 173,  306 => 171,  299 => 168,  297 => 167,  295 => 166,  290 => 165,  283 => 163,  281 => 161,  279 => 160,  277 => 159,  270 => 158,  263 => 150,  260 => 148,  256 => 145,  254 => 144,  252 => 143,  250 => 142,  241 => 140,  239 => 139,  233 => 138,  226 => 137,  221 => 133,  219 => 132,  217 => 131,  215 => 130,  213 => 129,  211 => 127,  209 => 125,  207 => 124,  203 => 123,  196 => 122,  191 => 119,  188 => 117,  183 => 115,  178 => 114,  175 => 113,  168 => 112,  161 => 190,  155 => 188,  153 => 187,  148 => 186,  146 => 185,  144 => 184,  140 => 182,  137 => 158,  135 => 157,  133 => 155,  131 => 154,  128 => 152,  126 => 137,  124 => 136,  120 => 122,  118 => 121,  113 => 112,  111 => 111,  108 => 107,  107 => 105,  106 => 104,  103 => 103,  101 => 100,  100 => 99,  99 => 98,  98 => 97,  97 => 96,  96 => 94,  95 => 93,  92 => 92,  89 => 91,  86 => 90,  83 => 89,  81 => 88,  78 => 87,  75 => 86,  72 => 85,  70 => 84,  67 => 83,  64 => 82,  62 => 81,  60 => 78,  59 => 77,  58 => 76,  57 => 75,  56 => 74,  55 => 73,  54 => 72,  53 => 71,  52 => 70,  51 => 69,  50 => 68,  49 => 67,  48 => 66,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "modules/contrib/blazy/templates/blazy.html.twig", "C:\\xampp\\htdocs\\test_drupal_site\\web\\modules\\contrib\\blazy\\templates\\blazy.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 66, "if" => 81, "block" => 112);
        static $filters = array("clean_class" => 68, "join" => 78, "t" => 85, "escape" => 182);
        static $functions = array("create_attribute" => 93);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'block'],
                ['clean_class', 'join', 't', 'escape'],
                ['create_attribute'],
                $this->source
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
