<?php

use Kev\Router;

Router::setRoutes('^admin/?$', ['controller' => 'Main', 'action' => 'index', 'admin_prefix' => 'Admin']);
Router::setRoutes('^admin/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['controller' => 'Main', 'action' => 'index', 'admin_prefix' => 'Admin']);
Router::setRoutes('^$', ['controller' => 'Main', 'action' => 'index']);
Router::setRoutes('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$');