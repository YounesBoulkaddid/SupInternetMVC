<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 14/05/15
 * Time: 23:40
 */
namespace Website\Controller;

class HomeController extends AbstractBaseController{

    public function __construct()
    {
        $this->bdd = $this->getConnection();
    }

    public function showHomeAction()
    {
        return [
            'view' => '../src/WebSite/View/body/home.html.php'
        ];
    }
}