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

/* modules/contrib/slick/templates/slick.html.twig */
class __TwigTemplate_4d4a776901c96a014a75b4cda3a94f86 extends Template
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
            'slick_content' => [$this, 'block_slick_content'],
            'slick_arrow' => [$this, 'block_slick_arrow'],
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 37
        $context["classes"] = [((CoreExtension::getAttribute($this->env, $this->source,         // line 38
($context["settings"] ?? null), "unslick", [], "any", false, false, true, 38)) ? ("unslick") : ("")), ((CoreExtension::getAttribute($this->env, $this->source,         // line 39
($context["settings"] ?? null), "vertical", [], "any", false, false, true, 39)) ? ("slick--vertical") : ("")), ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 40
($context["settings"] ?? null), "attributes", [], "any", false, false, true, 40), "class", [], "any", false, false, true, 40)) ? (Twig\Extension\CoreExtension::join($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "attributes", [], "any", false, false, true, 40), "class", [], "any", false, false, true, 40), 40, $this->source), " ")) : ("")), ((CoreExtension::getAttribute($this->env, $this->source,         // line 41
($context["settings"] ?? null), "skin", [], "any", false, false, true, 41)) ? (("slick--skin--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "skin", [], "any", false, false, true, 41), 41, $this->source)))) : ("")), ((CoreExtension::inFilter("boxed", CoreExtension::getAttribute($this->env, $this->source,         // line 42
($context["settings"] ?? null), "skin", [], "any", false, false, true, 42))) ? ("slick--skin--boxed") : ("")), ((CoreExtension::inFilter("split", CoreExtension::getAttribute($this->env, $this->source,         // line 43
($context["settings"] ?? null), "skin", [], "any", false, false, true, 43))) ? ("slick--skin--split") : ("")), ((CoreExtension::getAttribute($this->env, $this->source,         // line 44
($context["settings"] ?? null), "optionset", [], "any", false, false, true, 44)) ? (("slick--optionset--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "optionset", [], "any", false, false, true, 44), 44, $this->source)))) : ("")), ((        // line 45
array_key_exists("arrow_down_attributes", $context)) ? ("slick--has-arrow-down") : ("")), ((CoreExtension::getAttribute($this->env, $this->source,         // line 46
($context["settings"] ?? null), "asNavFor", [], "any", false, false, true, 46)) ? (("slick--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["display"] ?? null), 46, $this->source)))) : ("")), (((CoreExtension::getAttribute($this->env, $this->source,         // line 47
($context["settings"] ?? null), "slidesToShow", [], "any", false, false, true, 47) > 1)) ? ("slick--multiple-view") : ("")), (((CoreExtension::getAttribute($this->env, $this->source,         // line 48
($context["blazies"] ?? null), "count", [], "any", false, false, true, 48) <= CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "slidesToShow", [], "any", false, false, true, 48))) ? ("slick--less") : ("")), ((((        // line 49
($context["display"] ?? null) == "main") && CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "media_switch", [], "any", false, false, true, 49))) ? (("slick--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "media_switch", [], "any", false, false, true, 49), 49, $this->source)))) : ("")), ((((        // line 50
($context["display"] ?? null) == "thumbnail") && CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "thumbnail_caption", [], "any", false, false, true, 50))) ? ("slick--has-caption") : (""))];
        // line 54
        $context["arrow_classes"] = ["slick__arrow", ((CoreExtension::getAttribute($this->env, $this->source,         // line 56
($context["settings"] ?? null), "vertical", [], "any", false, false, true, 56)) ? ("slick__arrow--v") : ("")), ((CoreExtension::getAttribute($this->env, $this->source,         // line 57
($context["settings"] ?? null), "skin_arrows", [], "any", false, false, true, 57)) ? (("slick__arrow--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "skin_arrows", [], "any", false, false, true, 57), 57, $this->source)))) : (""))];
        // line 60
        yield "<div";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 60), 60, $this->source), "html", null, true);
        yield ">";
        // line 61
        if ( !CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "unslick", [], "any", false, false, true, 61)) {
            // line 62
            yield "<div";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["content_attributes"] ?? null), "addClass", ["slick__slider"], "method", false, false, true, 62), 62, $this->source), "html", null, true);
            yield ">";
        }
        // line 65
        yield from $this->unwrap()->yieldBlock('slick_content', $context, $blocks);
        // line 69
        if ( !CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "unslick", [], "any", false, false, true, 69)) {
            // line 70
            yield "</div>
    ";
            // line 71
            yield from $this->unwrap()->yieldBlock('slick_arrow', $context, $blocks);
        }
        // line 85
        yield "</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["settings", "arrow_down_attributes", "display", "blazies", "attributes", "content_attributes", "items", "arrow_attributes"]);        yield from [];
    }

    // line 65
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_slick_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 66
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["items"] ?? null), 66, $this->source), "html", null, true);
        yield from [];
    }

    // line 71
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_slick_arrow(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 72
        yield "      <nav";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["arrow_attributes"] ?? null), "addClass", [($context["arrow_classes"] ?? null)], "method", false, false, true, 72), 72, $this->source), "html", null, true);
        yield ">
        <button type=\"button\" data-role=\"none\" class=\"slick-prev\" aria-label=\"";
        // line 73
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, Twig\Extension\CoreExtension::striptags(t($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "prevArrow", [], "any", false, false, true, 73), 73, $this->source))), "html", null, true);
        yield "\" tabindex=\"0\">";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "prevArrow", [], "any", false, false, true, 73), 73, $this->source)));
        yield "</button>";
        // line 74
        if (array_key_exists("arrow_down_attributes", $context)) {
            // line 75
            yield "<button";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["arrow_down_attributes"] ?? null), "addClass", ["slick-down"], "method", false, false, true, 75), "setAttribute", ["type", "button"], "method", false, false, true, 75), "setAttribute", ["data-role", "none"], "method", false, false, true, 76), "setAttribute", ["data-target", CoreExtension::getAttribute($this->env, $this->source,             // line 78
($context["settings"] ?? null), "downArrowTarget", [], "any", false, false, true, 78)], "method", false, false, true, 77), "setAttribute", ["data-offset", CoreExtension::getAttribute($this->env, $this->source,             // line 79
($context["settings"] ?? null), "downArrowOffset", [], "any", false, false, true, 79)], "method", false, false, true, 78), 79, $this->source), "html", null, true);
            yield "></button>";
        }
        // line 81
        yield "<button type=\"button\" data-role=\"none\" class=\"slick-next\" aria-label=\"";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, Twig\Extension\CoreExtension::striptags(t($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "nextArrow", [], "any", false, false, true, 81), 81, $this->source))), "html", null, true);
        yield "\" tabindex=\"0\">";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "nextArrow", [], "any", false, false, true, 81), 81, $this->source)));
        yield "</button>
      </nav>
    ";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/contrib/slick/templates/slick.html.twig";
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
        return array (  131 => 81,  127 => 79,  126 => 78,  124 => 75,  122 => 74,  117 => 73,  112 => 72,  105 => 71,  100 => 66,  93 => 65,  86 => 85,  83 => 71,  80 => 70,  78 => 69,  76 => 65,  71 => 62,  69 => 61,  65 => 60,  63 => 57,  62 => 56,  61 => 54,  59 => 50,  58 => 49,  57 => 48,  56 => 47,  55 => 46,  54 => 45,  53 => 44,  52 => 43,  51 => 42,  50 => 41,  49 => 40,  48 => 39,  47 => 38,  46 => 37,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "modules/contrib/slick/templates/slick.html.twig", "C:\\xampp\\htdocs\\test_drupal_site\\web\\modules\\contrib\\slick\\templates\\slick.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 37, "if" => 61, "block" => 65);
        static $filters = array("join" => 40, "clean_class" => 41, "escape" => 60, "striptags" => 73, "t" => 73);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'block'],
                ['join', 'clean_class', 'escape', 'striptags', 't'],
                [],
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
