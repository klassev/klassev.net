<?php

namespace Kev;

class App
{
    public static $app;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        //$query = trim(urldecode($_SERVER['QUERY_STRING']),'/');
        $query = trim(urldecode($_SERVER['REQUEST_URI']),'/');
        new ErrorHandler();
        self::$app = Registry::getInstance();
        $this->getParams();
        Router::dispatch($query);
    }

    protected function getParams()
    {
        $params = require_once (CONFIG.'params.php');
        if(!empty($params)) {
            foreach($params as $key => $value) {
                self::$app->setProperty($key, $value);
            }
        }
    }
}