<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="max-age=604800" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="Bootstrap-ecommerce by Vosidiy">

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="<?= base_url()?>assets/css/login.css" rel="stylesheet" type = "text/css" />
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>




<body>
  <?php

    // Errors will come from the api 

/*
  $errors = [
                'username' => 'Please enter valid username',
                'password' => 'Please enter valid password'

            ];
    */



  // Bootstrap class we will have to check 


  ?>

  <?php
$csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
);

?>

<?php 



$error = $this->session->flashdata('errors')['error'] ?? '';
$data = $this->session->flashdata('errors')['data'] ?? '';


;?>


<div class="wrapper fadeInDown">

  <h1><font color="black">Tri</font><font color="red">buy</font><font color="orange">go</font></h1>
  <p style="font-size:12px;color:#000;" align="center;">Find your Ideal Purchase and Compare Prices from Different Websites</p>
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
     
    </div>



    <!-- Login Form -->
    <form method = "post" action = "administrator/login_request">

      <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" id = "csrf_ajax"/>
    
    
      <input name = "username" value = "<?= $data['username'] ?? ''; ?>" type="text" class="form-control <?= $error['username'] ? 'is-invalid' : '';?> fadeIn second" id="validationServer01" placeholder="Please enter username"  required>
     
      <div class="invalid-feedback">
         <?= $error['username'] ?? '' ?>
      </div>



       <input name = "password" type="text" class="form-control <?= $error['password'] ? 'is-invalid' : '';?> fadeIn second" id="validationServer01" placeholder="Please enter password"  required>
    <div class="invalid-feedback">
       <?= $error['password'] ?? '' ?>
      </div>
    
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <!-- Remind Passowrd 
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>
    -->

  </div>
</div>
</body>