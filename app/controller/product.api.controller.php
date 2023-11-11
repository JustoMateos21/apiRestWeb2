<?php

require_once './app/model/product.model.php';
require_once './app/view/api.view.php';
class ProductApiController
{


    private $model;
    private $view;


    function __construct()
    {

        $this->model = new ProductModel();
        $this->view = new ApiView();
    }

    public function get($params = [])
    {
        $products = $this->model->getProducts();
        if (!empty($products))
            return $this->view->response($products, 200);
        else
            return $this->view->response($products, 500);
    }

}



?>