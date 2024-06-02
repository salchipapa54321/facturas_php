<?php

class Views{

    private $templateDirectory;

    public function __construct($templateDirectory){
           $this->templateDirectory = $templateDirectory;
    }

    public function render($viewFile,$data = []){
        $templatePath = "$this->templateDirectory/$viewFile.php";

        if(file_exists($templatePath)){
            extract($data);
            include $templatePath;
        }else{
            throw new Exception("404 Error $templatePath Plantilla no encontrada");
        }
    }
}

