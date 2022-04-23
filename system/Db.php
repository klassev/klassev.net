<?php

namespace Kev;

use RedBeanPHP\R;

class Db
{
    use TSingleton;

    /**
     * @throws \Exception
     */
    private function __construct()
    {
        $conf = require_once CONFIG.'/db.php';
        R::setup($conf['dsn'], $conf['user'], $conf['password']);
        if(!R::testConnection()){
            throw new \Exception('No connection to DB',500);
        }
        R::freeze(true); // No modification DB
        if(DEBUG){
            R::debug(true,3);
        }
    }
}