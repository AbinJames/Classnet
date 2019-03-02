<?php
session_start();
require_once 'dbconnect.php';

  // it will never let you open index(login) page if session is set
if ( !isset($_SESSION['user']) ) {
  header("Location: classNET.html");
  exit;
}
else{
  $id=$_SESSION['user'];
}
?>
<!DOCTYPE html><html class=''>
<head>

<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
<style class="cp-pen-styles">.btn-block + .btn-block {
  margin-top: 0px;
}

.img-user {
  height: 50px;
  weight: 50px;
}

.form-edit [disabled] {
  cursor: default;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
}
</style></head><body>
  <div class="panel panel-default">
  <?php
  $query = "SELECT * FROM users WHERE id = $id";//select reciever details
  $result = $conn->query($query);
  $them = mysqli_fetch_assoc( $result);
  echo '
    <div class="panel-body">
        <iframe id="myiFrame" src="image.php"  width="100%" height="325px" frameborder="0">
</iframe>
    <h4 >';echo $them['firstname'];echo " ";echo $them['lastname'];echo '</h4>
      <h5 >';echo $them['email'];echo '</h5>
      <h5 >';if ($them['S_T']=='s') echo "Student"; else echo "Teacher";echo '</h5>
      <form class="form-edit form-edit--edit" action="change.php" method="post">
        
      </form>
      </div>
      </div>
      ';
    ?>
</div>
<div class="col-sm-6">
  <?php
  $query = "SELECT * FROM users WHERE id = $id";//select reciever details
  $result = $conn->query($query);
  $them = mysqli_fetch_assoc( $result);
  echo '
    <div class="panel-body">
    <h2>Change Profile</h2>
      <form class="form-edit form-edit--edit" action="change.php" method="post">
            <div class="form-group">
              <label class="control-label" for="bs-form-intput-29642">First Name</label>
              <input class="form-control form-preview" name="firstname" 
              type="text" value="';echo $them['firstname'];echo '" readonly="readonly"/>
              </div>
            <div class="form-group">
                <label class="control-label" for="bs-form-intput-29642">Last Name</label>
              <input class="form-control form-preview" name="lastname"  type="text" value="';echo $them['lastname'];echo '" readonly="readonly"/>
              </div>
            <div class="form-group">
              <label class="control-label" for="bs-form-intput-29642">Date of Birth</label>
              <input class="form-control form-preview" name="dob"  type="date" value="';echo $them['dob'];echo '" readonly="readonly"/>
              </div>
            <div class="form-group">
              <label class="control-label" for="bs-form-intput-555864">Phone Number</label>
                <input class="form-control form-preview" name="phno"  pattern="[7-9]{1}[0-9]{9}" maxlength="10"  type="text" value="';echo $them['phone'];echo '" readonly="readonly"/>
              </div>
              <div class="buttons--edit collapse in"><a class="btn btn-default btn-wide button--edit">Edit</a></div>
        <div class="buttons--cancel collapse">
          <div class="iqr-buttons--form">
            <button class="btn btn-primary btn-wide" type="submit" name = "profile">Save Changes</button>
            <button class="btn btn-default btn-wide button--cancel" type="reset">Cancel</button>
          </div>
        </div>
        
        </div>
            </div>
        
      </form>
      ';
    ?>

  </div>



<div class="col-sm-6">
  <?php
  $query = "SELECT * FROM users WHERE id = $id";//select reciever details
  $result = $conn->query($query);
  $them = mysqli_fetch_assoc( $result);
  echo '
    <div class="panel-body">
    <h2>Change Password</h2>
      <form name = "myForm" class="form-edit form-edit--edit" onsubmit="return validateForm();" action="change.php" method="post">
            <div class="form-group">
              <label class="control-label" for="bs-form-intput-29642">Current Password</label>
              <input class="form-control form-preview" name="opass" 
              type="password" readonly="readonly"/>
              </div>
            <div class="form-group">
                <label class="control-label" for="bs-form-intput-29642">New Password</label>
              <input class="form-control form-preview" name="npass" 
              type="password" readonly="readonly"/>
              </div>
            <div class="form-group">
              <label class="control-label" for="bs-form-intput-29642">Confirm Password</label>
              <input class="form-control form-preview" name="cpass" 
              type="password" readonly="readonly"/>
              </div>
            
              <div class="buttons--edit collapse in"><a class="btn btn-default btn-wide button--edit">Edit</a></div>
        <div class="buttons--cancel collapse">
          <div class="iqr-buttons--form">
            <button class="btn btn-primary btn-wide" type="submit" name = "pass">Save Changes</button>
            <button class="btn btn-default btn-wide button--cancel" type="reset">Cancel</button>
          </div>
        </div>
        </div>
            </div>
        
      </form>
      ';
    ?>
  </div>


<script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script><script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script>/**
 * Edit form *
 * Adds functionalities to edit the form and cancel the edit process withot data save
 **/
 $("#changeimg").click(function(){
    var iframe = $("#myiFrame");
    iframe.attr("src", "profileimg.html"); 
});
function validateForm() {
  var x = document.forms["myForm"]["opass"].value;
    var y = document.forms["myForm"]["npass"].value;
    var z = document.forms["myForm"]["cpass"].value;
    
    if(y!=z){
        alert("New Passwords do not match");
        return false;
    }
    
}
(function(module) {
  'use strict';

  module(window.jQuery);

}(function($) {
  'use strict';

  var
    $document = $(document),
    selectEdit = '.button--edit',
    selectCancel = '.button--cancel',
    selectorInput = '.form-control',
    buttonsCancel = '.buttons--cancel',
    buttonsEdit = '.buttons--edit',
    //nou  
    hideArrow = '.hideArrow';

  $document.ready(function() {
    $(selectEdit).on('click', function() {
      var 
        $form = $(this).parents('form');
        
      $form
        .find(buttonsCancel).addClass('in');
      $form
        .find(buttonsEdit).removeClass('in');  
      $form
        .find(selectorInput)
          .attr('readonly', false)
          .attr('disabled', false)
          .filter(':first').focus();
      // $form
      //   .find(hideArrow)
      //     .removeClass('noArrow');
                 
    });
    
    $(selectCancel).on('click', function() {
      var 
        $form = $(this).parents('form');

      $form
        .find(buttonsEdit).addClass('in');
      $form
        .find(buttonsCancel).removeClass('in');
      $form
        .find(selectorInput)
          .attr('readonly', true)
          .attr('disabled', true)
          .addClass('context-menu');  
      // $form
      //   .find(hideArrow)
      //     .addClass('noArrow');
    });
  });
}));

//# sourceURL=pen.js
</script>
</body></html>