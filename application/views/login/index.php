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

<div class="wrapper fadeInDown">
  <h1><font color="black">Tri</font><font color="red">buy</font><font color="orange">go</font></h1>
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
     
    </div>

    <!-- Login Form -->
    <form method = "post" action = "#">
 
    
    
      <input type="text" class="form-control <?= $errors['username'] ? 'is-invalid' : '';?> fadeIn second" id="validationServer01" placeholder="Please enter username"  required>
     
      <div class="invalid-feedback">
         <?= $errors['username'] ?? '' ?>
      </div>



       <input type="text" class="form-control <?= $errors['password'] ? 'is-invalid' : '';?> fadeIn second" id="validationServer01" placeholder="Please enter password"  required>
    <div class="invalid-feedback">
       <?= $errors['password'] ?? '' ?>
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