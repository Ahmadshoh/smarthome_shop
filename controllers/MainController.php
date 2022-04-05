<?php

namespace controllers;

use core\Controller;

class MainController extends Controller {
    public function indexAction() {
        $result = $this->model->getOrders();
        $vars = [
            'orders' => $result,
        ];
        $this->view->render('Main Page', $vars);
    }
}