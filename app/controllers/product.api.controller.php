<?php

require_once './app/controllers/api.controller.php';
require_once './app/models/product.model.php';
require_once './app/views/api.view.php';

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
        $products = $this->model->getProducts();
        if (!$products){
            return $this->view->response($products, 200);
        }
        return $this->view->response('Error al obtener los productos', 404);
       
    }

}



?>