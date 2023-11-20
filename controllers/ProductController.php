<?php
class ProductController
{
  public function list()
  {
    include '../views/list.php';
  }

  public function create()
  {
    include '../views/create.php';
  }

  public function store()
  {
    echo "store id:";
  }

  public function edit(string $id)
  {
    include '../views/edit.php';
  }

  public function update(string $id)
  {
    echo "edit: $id";
  }
}
