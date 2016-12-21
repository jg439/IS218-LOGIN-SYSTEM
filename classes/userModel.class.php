<?php

//The userModel is the blueprint of creating a new User, I developed the functions get_Data, hash_Password, get_Hash, verify_Pass, login, logout,

  class userModel extends model {

    private $username;
    private $password;



    public function get_Data($username){
      try {

        $db = dbConn::getConnection();

        $stmt = $db->prepare('SELECT first_name, last_name, memberID, avatar_url, email FROM members WHERE username = :username');
        $stmt->execute(array('username' => $username));
	         return $stmt->fetch();}

      catch(PDOException $e) {
        echo '<p>'.$e->getMessage().'</p>';
      }
    }

//I did not know how to do md5 scrypt I used this web http://www.the-art-of-web.com/php/blowfish-crypt/
// I used $2y cause it said it was more secure!

    public function hash_Password($password){
      if(defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH){
        $salt = '$2y$23' . substr(md5(uniqid(rand(), true)), 0, 30);
        return crypt($password, $salt);
      }
    }

    private function get_Hash($username){
      try {

        $db = dbConn::getConnection();
         $stmt = $db->prepare('SELECT password, username, memberID, avatar_url FROM members WHERE username = :username');
        $stmt->execute(array('username' => $username));
         return $stmt->fetch();  }

         catch(PDOException $e) {
           echo '<p>'.$e->getMessage().'</p>';
      }
    }

    private function verify_Pass($password, $hash){
      return crypt($password, $hash) == $hash;
    }
    public function save($first_name, $last_name, $username, $password, $email) {
      try {
        $db = dbConn::getConnection();
        $stmt = $db->prepare('INSERT INTO members (first_name,last_name,username,password,email) VALUES (:first, :last, :username, :password, :email)');
        $stmt->execute(array(':first' => $first_name,':last' => $last_name,':username' => $username ,':password' => $password,':email' => $email));
        header('Location: index.php?controller=userController&action=joined');
        exit;}

      catch(PDOException $e) {
        $error[] = $e->getMessage();
      }
    }

    public function user_loggedin(){
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        return true;
      }
    }

    public function login($username,$password){
      $line = $this->get_Hash($username);
      if($this->verify_Pass($password,$line['password']) == 1){
        $_SESSION['loggedin'] = true;
	       $_SESSION['username'] = $line['username'];
	           return true;
      }
    }
    public function logout(){
      session_destroy();
    }


    public function update($oldusername, $first_name, $last_name, $username, $email, $avatar_url) {
      try {
        $db = dbConn::getConnection();
        $stmt = $db->prepare('UPDATE members SET first_name=:first, last_name=:last, username=:username, email=:email, avatar_url=:avatar_url WHERE username=:old');
        $stmt->execute(array(':first' => $first_name,':last' => $last_name,':username' => $username,':email' => $email,':avatar_url' => $avatar_url,':old' => $oldusername));

        $_SESSION['username'] = $username;
        header('Location: index.php?controller=userController&action=profile');
        exit;}

      catch(PDOException $e) {
        echo '<p>'.$e->getMessage().'</p>';
        $error[] = $e->getMessage();
      }
   }
}
?>
