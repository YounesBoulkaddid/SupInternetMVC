<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 12/05/15
 * Time: 11:55
 */
namespace Website\Model;

class ProductManager
{
    function __construct($param)
    {
        $this->bdd = $param;
    }

    function listProducts()
    {

        $sql = 'SELECT *
                FROM Products';

        $statement = $this->bdd->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    function showProduct($id)
    {

        $sql = 'SELECT *
                FROM Products
                WHERE id = :id';

        $statement = $this->bdd->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);
        return $statement->fetch();
    }

    function addProduct($name, $detail, $email)
    {
        $sql = 'INSERT INTO Products (name, details)
                VALUES (:name, :details)';
        $statement = $this->bdd->prepare($sql);
        $statement->execute([
            'name' => $name,
            'details' => $detail
        ]);
    }

    function deleteProducts($name)
    {
        $this->bdd->delete('Products', array('name' => $name));
    }
}