<?php
  class loginRegisterView {
     public function getHTML($errors='', $form) {


      $form = '

        <div class="login-card">
          <form id="login" action="index.php?controller=userController" method="post">
            <center><h2>IS218 -Sign In</h2></center>
	    <div>
	      <label for="username">User Name:</label><br>
              <input type="text" id="username" name="username" placeholder=""/>
            </div>
	    <br>
	    <div>
	      <label for="password">Password:</label><br>
	      <input type="password" id="password" name="password" placeholder=""/>
            </div>
	    <br>

      <div>
	      <center><button type="submit" id="submit" class="button">Sign In</button></center>
      </div>
	  </form>
	</div>

  <p> Do not have an account yet? Please click here</p><button onclick="toggle_div_fun("sectiontohide");">Register</button>

        <div class = login-card id = "sectiontohide">

          <form id="register" action="index.php?controller=userController" method="post">
            <h2><center>IS 218-Register</center></h2>
	    <div>
	      <label for="firstname">First Name:</label><br>
              <input type="text" id="firstname" name="first_name"/>
            </div>
	    <br>
	    <div>
	      <label for="lastname">Last Name:</label><br>
	      <input type="text" id="lastname" name="last_name"/>
	    </div>
	    <br>
	    <div>
	      <label for="username">User Name:</label><br>
              <input type="text" id="username" name="user_name"/>
            </div>
	    <br>
	    <div>
	      <label for="email">Email:</label><br>
	      <input type="email" id="email" name="email"/>
            </div>
	    <br>
	    <div>
	      <label for="password">Password:</label><br>
	      <input type="password" id="password" name="password"/>
            </div>
	    <br>
	    <div>
	      <label for="confirmpassword">Repeat Password:</label><br>
	      <input type="password" id="confirmpassword" />
      </div>
	    <br>
	    <div>
	      <center><button type="submit" id="submit" class = button>Register</button></center>
            </div>
	           <br>
	     </form>


  </div>'
  ;
       return $form;
    }
}
?>
