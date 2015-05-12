<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 12/05/15
 * Time: 11:55
 */
namespace Website\Model;

class UserManager{
    function __construct($param){
        $this->bdd = $param;
    }
    function listUsers($request){
        $statement = $this->bdd->prepare('SELECT * FROM Users');
        $statement->execute();
        return $statement->fetchAll();
    }
    function showUser($request){
        $statement = $this->bdd->prepare('SELECT * FROM Users WHERE id = :id');
        $statement->execute([
            'id' => $request['session']['id']
        ]);
        return $statement->fetch();
    }
    function addUser($request){
        $statement = $this->bdd->prepare("INSERT INTO Users (name, password, email) VALUES (:name, :password, :email)");
        $statement->execute([
            'name' => $request['request']['name'],
            'password' => sha1($request['request']['password']),
            'email' => $request['request']['id']
        ]);
    }
    function deleteUser($request){
        $statement = $this->bdd->prepare("DELETE FROM Users WHERE name = :name");
        $statement->execute([
            'name' => $request['request']['name']
        ]);
    }
    function logUser($request){
        $request = $this->bdd->prepare('SELECT id,name ,password FROM users WHERE name = :name AND password = :password');
        $request->execute([
            "name" => $request['request']['name'],
            "password" => sha1($request['request']['password'])
        ]);
        return $request->fetch();
    }
}