<?php

namespace MF\Cores;

use PDO;
use PDOException;
use MF\cores\Config;

class Db extends PDO {
    private static $instance = null;

    public function __construct() {
        try {
            parent::__construct('mysql:host=' . config::HOST . ';dbname=' . config::DB_NAME, config::USER, config::PASSWORD);
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
        }
    }

    public static function getInstance() {
        if(is_null(self::$instance)) {
            self::$instance = new Db();
        }
        return self::$instance;
    }


    public function requete(string $sql, array $attributs = null) {
        if($attributs !== null) {
            $query = self::getInstance()->prepare($sql);
            $query->execute($attributs);
            
            return $query->fetchAll();
        }
        else {
            return self::getInstance()->query($sql)->fetchAll();
        }
    }

    public function requet(string $sql, array $attributs = null) {
        if($attributs !== null) {
            $query = self::getInstance()->prepare($sql);
            $query->execute($attributs);
        }
    }
}