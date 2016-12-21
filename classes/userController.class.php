<?php

//Page that helped a bit http://www.yiiframework.com/forum/index.php/topic/6064-how-to-get-get-as-action-parameters/


    class userController extends controller {


      public function get() {


	       if(isset($_GET['action'])){
           $get = $_GET;
           $action = $_GET['action'];



            if($action=="edit"){
              $user = new userModel;
              if($user->user_loggedin()){
                $profile = new profileView;
                $profileHTML = $profile->getHTML(true);
                $this->html .= $profileHTML;
              } else {
                $error = 'Login to edit your profile';
              }
            }
            elseif($action=="usertable"){
              $table = new tableView;
              $tableHTML = $table->getHTML();
              $this->html .= $tableHTML;
            }

            elseif($action=="video"){
              $video = new videoView;
              $videoHTML = $video->getHTML();
              $this->html .= $videoHTML;
            }

            elseif($action=="logout"){
	               $user = new userModel;
	                $logoutpage = new logoutView;
	                $logoutHTML = $logoutpage->getHTML();
	                $this->html .= $logoutHTML;

	    }
      elseif($action=="profile"){
            $user = new userModel;
            if($user->user_loggedin()){
              $profile = new profileView;
              $profileHTML = $profile->getHTML();
              $this->html .= $profileHTML;
            } else {
              $error = 'If you want to access the website please log-in';
            }
        }

            elseif($action=="joined"){
              $form = new loginRegisterView;
              $form_html = $form->getHTML();
              $this->html .= $form_html;
            }
      }
         elseif(isset($_GET['errors'])) {

	    if($_GET['form'] == 'edit') {
              $formtype = $_GET['form'];
              $errors = $_GET['errors'];
              $profile = new profileView;
              $profileHTML = $profile->getHTML(true,$errors);
              $this->html .= $profileHTML;
            } else {
              $formtype = $_GET['form'];
              $errors = $_GET['errors'];
              $form = new loginRegisterView;
              $form_html = $form->getHTML($errors, $formtype);
              $this->html .= $form_html;
            }

	}

        else{

            $form = new loginRegisterView;
            $form_html = $form->getHTML();
            $this->html .= $form_html;
          }
        }


    public function post() {

      if($_POST['form'] == 'sign_up'){
          $db = dbConn::getConnection();
	        $stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
	         $stmt->execute(array(':username' => $_POST['user_name']));
	          $line = $stmt->fetch(PDO::FETCH_ASSOC);

	  if(!empty($line['username'])){
	    $error[] = 'You need to complete your username';
	  }
          if($_POST['password'] != $_POST['confirmpassword']){
	    $error[] = 'Use matching passwords';
	  }
          if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
       	    $error[] = 'Email address invalid';
	  } else {
            $db = dbConn::getConnection();
	    $stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
	    $stmt->execute(array(':email' => $_POST['email']));
	    $line = $stmt->fetch(PDO::FETCH_ASSOC);

	    if(!empty($line['email'])){
	      $error[] = 'Log-in with new email';
	    }
      	}
     }


     elseif($_POST['form'] == 'edit') {

       $oldusername = $_POST['oldusername'];
       $user = new userModel;
       $reset = $user->get_Data($oldusername);
       $oldemail = $reset['email'];
       $first_name = $_POST['first_name'];
       $last_name = $_POST['last_name'];
       $username = $_POST['username'];
       $email = $_POST['email'];
       $avatar_url = $reset['avatar_url'];
       $check = false;
       while($check == false) {
         $db = dbConn::getConnection();
         $stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
         $stmt->execute(array(':username' => $username));
	 $line = $stmt->fetch(PDO::FETCH_ASSOC);

	 if(!empty($line['username']) && $line['username'] !== $oldusername){
         $error[] = 'Username provided is already in use.';
             goto end;
	 }

	 $db = dbConn::getConnection();
	 $stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
	 $stmt->execute(array(':email' => $email));
	 $line = $stmt->fetch(PDO::FETCH_ASSOC);

	 if(!empty($line['email']) && $line['email'] !== $oldemail){
	     $error[] = 'Email provided is already in use.';
             goto end;
	 }
             $check = true;

       }

//Putting my upload program here, I did not figure out how to make my images work.. Sorry Keith :(
// Watched tutorials: https://www.youtube.com/watch?v=Ipa9xAs_nTg ,https://www.youtube.com/watch?v=eVuTnjQ8vbw not very useful
    define("UPLOAD_DIR", "/afs/cad.njit.edu/u/j/g/jg439/public_html/IS218FINAL/images/");

	/*
  if (!empty($_FILES["myFile"])) {
      $myFile = $_FILES["myFile"];

      if ($myFile["error"] !== UPLOAD_ERR_OK) {
          echo "<p>An error occurred.</p>";
          exit;
      }

      // ensure a safe filename
      $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

      // don't overwrite an existing file
      $i = 0;
      $parts = pathinfo($name);
      while (file_exists(UPLOAD_DIR . $name)) {
          $i++;
          $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
      }

      // preserve file from temporary directory
      $success = move_uploaded_file($myFile["tmp_name"],
          UPLOAD_DIR . $name);
      if (!$success) {
          echo "<p>Unable to save file.</p>";
          print_r($_FILES);
          exit;
      }

      // set proper permissions on the new file
      chmod(UPLOAD_DIR . $name, 0644);
      echo 'Uploaded ' . $name . '.';
  }


   */

	    $user->update($oldusername, $first_name, $last_name, $username, $email, $avatar_url);
            end:
      }

       if(!isset($error)){
          try {
             if(isset($_POST['username']) && isset($_POST['password'])){
	         $user = new userModel;
                 if($user->login($_POST['username'], $_POST['password'])){
                    header('Location: index.php?controller=userController&action=profile');
                    exit;
                  } else{
                    $error[] = 'Error: Username or Password entered is incorrect';
                  }
             }else {
                 $user = new userModel;
                 $hashedpassword = $user->hash_Password($_POST['password']);
                 $user->save($_POST['first_name'], $_POST['last_name'], $_POST['user_name'], $hashedpassword, $_POST['email']);
             }

	  } catch(Exception $e) {
	      $error[] = $e->getMessage();
	  }
      }

     if(isset($error)){

        echo '<script>console.log("before $errors");</script>';
        $err_url = 'index.php?controller=userController&errors=';
        $get_url = '&form=' . $_POST['form'];
	foreach($error as $error){
             $err_url .= $error;
	}
        $fin_url = $err_url . $get_url;
           echo '<script>console.log("past $fin_url");</script>';
	   header("Location: $fin_url");
	}
    }


    public function put() {}
    public function delete() {}
}
?>
