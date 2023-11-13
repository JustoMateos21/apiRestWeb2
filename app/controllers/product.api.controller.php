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
        if (empty($params)) {
            $products = $this->model->getProducts();
        } else {
            $products = $this->model->getProductById($params[':ID']);
        }

        if (empty($products)) {
            return $this->view->response('Error al obtener los productos', 404);
        } else {
            return $this->view->response($products, 200);
        }
    }

    public function getByOrder($params = [])
    {
        $products = $this->model->getProducts();
        $order = $params[':order'];
        $field = $params[':orderBy'];

        // Define the orderByField function to sort by the specified field
        function orderByField($a, $b, $field)
        {
            return $a->$field > $b->$field ? 1 : -1;
        }

        if ($order === 'ascendent') {
            usort($products, function ($a, $b) use ($field) {
                return orderByField($a, $b, $field);
            });
        } else {
            // Reverse the sorting order for descending
            usort($products, function ($a, $b) use ($field) {
                return orderByField($b, $a, $field);
            });
        }
    
        if (empty($products)) {
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
            $description = $body->description;
            $brand = $body->brand;
            $price = $body->price;
            $stock_quantity = $body->stock_quantity;
            $category_id = $body->category_id;
            $image_url = $body->image_url;
            $this->model->updateProduct($name, $description, $brand, $price, $stock_quantity, $category_id);
            $this->view->response('El producto con id=' . $id . ' ha sido modificado.', 200);
        } else {
            $this->view->response('El producto con id=' . $id . ' no existe.', 404);
        }

    }


    function create($params = []) {
        $body = $this->getData();
        $this->view->response($body, 400);

        $name = $body->name;
        $description = $body->description;
        $brand = $body->brand;
        $price = $body->price;
        $stock_quantity = $body->stock_quantity;
        //Tener en cuenta que la categoria colocada en el cuerpo del post tiene que ser una existente en 
        //la tabla category. Se puede hacer un control consultando a la tabla category si existe el id seteado.
        $category_id = $body->category_id;

        if (empty($name) || empty($brand) || empty($price) || empty($category_id)) { 
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insertProduct($name, $description, $brand, $price, $stock_quantity, $category_id);

            $product = $this->model->getProductById($id);
            $this->view->response($product, 201);
        }

    }




}
?>