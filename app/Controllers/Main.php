<?php

namespace App\Controllers;

use Kev\Controller;

/**
 * @property \App\Models\Main $model
 */

class Main extends Controller
{
    //public false|string $layout = 'test2'; // redefine layouts_file for class

    public function index()
    {
        //$this->layout = 'test';  // redefine layouts_file for method
        $this->setMeta(
            'Главная страница',
            'Описание страницы' ,
            'Ключевый слова на странице'
        );

        $names = $this->model->getNames();
        //debug($names);
        $this->set(compact('names'));
    }
}