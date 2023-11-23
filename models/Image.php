<?php
namespace models;

class Image
{
  private string $id;
  private string $name;
  private string $path;

  public function __construct(string $id, string $name, string $path)
  {
    $this->id = $id;
    $this->name = $name;
    $this->path = $path;
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
}
