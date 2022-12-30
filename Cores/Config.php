<?php

namespace MF\cores;

class Config{
    const TITLE="Network";
    const HOST = 'localhost';
    const DB_NAME = 'Network';
    const USER = 'root';
    const PASSWORD = '';
    const TEMPLATE = 'template';

    static function Token(){
        $_SESSION['token'] = (!isset($_SESSION['token']))?  md5(rand(0,9999999)):$_SESSION['token'];
    }

}