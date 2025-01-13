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

/* modules/custom/cs_footer_block/templates/footer.html.twig */
class __TwigTemplate_5fc0e1be087dba4440d01d1c18313e8a extends Template
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
        // line 1
        yield "<div class=\"custom-footer\">
  <section class=\"\">
    <!-- Footer -->
    <footer class=\"text-center\">
        <!-- Grid container -->
        <div class=\"container p-4 pb-0\">
          <!-- Section: CTA -->
          <section class=\"\">
              <p class=\"d-flex justify-content-center align-items-center\">
              <span class=\"me-3\">Subscribe to stay up-to-date</span>
              <button data-mdb-ripple-init type=\"button\" class=\"btn btn-outline-light btn-rounded\">
                  Subscribe
              </button>
              </p>
          </section>
          <!-- Section: CTA -->
        </div>
        <!-- Grid container -->
        <!-- Copyright -->
        <div>
            © 2024 Copyright:
          <a style=\"color: #f5f6fa;\" href=\"#\">KhulaZA.gov</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
  </section>
    ";
        // line 29
        yield "</div>


";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/custom/cs_footer_block/templates/footer.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  73 => 29,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "modules/custom/cs_footer_block/templates/footer.html.twig", "C:\\xampp\\htdocs\\test_drupal_site\\web\\modules\\custom\\cs_footer_block\\templates\\footer.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array();
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
                [],
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
