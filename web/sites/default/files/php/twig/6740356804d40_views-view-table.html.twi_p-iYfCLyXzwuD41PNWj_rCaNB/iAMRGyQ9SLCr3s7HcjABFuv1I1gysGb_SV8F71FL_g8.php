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

/* themes/contrib/bootstrap_barrio/templates/views/views-view-table.html.twig */
class __TwigTemplate_aa32118d4d4b8b369da1564587368951 extends Template
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
        // line 34
        $context["classes"] = ["table", ((        // line 36
($context["hover"] ?? null)) ? ("table-hover") : ("")),         // line 37
($context["table_class"] ?? null), "views-table", "views-view-table", ("cols-" . Twig\Extension\CoreExtension::length($this->env->getCharset(), $this->sandbox->ensureToStringAllowed(        // line 40
($context["header"] ?? null), 40, $this->source))), ((        // line 41
($context["responsive"] ?? null)) ? ("responsive-enabled") : ("")), ((        // line 42
($context["sticky"] ?? null)) ? ("sticky-enabled") : (""))];
        // line 45
        yield "<div class=\"table-responsive col\">
<table";
        // line 46
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 46), 46, $this->source), "html", null, true);
        yield ">
  ";
        // line 47
        if (($context["caption_needed"] ?? null)) {
            // line 48
            yield "    <caption>
    ";
            // line 49
            if (($context["caption"] ?? null)) {
                // line 50
                yield "      ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["caption"] ?? null), 50, $this->source), "html", null, true);
                yield "
    ";
            } else {
                // line 52
                yield "      ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 52, $this->source), "html", null, true);
                yield "
    ";
            }
            // line 54
            yield "    ";
            if (( !Twig\Extension\CoreExtension::testEmpty(($context["summary"] ?? null)) ||  !Twig\Extension\CoreExtension::testEmpty(($context["description"] ?? null)))) {
                // line 55
                yield "      <details>
        ";
                // line 56
                if ( !Twig\Extension\CoreExtension::testEmpty(($context["summary"] ?? null))) {
                    // line 57
                    yield "          <summary>";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["summary"] ?? null), 57, $this->source), "html", null, true);
                    yield "</summary>
        ";
                }
                // line 59
                yield "        ";
                if ( !Twig\Extension\CoreExtension::testEmpty(($context["description"] ?? null))) {
                    // line 60
                    yield "          ";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["description"] ?? null), 60, $this->source), "html", null, true);
                    yield "
        ";
                }
                // line 62
                yield "      </details>
    ";
            }
            // line 64
            yield "    </caption>
  ";
        }
        // line 66
        yield "  ";
        if (($context["header"] ?? null)) {
            // line 67
            yield "    <thead class='";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["thead_class"] ?? null), 67, $this->source), "html", null, true);
            yield "'>
      <tr>
        ";
            // line 69
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["header"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["column"]) {
                // line 70
                yield "          ";
                if (CoreExtension::getAttribute($this->env, $this->source, $context["column"], "default_classes", [], "any", false, false, true, 70)) {
                    // line 71
                    yield "            ";
                    // line 72
                    $context["column_classes"] = ["views-field", ("views-field-" . $this->sandbox->ensureToStringAllowed((($__internal_compile_0 =                     // line 74
($context["fields"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess && in_array($__internal_compile_0::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($__internal_compile_0[$context["key"]] ?? null) : CoreExtension::getAttribute($this->env, $this->source, ($context["fields"] ?? null), $context["key"], [], "array", false, false, true, 74)), 74, $this->source))];
                    // line 77
                    yield "          ";
                }
                // line 78
                yield "          <th";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["column"], "attributes", [], "any", false, false, true, 78), "addClass", [($context["column_classes"] ?? null)], "method", false, false, true, 78), "setAttribute", ["scope", "col"], "method", false, false, true, 78), 78, $this->source), "html", null, true);
                yield ">";
                // line 79
                if (CoreExtension::getAttribute($this->env, $this->source, $context["column"], "wrapper_element", [], "any", false, false, true, 79)) {
                    // line 80
                    yield "<";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["column"], "wrapper_element", [], "any", false, false, true, 80), 80, $this->source), "html", null, true);
                    yield ">";
                    // line 81
                    if (CoreExtension::getAttribute($this->env, $this->source, $context["column"], "url", [], "any", false, false, true, 81)) {
                        // line 82
                        yield "<a href=\"";
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["column"], "url", [], "any", false, false, true, 82), 82, $this->source), "html", null, true);
                        yield "\" title=\"";
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["column"], "title", [], "any", false, false, true, 82), 82, $this->source), "html", null, true);
                        yield "\">";
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["column"], "content", [], "any", false, false, true, 82), 82, $this->source), "html", null, true);
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["column"], "sort_indicator", [], "any", false, false, true, 82), 82, $this->source), "html", null, true);
                        yield "</a>";
                    } else {
                        // line 84
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["column"], "content", [], "any", false, false, true, 84), 84, $this->source), "html", null, true);
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["column"], "sort_indicator", [], "any", false, false, true, 84), 84, $this->source), "html", null, true);
                    }
                    // line 86
                    yield "</";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["column"], "wrapper_element", [], "any", false, false, true, 86), 86, $this->source), "html", null, true);
                    yield ">";
                } else {
                    // line 88
                    if (CoreExtension::getAttribute($this->env, $this->source, $context["column"], "url", [], "any", false, false, true, 88)) {
                        // line 89
                        yield "<a href=\"";
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["column"], "url", [], "any", false, false, true, 89), 89, $this->source), "html", null, true);
                        yield "\" title=\"";
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["column"], "title", [], "any", false, false, true, 89), 89, $this->source), "html", null, true);
                        yield "\">";
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["column"], "content", [], "any", false, false, true, 89), 89, $this->source), "html", null, true);
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["column"], "sort_indicator", [], "any", false, false, true, 89), 89, $this->source), "html", null, true);
                        yield "</a>";
                    } else {
                        // line 91
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["column"], "content", [], "any", false, false, true, 91), 91, $this->source), "html", null, true);
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["column"], "sort_indicator", [], "any", false, false, true, 91), 91, $this->source), "html", null, true);
                    }
                }
                // line 94
                yield "</th>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['key'], $context['column'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 96
            yield "      </tr>
    </thead>
  ";
        }
        // line 99
        yield "  <tbody>
    ";
        // line 100
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["rows"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 101
            yield "      <tr";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "attributes", [], "any", false, false, true, 101), 101, $this->source), "html", null, true);
            yield ">
        ";
            // line 102
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "columns", [], "any", false, false, true, 102));
            foreach ($context['_seq'] as $context["key"] => $context["column"]) {
                // line 103
                yield "          ";
                if (CoreExtension::getAttribute($this->env, $this->source, $context["column"], "default_classes", [], "any", false, false, true, 103)) {
                    // line 104
                    yield "            ";
                    // line 105
                    $context["column_classes"] = ["views-field"];
                    // line 109
                    yield "            ";
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["column"], "fields", [], "any", false, false, true, 109));
                    foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
                        // line 110
                        yield "              ";
                        $context["column_classes"] = Twig\Extension\CoreExtension::merge($this->sandbox->ensureToStringAllowed(($context["column_classes"] ?? null), 110, $this->source), [("views-field-" . $this->sandbox->ensureToStringAllowed($context["field"], 110, $this->source))]);
                        // line 111
                        yield "            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_key'], $context['field'], $context['_parent']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 112
                    yield "          ";
                }
                // line 113
                yield "          <td";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["column"], "attributes", [], "any", false, false, true, 113), "addClass", [($context["column_classes"] ?? null)], "method", false, false, true, 113), 113, $this->source), "html", null, true);
                yield ">";
                // line 114
                if (CoreExtension::getAttribute($this->env, $this->source, $context["column"], "wrapper_element", [], "any", false, false, true, 114)) {
                    // line 115
                    yield "<";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["column"], "wrapper_element", [], "any", false, false, true, 115), 115, $this->source), "html", null, true);
                    yield ">
              ";
                    // line 116
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["column"], "content", [], "any", false, false, true, 116));
                    foreach ($context['_seq'] as $context["_key"] => $context["content"]) {
                        // line 117
                        yield "                ";
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["content"], "separator", [], "any", false, false, true, 117), 117, $this->source), "html", null, true);
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["content"], "field_output", [], "any", false, false, true, 117), 117, $this->source), "html", null, true);
                        yield "
              ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_key'], $context['content'], $context['_parent']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 119
                    yield "              </";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["column"], "wrapper_element", [], "any", false, false, true, 119), 119, $this->source), "html", null, true);
                    yield ">";
                } else {
                    // line 121
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["column"], "content", [], "any", false, false, true, 121));
                    foreach ($context['_seq'] as $context["_key"] => $context["content"]) {
                        // line 122
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["content"], "separator", [], "any", false, false, true, 122), 122, $this->source), "html", null, true);
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["content"], "field_output", [], "any", false, false, true, 122), 122, $this->source), "html", null, true);
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_key'], $context['content'], $context['_parent']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                }
                // line 125
                yield "          </td>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['key'], $context['column'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 127
            yield "      </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['row'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 129
        yield "  </tbody>
