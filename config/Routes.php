<?php

        use system\core\Router;
        Router::add('^user/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'User']);
        Router::add('^page/(?P<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);


#default routes
        Router::add('^$', ['controller' => 'User', 'action' => 'index']);
        Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');


