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
    function listUsers(){

        $sql = 'SELECT *
                FROM Users';

        $statement = $this->bdd->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    function showUser($id){

        $sql = 'SELECT *
                FROM Users
                WHERE id = :id';

        $statement = $this->bdd->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);
        return $statement->fetch();
    }
    function addUser($name, $pass, $email){
        $sql = 'INSERT INTO Users (name, password, email)
                VALUES (:name, :password, :email)';
        $statement = $this->bdd->prepare($sql);
        $statement->execute([
            'name' => $name,
            'password' => sha1($pass),
            'email' => $email
        ]);
    }
    function deleteUser($name){
        $this->bdd->delete('user', array('name' => $name));
    }
    function logUser($name, $pass){
        $sql = 'SELECT id,name ,password
                FROM users
                WHERE name = :name AND password = :password';
        $request = $this->bdd->prepare($sql);
        $request->execute([
            "name" => $name,
            "password" => sha1($pass)
        ]);
        return $request->fetch();
    }
}