</table>
</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["hover", "table_class", "header", "responsive", "sticky", "attributes", "caption_needed", "caption", "title", "summary", "description", "thead_class", "fields", "rows"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/bootstrap_barrio/templates/views/views-view-table.html.twig";
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
        return array (  288 => 129,  281 => 127,  274 => 125,  266 => 122,  262 => 121,  257 => 119,  247 => 117,  243 => 116,  238 => 115,  236 => 114,  232 => 113,  229 => 112,  223 => 111,  220 => 110,  215 => 109,  213 => 105,  211 => 104,  208 => 103,  204 => 102,  199 => 101,  195 => 100,  192 => 99,  187 => 96,  180 => 94,  175 => 91,  165 => 89,  163 => 88,  158 => 86,  154 => 84,  144 => 82,  142 => 81,  138 => 80,  136 => 79,  132 => 78,  129 => 77,  127 => 74,  126 => 72,  124 => 71,  121 => 70,  117 => 69,  111 => 67,  108 => 66,  104 => 64,  100 => 62,  94 => 60,  91 => 59,  85 => 57,  83 => 56,  80 => 55,  77 => 54,  71 => 52,  65 => 50,  63 => 49,  60 => 48,  58 => 47,  54 => 46,  51 => 45,  49 => 42,  48 => 41,  47 => 40,  46 => 37,  45 => 36,  44 => 34,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/contrib/bootstrap_barrio/templates/views/views-view-table.html.twig", "C:\\xampp\\htdocs\\test_drupal_site\\web\\themes\\contrib\\bootstrap_barrio\\templates\\views\\views-view-table.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 34, "if" => 47, "for" => 69);
        static $filters = array("length" => 40, "escape" => 46, "merge" => 110);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'for'],
                ['length', 'escape', 'merge'],
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
