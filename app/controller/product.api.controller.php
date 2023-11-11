<?php

require_once './app/model/product.model.php';
require_once './app/view/api.view.php';
class ProductApiController extends ApiController
{

 
    function __construct()
    {
        parent::__construct();
        $this->model = new ProductModel();
    }

    public function get($params = [])
    {
        $products = $this->model->getProducts();
        return $this->view->response($products, 200);
       
    }

}



?>