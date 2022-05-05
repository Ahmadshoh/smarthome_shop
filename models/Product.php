<?php

namespace models;
use core\Model;

class Product extends Model
{
    public function getAll() {
        return $this->db->row("SELECT * FROM products");
    }

    public function getById($id) {
        return $this->db->query("SELECT * FROM products WHERE id = :id;", ["id" => $id])->fetch();
    }
}