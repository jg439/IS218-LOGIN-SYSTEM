<?php
//The controller class includes the header, I developed my own css and js to create the pages
//mainly it is based on my Easy-Login System


  abstract class controller {
    protected $html;
    public function get() {}
    public function post() {}
    public function put() {}
    public function delete() {}
    public function __construct() {
      $header = '<!DOCTYPE html>
        <html>
          <head>
	            <title>IS 218 - Julia Garcia Website</title>


              <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
              <link rel="stylesheet" href="css/main.css" type="text/css" />
              <script type = "text/javascript" src = "js/jquery.js"></script>
              <script type = "text/javascript" src = "js/showhide.js"></script>

        </head>
        <header>
        <div id="header">
		      <ul class="nav">
			       <li><a href="index.php">Home</a></li>
			       <li><a href="index.php?controller=userController">Login</a>

      	</ul>

	       </div>
        </header>
      ';
      $this->html .= $header;
    }
    public function getHTML() {
        return $this->html;
    }
  }
