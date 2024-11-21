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

/* themes/custom/khula_theme/templates/page.html.twig */
class __TwigTemplate_fde8f28e815b844081acc08095a92917 extends Template
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
            'head' => [$this, 'block_head'],
            'featured' => [$this, 'block_featured'],
            'content' => [$this, 'block_content'],
            'footer' => [$this, 'block_footer'],
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 71
        $context["sidebar_first_exists"] =  !Twig\Extension\CoreExtension::testEmpty(Twig\Extension\CoreExtension::trim(Twig\Extension\CoreExtension::striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 71), 71, $this->source)), "<img><video><audio><drupal-render-placeholder>")));
        // line 72
        $context["sidebar_second_exists"] =  !Twig\Extension\CoreExtension::testEmpty(Twig\Extension\CoreExtension::trim(Twig\Extension\CoreExtension::striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 72), 72, $this->source)), "<img><video><audio><drupal-render-placeholder>")));
        // line 73
        yield "
<div id=\"page-wrapper\">
  <div id=\"page\">
    <header id=\"header\" class=\"header\" role=\"banner\" aria-label=\"";
        // line 76
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Site header"));
        yield "\">
      ";
        // line 78
        yield "      ";
        yield from $this->unwrap()->yieldBlock('head', $context, $blocks);
        // line 127
        yield "
    ";
        // line 129
        yield "    </header>
    ";
        // line 130
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "highlighted", [], "any", false, false, true, 130)) {
            // line 131
            yield "      <div class=\"highlighted\">
        <aside class=\"";
            // line 132
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 132, $this->source), "html", null, true);
            yield " section clearfix\" role=\"complementary\">
          ";
            // line 133
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "highlighted", [], "any", false, false, true, 133), 133, $this->source), "html", null, true);
            yield "
        </aside>
      </div>
    ";
        }
        // line 137
        yield "    ";
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_top", [], "any", false, false, true, 137)) {
            // line 138
            yield "      ";
            yield from $this->unwrap()->yieldBlock('featured', $context, $blocks);
            // line 145
            yield "    ";
        }
        // line 146
        yield "    <div id=\"main-wrapper\" class=\"h-auto layout-main-wrapper clearfix\">
      ";
        // line 147
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 174
        yield "    </div>
    ";
        // line 175
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_first", [], "any", false, false, true, 175) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_second", [], "any", false, false, true, 175)) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_third", [], "any", false, false, true, 175))) {
            // line 176
            yield "      <div class=\"featured-bottom\">
        <aside class=\"";
            // line 177
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 177, $this->source), "html", null, true);
            yield " clearfix\" role=\"complementary\">
          ";
            // line 178
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_first", [], "any", false, false, true, 178), 178, $this->source), "html", null, true);
            yield "
          ";
            // line 179
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_second", [], "any", false, false, true, 179), 179, $this->source), "html", null, true);
            yield "
          ";
            // line 180
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_third", [], "any", false, false, true, 180), 180, $this->source), "html", null, true);
            yield "
        </aside>
      </div>
    ";
        }
        // line 184
        yield "
    ";
        // line 186
        yield "    <section class=\"\">
      <!-- Footer -->
      <footer class=\"text-center\" style=\"color: #f5f6fa; background-color: #2f3640;\">
        <!-- Grid container -->
        ";
        // line 190
        yield from $this->unwrap()->yieldBlock('footer', $context, $blocks);
        // line 212
        yield "        <!-- Copyright -->
      </footer>
      <!-- Footer -->
    </section>

  </div>
