<!-- ========================= FOOTER ========================= -->
<footer class="section-footer bg-secondary" style = "position: relative; bottom: 0px; width:100%; height: auto; margin: auto;">
	<div class="container">
		<section class="footer-top padding-top">

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

 
<script src="<?php echo base_url(); ?>assets/js/jquery-2.0.0.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.easy-autocomplete.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/keys.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/script.js" type="text/javascript"></script>


<script>


//const TRANSFER_PROTOCAL = window.location.protocol;
//const HOST_NAME = window.location.hostname;

// form location 
const  categorySuggesstion = TRANSFER_PROTOCAL+'//'+HOST_NAME+PATH_NAME+'CategoryListLocation';
const ProductSuggesstion = TRANSFER_PROTOCAL+'//'+HOST_NAME+PATH_NAME+'ProductSuggestions';

console.log(window.location);

  

    $.ajax({
      type: 'POST',
      url: categorySuggesstion,
      data: {token: 'abcd'},
      dataType: "json",
      success: function(resultData) 
      { 
          

           var options = {
           url: ProductSuggesstion,
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