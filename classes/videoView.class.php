<?php
  class videoView {
       public function getHTML($errors='') {
       $video = '<h1>Tutorial Video</h1>

       <iframe width="560" height="315" src="https://www.youtube.com/embed/0dVJWqHwhZo" frameborder="0" allowfullscreen></iframe>';
          return $video;
       }
  }
?>
