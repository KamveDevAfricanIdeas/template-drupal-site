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

/* core/modules/layout_builder/layouts/fourcol_section/layout--fourcol-section.html.twig */
class __TwigTemplate_78108fb516ffbedcf3df21d791d7dde5 extends Template
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
        // line 15
        $context["classes"] = ["layout", "layout--fourcol-section"];
        // line 20
        if (($context["content"] ?? null)) {
            // line 21
            yield "  <div";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 21), 21, $this->source), "html", null, true);
            yield ">

    ";
            // line 23
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "first", [], "any", false, false, true, 23)) {
                // line 24
                yield "      <div ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["region_attributes"] ?? null), "first", [], "any", false, false, true, 24), "addClass", ["layout__region", "layout__region--first"], "method", false, false, true, 24), 24, $this->source), "html", null, true);
                yield ">
        ";
                // line 25
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "first", [], "any", false, false, true, 25), 25, $this->source), "html", null, true);
                yield "
      </div>
    ";
            }
            // line 28
            yield "
    ";
            // line 29
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "second", [], "any", false, false, true, 29)) {
                // line 30
                yield "      <div ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["region_attributes"] ?? null), "second", [], "any", false, false, true, 30), "addClass", ["layout__region", "layout__region--second"], "method", false, false, true, 30), 30, $this->source), "html", null, true);
                yield ">
        ";
                // line 31
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "second", [], "any", false, false, true, 31), 31, $this->source), "html", null, true);
                yield "
      </div>
    ";
            }
            // line 34
            yield "
    ";
            // line 35
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "third", [], "any", false, false, true, 35)) {
                // line 36
                yield "      <div ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["region_attributes"] ?? null), "third", [], "any", false, false, true, 36), "addClass", ["layout__region", "layout__region--third"], "method", false, false, true, 36), 36, $this->source), "html", null, true);
                yield ">
        ";
                // line 37
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "third", [], "any", false, false, true, 37), 37, $this->source), "html", null, true);
                yield "
      </div>
    ";
            }
            // line 40
            yield "
    ";
            // line 41
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "fourth", [], "any", false, false, true, 41)) {
                // line 42
                yield "      <div ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["region_attributes"] ?? null), "fourth", [], "any", false, false, true, 42), "addClass", ["layout__region", "layout__region--fourth"], "method", false, false, true, 42), 42, $this->source), "html", null, true);
                yield ">
        ";
                // line 43
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "fourth", [], "any", false, false, true, 43), 43, $this->source), "html", null, true);
                yield "
      </div>
    ";
            }
            // line 46
            yield "
  </div>
";
        }
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["content", "attributes", "region_attributes"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "core/modules/layout_builder/layouts/fourcol_section/layout--fourcol-section.html.twig";
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
        return array (  115 => 46,  109 => 43,  104 => 42,  102 => 41,  99 => 40,  93 => 37,  88 => 36,  86 => 35,  83 => 34,  77 => 31,  72 => 30,  70 => 29,  67 => 28,  61 => 25,  56 => 24,  54 => 23,  48 => 21,  46 => 20,  44 => 15,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "core/modules/layout_builder/layouts/fourcol_section/layout--fourcol-section.html.twig", "C:\\xampp\\htdocs\\test_drupal_site\\web\\core\\modules\\layout_builder\\layouts\\fourcol_section\\layout--fourcol-section.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 15, "if" => 20);
        static $filters = array("escape" => 21);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape'],
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
