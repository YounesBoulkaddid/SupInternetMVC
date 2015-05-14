<?php

namespace Website\Controller;
use Website\Model\ProductManager;

class ProductController extends AbstractBaseController
{

    public function __construct()
    {
        $this->bdd = $this->getConnection();
    }

    public function listProductsAction()
    {

        $productManager = new ProductManager($this->getConnection());
        $product = $productManager->ListProducts();

        return [
            'view' => '../src/WebSite/View/product/listProducts.html.php',
            'product' => $product
        ];
    }

    public function showProductAction($request)
    {
        $productManager = new ProductManager($this->getConnection());
        $product = $productManager->showProduct($request['request']['id']);

        return [
            'view' => '../src/WebSite/View/product/showProduct.html.php',
            'product' => $product
        ];
    }

    public function addProductAction($request)
    {
        if ($request['request']) {
            $productManager = new ProductManager($this->getConnection());
            $productManager->showProduct($request['request']['name'],$request['request']['password'], $request['request']['email'] );
            return [
                'redirect_to' => 'index.php?p=product_list',
            ];
        }

        return [
            'view' => '../src/WebSite/View/Product/addProduct.html.php',
        ];
    }

    public function deleteProductAction($request)
    {
        $productManager = new ProductManager($this->getConnection());
        $productManager->showProduct($request['request']['name']);
        return [
            'redirect_to' => 'index.php',
        ];
    }
}