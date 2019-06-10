<!DOCTYPE html>
<html>
<head>
  
  <title>Tribuygo</title>

<script>
  
  if (window.performance && window.performance.navigation.type == window.performance.navigation.TYPE_BACK_FORWARD) {
    window.location.reload();
} 
</script>
  

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />

<!-- CSS file -->
<link rel="stylesheet" href="<?= base_url()?>assets/css/easy-autocomplete.min.css"> 

<!-- Additional CSS Themes file - not required-->
<link rel="stylesheet" href="<?= base_url()?>assets/css/easy-autocomplete.themes.min.css"> 

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<link rel="stylesheet" href="<?= base_url()?>assets/css/custom123.css"> 




<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />

<!-- CSS file -->
<link rel="stylesheet" href="<?= base_url()?>assets/css/easy-autocomplete.min.css"> 

<!-- Additional CSS Themes file - not required-->
<link rel="stylesheet" href="<?= base_url()?>assets/css/easy-autocomplete.themes.min.css"> 

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

</head>
<body>

 
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style = "display:none;" id = "model7878">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" id = "close123">&times;</button>
         
        </div>
        <div class="modal-body">
          <p>Please wait while sending the request.....</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  



	<nav class="navbar navbar-expand-lg navbar-light bg-light">

   <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
               <button type="button" class="btn btn-default" id = "enquiry143" data-toggle="tooltip" data-html="true"  title = "<div>
<p><b>Specific only for individual</b></p>
<ul style = 'text-decoration: none; list-style: none; padding:0px;'>
<li>Inquiries</li>
<li>Concerns</li>
<li>Sugession</li>
</ul>
</div>">Enquiry</button>
            </li>

             &nbsp; &nbsp;
            <li class="nav-item">
            	

               <button type="button" class="btn btn-default" id = "join-us" data-toggle="tooltip" data-html="true"  title = "<div>
<p><b>Specific only for Adding/ Updating/ Removing (New/Existing)</b></p>
<ul style = 'text-decoration: none; list-style: none; padding:0px;'>
<li>Advertisers</li>
<li>Websites Owners</li>
<li>e-Commerce Traders</li>
</ul>
</div>">Join Us</button>

               

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
<h2 align="center"><font color="black" size="15">tri</font><font color="red" size="15">buy</font><font color="orange" size="15">go</font>
</h2>



<p style="color:#000;" align="center">Find your Ideal Purchase and Compare Prices from Different Websites</p>




<form method="POST" action = "search" id = "search-form-6767" >
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

  	<span class="text-muted"> Powered by  <a href = "https://www.qdcmedia.com/" style = "color:red;" target="_blank">Quality Digital Community </a><br/>
	
  	 <a style = "text-decoration: none; color:#6c757d!important;" href = "https://www.qdcmedia.com/" target="_blank" >Copyright© <?= date('Y'); ?> All Right Reserved By QDC </a></span>
     <br/>
     <a href = "<?= base_url()?>privacy-and-policy" style = "color:#000000; text-decoration: none;" target="_blank">Privacy and Policy</a>

  </div>

  <div class="jsx-3729605677 appLinksModule">



    <div class="jsx-3729605677 badgesContainer">

    <a target="_blank" href="https://itunes.apple.com/ae/app/tribuygo/id1465088678?mt=8" rel="noopener noreferrer" aria-label="Visit the AppStore (opens in a new window)" class="jsx-3729605677 ios">ios App</a>


      <a target="_blank" href="https://play.google.com/store/apps/details?id=com.qdc.tribuygo" rel="noopener noreferrer" aria-label="Visit the PlayStore (opens in a new window)" class="jsx-3729605677 android">Android App</a>

    </div>

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
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


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
