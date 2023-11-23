<?php

namespace controllers;

use \models\Product;

require '../models/Product.php';

class ProductController
{
    public function list(): void
    {
        $products = new Product();
        $products = $products->getProducts();
        include '../views/list.php';
    }

    public function create(): void
    {
        include '../views/create.php';
    }

    public function store(): void
    {
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $stock = (int)$_POST['stock'] ?? 0;
        $price = (double)$_POST['price'] ?? 0.00;

        $product = new Product();
        $product->setName($name);
        $product->setDescription($description);
        $product->setStock($stock);
        $product->setPrice($price);

        if ($product->addProduct()) {
            header('Location: /');
            exit;
        } else {
            echo "Failed to add product.";
        }
    }

    public function edit(string $id): void
    {
        include '../views/edit.php';
    }

    public function update(string $id): void
    {
        echo "edit: $id";
    }
}
