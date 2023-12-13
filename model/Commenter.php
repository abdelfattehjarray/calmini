<?php
class Commenter {
  private $user;
    private $comment;

    private $time;
    private $IdArticle;

    function __construct($user, $comment,$IdArticle) {
      $this->comment = $comment;
      $this->user = $user;
      $this->time = date('Y-m-d H:i:s'); // current date and time in MySQL format
      $this->IdArticle=$IdArticle;
    }
  
    function getcomment() {
      return $this->comment;
    }
    function setcomment($comment) {
       $this->comment=$comment;
      }
    function getIdArticle() {
        return $this->IdArticle;
      }

    function setUser($user) {
      $this->user=$user;
    }
  
    function setTime($time) {
      $this->time=$time;
    }
    function setIdArticle($IdArticle) {
         $this->IdArticle=$IdArticle;
      }
    

    
      function getUser() {
        return $this->user;
      }
    
      function getTime() {
         return $this->time;
      }
  }
  

?>