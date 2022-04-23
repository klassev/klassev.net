<?php
/**
 * Debugging
 */
const DEBUG = 1;

/**
 * System paths
 */
define("ROOT", dirname(__DIR__).DIRECTORY_SEPARATOR);
const WWW = ROOT.'public'.DIRECTORY_SEPARATOR;
const APP = ROOT.'app'.DIRECTORY_SEPARATOR;
const CORE = ROOT.'system'.DIRECTORY_SEPARATOR;
const HELPERS = APP.'Helpers'.DIRECTORY_SEPARATOR;
const CACHE = ROOT.'tmp'.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR;
const LOGS = ROOT.'tmp'.DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR;
const CONFIG = APP.'Configs'.DIRECTORY_SEPARATOR;
const PATH = 'http://klassev.test'; // @todo move to .env
const ADMIN = PATH.'/admin'; // @todo ???
const NO_IMAGE = 'uploads/no-image.jpg'; // @todo ???

/**
 *
 */
const LAYOUT = 'default';


/**
 *
 */

require_once ROOT.'vendor/autoload.php';