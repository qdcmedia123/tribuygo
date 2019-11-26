<!-- ========================= FOOTER ========================= -->
<footer class="section-footer bg-secondary">
	<div class="container">
		<section class="footer-top padding-top">

<!--
			<div class="row">
				<aside class="col-sm-3 col-md-3 white">
					<h5 class="title">Customer Services</h5>
					<ul class="list-unstyled">
						<li> <a href="#">Help center</a></li>
						<li> <a href="#">Money refund</a></li>
						<li> <a href="#">Terms and Policy</a></li>
						<li> <a href="#">Open dispute</a></li>
					</ul>
				</aside>
				<aside class="col-sm-3  col-md-3 white">
					<h5 class="title">My Account</h5>
					<ul class="list-unstyled">
						<li> <a href="#"> User Login </a></li>
						<li> <a href="#"> User register </a></li>
						<li> <a href="#"> Account Setting </a></li>
						<li> <a href="#"> My Orders </a></li>
						<li> <a href="#"> My Wishlist </a></li>
					</ul>
				</aside>
				<aside class="col-sm-3  col-md-3 white">
					<h5 class="title">About</h5>
					<ul class="list-unstyled">
						<li> <a href="#"> Our history </a></li>
						<li> <a href="#"> How to buy </a></li>
						<li> <a href="#"> Delivery and payment </a></li>
						<li> <a href="#"> Advertice </a></li>
						<li> <a href="#"> Partnership </a></li>
					</ul>
				</aside>
				<aside class="col-sm-3">
					<article class="white">
						<h5 class="title">Contacts</h5>
						<p>
							<strong>Phone: </strong> +123456789 <br> 
						    <strong>Fax:</strong> +123456789
						</p>

						 <div class="btn-group white">
						    <a class="btn btn-facebook" title="Facebook" target="_blank" href="#"><i class="fab fa-facebook-f  fa-fw"></i></a>
						    <a class="btn btn-instagram" title="Instagram" target="_blank" href="#"><i class="fab fa-instagram  fa-fw"></i></a>
						    <a class="btn btn-youtube" title="Youtube" target="_blank" href="#"><i class="fab fa-youtube  fa-fw"></i></a>
						    <a class="btn btn-twitter" title="Twitter" target="_blank" href="#"><i class="fab fa-twitter  fa-fw"></i></a>
						</div>
					</article>
				</aside>
			</div> 

-->
			<br> 
		</section>



		<section class="footer-bottom row border-top-white">
			

			<div class = "col-md-12" >
				
				<div class = "footer-inner">
					
<span class="text-muted"> Powered by  <a href = "https://www.qdcmedia.com/" style = "color:red;" target="_blank" >Quality Digital Community </a><br/>
	
  	 <a href = "https://www.qdcmedia.com/">Copyright© <?= date('Y'); ?> All Right Reserved By QDC </a></span>

  	 <br/>
     <a href = "<?= base_url()?>privacy-and-policy" style = "color:#000000; text-decoration: none;" target="_blank">Privacy and Policy</a>
				
 <div class="jsx-3729605677 appLinksModule">



    <div class="jsx-3729605677 badgesContainer">

    <a target="_blank" href="https://itunes.apple.com/ae/app/tribuygo/id1465088678?mt=8" rel="noopener noreferrer" aria-label="Visit the AppStore (opens in a new window)" class="jsx-3729605677 ios">ios App</a>


      <a target="_blank" href="https://play.google.com/store/apps/details?id=com.qdc.tribuygo" rel="noopener noreferrer" aria-label="Visit the PlayStore (opens in a new window)" class="jsx-3729605677 android">Android App</a>

    </div>

  </div>
				</div>


			</div>


		</section> <!-- //footer-top -->
	</div><!-- //container -->


</footer>
<!-- ========================= FOOTER END // ========================= -->

<script>
  
  if (window.performance && window.performance.navigation.type == window.performance.navigation.TYPE_BACK_FORWARD) {
    //window.location.reload();

    alert('back');
}
</script>


  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

   <!-- JS file -->
  <script src="<?= base_url()?>assets/js/jquery.easy-autocomplete.min.js"></script> 
 <script src="<?= base_url()?>assets/js/keys.js"></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

  <script>

  	$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
  	

    // http://localhost/canbelessprice/api/category_list_location
    // http://localhost/canbelessprice/api/product_sugesstion
    var csrf_id = $('#csrf_ajax').val();
    


    $.ajax({
      type: 'POST',
      url: ORIGIN+'/api/category_list_location',
      data: {csrf_test_name: csrf_id},
      dataType: "json",
      success: function(resultData) 
      { 

          //console.log(resultData)
      	//var resdata = JSON.parse(resultData);
        //const csrfhash = resultData.csrf.hash;	      	//var resdata = JSON.parse(resultData);
       const csrfhash = '';	
       	 $('#csrf_ajax').val(csrfhash);

        var options = {
  data: resultData.getautolocation,

  list: {
    onClickEvent: function() { 
            
            
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
<script src="<?= base_url()?>assets/js/jquery.twbsPagination.min.js"></script> 


<script>

	<?php if(isset($output['numberOfResult'])) :?>

		<?php if($output['numberOfResult'] > 20) :?>

			$('#pagination-demo').twbsPagination({
        totalPages: <?= $output['numberOfPages']; ?>,
        visiblePages: <?= $output['numberOfPages'] > 2 ? 3 : $output['numberOfPages'] ;?>,
        next: 'Next',
        prev: 'Prev',
        startPage:<?= $output['whichpage'] ;?>,
        onPageClick: function (event, page) {
            //fetch content and render here
            // Setting up the url 
            
           
        }
    }).on("page", function (event, page) {

    		// Setting up
    		 var url = '<?= base_url()?>search?search=<?= urlencode($_GET['search'])?>&page='+page;

            console.log(url);
            //window.location.href = url;
			window.location.href = url;
            $('#page-content').text('Page ' + page) + ' content here';
    });

   
    

		<?php endif; ?>


	
	<?php endif; ?>
	

</script>


</body>
</html>