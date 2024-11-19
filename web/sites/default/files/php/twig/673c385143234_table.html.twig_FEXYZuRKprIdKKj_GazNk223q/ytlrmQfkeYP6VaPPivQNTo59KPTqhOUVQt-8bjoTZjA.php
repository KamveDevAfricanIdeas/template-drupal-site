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

/* themes/contrib/bootstrap_barrio/templates/dataset/table.html.twig */
class __TwigTemplate_2dd7b0f0cc9e26a0fc095f4b4055ffc3 extends Template
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
        // line 43
        yield "
";
        // line 45
        $context["table_classes"] = ["table", ((        // line 47
($context["hover"] ?? null)) ? ("table-hover") : ("")), (( !        // line 48
($context["no_striping"] ?? null)) ? ("table-striped") : ("table-bordered"))];
        // line 51
        yield "<div class=\"table-responsive\">
<table";
        // line 52
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["table_classes"] ?? null)], "method", false, false, true, 52), 52, $this->source), "html", null, true);
        yield ">
  ";
        // line 53
        if (($context["caption"] ?? null)) {
            // line 54
            yield "    <caption>";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["caption"] ?? null), 54, $this->source), "html", null, true);
            yield "</caption>
  ";
        }
        // line 56
        yield "
  ";
        // line 57
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["colgroups"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["colgroup"]) {
            // line 58
            yield "    ";
            if (CoreExtension::getAttribute($this->env, $this->source, $context["colgroup"], "cols", [], "any", false, false, true, 58)) {
                // line 59
                yield "      <colgroup";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["colgroup"], "attributes", [], "any", false, false, true, 59), 59, $this->source), "html", null, true);
                yield ">
        ";
                // line 60
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["colgroup"], "cols", [], "any", false, false, true, 60));
                foreach ($context['_seq'] as $context["_key"] => $context["col"]) {
                    // line 61
                    yield "          <col";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["col"], "attributes", [], "any", false, false, true, 61), 61, $this->source), "html", null, true);
                    yield " />
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['col'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 63
                yield "      </colgroup>
    ";
            } else {
                // line 65
                yield "      <colgroup";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["colgroup"], "attributes", [], "any", false, false, true, 65), 65, $this->source), "html", null, true);
                yield " />
    ";
            }
            // line 67
            yield "  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['colgroup'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 68
        yield "
  ";
        // line 69
        if (($context["header"] ?? null)) {
            // line 70
            yield "    <thead class='";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["thead_class"] ?? null), 70, $this->source), "html", null, true);
            yield "'>
      <tr>
        ";
            // line 72
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["header"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["cell"]) {
                // line 73
                yield "          ";
                // line 74
                $context["cell_classes"] = [((CoreExtension::getAttribute($this->env, $this->source,                 // line 75
$context["cell"], "active_table_sort", [], "any", false, false, true, 75)) ? ("active") : (""))];
                // line 78
                yield "          <";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "tag", [], "any", false, false, true, 78), 78, $this->source), "html", null, true);
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "attributes", [], "any", false, false, true, 78), "addClass", [($context["cell_classes"] ?? null)], "method", false, false, true, 78), 78, $this->source), "html", null, true);
                yield ">";
                // line 79
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "content", [], "any", false, false, true, 79), 79, $this->source), "html", null, true);
                // line 80
                yield "</";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "tag", [], "any", false, false, true, 80), 80, $this->source), "html", null, true);
                yield ">
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['cell'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 82
            yield "      </tr>
    </thead>
  ";
        }
        // line 85
        yield "
  ";
        // line 86
        if (($context["rows"] ?? null)) {
            // line 87
            yield "    <tbody>
      ";
            // line 88
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["rows"] ?? null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 89
                yield "        ";
                // line 90
                $context["row_classes"] = [(( !                // line 91
($context["no_striping"] ?? null)) ? (Twig\Extension\CoreExtension::cycle(["odd", "even"], $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, true, 91), 91, $this->source))) : (""))];
                // line 94
                yield "        <tr";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["row"], "attributes", [], "any", false, false, true, 94), "addClass", [($context["row_classes"] ?? null)], "method", false, false, true, 94), 94, $this->source), "html", null, true);
                yield ">
          ";
                // line 95
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "cells", [], "any", false, false, true, 95));
                foreach ($context['_seq'] as $context["_key"] => $context["cell"]) {
                    // line 96
                    yield "            <";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "tag", [], "any", false, false, true, 96), 96, $this->source), "html", null, true);
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "attributes", [], "any", false, false, true, 96), 96, $this->source), "html", null, true);
                    yield ">";
                    // line 97
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "content", [], "any", false, false, true, 97), 97, $this->source), "html", null, true);
                    // line 98
                    yield "</";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "tag", [], "any", false, false, true, 98), 98, $this->source), "html", null, true);
                    yield ">
          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['cell'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 100
                yield "        </tr>
      ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 102
            yield "    </tbody>
  ";
        } elseif (        // line 103
($context["empty"] ?? null)) {
            // line 104
            yield "    <tbody>
      <tr class=\"odd\">
        <td colspan=\"";
            // line 106
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["header_columns"] ?? null), 106, $this->source), "html", null, true);
            yield "\" class=\"empty message\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["empty"] ?? null), 106, $this->source), "html", null, true);
            yield "</td>
      </tr>
    </tbody>
  ";
        }
        // line 110
        yield "  ";
        if (($context["footer"] ?? null)) {
            // line 111
            yield "    <tfoot>
      ";
            // line 112
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["footer"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 113
                yield "        <tr";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "attributes", [], "any", false, false, true, 113), 113, $this->source), "html", null, true);
                yield ">
          ";
                // line 114
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "cells", [], "any", false, false, true, 114));
                foreach ($context['_seq'] as $context["_key"] => $context["cell"]) {
                    // line 115
                    yield "            <";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "tag", [], "any", false, false, true, 115), 115, $this->source), "html", null, true);
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "attributes", [], "any", false, false, true, 115), 115, $this->source), "html", null, true);
                    yield ">";
                    // line 116
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "content", [], "any", false, false, true, 116), 116, $this->source), "html", null, true);
                    // line 117
                    yield "</";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "tag", [], "any", false, false, true, 117), 117, $this->source), "html", null, true);
                    yield ">
          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['cell'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 119
                yield "        </tr>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['row'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 121
            yield "    </tfoot>
  ";
        }
        // line 123
        yield "</table>
