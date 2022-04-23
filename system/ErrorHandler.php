<?php

namespace Kev;

class ErrorHandler
{
    public function __construct()
    {
        if(DEBUG){
            error_reporting(-1);
        }else{
            error_reporting(0);
        }

        set_exception_handler([$this, 'exceptionHandler']);
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']);
    }

    public function exceptionHandler(\Throwable $e)
    {
        $this->logError($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    protected function logError($message = '', $file = '', $line = '')
    {
        file_put_contents(
            LOGS.'errors.log',
            "[".date('Y-m-d H:i:s')."] Error message: {$message} | File: {$file} | Line: {$line}\n================\n",
            FILE_APPEND
        );
    }

    protected function displayError($err_num, $err_str, $err_file, $err_line, $err_response = 500)
    {
        if($err_response == 0){
            $err_response = 404;
        }

        http_response_code($err_response);

        if($err_response == 404 && !DEBUG){
            require WWW.'errors/404.php';
            die();
        }

        if(DEBUG){
            require WWW.'errors/dev.php';
        }else{
            require WWW.'errors/prod.php';
        }
        die();
    }

    public function errorHandler($err_num, $err_str, $err_file, $err_line)
    {
        $this->logError($err_str, $err_file, $err_line);
        $this->displayError($err_num, $err_str, $err_file, $err_line);
    }

    public function fatalErrorHandler()
    {
        $error = error_get_last();
        if(!empty($error) && $error['type'] && (E_ERROR | E_PARSE | E_CORE_ERROR | E_COMPILE_ERROR)){
            $this->logError($error['message'], $error['file'], $error['line']);
            ob_end_clean();
            $this->displayError($error['type'],$error['message'], $error['file'], $error['line']);
        }else{
            ob_end_flush();
        }
    }
}