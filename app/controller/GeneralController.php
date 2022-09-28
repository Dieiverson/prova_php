<?php
    namespace App\Controller;
    class GeneralController
    {
        protected function load(string $view, $params = [])
        {
            $twig = new \Twig\Environment(
                new \Twig\Loader\FilesystemLoader('./app/view/'),
                    [
                        'auto_reload'=>true,
                        'autoescape'=>false
                    ]
            );
            $twig->addGlobal('BASE',URL_BASE);                     
            echo $twig->render($view.'.php',$params);          
        }  
    } 
?>