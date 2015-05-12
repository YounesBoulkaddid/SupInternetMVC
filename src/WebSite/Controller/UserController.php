<?php
/**
 * Created by PhpStorm.
 * User: nico
 * Date: 23/04/2015
 * Time: 23:45
 */

namespace Website\Controller;
use Symfony\Component\Yaml\Parser;
use Website\Controller\AbstractBaseController;

/**
 * Class UserController->
 *
 * Controller of all User actions
 *
 * @package Website\Controller
 */
class UserController extends AbstractBaseController{
    /**
     * Recup all users and print it
     *
     * @return array
     */

    public function __construct(){
        $this->bdd = $this->getConnection();
    }
    public function listUserAction($request) {//Use Doctrine DBAL here
/*****/

//for this array use config_dev.yml and YamlComponents
// http://symfony.com/…/curr…/components/yaml/introduction.html
// http://docs.doctrine-project.org/…/data-retrieval-and-manip…
// it's much better if you use QueryBuilder : http://docs.doctrine-project.org/…/refer…/query-builder.html
        $statement = $this->bdd->prepare('SELECT * FROM Users');
        $statement->execute();
        $users = $statement->fetchAll();
/******/
//you can return a Response object
        return [
        'view' => '../src/WebSite/View/user/listUser.html.twig', // should be Twig : 'WebSite/View/user/listUser.html.twig'
        'users' => $users
        ];

}
    /**
     * swho one user thanks to his id : &id=...
     *
     * @return array
     */
    public function showUserAction($request) {
        //Use Doctrine DBAL here
        $statement = $this->bdd->prepare('SELECT * FROM Users WHERE id = :id');
        $statement->execute([
            'id' => $request['session']['id']
        ]);
        $user = $statement->fetch();

        //you can return a Response object
        return [
            'view' => '../src/WebSite/View/user/showUser.html.twig', // should be Twig : 'WebSite/View/user/listUser.html.twig'
            'user' => $user
        ];
    }

    /**
     * Add User and redirect on listUser after
     */
    public function addUserAction($request) {
        //Use Doctrine DBAL here
        if ($request['request']) { //if POST
            //handle form with DBAL
            //...
            $statement = $this->bdd->prepare("INSERT INTO Users (name, password, email) VALUES (:name, :password, :email)");
            $statement->execute([
                'name' => $request['request']['name'],
                'password' => $request['request']['password'],
                'email' => $request['request']['id']
            ]);
            //Redirect to show
            //you should return a RedirectResponse object
            return [
                'redirect_to' => 'index.php?p=user_list',// => manage it in index.php !! URL should be generate by Routing functions thanks to routing config

            ];
        }


        //you should return a Response object
        return [
            'view' => '../src/WebSite/View/user/addUser.html.twig',// => create the file
            //'user' => $user
        ];
    }


    /**
     * Delete User and redirect on listUser after
     */
    public function deleteUser($request) {
        //Use Doctrine DBAL here

        $statement = $this->bdd->prepare("DELETE FROM Users WHERE name = :name");
        $statement->execute([
            'name' => $request['request']['name']
        ]);

        //you should return a RedirectResponse object , redirect to list
        return [
            'redirect_to' => 'http://.......',// => manage it in index.php !! URL should be generate by Routing functions thanks to routing config

        ];
    }

    /**
     * Log User (Session) , add session in $request first (index.php)
     */
    public function logUser($request) {
        if ($request['request']) { //if POST
            //handle form with DBAL
            //...


        }


        //take FlashBag system from
        // https://github.com/NicolasBadey/SupInternetTweeter/blob/master/model/functions.php
        // line 87 : https://github.com/NicolasBadey/SupInternetTweeter/blob/master/index.php
        // and manage error and success

        //Redirect to list or home
        //you should return a RedirectResponse object
        return [
            'redirect_to' => 'http://.......',// => manage it in index.php !! URL should be generate by Routing functions thanks to routing config

        ];

    }
}