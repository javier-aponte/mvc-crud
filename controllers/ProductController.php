<?php

namespace controllers;

use \models\Product;
use \models\Image;

require '../models/Product.php';
require '../models/Image.php';

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

        $target_dir = "uploads/";
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $imageName = uniqid() . '.' . $imageFileType;
        $target_file = $target_dir . $imageName;

        $check = getimagesize($_FILES["image"]["tmp_name"]);

        if ($check !== false) {
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        }

        $product = new Product();
        $product->setName($name);
        $product->setDescription($description);
        $product->setStock($stock);
        $product->setPrice($price);

        $product_result = $product->addProduct();

        $image = new Image();
        $image->setPath($target_file);
        $image->setName($imageName);
        $image->setProductId($product_result);

        $image_result = $image->AddImage();

        if ($product_result && $image_result) {
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
