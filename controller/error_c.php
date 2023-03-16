<?php
    class Error_c{
        public function __construct($params){
            require_once 'view/header.php';
            var_dump($params);
            require_once 'view/error.php';
        }
    }
?>