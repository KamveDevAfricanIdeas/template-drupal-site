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

/* core/modules/system/templates/status-report-grouped.html.twig */
class __TwigTemplate_7e9d7ca0ee0355aa005385690ffd39c3 extends Template
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
        // line 19
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("core/drupal.collapse"), "html", null, true);
        yield "

<div>
  ";
        // line 22
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["grouped_requirements"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
            // line 23
            yield "    <div>
      <h3 id=\"";
            // line 24
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["group"], "type", [], "any", false, false, true, 24), 24, $this->source), "html", null, true);
            yield "\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["group"], "title", [], "any", false, false, true, 24), 24, $this->source), "html", null, true);
            yield "</h3>
      ";
            // line 25
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["group"], "items", [], "any", false, false, true, 25));
            foreach ($context['_seq'] as $context["_key"] => $context["requirement"]) {
                // line 26
                yield "        <details class=\"system-status-report__entry\" open>
          ";
                // line 28
                $context["summary_classes"] = ["system-status-report__status-title", ((CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source,                 // line 30
$context["group"], "type", [], "any", false, false, true, 30), ["warning", "error"])) ? (("system-status-report__status-icon system-status-report__status-icon--" . $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["group"], "type", [], "any", false, false, true, 30), 30, $this->source))) : (""))];
                // line 33
                yield "          <summary";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->createAttribute(["class" => $this->sandbox->ensureToStringAllowed(($context["summary_classes"] ?? null), 33, $this->source)]), "html", null, true);
                yield " role=\"button\">
            ";
                // line 34
                if (CoreExtension::getAttribute($this->env, $this->source, $context["requirement"], "severity_title", [], "any", false, false, true, 34)) {
                    // line 35
                    yield "              <span class=\"visually-hidden\">";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["requirement"], "severity_title", [], "any", false, false, true, 35), 35, $this->source), "html", null, true);
                    yield "</span>
            ";
                }
                // line 37
                yield "            ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["requirement"], "title", [], "any", false, false, true, 37), 37, $this->source), "html", null, true);
                yield "
          </summary>
          <div class=\"system-status-report__entry__value\">
            ";
                // line 40
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["requirement"], "value", [], "any", false, false, true, 40), 40, $this->source), "html", null, true);
                yield "
            ";
                // line 41
                if (CoreExtension::getAttribute($this->env, $this->source, $context["requirement"], "description", [], "any", false, false, true, 41)) {
                    // line 42
                    yield "              <div class=\"description\">";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["requirement"], "description", [], "any", false, false, true, 42), 42, $this->source), "html", null, true);
                    yield "</div>
            ";
                }
                // line 44
                yield "          </div>
        </details>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['requirement'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 47
            yield "    </div>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['group'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
        yield "</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["grouped_requirements"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "core/modules/system/templates/status-report-grouped.html.twig";
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
        return array (  120 => 49,  113 => 47,  105 => 44,  99 => 42,  97 => 41,  93 => 40,  86 => 37,  80 => 35,  78 => 34,  73 => 33,  71 => 30,  70 => 28,  67 => 26,  63 => 25,  57 => 24,  54 => 23,  50 => 22,  44 => 19,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "core/modules/system/templates/status-report-grouped.html.twig", "C:\\xampp\\htdocs\\test_drupal_site\\web\\core\\modules\\system\\templates\\status-report-grouped.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 22, "set" => 28, "if" => 34);
        static $filters = array("escape" => 19);
        static $functions = array("attach_library" => 19, "create_attribute" => 33);

        try {
            $this->sandbox->checkSecurity(
                ['for', 'set', 'if'],
                ['escape'],
                ['attach_library', 'create_attribute'],
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
