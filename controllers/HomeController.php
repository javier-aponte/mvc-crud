<?php
class HomeController
{
  public function index()
  {
    $this->render('home/index');
  }

  public function render($view)
  {
    if (file_exists("../views/{$view}.php")) {
      include "views/{$view}.php";
    } else {
      echo "View not found";
    }
  }
}
