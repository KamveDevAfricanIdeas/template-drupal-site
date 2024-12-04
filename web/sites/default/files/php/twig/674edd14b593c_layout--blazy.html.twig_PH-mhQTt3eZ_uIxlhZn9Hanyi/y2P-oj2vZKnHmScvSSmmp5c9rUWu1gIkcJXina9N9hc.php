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

/* modules/contrib/blazy/modules/blazy_layout/templates/layout--blazy.html.twig */
class __TwigTemplate_d2c89c998851379dd148b91883d849c6 extends Template
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
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 7
        $context["wrapper_classes"] = ["b-layout-wrapper", ((CoreExtension::getAttribute($this->env, $this->source,         // line 9
($context["settings"] ?? null), "ete", [], "any", false, false, true, 9)) ? ("b-layout-wrapper--ete") : (""))];
        // line 13
        $context["classes"] = ["b-layout", ((CoreExtension::getAttribute($this->env, $this->source,         // line 15
($context["settings"] ?? null), "ete", [], "any", false, false, true, 15)) ? ("b-layout--ete") : ("")), ((CoreExtension::getAttribute($this->env, $this->source,         // line 16
($context["settings"] ?? null), "id", [], "any", false, false, true, 16)) ? (("b-layout--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "id", [], "any", false, false, true, 16), 16, $this->source)))) : ("")), ((CoreExtension::getAttribute($this->env, $this->source,         // line 17
($context["settings"] ?? null), "background", [], "any", false, false, true, 17)) ? ("b-layout--bg") : (""))];
        // line 20
        $context["common_classes"] = ["grid", "blazy__region", "region"];
        // line 26
        $context["MAIN_TAG"] = ((CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "wrapper", [], "any", true, true, true, 26)) ? (Twig\Extension\CoreExtension::default($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "wrapper", [], "any", false, false, true, 26), 26, $this->source), "div")) : ("div"));
        // line 27
        if (($context["content"] ?? null)) {
            // line 28
            yield "  <div";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["wrapper_attributes"] ?? null), "addClass", [($context["wrapper_classes"] ?? null)], "method", false, false, true, 28), 28, $this->source), "html", null, true);
            yield ">
    <";
            // line 29
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["MAIN_TAG"] ?? null), 29, $this->source), "html", null, true);
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 29), 29, $this->source), "html", null, true);
            yield ">
      ";
            // line 30
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "background", [], "any", false, false, true, 30)) {
                // line 31
                yield "        ";
                $context["REGSETS"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "regions", [], "any", false, false, true, 31), "bg", [], "any", false, false, true, 31);
                // line 32
                yield "        ";
                $context["CUSTOM_CLASSES"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["REGSETS"] ?? null), "settings", [], "any", false, false, true, 32), "classes", [], "any", false, false, true, 32);
                // line 33
                yield "        ";
                $context["IS_EMPTY"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["REGSETS"] ?? null), "settings", [], "any", false, false, true, 33), "empty", [], "any", false, false, true, 33);
                // line 34
                yield "        ";
                // line 35
                $context["bg_classes"] = Twig\Extension\CoreExtension::merge($this->sandbox->ensureToStringAllowed(($context["common_classes"] ?? null), 35, $this->source), ["region--bg", ((                // line 37
($context["IS_EMPTY"] ?? null)) ? ("region--empty") : ("")), (( !Twig\Extension\CoreExtension::testEmpty(                // line 38
($context["CUSTOM_CLASSES"] ?? null))) ? (Twig\Extension\CoreExtension::join($this->sandbox->ensureToStringAllowed(($context["CUSTOM_CLASSES"] ?? null), 38, $this->source), " ")) : (""))]);
                // line 41
                yield "        <div";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["region_attributes"] ?? null), "bg", [], "any", false, false, true, 41), "addClass", [($context["bg_classes"] ?? null)], "method", false, false, true, 41), 41, $this->source), "html", null, true);
                yield ">
          ";
                // line 42
                if ((($context["in_preview"] ?? null) && ($context["IS_EMPTY"] ?? null))) {
                    // line 43
                    yield "            <p class=\"blazy__warning\">";
                    yield t("Any backgrounds require Blazy or builtin Image/Media with Use CSS Background, or just Background color.", array());
                    yield "</p>
          ";
                }
                // line 45
                yield "          ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "bg", [], "any", false, false, true, 45), 45, $this->source), "html", null, true);
                yield "
        </div>
      ";
            }
            // line 48
            yield "      ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["regions"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["region"]) {
                // line 49
                yield "        ";
                $context["REGSETS"] = (($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "regions", [], "any", false, false, true, 49)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess && in_array($__internal_compile_0::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($__internal_compile_0[$context["region"]] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["settings"] ?? null), "regions", [], "any", false, false, true, 49), $context["region"], [], "array", false, false, true, 49));
                // line 50
                yield "        ";
                $context["NAME"] = CoreExtension::getAttribute($this->env, $this->source, ($context["REGSETS"] ?? null), "label", [], "any", false, false, true, 50);
                // line 51
                yield "        ";
                $context["USE_BG"] =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["REGSETS"] ?? null), "settings", [], "any", false, false, true, 51), "background", [], "any", false, false, true, 51));
                // line 52
                yield "        ";
                $context["CUSTOM_CLASSES"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["REGSETS"] ?? null), "settings", [], "any", false, false, true, 52), "classes", [], "any", false, false, true, 52);
                // line 53
                yield "        ";
                $context["REGION_TAG"] = ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["REGSETS"] ?? null), "settings", [], "any", false, true, true, 53), "wrapper", [], "any", true, true, true, 53)) ? (Twig\Extension\CoreExtension::default($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["REGSETS"] ?? null), "settings", [], "any", false, true, true, 53), "wrapper", [], "any", false, false, true, 53), 53, $this->source), "div")) : ("div"));
                // line 54
                yield "        ";
                $context["IS_EMPTY"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["REGSETS"] ?? null), "settings", [], "any", false, false, true, 54), "empty", [], "any", false, false, true, 54);
                // line 55
                yield "        ";
                // line 56
                $context["region_classes"] = Twig\Extension\CoreExtension::merge($this->sandbox->ensureToStringAllowed(($context["common_classes"] ?? null), 56, $this->source), [("region--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(                // line 57
$context["region"], 57, $this->source))), (( !Twig\Extension\CoreExtension::testEmpty(                // line 58
($context["NAME"] ?? null))) ? (("region--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["NAME"] ?? null), 58, $this->source)))) : ("")), ((                // line 59
($context["USE_BG"] ?? null)) ? ("region--b-bg") : ("")), ((                // line 60
($context["IS_EMPTY"] ?? null)) ? ("region--empty") : ("")), (( !Twig\Extension\CoreExtension::testEmpty(                // line 61
($context["CUSTOM_CLASSES"] ?? null))) ? (Twig\Extension\CoreExtension::join($this->sandbox->ensureToStringAllowed(($context["CUSTOM_CLASSES"] ?? null), 61, $this->source), " ")) : (""))]);
                // line 64
                yield "        <";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["REGION_TAG"] ?? null), 64, $this->source), "html", null, true);
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, (($__internal_compile_1 = ($context["region_attributes"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess && in_array($__internal_compile_1::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($__internal_compile_1[$context["region"]] ?? null) : CoreExtension::getAttribute($this->env, $this->source, ($context["region_attributes"] ?? null), $context["region"], [], "array", false, false, true, 64)), "addClass", [($context["region_classes"] ?? null)], "method", false, false, true, 64), 64, $this->source), "html", null, true);
                yield ">
          ";
                // line 66
                yield "          ";
                if (($context["in_preview"] ?? null)) {
                    // line 67
                    yield "            ";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed((($__internal_compile_2 = ($context["content"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess && in_array($__internal_compile_2::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($__internal_compile_2[$context["region"]] ?? null) : CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), $context["region"], [], "array", false, false, true, 67)), 67, $this->source), "html", null, true);
                    yield "
          ";
                } else {
                    // line 69
                    yield "            <div";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, (($__internal_compile_3 = ($context["region_content_attributes"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess && in_array($__internal_compile_3::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($__internal_compile_3[$context["region"]] ?? null) : CoreExtension::getAttribute($this->env, $this->source, ($context["region_content_attributes"] ?? null), $context["region"], [], "array", false, false, true, 69)), "addClass", ["grid__content"], "method", false, false, true, 69), 69, $this->source), "html", null, true);
                    yield ">
              ";
                    // line 70
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed((($__internal_compile_4 = ($context["content"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess && in_array($__internal_compile_4::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($__internal_compile_4[$context["region"]] ?? null) : CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), $context["region"], [], "array", false, false, true, 70)), 70, $this->source), "html", null, true);
                    yield "
            </div>
          ";
                }
                // line 73
                yield "        </";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["REGION_TAG"] ?? null), 73, $this->source), "html", null, true);
                yield ">
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['region'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 75
            yield "    </";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["MAIN_TAG"] ?? null), 75, $this->source), "html", null, true);
            yield ">
  </div>
