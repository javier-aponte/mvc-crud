<?php

namespace controllers;

use \models\Product;
use \models\Image;

require '../models/Product.php';
require '../models/Image.php';

class ProductController
{
    private Product $productModel;
    private Image $imageModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->imageModel = new Image();
    }


    public function list(): void
    {
        $products = $this->productModel->findProducts();
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

        $image_data = $this->saveFile($_FILES['image']);

        $product = new Product();
        $product->setName($name);
        $product->setDescription($description);
        $product->setStock($stock);
        $product->setPrice($price);

        $product_result = $product->addProduct();

        $image = new Image();
        $image->setPath($image_data[0]);
        $image->setName($image_data[1]);
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
        $product = $this->productModel->findProduct($id);
        include '../views/edit.php';
    }

    public function update(): void
    {
        $id = $_POST['id'] ?? '';
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $stock = (int)$_POST['stock'] ?? 0;
        $price = (double)$_POST['price'] ?? 0.00;

        $product = new Product();
        $product->setId($id);
        $product->setName($name);
        $product->setDescription($description);
        $product->setStock($stock);
        $product->setPrice($price);

        $product_result = $product->updateProduct();

        if ($product_result) {
            header('Location: /');
            exit;
        } else {
            echo "Failed to add product.";
        }
    }

    public function delete(): void
    {
        $id = $_POST['id'] ?? '';

        $this->productModel->setId($id);

        if ($this->productModel->deleteProduct()) {
            header('Location: /');
        } else {
            echo "Failed to delete product";
        }
    }

    public function saveFile(array $file): array
    {
      $target_dir = "uploads/";
      $imageFileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
      $imageName = uniqid() . '.' . $imageFileType;
      $target_file = $target_dir . $imageName;

      $check = getimagesize($file["tmp_name"]);

        if ($check !== false) {
            move_uploaded_file($file["tmp_name"], $target_file);
        }

      return [$target_file, $imageName];
    }
}
