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

/* themes/contrib/bootstrap_barrio/templates/content/comment.html.twig */
class __TwigTemplate_7173d013f21e3a7bfe0a7a9a6404a3c4 extends Template
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
        // line 67
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("bootstrap_barrio/comments"), "html", null, true);
        yield "
";
        // line 69
        $context["classes"] = ["comment", "js-comment", (((        // line 72
($context["status"] ?? null) != "published")) ? (("comment--" . $this->sandbox->ensureToStringAllowed(($context["status"] ?? null), 72, $this->source))) : ("")), ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,         // line 73
($context["comment"] ?? null), "owner", [], "any", false, false, true, 73), "anonymous", [], "any", false, false, true, 73)) ? ("by-anonymous") : ("")), (((        // line 74
($context["author_id"] ?? null) && (($context["author_id"] ?? null) == CoreExtension::getAttribute($this->env, $this->source, ($context["commented_entity"] ?? null), "getOwnerId", [], "method", false, false, true, 74)))) ? ((("by-" . $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["commented_entity"] ?? null), "getEntityTypeId", [], "method", false, false, true, 74), 74, $this->source)) . "-author")) : ("")), "clearfix"];
        // line 78
        yield "<article role=\"article\"";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->withoutFilter($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 78), 78, $this->source), "role"), "html", null, true);
        yield ">

  <div class=\"comment__meta col-sm-3\">
    ";
        // line 86
        yield "    <span class=\"hidden text-danger\" data-comment-timestamp=\"";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["new_indicator_timestamp"] ?? null), 86, $this->source), "html", null, true);
        yield "\"></span>
    ";
        // line 87
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["user_picture"] ?? null), 87, $this->source), "html", null, true);
        yield "
    <small class=\"comment__author\">";
        // line 88
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["author"] ?? null), 88, $this->source), "html", null, true);
        yield "</small>
    ";
        // line 94
        yield "    ";
        if (($context["parent"] ?? null)) {
            // line 95
            yield "      <p class=\"visually-hidden\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["parent"] ?? null), 95, $this->source), "html", null, true);
            yield "</p>
    ";
        }
        // line 97
        yield "  </div>

  <div";
        // line 99
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["content_attributes"] ?? null), "addClass", [["comment__content", "col-sm-9", "card"]], "method", false, false, true, 99), 99, $this->source), "html", null, true);
        yield ">
    <div class=\"card-body\">
      ";
        // line 101
        if (($context["title"] ?? null)) {
            // line 102
            yield "        ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null), 102, $this->source), "html", null, true);
            yield "
        <h3";
            // line 103
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["title_attributes"] ?? null), "addClass", ["card-title"], "method", false, false, true, 103), 103, $this->source), "html", null, true);
            yield ">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 103, $this->source), "html", null, true);
            yield "</h3>
        ";
            // line 104
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null), 104, $this->source), "html", null, true);
            yield "
      ";
        }
        // line 106
        yield "      ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->withoutFilter($this->sandbox->ensureToStringAllowed(($context["content"] ?? null), 106, $this->source), "links"), "html", null, true);
        yield "
      ";
        // line 107
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "links", [], "any", false, false, true, 107)) {
            // line 108
            yield "        <nav>";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "links", [], "any", false, false, true, 108), 108, $this->source), "html", null, true);
            yield "</nav>
      ";
        }
        // line 110
        yield "    </div>
    <div class=\"card-body\">
      <span class=\"comment__time\">";
        // line 112
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["created"] ?? null), 112, $this->source), "html", null, true);
        yield "</span>
      <span class=\"comment__permalink\">";
        // line 113
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["permalink"] ?? null), 113, $this->source), "html", null, true);
        yield "</span>
    </div>
  </div>
</article>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["status", "comment", "author_id", "commented_entity", "attributes", "new_indicator_timestamp", "user_picture", "author", "parent", "content_attributes", "title", "title_prefix", "title_attributes", "title_suffix", "content", "created", "permalink"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/bootstrap_barrio/templates/content/comment.html.twig";
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
        return array (  130 => 113,  126 => 112,  122 => 110,  116 => 108,  114 => 107,  109 => 106,  104 => 104,  98 => 103,  93 => 102,  91 => 101,  86 => 99,  82 => 97,  76 => 95,  73 => 94,  69 => 88,  65 => 87,  60 => 86,  53 => 78,  51 => 74,  50 => 73,  49 => 72,  48 => 69,  44 => 67,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/contrib/bootstrap_barrio/templates/content/comment.html.twig", "C:\\xampp\\htdocs\\test_drupal_site\\web\\themes\\contrib\\bootstrap_barrio\\templates\\content\\comment.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 69, "if" => 94);
        static $filters = array("escape" => 67, "without" => 78);
        static $functions = array("attach_library" => 67);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape', 'without'],
                ['attach_library'],
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