";
        }
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["settings", "content", "wrapper_attributes", "attributes", "region_attributes", "in_preview", "regions", "region_content_attributes"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/contrib/blazy/modules/blazy_layout/templates/layout--blazy.html.twig";
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
        return array (  172 => 75,  163 => 73,  157 => 70,  152 => 69,  146 => 67,  143 => 66,  137 => 64,  135 => 61,  134 => 60,  133 => 59,  132 => 58,  131 => 57,  130 => 56,  128 => 55,  125 => 54,  122 => 53,  119 => 52,  116 => 51,  113 => 50,  110 => 49,  105 => 48,  98 => 45,  92 => 43,  90 => 42,  85 => 41,  83 => 38,  82 => 37,  81 => 35,  79 => 34,  76 => 33,  73 => 32,  70 => 31,  68 => 30,  63 => 29,  58 => 28,  56 => 27,  54 => 26,  52 => 20,  50 => 17,  49 => 16,  48 => 15,  47 => 13,  45 => 9,  44 => 7,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "modules/contrib/blazy/modules/blazy_layout/templates/layout--blazy.html.twig", "C:\\xampp\\htdocs\\test_drupal_site\\web\\modules\\contrib\\blazy\\modules\\blazy_layout\\templates\\layout--blazy.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 7, "if" => 27, "trans" => 43, "for" => 48);
        static $filters = array("clean_class" => 16, "default" => 26, "escape" => 28, "merge" => 35, "join" => 38);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'trans', 'for'],
                ['clean_class', 'default', 'escape', 'merge', 'join'],
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
