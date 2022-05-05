<?php

namespace controllers;

use core\Controller;
use core\View;

class ProductController extends Controller
{
    public function indexAction() {
        $products = $this->model->getAll();

        $vars = [
            'products' => $products
        ];

        $this->view->render('Product Page', $vars);
    }

    public function showAction($id) {
        $product = $this->model->getById($id);

        if (!$product) {
            View::errorCode(404);
        }

        $vars = [
            'product' => $product
        ];

        $this->view->render("Product information", $vars);
    }

    public function deleteAction($id) {
        $result = $this->model->query("DELETE FROM products WHERE id = ?;", [$id]);

        $vars = [
            'result' => $result
        ];

        $this->view->redirect("products");
    }
}