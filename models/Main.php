<?php

namespace models;

use core\Model;

class Main extends Model {

    public function getOrders() {
        return $this->db->row('SELECT * FROM orders');
    }

}