</div>";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["hover", "no_striping", "attributes", "caption", "colgroups", "header", "thead_class", "rows", "loop", "empty", "header_columns", "footer"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/bootstrap_barrio/templates/dataset/table.html.twig";
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
        return array (  285 => 123,  281 => 121,  274 => 119,  265 => 117,  263 => 116,  258 => 115,  254 => 114,  249 => 113,  245 => 112,  242 => 111,  239 => 110,  230 => 106,  226 => 104,  224 => 103,  221 => 102,  206 => 100,  197 => 98,  195 => 97,  190 => 96,  186 => 95,  181 => 94,  179 => 91,  178 => 90,  176 => 89,  159 => 88,  156 => 87,  154 => 86,  151 => 85,  146 => 82,  137 => 80,  135 => 79,  130 => 78,  128 => 75,  127 => 74,  125 => 73,  121 => 72,  115 => 70,  113 => 69,  110 => 68,  104 => 67,  98 => 65,  94 => 63,  85 => 61,  81 => 60,  76 => 59,  73 => 58,  69 => 57,  66 => 56,  60 => 54,  58 => 53,  54 => 52,  51 => 51,  49 => 48,  48 => 47,  47 => 45,  44 => 43,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/contrib/bootstrap_barrio/templates/dataset/table.html.twig", "C:\\xampp\\htdocs\\test_drupal_site\\web\\themes\\contrib\\bootstrap_barrio\\templates\\dataset\\table.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 45, "if" => 53, "for" => 57);
        static $filters = array("escape" => 52);
        static $functions = array("cycle" => 91);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'for'],
                ['escape'],
                ['cycle'],
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
