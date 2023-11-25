<?php

namespace models;

require_once '../config/Database.php';

class Image
{
    private string $id;
    private string $name;
    private string $path;
    private string $product_id;

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

    public function getPath(): string
    {
        return $this->path;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getProductId(): string
    {
        return $this->product_id;
    }

    public function setProductId(string $product_id): void
    {
        $this->product_id = $product_id;
    }

    public function AddImage(): bool
    {
        $db = getDBConnection();
        $stmt = $db->prepare(
            "INSERT INTO images(name, path, product_id) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("sss", $this->name, $this->path, $this->product_id);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            error_log("Error: " . $stmt->error);
            $stmt->close();
            return false;
        }
    }

    public function findImage(string $id): ?Image
    {
        $db = getDBConnection();
        if (!$db) return null;

        $stmt = $db->prepare("SELECT id, name, path, product_id FROM images WHERE product_id = ?");
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $image = new Image();

            while ($row = $result->fetch_assoc()) {
                $image->setId($row['id']);
                $image->setName($row['name']);
                $image->setPath($row['path']);
                $image->setProductId($row['product_id']);
            }

            $stmt->close();
            return $image;
        } else {
            error_log("Error: " . $stmt->error);
            $stmt->close();
            return null;
        }
    }

    public function updateImage(): bool
    {
        $db = getDBConnection();
        $stmt = $db->prepare(
            "UPDATE images SET name = ?, path = ? WHERE id = ?"
        );
        $stmt->bind_param("sss", $this->name, $this->path, $this->id);
        $result = $stmt->execute();
        $stmt->close();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
