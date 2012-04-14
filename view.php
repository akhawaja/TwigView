<?php

namespace TwigView;

use Laravel;

class View extends Laravel\View
{
    /** @var string */
    protected $bundle_root = '';

    /** @var string */
    protected $template = '';

    /** @var string */
    protected $template_ext = '.twig';

    /**
     * Get the path to a view on disk.
     *
     * @param $view
     *
     * @return string
     * @throws \Exception
     */
    protected function path($view)
    {
        $view = str_replace('.', '/', $view);
        $this->bundle_root = $root = Laravel\Bundle::path(Laravel\Bundle::name($view)).'views';

        $path = $root.DS.Laravel\Bundle::element($view).$this->template_ext;

        if (file_exists($path))
        {
            // If the view is from a bundle, remove the bundle separator from the view name, Otherwise,
            // just use the view name and add the file extension.
            if (str_contains($view, '::'))
            {
                $this->template = substr($view, strpos($view, '::') + 2, strlen($view)).$this->template_ext;
            }
            else
            {
                $this->template = $view.$this->template_ext;
            }

            return $path;
        }

        throw new \Exception("View [$view] does not exist.");
    }

    /**
     * Render the view.
     *
     * @return string
     * @throws \Exception
     */
    public function render()
    {
        // Events
        Laravel\Event::fire("laravel.composing: {$this->view}", array($this));

        // Buffer the output
        ob_start();

        try
        {
            // Include the Twig functions we wish to register.
            $files = Laravel\Config::get('TwigView::twig.include');

            foreach ($files as $file)
            {
                require_once $file;
            }

            // Include the Twig Autoloader
            require_once dirname(__FILE__).DS.'Twig/Autoloader.php';

            // Register the Twig Autoloader.
            \Twig_Autoloader::register();

            // Build the Twig object. By default, we will add the application views folder and the
            // bundle's views folder to the Twig loader.
            $loader = new \Twig_Loader_Filesystem(array(
                                                       $this->bundle_root, path('app').'views',
                                                  ));

            // Load the Twig_Environment configuration.
            $cache = Laravel\Config::get('TwigView::twig.cache');
            $debug = Laravel\Config::get('TwigView::twig.debug');
            $autoreload = Laravel\Config::get('TwigView::twig.autoreload');
            $functions = Laravel\Config::get('TwigView::twig.functions', array());
            $filters = Laravel\Config::get('TwigView::twig.filters', array());

            // Define the Twig environment.
            $twig_env = new \Twig_Environment($loader, array(
                                                            'cache' => $cache,
                                                            'debug' => $debug,
                                                            'autoreload' => $autoreload,
                                                       ));

            // Register functions as Twig functions
            foreach ($functions as $name => $value)
            {
                $params = isset($value['params']) ? $value['params'] : array();
                $twig_env->addFunction($name, new \Twig_Function_Function($value['function'], $params));
            }

            // Register filters as Twig filters
            foreach ($filters as $name => $value)
            {
                $params = isset($value['params']) ? $value['params'] : array();
                $twig_env->addFilter($name, new \Twig_Filter_Function($value['filter'], $params));
            }

            print $twig_env->render($this->template, $this->data());
        }
        catch (\Exception $e)
        {
            ob_get_clean();
            throw $e;
        }

        return ob_get_clean();
    }
}
