<?php

class SulkShopCategory {
  public $id;
  public $image_url;
  public $category_name;
  public $number_of_products;

  function __construct($id,$image_url,$category_name,$number_of_products) {
    $this->id = $id;
    $this->image_url = $image_url;
    $this->category_name = $category_name;
    $this->number_of_products = $number_of_products;
  }
}