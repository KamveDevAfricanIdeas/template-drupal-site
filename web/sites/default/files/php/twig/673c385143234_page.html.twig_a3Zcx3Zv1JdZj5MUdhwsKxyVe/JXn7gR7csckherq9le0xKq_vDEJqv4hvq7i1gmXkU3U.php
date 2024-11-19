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

/* themes/contrib/bootstrap_barrio/templates/layout/page.html.twig */
class __TwigTemplate_dff1aab2330ba5b2203efad2f19ef600 extends Template
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
        // line 77
        yield from $this->unwrap()->yieldBlock('head', $context, $blocks);
        // line 130
        yield "    </header>
    ";
        // line 131
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "highlighted", [], "any", false, false, true, 131)) {
            // line 132
            yield "      <div class=\"highlighted\">
        <aside class=\"";
            // line 133
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 133, $this->source), "html", null, true);
            yield " section clearfix\" role=\"complementary\">
          ";
            // line 134
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "highlighted", [], "any", false, false, true, 134), 134, $this->source), "html", null, true);
            yield "
        </aside>
      </div>
    ";
        }
        // line 138
        yield "    ";
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_top", [], "any", false, false, true, 138)) {
            // line 139
            yield "      ";
            yield from $this->unwrap()->yieldBlock('featured', $context, $blocks);
            // line 146
            yield "    ";
        }
        // line 147
        yield "    <div id=\"main-wrapper\" class=\"layout-main-wrapper clearfix\">
      ";
        // line 148
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 175
        yield "    </div>
    ";
        // line 176
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_first", [], "any", false, false, true, 176) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_second", [], "any", false, false, true, 176)) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_third", [], "any", false, false, true, 176))) {
            // line 177
            yield "      <div class=\"featured-bottom\">
        <aside class=\"";
            // line 178
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 178, $this->source), "html", null, true);
            yield " clearfix\" role=\"complementary\">
          ";
            // line 179
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_first", [], "any", false, false, true, 179), 179, $this->source), "html", null, true);
            yield "
          ";
            // line 180
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_second", [], "any", false, false, true, 180), 180, $this->source), "html", null, true);
            yield "
          ";
            // line 181
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_third", [], "any", false, false, true, 181), 181, $this->source), "html", null, true);
            yield "
        </aside>
      </div>
    ";
        }
        // line 185
        yield "    <footer class=\"site-footer\">
      ";
        // line 186
        yield from $this->unwrap()->yieldBlock('footer', $context, $blocks);
        // line 203
        yield "    </footer>
  </div>
