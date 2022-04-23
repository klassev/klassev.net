<?php

namespace Kev;

use RedBeanPHP\R;

class View
{
    public string $content = '';

    public function __construct(
        public $route,
        public $layout = '', // @todo maybe = false?
        public $view = '',
        public $meta = [],
    )
    {
        if(false !== $this->layout){
            $this->layout = $this->layout ?: LAYOUT;
        }
    }

    /**
     * @throws \Exception
     */
    public function render($data)
    {
        if(is_array($data)){
            extract($data);
        }

        $prefix = str_replace('\\', '/', $this->route['admin_prefix']);
        $view_file = APP."/Views/{$prefix}{$this->route['controller']}/{$this->view}.php";
        if(is_file($view_file)){
            ob_start();
            require_once $view_file;
            $this->content = ob_get_clean();
        }else{
            throw new \Exception("Not found view {$view_file}", 500);
        }

        if(false !== $this->layout){
            $layouts_file = APP."/Views/Layouts/{$this->layout}.php";
            if(is_file($layouts_file)){
                require_once $layouts_file;
            }else{
                throw new \Exception("Not found view {$layouts_file}", 500);
            }
        }
    }

    /**
     * @todo htmlspecialchars() - ???
     * @return string
     */
    public function getMeta(): string
    {
        $out = '<title>'.htmlspecialchars($this->meta['title']).'</title>'.PHP_EOL;
        $out .= '<meta name="description" content="'.htmlspecialchars($this->meta['description']).'">'.PHP_EOL;
        $out .= '<meta name="keywords" content="'.htmlspecialchars($this->meta['keywords']).'">'.PHP_EOL;
        return  $out;
    }

    public function getDbLogs()
    {
         if(DEBUG){
             $logs = R::getDatabaseAdapter()
                 ->getDatabase()
                 ->getLogger();

             $logs = array_merge(
                 $logs->grep('SELECT'),
                 $logs->grep('INSERT'),
                 $logs->grep('UPDATE'),
                 $logs->grep('DELETE'),
             );
             debug($logs);
         }
    }
}