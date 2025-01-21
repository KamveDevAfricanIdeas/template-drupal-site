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

/* core/modules/system/templates/status-report-general-info.html.twig */
class __TwigTemplate_5ec347f1abde0f555238ba2fc60076fb extends Template
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
        // line 32
        yield "
<h2>";
        // line 33
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("General System Information"));
        yield "</h2>
<div class=\"system-status-general-info__item\">
  <h3 class=\"system-status-general-info__item-title\">";
        // line 35
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Drupal Version"));
        yield "</h3>
  ";
        // line 36
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["drupal"] ?? null), "value", [], "any", false, false, true, 36), 36, $this->source), "html", null, true);
        yield "
  ";
        // line 37
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["drupal"] ?? null), "description", [], "any", false, false, true, 37)) {
            // line 38
            yield "    ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["drupal"] ?? null), "description", [], "any", false, false, true, 38), 38, $this->source), "html", null, true);
            yield "
  ";
        }
        // line 40
        yield "</div>
<div class=\"system-status-general-info__item\">
  <h3 class=\"system-status-general-info__item-title\">";
        // line 42
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Last Cron Run"));
        yield "</h3>
  ";
        // line 43
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["cron"] ?? null), "value", [], "any", false, false, true, 43), 43, $this->source), "html", null, true);
        yield "
  ";
        // line 44
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["cron"] ?? null), "run_cron", [], "any", false, false, true, 44)) {
            // line 45
            yield "    ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["cron"] ?? null), "run_cron", [], "any", false, false, true, 45), 45, $this->source), "html", null, true);
            yield "
  ";
        }
        // line 47
        yield "  ";
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["cron"] ?? null), "description", [], "any", false, false, true, 47)) {
            // line 48
            yield "    ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["cron"] ?? null), "description", [], "any", false, false, true, 48), 48, $this->source), "html", null, true);
            yield "
  ";
        }
        // line 50
        yield "</div>
<div class=\"system-status-general-info__item\">
  <h3 class=\"system-status-general-info__item-title\">";
        // line 52
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Web Server"));
        yield "</h3>
  ";
        // line 53
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["webserver"] ?? null), "value", [], "any", false, false, true, 53), 53, $this->source), "html", null, true);
        yield "
  ";
        // line 54
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["webserver"] ?? null), "description", [], "any", false, false, true, 54)) {
            // line 55
            yield "    ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["webserver"] ?? null), "description", [], "any", false, false, true, 55), 55, $this->source), "html", null, true);
            yield "
  ";
        }
        // line 57
        yield "</div>
<div class=\"system-status-general-info__item\">
  <h3 class=\"system-status-general-info__item-title\">";
        // line 59
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("PHP"));
        yield "</h3>
  <h4>";
        // line 60
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Version"));
        yield "</h4> ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["php"] ?? null), "value", [], "any", false, false, true, 60), 60, $this->source), "html", null, true);
        yield "
  ";
        // line 61
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["php"] ?? null), "description", [], "any", false, false, true, 61)) {
            // line 62
            yield "    ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["php"] ?? null), "description", [], "any", false, false, true, 62), 62, $this->source), "html", null, true);
            yield "
  ";
        }
        // line 64
        yield "
  <h4>";
        // line 65
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Memory limit"));
        yield "</h4>";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["php_memory_limit"] ?? null), "value", [], "any", false, false, true, 65), 65, $this->source), "html", null, true);
        yield "
  ";
        // line 66
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["php_memory_limit"] ?? null), "description", [], "any", false, false, true, 66)) {
            // line 67
            yield "    ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["php_memory_limit"] ?? null), "description", [], "any", false, false, true, 67), 67, $this->source), "html", null, true);
            yield "
  ";
        }
        // line 69
        yield "</div>
<div class=\"system-status-general-info__item\">
  <h3 class=\"system-status-general-info__item-title\">";
        // line 71
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Database"));
        yield "</h3>
  <h4>";
        // line 72
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Version"));
        yield "</h4>";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["database_system_version"] ?? null), "value", [], "any", false, false, true, 72), 72, $this->source), "html", null, true);
        yield "
  ";
        // line 73
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["database_system_version"] ?? null), "description", [], "any", false, false, true, 73)) {
            // line 74
            yield "    ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["database_system_version"] ?? null), "description", [], "any", false, false, true, 74), 74, $this->source), "html", null, true);
            yield "
  ";
        }
        // line 76
        yield "
  <h4>";
        // line 77
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("System"));
        yield "</h4>";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["database_system"] ?? null), "value", [], "any", false, false, true, 77), 77, $this->source), "html", null, true);
        yield "
  ";
        // line 78
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["database_system"] ?? null), "description", [], "any", false, false, true, 78)) {
            // line 79
            yield "    ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["database_system"] ?? null), "description", [], "any", false, false, true, 79), 79, $this->source), "html", null, true);
            yield "
  ";
        }
        // line 81
        yield "</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["drupal", "cron", "webserver", "php", "php_memory_limit", "database_system_version", "database_system"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "core/modules/system/templates/status-report-general-info.html.twig";
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
        return array (  195 => 81,  189 => 79,  187 => 78,  181 => 77,  178 => 76,  172 => 74,  170 => 73,  164 => 72,  160 => 71,  156 => 69,  150 => 67,  148 => 66,  142 => 65,  139 => 64,  133 => 62,  131 => 61,  125 => 60,  121 => 59,  117 => 57,  111 => 55,  109 => 54,  105 => 53,  101 => 52,  97 => 50,  91 => 48,  88 => 47,  82 => 45,  80 => 44,  76 => 43,  72 => 42,  68 => 40,  62 => 38,  60 => 37,  56 => 36,  52 => 35,  47 => 33,  44 => 32,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "core/modules/system/templates/status-report-general-info.html.twig", "C:\\xampp\\htdocs\\test_drupal_site\\web\\core\\modules\\system\\templates\\status-report-general-info.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 37);
        static $filters = array("t" => 33, "escape" => 36);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['t', 'escape'],
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