</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["page", "container", "navbar_top_attributes", "container_navbar", "navbar_attributes", "content_attributes", "sidebar_first_attributes", "sidebar_second_attributes"]);        yield from [];
    }

    // line 78
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_head(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 79
        yield "        ";
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "secondary_menu", [], "any", false, false, true, 79) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "top_header", [], "any", false, false, true, 79)) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "top_header_form", [], "any", false, false, true, 79))) {
            // line 80
            yield "          <nav";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["navbar_top_attributes"] ?? null), 80, $this->source), "html", null, true);
            yield ">
            ";
            // line 81
            if (($context["container_navbar"] ?? null)) {
                // line 82
                yield "            <div class=\"container\">
            ";
            }
            // line 84
            yield "                ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "secondary_menu", [], "any", false, false, true, 84), 84, $this->source), "html", null, true);
            yield "
                ";
            // line 85
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "top_header", [], "any", false, false, true, 85), 85, $this->source), "html", null, true);
            yield "
                ";
            // line 86
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "top_header_form", [], "any", false, false, true, 86)) {
                // line 87
                yield "                  <div class=\"form-inline navbar-form ms-auto\">
                    ";
                // line 88
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "top_header_form", [], "any", false, false, true, 88), 88, $this->source), "html", null, true);
                yield "
                  </div>
                ";
            }
            // line 91
            yield "            ";
            if (($context["container_navbar"] ?? null)) {
                // line 92
                yield "            </div>
            ";
            }
            // line 94
            yield "          </nav>
        ";
        }
        // line 96
        yield "
        ";
        // line 98
        yield "        ";
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, true, 98) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 98)) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header_form", [], "any", false, false, true, 98))) {
            // line 99
            yield "          <nav";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["navbar_attributes"] ?? null), 99, $this->source), "html", null, true);
            yield " class=\"navbar navbar-expand-md navbar-light bg-light p-5\">
            ";
            // line 100
            if (($context["container_navbar"] ?? null)) {
                // line 101
                yield "              <div class=\"container\">
            ";
            }
            // line 103
            yield "              ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, true, 103), 103, $this->source), "html", null, true);
            yield "
              ";
            // line 104
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 104) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header_form", [], "any", false, false, true, 104))) {
                // line 105
                yield "                <!-- Navbar Toggler (Burger Menu) -->
                <button class=\"navbar-toggler collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#CollapsingNavbar\" aria-controls=\"CollapsingNavbar\" aria-expanded=\"false\" aria-label=\"";
                // line 106
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Toggle navigation"));
                yield "\">
                  <span class=\"navbar-toggler-icon\"></span>
                </button>
                <!-- Navbar Links -->
                ";
                // line 111
                yield "                <div class=\"collapse navbar-collapse\" id=\"CollapsingNavbar\">
                  ";
                // line 112
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 112), 112, $this->source), "html", null, true);
                yield "
                  ";
                // line 113
                if (CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header_form", [], "any", false, false, true, 113)) {
                    // line 114
                    yield "                    <div class=\"form-inline navbar-form justify-content-end\">
                      ";
                    // line 115
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header_form", [], "any", false, false, true, 115), 115, $this->source), "html", null, true);
                    yield "
                    </div>
                  ";
                }
                // line 118
                yield "                </div>
              ";
            }
            // line 120
            yield "            ";
            if (($context["container_navbar"] ?? null)) {
                // line 121
                yield "              </div>
            ";
            }
            // line 123
            yield "          </nav>
        ";
        }
        // line 125
        yield "
    ";
        yield from [];
    }

    // line 138
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_featured(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 139
        yield "        <div class=\"featured-top\">
          <aside class=\"featured-top__inner section ";
        // line 140
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 140, $this->source), "html", null, true);
        yield " clearfix\" role=\"complementary\">
            ";
        // line 141
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_top", [], "any", false, false, true, 141), 141, $this->source), "html", null, true);
        yield "
          </aside>
        </div>
      ";
        yield from [];
    }

    // line 147
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 148
        yield "        <div id=\"main\" class=\"";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 148, $this->source), "html", null, true);
        yield "\">
          ";
        // line 149
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumb", [], "any", false, false, true, 149), 149, $this->source), "html", null, true);
        yield "
          <div class=\"row row-offcanvas row-offcanvas-left clearfix\">
              <main";
        // line 151
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content_attributes"] ?? null), 151, $this->source), "html", null, true);
        yield ">
                <section class=\"section\">
                  <a href=\"#main-content\" id=\"main-content\" tabindex=\"-1\"></a>
                  ";
        // line 154
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 154), 154, $this->source), "html", null, true);
        yield "
                </section>
              </main>
            ";
        // line 157
        if (($context["sidebar_first_exists"] ?? null)) {
            // line 158
            yield "              <div";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebar_first_attributes"] ?? null), 158, $this->source), "html", null, true);
            yield ">
                <aside class=\"section\" role=\"complementary\">
                  ";
            // line 160
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 160), 160, $this->source), "html", null, true);
            yield "
                </aside>
              </div>
            ";
        }
        // line 164
        yield "            ";
        if (($context["sidebar_second_exists"] ?? null)) {
            // line 165
            yield "              <div";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebar_second_attributes"] ?? null), 165, $this->source), "html", null, true);
            yield ">
                <aside class=\"section\" role=\"complementary\">
                  ";
            // line 167
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 167), 167, $this->source), "html", null, true);
            yield "
                </aside>
              </div>
            ";
        }
        // line 171
        yield "          </div>
        </div>
      ";
        yield from [];
    }

    // line 190
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_footer(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 191
        yield "        <div class=\"container p-4 pb-0\">
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
        <div class=\"text-center p-3\" 
              style=\"background-color: rgba(0, 0, 0, 0.2);\">
          © 2024 Copyright:
          <a class=\"\" style=\"color: #f5f6fa;\" href=\"#\">KhulaZA.gov</a>
        </div>
        ";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/custom/khula_theme/templates/page.html.twig";
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
        return array (  373 => 191,  366 => 190,  359 => 171,  352 => 167,  346 => 165,  343 => 164,  336 => 160,  330 => 158,  328 => 157,  322 => 154,  316 => 151,  311 => 149,  306 => 148,  299 => 147,  290 => 141,  286 => 140,  283 => 139,  276 => 138,  270 => 125,  266 => 123,  262 => 121,  259 => 120,  255 => 118,  249 => 115,  246 => 114,  244 => 113,  240 => 112,  237 => 111,  230 => 106,  227 => 105,  225 => 104,  220 => 103,  216 => 101,  214 => 100,  209 => 99,  206 => 98,  203 => 96,  199 => 94,  195 => 92,  192 => 91,  186 => 88,  183 => 87,  181 => 86,  177 => 85,  172 => 84,  168 => 82,  166 => 81,  161 => 80,  158 => 79,  151 => 78,  138 => 212,  136 => 190,  130 => 186,  127 => 184,  120 => 180,  116 => 179,  112 => 178,  108 => 177,  105 => 176,  103 => 175,  100 => 174,  98 => 147,  95 => 146,  92 => 145,  89 => 138,  86 => 137,  79 => 133,  75 => 132,  72 => 131,  70 => 130,  67 => 129,  64 => 127,  61 => 78,  57 => 76,  52 => 73,  50 => 72,  48 => 71,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/custom/khula_theme/templates/page.html.twig", "C:\\xampp\\htdocs\\test_drupal_site\\web\\themes\\custom\\khula_theme\\templates\\page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 71, "block" => 78, "if" => 130);
        static $filters = array("trim" => 71, "striptags" => 71, "render" => 71, "t" => 76, "escape" => 132);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'block', 'if'],
                ['trim', 'striptags', 'render', 't', 'escape'],
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
