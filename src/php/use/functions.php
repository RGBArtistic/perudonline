<?php
    function normalizeUserChar($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }

  function verifPost($post, $pattern)
  {
      if(!empty(trim($post)) && preg_match($pattern, $post)) return normalizeUserChar($post);
  }

  function verifMail($mail)
  {
      if(filter_var($mail, FILTER_VALIDATE_EMAIL)) return normalizeUserChar($mail);
  }

  function bindParamDb($prepare, $string, $value)
  {
      $prepare->bindParam($string, $value) ;
  }

?>