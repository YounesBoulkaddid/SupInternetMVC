<?php
session_start();
require_once __DIR__.'/../vendor/autoload.php';


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
use Symfony\Component\Yaml\Yaml;




    $routes = Yaml::parse(file_get_contents(__DIR__.'/../app/config/routing.yml'));
    if(!empty($_GET['p'])){
        $page = $_GET['p'];
    } else {
        $page = 'home'; //put your default route name here, can be user_list
    }
//check if controller config exits in routing.yml
    if (!empty($routes[$page]['controller'])) {
        list($controller_class,$action_name) = explode(':', $routes[$_GET['p']]['controller']);
    } else {
        throw new Exception('add routing config for '.$page.' in routing.yml');
    }

    echo $controller_class.'<BR>';
    $controller = new $controller_class();

//$Request can by an object
    $request['request'] = &$_POST;
    $request['query'] = &$_GET;
    $request['session'] = &$_SESSION;
//...

//$response can be an object
    $response = $controller->$action_name($request);
    var_dump($response);


if(isset($response['redirect_to'])){  /** Test Redirection */
    header('Location: '.$reponse['redirect_to']);
    exit;
} elseif (!empty($response['view'])) {
    /**
     * Use Twig !
     */
    require __DIR__ . '/../src/' . $response['view'];
} else {
    throw new Exception('your action "'.$page.'" do not return a correct response array, should have "view" or "redirect_to"');
}