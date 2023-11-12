<?php

require_once './app/controllers/api.controller.php';
require_once './app/models/product.model.php';


class ProductApiController extends ApiController
{
    private $model;
        
    function __construct()
    {
        parent::__construct();
        $this->model = new ProductModel();
    }

    public function get($params = [])
    {

        $products = '';
        if (empty($params)) {
        $products = $this->model->getProducts();

        } else {
            $products = $this->model->getProductById($params[':ID']);

        }
        if (!$products) {
            return $this->view->response('Error al obtener los productos', 404);
        } else {
            return $this->view->response($products, 200);
        }

    }



    public function update($params = [])
    {

        $id = $params[':ID'];
        $tarea = $this->model->getProductById($id);

        if ($tarea) {
            $body = $this->getData();
            $name = $body->name;
            $description = $body->titulo;
            $brand = $body->description;
            $price = $body->price;
            $stock_quantity = $body->stock_quantity;
            $category_id = $body->category_id;
            $image_url = $body->image_url;
            $this->model->updateProduct($name, $name, $description, $brand, $price, $stock_quantity, $category_id, $image_url);
            $this->view->response('El producto con id=' . $id . ' ha sido modificado.', 200);
        } else {
            $this->view->response('El producto con id=' . $id . ' no existe.', 404);
        }

    }



}
?>