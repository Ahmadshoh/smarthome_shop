<?php

namespace core;

use core\View;

class Router {

    protected $routes = [];
    protected $params = [];
    protected $id = 0;

    public function __construct() {
        $arr = require 'config/routes.php';
        foreach ($arr as $key => $val) {
            $this->add($key, $val);
        }
    }

    public function add($route, $params) {
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    public function match() {

        $routes = require 'config/routes.php';
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($routes as $route => $params) {

            if (key_exists("dynamic", $params) && $params["dynamic"]) {
                $url_parts = explode("/", $url);
                $route_parts = explode("/", $route);

                if ($url_parts[0] == $route_parts[0]) {
                    $this->params = $params;
                    $this->id = (int)$url_parts[1];
                    return true;
                }

            }
            if (preg_match('#^'.$route.'$#', $url, $matches)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function run(){
        if ($this->match()) {
            $path = 'controllers\\'.ucfirst($this->params['controller']).'Controller';

            if (class_exists($path)) {

                $action = $this->params['action'].'Action';

                if (method_exists($path, $action)) {

                    $controller = new $path($this->params);

                    if (key_exists("dynamic", $this->params) && $this->params["dynamic"]) {
                        $controller->$action($this->id);
                    } else {
                        $controller->$action();
                    }
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }

}