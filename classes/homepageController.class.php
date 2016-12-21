<?php
//Passes the info from the controller to homepageview
    class homepageController extends controller {
      public function get() {
        $user = new userModel;
        $userhomepage = new homeView;
        $homepageHTML = $userhomepage ->getHTML();
        $this->html .= $homepageHTML;
      }
      public function post() {}
      public function put() {}
      public function delete() {}
    }
?>
