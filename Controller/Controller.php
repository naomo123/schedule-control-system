<?php
abstract class Controller{
    public function Render($view, $viewBag=array()){
        $file = 'View/'.static::class.'/'.$view.'.php';
        $file = str_replace("Controller", "", $file);
        if(is_file($file)){
            ob_start();
            extract($viewBag);
            require_once $file;
            $content = ob_get_contents();
            ob_end_clean();
            echo $content;
        }
        else{
            echo '<h1>Dirección no encontrada</h1>';
        }
    }
}