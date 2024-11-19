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

/* themes/contrib/bootstrap_barrio/templates/layout/region--full-width.html.twig */
class __TwigTemplate_48169aa031f3fb63b01392a82d50feb5 extends Template
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
        $context["region_attributes"] = ($context["attributes"] ?? null);
        // line 17
        $context["classes"] = ["region", ("region-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 19
($context["region"] ?? null), 19, $this->source)))];
        // line 22
        if (($context["content"] ?? null)) {
            // line 23
            yield "  ";
            yield from             $this->loadTemplate("themes/contrib/bootstrap_barrio/templates/layout/region--full-width.html.twig", "themes/contrib/bootstrap_barrio/templates/layout/region--full-width.html.twig", 23, "2005270061")->unwrap()->yield(CoreExtension::merge($context, ["attributes" => $this->extensions['Drupal\Core\Template\TwigExtension']->createAttribute(["class" => [("region-wrapper-" . \Drupal\Component\Utility\Html::getClass(            // line 24
($context["region"] ?? null)))]]), "full_width" => true, "container" => true]));
        }
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["attributes", "region", "content"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/bootstrap_barrio/templates/layout/region--full-width.html.twig";
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
        return array (  53 => 24,  51 => 23,  49 => 22,  47 => 19,  46 => 17,  44 => 15,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/contrib/bootstrap_barrio/templates/layout/region--full-width.html.twig", "C:\\xampp\\htdocs\\test_drupal_site\\web\\themes\\contrib\\bootstrap_barrio\\templates\\layout\\region--full-width.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 15, "if" => 22, "embed" => 23);
        static $filters = array("clean_class" => 19);
        static $functions = array("create_attribute" => 24);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'embed'],
                ['clean_class'],
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


/* themes/contrib/bootstrap_barrio/templates/layout/region--full-width.html.twig */
class __TwigTemplate_48169aa031f3fb63b01392a82d50feb5___2005270061 extends Template
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

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 23
        return "bootstrap_barrio:container";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("bootstrap_barrio:container", "themes/contrib/bootstrap_barrio/templates/layout/region--full-width.html.twig", 23);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["clean", "region_attributes", "classes", "content"]);    }

    // line 29
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 30
        yield "      ";
        if ( !($context["clean"] ?? null)) {
            // line 31
            yield "        <div";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["region_attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 31), 31, $this->source), "html", null, true);
            yield ">
      ";
        }
        // line 33
        yield "          ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content"] ?? null), 33, $this->source), "html", null, true);
        yield "
      ";
        // line 34
        if ( !($context["clean"] ?? null)) {
            // line 35
            yield "        </div>
      ";
        }
        // line 37
        yield "    ";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/bootstrap_barrio/templates/layout/region--full-width.html.twig";
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
        return array (  183 => 37,  179 => 35,  177 => 34,  172 => 33,  166 => 31,  163 => 30,  156 => 29,  144 => 23,  53 => 24,  51 => 23,  49 => 22,  47 => 19,  46 => 17,  44 => 15,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/contrib/bootstrap_barrio/templates/layout/region--full-width.html.twig", "C:\\xampp\\htdocs\\test_drupal_site\\web\\themes\\contrib\\bootstrap_barrio\\templates\\layout\\region--full-width.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("extends" => 23, "if" => 30);
        static $filters = array("escape" => 31);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['extends', 'if'],
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
