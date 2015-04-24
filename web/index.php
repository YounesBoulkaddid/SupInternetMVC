<?php

/**
 * This is you FrontController, the only point of access to your webapp
 */

/**
 * Use Yaml components for load a config routing, $routes is in yaml app/config/routing.yml :
 *
 * Url will be /index.php?p=route_name
 *
 *
 */
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Yaml\Parser;
$yaml = new Parser();
$routes = $yaml->parse(file_get_contents('../app/config/routing.yml'));
if(isset($_GET['p'])) {
    $currentRoute = $routes[$_GET['p']]['controller'];
    $routesArray = explode(':', $currentRoute);
    var_dump($routesArray);
//ControllerClassName, end name is ...Controller
    $controller_class = $routesArray[0];

//ActionName, end name is ...Action
    $action_name = $routesArray[1];

    $controller = new $controller_class();

//$Request can by an object
    $request['request'] = &$_POST;
    $request['query'] = &$_GET;
//...

//$response can be an object
    $response = $controller->$action_name($request);

    /**
     * Use Twig !
     */
    require $response['view'];
}