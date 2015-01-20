<?php

namespace Config;

class Config {

    private static $instance = null;

    private function __construct() {
        require_once 'Psr4AutoloaderClass.php';
        $this->loader = new Psr4AutoloaderClass();
        $this->loader->register();
        $this->loader->addNamespace('Includes', __DIR__ . '/../includes');
		$this->loader->addNamespace('Lib', __DIR__ . '/../lib');
        $this->parseIni();
    }

    public static function getInstance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function parseIni()
    {
        foreach(parse_ini_file('config.ini') as $key => $config){
            $this->$key = $config;
        }
    }

}

Config::getInstance();
