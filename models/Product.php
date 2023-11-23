<?php

namespace models;

require_once '../config/Database.php';

class Product
{
    private string $id;
    private string $name;
    private string $description;
    private array $images;
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

    public function getImage(): array
    {
        return $this->images;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function AddImage(Image $image): void
    {
        $this->images[] = $image;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getProducts(): array
    {
        $db = getDBConnection();
        $result = $db->query(
            "SELECT id, name, description, stock, price FROM products ORDER BY  created_at DESC"
        );
        $products = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
            $result->free();
            $db->close();
        }
        return $products;
    }

    public function addProduct(): bool
    {
        $db = getDBConnection();
        $stmt = $db->prepare(
            "INSERT INTO products(name, description, stock, price) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("ssis", $this->name, $this->description, $this->stock, $this->price);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            error_log("Error: " . $stmt->error);
            $db->close();
            return false;
        }
    }

    public function __toString(): string
    {
        return "name: $this->name description: $this->description stock: $this->stock price $this->price";
    }


}
