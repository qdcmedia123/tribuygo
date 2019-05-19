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
					
<span class="text-muted"> Powered by  <a href = "https://www.qdcmedia.com/" style = "color:red;">Quality Digital Community </a><br/>
	
  	 <a href = "https://www.qdcmedia.com/">Copyright© <?= date('Y'); ?> All Right Reserved By QDC </a></span>
				</div>
			</div>
		</section> <!-- //footer-top -->
	</div><!-- //container -->
</footer>
<!-- ========================= FOOTER END // ========================= -->

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <!-- JS file -->
  <script src="<?= base_url()?>assets/js/jquery.easy-autocomplete.min.js"></script> 
 <script src="<?= base_url()?>assets/js/keys.js"></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

  <script>


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
          //const csrfname = resultData.csrf.name;
      	const csrfhash = resultData.csrf.hash;

      	 $('#csrf_ajax').val(csrfhash);


           var options = {
           url: ORIGIN+"/api/product_sugesstion",
           categories: resultData.getautolocation
         ,
    
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



</body>
</html>