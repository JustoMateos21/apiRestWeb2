<?php

require_once 'app/models/model.php';

class ProductModel extends Model
{

    public function getProducts()
    {
        $query = $this->db->prepare('SELECT * FROM product');
        $query->execute();

        // Fetch all rows from the query result
        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }


}

?>