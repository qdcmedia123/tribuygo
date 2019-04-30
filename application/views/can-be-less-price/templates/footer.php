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
			<div class="col-sm-6"> 
				<p class="text-white-50"> Made with <3 <br>  by Vosidiy M.</p>
			</div>
			<div class="col-sm-6 text-right">
				<p class="text-sm-right text-white-50">
	Copyright &copy 2018 <br>
<a href="" class="text-white-50">Kepp Searching</a>
				</p>
			</div>
		</section> <!-- //footer-top -->
	</div><!-- //container -->
</footer>
<!-- ========================= FOOTER END // ========================= -->

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <!-- JS file -->
  <script src="<?= base_url()?>assets/js/jquery.easy-autocomplete.min.js"></script> 
 <script src="<?= base_url()?>assets/js/keys.js"></script> 

  <script>


    // http://localhost/canbelessprice/api/category_list_location
    // http://localhost/canbelessprice/api/product_sugesstion

    $.ajax({
      type: 'POST',
      url: ORIGIN+'/api/category_list_location',
      data: {token: 'abcd'},
      dataType: "json",
      success: function(resultData) 
      { 
          

           var options = {
           url: ORIGIN+"/api/product_sugesstion",
           categories: resultData
         ,
    
        list: {
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