<!DOCTYPE html>
<html>
<head>
  
  <title>Tribuygo</title>


   <style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />

<!-- CSS file -->
<link rel="stylesheet" href="<?= base_url()?>assets/css/easy-autocomplete.min.css"> 

<!-- Additional CSS Themes file - not required-->
<link rel="stylesheet" href="<?= base_url()?>assets/css/easy-autocomplete.themes.min.css"> 

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>

  
  @import url(https://fonts.googleapis.com/css?family=Open+Sans);

body{
  background: #fff;
  font-family: 'Open Sans', sans-serif;
}

.search {
  width: 100%;
  position: relative
}

.searchTerm {
  float: left;
  width: 100%;
  border: 3px solid #00B4CC;
  padding: 5px;
  height: 20px;
  border-radius: 5px;
  outline: none;
  color: #9DBFAF;
}

.searchTerm:focus{
  color: #00B4CC;
}

.searchButton {
  position: absolute;  
  bottom:1px;
  right: -65px;
  width: 40px;
  height: 37px;
  border: 1px solid #00B4CC;
  background: #00B4CC;
  text-align: center;
  color: #fff;

  border-radius: 0px 30px 30px 0px; ;
  cursor: pointer;
  font-size: 20px;

}

/*Resize the wrap to see the search bar change!*/
.wrap{
  width: 35%;
  position: absolute;
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.easy-autocomplete{

  width:100%;
}

.footer{
background-color: #f8f9fa!important;
  width: 100%;
  position: absolute;
  bottom: 0px;
 text-align: center;

}
a{
	text-decoration: none;
	color:none;
}






</style>



<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />

<!-- CSS file -->
<link rel="stylesheet" href="<?= base_url()?>assets/css/easy-autocomplete.min.css"> 

<!-- Additional CSS Themes file - not required-->
<link rel="stylesheet" href="<?= base_url()?>assets/css/easy-autocomplete.themes.min.css"> 

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">

   <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
               <button type="button" class="btn btn-default" id = "enquiry143">Enquiry</button>
            </li>

             &nbsp; &nbsp;
            <li class="nav-item">
            	

               <button type="button" class="btn btn-default" id = "join-us" disabled>Join Us</button>

               

            </li>
            
        </ul>
    </div>
</nav>


<?php
$csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
);

?>

<main>
<div class="wrap">
<h2 align="center">
  <font color="black" size="15">tri</font>
  <font color="red" size="15">buy</font>
  <font color="orange" size="15">go</font>
</h2>



<p style="color:#000;" align="center">Find your Ideal Purchase and Compare Prices from Different Websites</p>




<form method="POST" action = "search" id = "search-form-6767">
  <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" id = "csrf_ajax"/>

  
   <div class="search">
      <input name = "search" type="text" class="form-control" placeholder="Type... eg: Samsung,Iphone...." id = "categories-basic" style = "width:100%;">


      
      <button type="submit" class="searchButton" style = "width:10%;">
        <i class="fa fa-search"></i>
     </button>
  
   
   </div>
</form>





</div>

</main>
<footer class="footer mt-auto py-3">
  <div class="container">

  	<span class="text-muted"> Powered by  <a href = "https://www.qdcmedia.com/" style = "color:red;">Quality Digital Community </a><br/>
	
  	 <a style = "text-decoration: none; color:#6c757d!important;" href = "https://www.qdcmedia.com/">Copyright© <?= date('Y'); ?> All Right Reserved By QDC </a></span>

  </div>
</footer>





  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <!-- JS file -->
  <script src="<?= base_url()?>assets/js/jquery.easy-autocomplete.min.js"></script> 
   <script src="<?= base_url()?>assets/js/keys.js"></script> 




<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<script>
	
	const csrfToken = 'nonthing';

</script>



<script>



    // http://localhost/canbelessprice/api/category_list_location
    // http://localhost/canbelessprice/api/product_sugesstion
    // Get the id 
    var csrfid = $('#csrf_ajax').val();
    
    $.ajax({
      type: 'POST',
      url: ORIGIN+"/api/category_list_location",
      data: {csrf_test_name: csrfid},
      dataType: "json",
      success: function(resultData) 
      { 
          
      	// Set the csrf token again 
      	// 
      	//const csrfname = resultData.csrf.name;
      	const csrfhash = resultData.csrf.hash;

      	 $('#csrf_ajax').val(csrfhash);

           var options = {
           url: ORIGIN+"/api/product_sugesstion",
           categories: resultData.getautolocation
         ,
    
      list: {
        
        onClickEvent: function() { 
            
            var value = $("#categories-basic").getSelectedItemData();
            $('#search-form-6767').submit();
            
          },
        match: {
        enabled: true
       }
  }


};

$("#categories-basic").easyAutocomplete(options);
      }

});

   






  
 
</script>

<script src="<?= base_url()?>assets/js/join-usform.js"></script> 

</body>

</html>
