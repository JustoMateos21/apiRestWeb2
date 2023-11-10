<?php

require_once './app/model/model.php';
class ProductModel extends Model
{

    public function getProducts()
    {
        $query = $this->db->prepare('SELECT * FROM PRODUCT');
        $query->execute();

        // Fetch all rows from the query result
        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }


}

?>