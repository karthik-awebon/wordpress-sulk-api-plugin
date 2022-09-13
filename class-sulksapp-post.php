<?php

class SulkAppPost {
  public $id;
  public $image_url;
  public $category;
  public $title;
  public $description;
  public $published_date;
  public $content;

  function __construct($id,$image_url,$category,$title,$description,$content,$published_date) {
    $this->id = $id;
    $this->image_url = $image_url;
    $this->category = $category;
    $this->title = $title;
    $this->description = $description;
    $this->content = $content;
    $this->published_date = $published_date;
  }
}