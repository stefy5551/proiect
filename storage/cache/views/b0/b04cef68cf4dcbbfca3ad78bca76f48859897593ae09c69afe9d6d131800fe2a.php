<?php

/* show.html */
class __TwigTemplate_9116ca80980eda4848553dabc97f99344d78af8fd276dbab9696189eac1f44c7 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<h1> Hello ";
        echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
        echo " </h1>";
    }

    public function getTemplateName()
    {
        return "show.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "show.html", "D:\\Facultate\\XAMPP\\htdocs\\proiect\\app\\Views\\show.html");
    }
}
