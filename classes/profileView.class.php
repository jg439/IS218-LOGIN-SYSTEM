<?php
  class profileView{
     public function getHTML($edit=false, $errors='') {
       if($edit == true) {
         $username = $_SESSION['username'];
         $user = new userModel;
         $row = $user->get_Data($username);

         $profile = '
           <div id="profileform" class="login-card">
             <form id="edit" action="index.php?controller=userController&action=edit" method="post" enctype="multipart/form-data">
	            <center><h2>IS 218 - Profile Display</h2></center>

             <div id="profile">
               <div id="photo">
	              <center><img width="200px" height="200px" src="'.$row['avatar_url'].'"/></center>
               </div>
	       <div>
                 <label for="image">
		               <center><input type="file" name="avatar" accept="images/*"></center>
        </div>
	       <br>
	       <div>
	         <label for="firstname">First Name:</label>
		 <input type="text" id="firstname" name="first_name" value="'.$row['first_name'].'"/>
	       </div>
	       <br>
	       <div>
	         <label for="lastname">Last Name:</label>
	         <input type="text" id="lastname" name="last_name" value="'.$row['last_name'].'"/>
               </div>
	       <br>
	       <div>
	         <label for="username">User Name:  </label>
		 <input type="text" id="username" name="username" value="'.$username.'"/>
               </div>
	       <br>
	       <div>
	         <label for="email">  User Email: </label>
		 <input type="email" id="email" name="email" value="'.$row['email'].'"/>
	       </div>
	       <br>
	       <div>
                 <input type="hidden" name="form" value="edit" />
               </div>
	       <br>
	       <div>
	         <input type="hidden" name="oldusername" value="'.$username.'" />
               </div>
	       <br>
	       <div>
	         <center><button type="submit" id="submit" class = button>Update</button></center>
          </div>
	     </div>
	     </form>
	   </div>
         ';
       }
       else {
         $username = $_SESSION['username'];
         $user = new userModel;
         $row = $user->get_Data($username);
      $profile = '
         <div id="profileform" class="login-card">
	   <form id="edit">
	   <center><h2>My Profile</h2></center>
    <center> <h4> Access<a href =index.php?controller=userController&action=usertable>User Table</a></h4>
      <center> <h4> Access<a href =index.php?controller=userController&action=video>Video Tutorial</a></h4>
             <div id="profile" class="profile">
	             <div id="image">
                 <center><img width="300px" height="250px" src="'.$row['avatar_url'].'"/></center>
	       </div>
	       <br><br>
	       <center><div>
	       <div>
                 <label>First Name: '.$row['first_name'].'</label><br><br>
               </div>
	       <div>
	         <label>Last Name: '.$row['last_name'].'</label><br><br>
               </div>
	       <div>
	         <label>Username: '.$username.'</label><br><br>
               </div>
	       <div>
	         <label>Email: '.$row['email'].'</label><br><br>
               </div>
	       </div></center>
	       <div>
	         <center><button id="submit" class = button><a href="index.php?controller=userController&action=edit">Edit</a></center>
               <br><br>
	       <div>
        <p> If you want to logout, please click here </p><a href = index.php?controller=userController&action=logout>Logout</p>
	     </div>
  	      ';
       }
    return $profile;
     }
  }
?>
