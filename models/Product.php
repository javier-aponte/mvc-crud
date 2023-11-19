<?php
class Product
{
  private string $id;
  private string $name;
  private string $description;
  private array $images;
  private int $stock;
  private float $price;

  public function __construct(
    string $id,
    string $name,
    string $description,
    array $images = [],
    int $stock,
    float $price
  ) {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    $this->images = $images;
    $this->stock = $stock;
    $this->price = $price;
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
}
