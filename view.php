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
            $this->template = substr($view, strpos($view, '::') + 2, strlen($view)).$this->template_ext;
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
            require_once 'twigfunctions.php';

            // Call the Twig autoloader
            \Twig_Autoloader::register();

            // Build the Twig object. By default, we will add the application views folder and the
            // bundle's views folder to the Twig loader.
            $loader = new \Twig_Loader_Filesystem(array(
                                                       path('app').'views', $this->bundle_root,
                                                  ));

            // Define the Twig environment.
            $twig_env = new \Twig_Environment($loader, array(
                                                            'cache' => path('storage').'views',
                                                            'debug' => $_SERVER['LARAVEL_ENV'] == 'dev',
                                                            'autoreload' => true,
                                                       ));

            // Register Laravel functions as Twig functions
            $twig_env->addFunction(
                'config', new \Twig_Function_Function('twig_fn_config', array('is_safe' => array('html'))));
            $twig_env->addFunction('val', new \Twig_Function_Function('twig_fn_val', array('is_safe' => array('html'))));
            $twig_env->addFunction('tr', new \Twig_Function_Function('twig_fn_tr', array('is_safe' => array('html'))));
            $twig_env->addFunction('url_to', new \Twig_Function_Function('twig_fn_url_to', array('is_safe' => array('html'))));
            $twig_env->addFunction(
                'secure_url_to', new \Twig_Function_Function('twig_fn_secure_url_to', array('is_safe' => array('html'))));
            $twig_env->addFunction(
                'url_to_route', new \Twig_Function_Function('twig_fn_url_to_route', array('is_safe' => array('html'))));
            $twig_env->addFunction(
                'url_to_secure_route', new \Twig_Function_Function('twig_fn_url_to_secure_route', array('is_safe' => array('html'))));
            $twig_env->addFunction('script', new \Twig_Function_Function('twig_fn_script', array('is_safe' => array('html'))));
            $twig_env->addFunction('style', new \Twig_Function_Function('twig_fn_style', array('is_safe' => array('html'))));
            $twig_env->addFunction('link', new \Twig_Function_Function('twig_fn_link', array('is_safe' => array('html'))));
            $twig_env->addFunction(
                'secure_link', new \Twig_Function_Function('twig_fn_secure_link', array('is_safe' => array('html'))));
            $twig_env->addFunction('image', new \Twig_Function_Function('twig_fn_image', array('is_safe' => array('html'))));
            $twig_env->addFunction('email', new \Twig_Function_Function('twig_fn_email', array('is_safe' => array('html'))));

            // Register Laravel functions as Twig filters
            $twig_env->addFilter('slugify', new \Twig_Filter_Function('twig_fn_slugify', array('is_safe' => array('html'))));

            print $twig_env->render($this->template, $this->data);
        }
        catch (\Exception $e)
        {
            ob_get_clean();
            throw $e;
        }

        return ob_get_clean();
    }
}
