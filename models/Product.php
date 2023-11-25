<?php

namespace models;

require_once '../config/Database.php';

class Product
{
    private string $id;
    private string $name;
    private string $description;
    private int $stock;
    private float $price;

    public function __construct()
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function findProducts(): ?array
    {
        $db = getDBConnection();

        if (!$db) return null;

        $result = $db->query("SELECT id, name, description, stock, price FROM products ORDER BY created_at DESC");
        $products = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
            $result->free();
        }

        return $products;
    }

    public function findProduct(string $uuid): ?Product
    {
        $db = getDBConnection();

        if (!$db) return null;

        $stmt = $db->prepare("SELECT id, name, description, stock, price FROM products WHERE id = ?");
        $stmt->bind_param("s", $uuid);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $product = new Product();

            while ($row = $result->fetch_assoc()) {
                $product->setId($row['id']);
                $product->setName($row['name']);
                $product->setDescription($row['description']);
                $product->setStock($row['stock']);
                $product->setPrice($row['price']);
            }

            $stmt->close();
            return $product;
        } else {
            error_log("Error: " . $stmt->error);
            $stmt->close();
            return null;
        }
    }

    public function addProduct(): string
    {
        $db = getDBConnection();
        $uuid = $db->query("SELECT UUID() as uuid")->fetch_assoc()['uuid'];
        $stmt = $db->prepare(
            "INSERT INTO products(id, name, description, stock, price) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssis", $uuid, $this->name, $this->description, $this->stock, $this->price);

        if ($stmt->execute()) {
            $stmt->close();
            return $uuid;
        } else {
            error_log("Error: " . $stmt->error);
            $stmt->close();
            return false;
        }
    }

    public function updateProduct(): bool
    {
        $db = getDBConnection();
        $stmt = $db->prepare(
            "UPDATE products SET name = ?, description = ?, stock = ?, price = ? WHERE id = ?"
        );
        $stmt->bind_param("ssiss", $this->name, $this->description, $this->stock, $this->price, $this->id);
        $result = $stmt->execute();
        $stmt->close();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteProduct(): bool
    {
        $db = getDBConnection();
        if (!$db) return false;

        $stmt = $db->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("s", $this->id);
        $result = $stmt->execute();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function __toString(): string
    {
        return "name: $this->name description: $this->description stock: $this->stock price $this->price";
    }


}
