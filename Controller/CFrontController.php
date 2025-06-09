<?php

class CFrontController{
    
    public function run($requestUri){

        //This line cleans the URI (ex. : '/Delivery/User/home/' → 'Delivery/User/home')
        $requestUri = trim($requestUri, '/');
        //If the URI final part is .css|.js|...|.woff2 ecc. the frontController do nothing, because it's a static resoure
        if (preg_match('/\.(css|js|jpg|jpeg|png|gif|ico|svg|webp|woff2)$/i', $requestUri)) {
            return;
        }
        //Split URI in parts (ex.:  'Delivery/User/home' → ['Delivery', 'User', 'home'])
        $uriParts = explode('/', $requestUri);

        //Remove the first part of URI to simplify the routing
        array_shift($uriParts);

        //Remove Delivery into URI: (ex.: 'Delivery/User/home' → ['User', 'home'])
        if (isset($uriParts[0]) && $uriParts[0] === 'Delivery') {
            array_shift($uriParts);
        }

        //If uriParts[0] is not empty, we save the controller name
        //Else we use the default controller name : User -> CUser
        $controllerName = !empty($uriParts[0]) ? ucfirst($uriParts[0]) : 'User';

        //If uriParts[1] is not empty, we save the method name
        //Else we use save default 'home'
        $methodName = !empty($uriParts[1]) ? $uriParts[1] : 'home';


        $controllerClass = 'C' . $controllerName;
        $controllerFile = __DIR__ . "/{$controllerClass}.php";

        if (file_exists($controllerFile)) {
            require_once $controllerFile;

            //If the required method exists parameters are extracted and passed
            // to the method (ex. : /User/details/5 → parameter: ['5'])
            //Else redirect to home page (/Delivery/User/home)
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