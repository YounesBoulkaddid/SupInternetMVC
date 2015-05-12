<?php

namespace Website\Controller;
use Website\Model\UserManager;

class UserController extends AbstractBaseController
{

    public function __construct()
    {
        $this->bdd = $this->getConnection();
    }

    public function listUsersAction($request)
    {

        $userManager = new UserManager($this->getConnection());
        $users = $userManager->ListUsers($request);

        return [
            'view' => '../src/WebSite/View/user/listUser.html.twig',
            'users' => $users
        ];
    }

    public function showUserAction($request)
    {
        $userManager = new UserManager($this->getConnection());
        $users = $userManager->showUser($request);

        return [
            'view' => '../src/WebSite/View/user/showUser.html.twig',
            'users' => $users
        ];
    }

    public function addUserAction($request)
    {
        if ($request['request']) {
            $userManager = new UserManager($this->getConnection());
            $userManager->showUser($request);
            return [
                'redirect_to' => 'index.php?p=user_list',
            ];
        }

        return [
            'view' => '../src/WebSite/View/user/addUser.html.twig',
        ];
    }

    public function deleteUser($request)
    {
        $userManager = new UserManager($this->getConnection());
        $userManager->showUser($request);
        return [
            'redirect_to' => 'index.php',
        ];
    }

    public function logUserAction($request)
    {
        if ($request['request']) {
            $userManager = new UserManager($this->getConnection());
            $users = $userManager->logUser($request);
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