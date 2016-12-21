<?php
class tableView{
     public function getHTML($errors='') {

try {
         $db = dbConn::getConnection();
         $stmt = $db->query('SELECT username,first_name,last_name, email FROM members ORDER BY first_name');
 		  	 $array = $stmt->fetchAll(\PDO::FETCH_ASSOC);
         $columns = array('0' => 'Username','1' => 'First Name','2' => 'Last Name','3' => 'Email');
         array_unshift($array, $columns);
 		   } catch(PDOException $e) {
 		     echo '<p>'.$e->getMessage().'</p>';
 		   }
       $tableArray = new tableArray();
       $getTable = $tableArray->getHTML($array);
       $tableHTML = '

     <center> <form class="login-card">
     <p> Back to my <a href = index.php?controller=userController&action=profile> Profile</a></p>
     <h2><center>User table</center></h2>
           '.$errorhtml.'
           '.$getTable.'
           </form></center>';
       return $tableHTML;
    }
}

?>
