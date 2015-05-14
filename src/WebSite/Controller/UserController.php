<?php

namespace Website\Controller;
use Website\Model\UserManager;

class UserController extends AbstractBaseController
{

    public function __construct()
    {
        $this->bdd = $this->getConnection();
    }

    public function listUsersAction()
    {

        $userManager = new UserManager($this->getConnection());
        $users = $userManager->ListUsers();

        return [
            'view' => '../src/WebSite/View/user/listUser.html.php',
            'users' => $users
        ];
    }

    public function showUserAction($request)
    {
        $userManager = new UserManager($this->getConnection());
        $users = $userManager->showUser($request['session']['id']);

        return [
            'view' => '../src/WebSite/View/user/showUser.html.php',
            'users' => $users
        ];
    }

    public function addUserAction($request)
    {
        if ($request['request']) {
            $userManager = new UserManager($this->getConnection());
            $userManager->showUser($request['request']['name'],$request['request']['password'], $request['request']['email'] );
            return [
                'redirect_to' => 'index.php?p=user_list',
            ];
        }

        return [
            'view' => '../src/WebSite/View/user/addUser.html.php',
        ];
    }

    public function deleteUserAction($request)
    {
        $userManager = new UserManager($this->getConnection());
        $userManager->showUser($request['request']['name']);
        return [
            'redirect_to' => 'index.php',
        ];
    }

    public function logUserAction($request)
    {
        if ($request['request']) {
            $userManager = new UserManager($this->getConnection());
            $users = $userManager->logUser($request['request']['name'],$request['request']['password'] );
            if ($users) {
                $request['session']['user'] = $users;
            }
        }
        return [
            'redirect_to' => 'index.php?p=user_list',
        ];

    }

    public function logOutAction($request)
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
            $request['session'] = array();
            return [
                'redirect_to' => 'index.php?p=user_list',
            ];

        }

    }
}