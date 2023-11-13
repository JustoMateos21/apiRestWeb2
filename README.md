# apiRestWeb2

RUTAS DE LA API

Obtiene todos los productos. 
$router->addRoute('products', 'GET', 'ProductApiController', 'get'); 


Crea un nuevo producto. Los campos necesarios son los siguientes: 
 - name
- description
- brand
- price
- stock_quantity
- category_id
  
- $router->addRoute('products', 'POST', 'ProductApiController', 'create');

Obtiene un determinado producto por su ID
- $router->addRoute('products/:ID', 'GET', 'ProductApiController', 'getById');

Obtiene una determinada cantidad de productos.
- $router->addRoute('products&qty=', 'GET', 'ProductApiController', 'get');

Obtiene los productos por orden en alguno de sus campos. 
El order puede ser ascendent o descendent y los parametros posibles para orderBy son:
- product_id, name, description, brand, price, stock_quantity, category_id.
- $router->addRoute('products/sort/:orderBy/:order', 'GET', 'ProductApiController', 'getByOrder');

Modifica un producto especifico. Los campos de modificacion son los mismos que los de creacion. 
- $router->addRoute('products/:ID', 'PUT', 'ProductApiController', 'update');
