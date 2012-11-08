<?php

return array(
    // Twig_Environment configurations.
    'cache' => path('storage').'views', // Set to `path('storage').'views'` if you want to use Twig caching
    'debug' => true,
    'autoreload' => true,

    // Additional files to include. Put things like Twig functions, filters, etc. here.
    'include' => array(dirname(__DIR__).DS.'twigfunctions.php'),

    // Twig functions. These are used in the Twig templates.
    'functions' => array(
        'config' => array('function' => 'twig_fn_config', 'params' => array('is_safe' => array('html'))),
        'val' => array('function' => 'twig_fn_val', 'params' => array('is_safe' => array('html'))),
        'tr' => array('function' => 'twig_fn_tr', 'params' => array('is_safe' => array('html'))),
        'url_to' => array('function' => 'twig_fn_url_to', 'params' => array('is_safe' => array('html'))),
        'url_to_route' => array('function' => 'twig_fn_url_to_route', 'params' => array('is_safe' => array('html'))),
        'url_to_secure_route' => array('function' => 'twig_fn_url_to_secure_route', 'params' => array('is_safe' => array('html'))),
        'script' => array('function' => 'twig_fn_script', 'params' => array('is_safe' => array('html'))),
        'style' => array('function' => 'twig_fn_style', 'params' => array('is_safe' => array('html'))),
        'link' => array('function' => 'twig_fn_link', 'params' => array('is_safe' => array('html'))),
        'secure_link' => array('function' => 'twig_fn_secure_link', 'params' => array('is_safe' => array('html'))),
        'image' => array('function' => 'twig_fn_image', 'params' => array('is_safe' => array('html'))),
        'email' => array('function' => 'twig_fn_email', 'params' => array('is_safe' => array('html'))),
        'form_open' => array('function' => 'twig_fn_form_open', 'params' => array('is_safe' => array('html'))),
        'form_open_secure' => array('function' => 'twig_fn_form_open_secure', 'params' => array('is_safe' => array('html'))),
        'form_open_for_files' => array('function' => 'twig_fn_form_open_for_files', 'params' => array('is_safe' => array('html'))),
        'form_open_secure_for_files' => array('function' => 'twig_fn_form_open_secure_for_files', 'params' => array('is_safe' => array('html'))),
        'form_close' => array('function' => 'twig_fn_form_close', 'params' => array('is_safe' => array('html'))),
        'form_label' => array('function' => 'twig_fn_form_label', 'params' => array('is_safe' => array('html'))),
        'form_text' => array('function' => 'twig_fn_form_text', 'params' => array('is_safe' => array('html'))),
        'form_submit' => array('function' => 'twig_fn_form_submit', 'params' => array('is_safe' => array('html'))),
        'form_textarea' => array('function' => 'twig_fn_form_textarea', 'params' => array('is_safe' => array('html'))),
        'form_hidden' => array('function' => 'twig_fn_form_hidden', 'params' => array('is_safe' => array('html'))),
        'form_token' => array('function' => 'twig_fn_form_token', 'params' => array('is_safe' => array('html'))),
        'form_checkbox' => array('function' => 'twig_fn_form_checkbox', 'params' => array('is_safe' => array('html'))),
        'form_radio' => array('function' => 'twig_fn_form_radio', 'params' => array('is_safe' => array('html'))),
        'form_select' => array('function' => 'twig_fn_form_select', 'params' => array('is_safe' => array('html'))),

    ),

    // Twig filters. These are used in the Twig templates.
    'filters' => array(
        'slugify' => array('filter' => 'twig_flt_slugify', 'params' => array('is_safe' => array('html'))),
    ),
);
