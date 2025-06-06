<?php

class CFrontController{
    
    public function run($requestUri){

        $requestUri = trim($requestUri, '/');
        if (preg_match('/\.(css|js|jpg|jpeg|png|gif|ico|svg|webp|woff2)$/i', $requestUri)) {
            return;
        }
        $uriParts = explode('/', $requestUri);

        array_shift($uriParts);

        if (isset($uriParts[0]) && $uriParts[0] === 'Delivery') {
            array_shift($uriParts);
        }

        $controllerName = !empty($uriParts[0]) ? ucfirst($uriParts[0]) : 'User';
     
        $methodName = !empty($uriParts[1]) ? $uriParts[1] : 'home';

        $controllerClass = 'C' . $controllerName;
        $controllerFile = __DIR__ . "/{$controllerClass}.php";

        if (file_exists($controllerFile)) {
            require_once $controllerFile;

            if (method_exists($controllerClass, $methodName)) {
                $params = array_slice($uriParts, 2); 
                call_user_func_array([$controllerClass, $methodName], $params);
            } else {
                header('Location: /Delivery/User/home');
            }
        } else {
            http_response_code(404);
echo "Pagina non .";
exit;

        }
    }
}