</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["page", "container", "navbar_top_attributes", "container_navbar", "navbar_attributes", "navbar_collapse_btn_data", "navbar_collapse_class", "navbar_offcanvas", "sidebar_collapse", "content_attributes", "sidebar_first_attributes", "sidebar_second_attributes"]);        yield from [];
    }

    // line 77
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_head(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 78
        yield "        ";
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "secondary_menu", [], "any", false, false, true, 78) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "top_header", [], "any", false, false, true, 78)) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "top_header_form", [], "any", false, false, true, 78))) {
            // line 79
            yield "          <nav";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["navbar_top_attributes"] ?? null), 79, $this->source), "html", null, true);
            yield ">
          ";
            // line 80
            if (($context["container_navbar"] ?? null)) {
                // line 81
                yield "          <div class=\"container\">
          ";
            }
            // line 83
            yield "              ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "secondary_menu", [], "any", false, false, true, 83), 83, $this->source), "html", null, true);
            yield "
              ";
            // line 84
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "top_header", [], "any", false, false, true, 84), 84, $this->source), "html", null, true);
            yield "
              ";
            // line 85
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "top_header_form", [], "any", false, false, true, 85)) {
                // line 86
                yield "                <div class=\"form-inline navbar-form ms-auto\">
                  ";
                // line 87
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "top_header_form", [], "any", false, false, true, 87), 87, $this->source), "html", null, true);
                yield "
                </div>
              ";
            }
            // line 90
            yield "          ";
            if (($context["container_navbar"] ?? null)) {
                // line 91
                yield "          </div>
          ";
            }
            // line 93
            yield "          </nav>
        ";
        }
        // line 95
        yield "        ";
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, true, 95) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 95)) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header_form", [], "any", false, false, true, 95))) {
            // line 96
            yield "          <nav";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["navbar_attributes"] ?? null), 96, $this->source), "html", null, true);
            yield ">
            ";
            // line 97
            if (($context["container_navbar"] ?? null)) {
                // line 98
                yield "            <div class=\"container\">
            ";
            }
            // line 100
            yield "              ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, true, 100), 100, $this->source), "html", null, true);
            yield "
              ";
            // line 101
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 101) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header_form", [], "any", false, false, true, 101))) {
                // line 102
                yield "                <button class=\"navbar-toggler collapsed\" type=\"button\" data-bs-toggle=\"";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["navbar_collapse_btn_data"] ?? null), 102, $this->source), "html", null, true);
                yield "\" data-bs-target=\"#CollapsingNavbar\" aria-controls=\"CollapsingNavbar\" aria-expanded=\"false\" aria-label=\"Toggle navigation\"><span class=\"navbar-toggler-icon\"></span></button>
                <div class=\"";
                // line 103
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["navbar_collapse_class"] ?? null), 103, $this->source), "html", null, true);
                yield "\" id=\"CollapsingNavbar\">
                  ";
                // line 104
                if (($context["navbar_offcanvas"] ?? null)) {
                    // line 105
                    yield "                    <div class=\"offcanvas-header\">
                      <button type=\"button\" class=\"btn-close text-reset\" data-bs-dismiss=\"offcanvas\" aria-label=\"Close\"></button>
                    </div>
                    <div class=\"offcanvas-body\">
                  ";
                }
                // line 110
                yield "                  ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 110), 110, $this->source), "html", null, true);
                yield "
                  ";
                // line 111
                if (CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header_form", [], "any", false, false, true, 111)) {
                    // line 112
                    yield "                    <div class=\"form-inline navbar-form justify-content-end\">
                      ";
                    // line 113
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header_form", [], "any", false, false, true, 113), 113, $this->source), "html", null, true);
                    yield "
                    </div>
                  ";
                }
                // line 116
                yield "                  ";
                if (($context["navbar_offcanvas"] ?? null)) {
                    // line 117
                    yield "                    </div>
                  ";
                }
                // line 119
                yield "                </div>
              ";
            }
            // line 121
            yield "              ";
            if (($context["sidebar_collapse"] ?? null)) {
                // line 122
                yield "                <button class=\"navbar-toggler navbar-toggler-left collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#CollapsingLeft\" aria-controls=\"CollapsingLeft\" aria-expanded=\"false\" aria-label=\"Toggle navigation\"></button>
              ";
            }
            // line 124
            yield "            ";
            if (($context["container_navbar"] ?? null)) {
                // line 125
                yield "            </div>
            ";
            }
            // line 127
            yield "          </nav>
        ";
        }
        // line 129
        yield "      ";
        yield from [];
    }

    // line 139
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_featured(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 140
        yield "        <div class=\"featured-top\">
          <aside class=\"featured-top__inner section ";
        // line 141
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 141, $this->source), "html", null, true);
        yield " clearfix\" role=\"complementary\">
            ";
        // line 142
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_top", [], "any", false, false, true, 142), 142, $this->source), "html", null, true);
        yield "
          </aside>
        </div>
      ";
        yield from [];
    }

    // line 148
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 149
        yield "        <div id=\"main\" class=\"";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 149, $this->source), "html", null, true);
        yield "\">
          ";
        // line 150
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumb", [], "any", false, false, true, 150), 150, $this->source), "html", null, true);
        yield "
          <div class=\"row row-offcanvas row-offcanvas-left clearfix\">
              <main";
        // line 152
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content_attributes"] ?? null), 152, $this->source), "html", null, true);
        yield ">
                <section class=\"section\">
                  <a href=\"#main-content\" id=\"main-content\" tabindex=\"-1\"></a>
                  ";
        // line 155
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 155), 155, $this->source), "html", null, true);
        yield "
                </section>
              </main>
            ";
        // line 158
        if (($context["sidebar_first_exists"] ?? null)) {
            // line 159
            yield "              <div";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebar_first_attributes"] ?? null), 159, $this->source), "html", null, true);
            yield ">
                <aside class=\"section\" role=\"complementary\">
                  ";
            // line 161
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 161), 161, $this->source), "html", null, true);
            yield "
                </aside>
              </div>
            ";
        }
        // line 165
        yield "            ";
        if (($context["sidebar_second_exists"] ?? null)) {
            // line 166
            yield "              <div";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebar_second_attributes"] ?? null), 166, $this->source), "html", null, true);
            yield ">
                <aside class=\"section\" role=\"complementary\">
                  ";
            // line 168
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 168), 168, $this->source), "html", null, true);
            yield "
                </aside>
              </div>
            ";
        }
        // line 172
        yield "          </div>
        </div>
      ";
        yield from [];
    }

    // line 186
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_footer(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 187
        yield "        <div class=\"";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 187, $this->source), "html", null, true);
        yield "\">
          ";
        // line 188
        if ((((CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_first", [], "any", false, false, true, 188) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_second", [], "any", false, false, true, 188)) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_third", [], "any", false, false, true, 188)) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_fourth", [], "any", false, false, true, 188))) {
            // line 189
            yield "            <div class=\"site-footer__top clearfix\">
              ";
            // line 190
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_first", [], "any", false, false, true, 190), 190, $this->source), "html", null, true);
            yield "
              ";
            // line 191
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_second", [], "any", false, false, true, 191), 191, $this->source), "html", null, true);
            yield "
              ";
            // line 192
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_third", [], "any", false, false, true, 192), 192, $this->source), "html", null, true);
            yield "
              ";
            // line 193
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_fourth", [], "any", false, false, true, 193), 193, $this->source), "html", null, true);
            yield "
            </div>
          ";
        }
        // line 196
        yield "          ";
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_fifth", [], "any", false, false, true, 196)) {
            // line 197
            yield "            <div class=\"site-footer__bottom\">
              ";
            // line 198
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_fifth", [], "any", false, false, true, 198), 198, $this->source), "html", null, true);
            yield "
            </div>
          ";
        }
        // line 201
        yield "        </div>
      ";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/bootstrap_barrio/templates/layout/page.html.twig";
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
        return array (  415 => 201,  409 => 198,  406 => 197,  403 => 196,  397 => 193,  393 => 192,  389 => 191,  385 => 190,  382 => 189,  380 => 188,  375 => 187,  368 => 186,  361 => 172,  354 => 168,  348 => 166,  345 => 165,  338 => 161,  332 => 159,  330 => 158,  324 => 155,  318 => 152,  313 => 150,  308 => 149,  301 => 148,  292 => 142,  288 => 141,  285 => 140,  278 => 139,  273 => 129,  269 => 127,  265 => 125,  262 => 124,  258 => 122,  255 => 121,  251 => 119,  247 => 117,  244 => 116,  238 => 113,  235 => 112,  233 => 111,  228 => 110,  221 => 105,  219 => 104,  215 => 103,  210 => 102,  208 => 101,  203 => 100,  199 => 98,  197 => 97,  192 => 96,  189 => 95,  185 => 93,  181 => 91,  178 => 90,  172 => 87,  169 => 86,  167 => 85,  163 => 84,  158 => 83,  154 => 81,  152 => 80,  147 => 79,  144 => 78,  137 => 77,  128 => 203,  126 => 186,  123 => 185,  116 => 181,  112 => 180,  108 => 179,  104 => 178,  101 => 177,  99 => 176,  96 => 175,  94 => 148,  91 => 147,  88 => 146,  85 => 139,  82 => 138,  75 => 134,  71 => 133,  68 => 132,  66 => 131,  63 => 130,  61 => 77,  57 => 76,  52 => 73,  50 => 72,  48 => 71,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/contrib/bootstrap_barrio/templates/layout/page.html.twig", "C:\\xampp\\htdocs\\test_drupal_site\\web\\themes\\contrib\\bootstrap_barrio\\templates\\layout\\page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 71, "block" => 77, "if" => 131);
        static $filters = array("trim" => 71, "striptags" => 71, "render" => 71, "t" => 76, "escape" => 133);
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
