<?php
class Article {
  private $IdArticle;
    private $title;
    private $content;
    private $user;
    private $time;
    private $imageData;
    private $imageType;

    function __construct($title, $content, $user, $imageData, $imageType) {
      $this->title = $title;
      $this->content = $content;
      $this->user = $user;
      $this->time = date('Y-m-d H:i:s');
      $this->imageData = $imageData;
      $this->imageType = $imageType;
  }
  function getImageData() {
    return $this->imageData;
}
public function setIdArticle($id)
{
    $this->IdArticle = $id;
}
function getImageType() {
    return $this->imageType;
}
  
    function getTitle() {
        return $this->title;
      }
  
    function getContent() {
      return $this->content;
    }
  
    function setUser($user) {
      $this->user=$user;
    }
  
    function setTime($time) {
      $this->time=$time;
    }
    function setTitle($title) {
         $this->title=$title;
      }
    
      function setContent($content) {
         $this->content=$content;
      }
    
      function getUser() {
        return $this->user;
      }
    
      function getTime() {
         return $this->time;
      }
  }
  

?>