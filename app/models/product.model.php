<?php

require_once 'app/models/model.php';

class ProductModel extends Model
{

    public function getProducts()
    {
        $query = $this->db->prepare('SELECT *, NULL AS image_file FROM product;');
        $query->execute();

        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }


    public function getProductById($id)
    {
        $query = $this->db->prepare('SELECT *, NULL AS image_file FROM product WHERE product_id = ?');
        $query->execute([$id]);
        $product = $query->fetch(PDO::FETCH_OBJ);
        return $product;
    }


    public function updateProduct($id, $name, $description, $brand, $price, $stock_quantity, $category_id)
    {
        $query = $this->db->prepare('UPDATE product
        SET name = ?, description = ?, brand = ?, price = ?, stock_quantity = ?, category_id = ?
        WHERE product_id = ?');
        $query->execute([$name, $description, $brand, $price, $stock_quantity, $category_id, $id]);

    }

    public function getProductsLimited($limit)
    {
        $limit = (int) $limit ?: 10;
        $query = $this->db->prepare('SELECT *, NULL AS image_file FROM product LIMIT :limit');
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->execute();

        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }


    public function getProductsByBrand($brand)
    {
        $query = $this->db->prepare('SELECT *, NULL AS image_file FROM product WHERE brand = ?');
        $query->execute([$brand]);
        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;

    }


    public function insertProduct($name, $description, $brand, $price, $stock_quantity, $category_id) {
        $query = $this->db->prepare('INSERT INTO product (name, description, brand, price, stock_quantity, category_id) VALUES(?,?,?,?,?,?)');
        $query->execute([$name, $description, $brand, $price, $stock_quantity, $category_id]);

        return $this->db->lastInsertId();
    }


}

?>