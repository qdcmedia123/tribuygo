<?php 

function GetAEDToUSD( $aedPrice):string {

	// Check if pattern math
	if(!preg_match('/[0-9.]/', $aedPrice)) {

		return false;
	}
	// Set money to local 
	setlocale(LC_MONETARY,"en_US.UTF-8");

	// USD Conversation 
	$usdConversion = 3.67250;

	// Remove anthing except number 
	$aedPrice = preg_replace('/[^0-9.]/', '', $aedPrice);

	// USD PRice 
	$usdPrice = $aedPrice / $usdConversion;

	 // Then make it number formate 
	 $usdPrice  = money_format("%.2n", $usdPrice);

	 // Return USD Price
	 return $usdPrice.' USD';

}




$logos = array(
   
        'www.amazon.ae' => 'https://tribuygo.com/assets/images/amazon_ae.jpg',
        'www.ebay.com' => 'https://ir.ebaystatic.com/rs/v/fxxj3ttftm5ltcqnto1o4baovyl.png',
        'www.virginmegastore.ae' => 'https://www.virginmobile.ae/site/template/img/virgin-logo.png',
      	'www.carrefouruae.com' => 'https://hybrisprod.azureedge.net/sys-master-prod/static_images/carrefour.svg',
		'www.erosdigitalhome.ae' => 'https://cdn.erosdigitalhome.ae/pub/media/logo/default/english.png',
		'www.axiomtelecom.com' => 'https://bab-assets2.babapi.ooo/img/lookandfeel/8687242/af55ef6287b71_axiomlogo.png.999xx.png',
  		'www.jumbo.ae' => 'https://bab-assets3.babapi.ooo/img/lookandfeel/0441617/da39a3ee5e6b4b0d3255b_jumbo.png.999xx.png',
		'www.noon.com' => 'https://k.nooncdn.com/s/app/2019/com-www-bigalog/f668c69a972129bbd6f74d6331994b19084e8636/static/images/noon_logo_black_english.svg',
		'uae.microless.com' => 'https://uae.microless.com/cdn/microless-svg-logo-next.svg',
		'www.amazon.com'=> 'https://images-na.ssl-images-amazon.com/images/G/01/rainier/available_at_amazon_1200x600_Nvz5h2M.png',
		'www.newegg.com' => 'https://c1.neweggimages.com/WebResource/Themes/2005/Nest/logo_424x210.png',
		'www.alibaba.com' => 'http://globalbizcircle.com/wp-content/uploads/2015/05/Alibaba-logo-300x300.jpg',
		'www.etsy.com' => 'https://cdn.worldvectorlogo.com/logos/etsy.svg'

);

?>
<section class="section-content bg padding-y">
<div class="container">

<div class="row">
	
	<div class = "col-md-2">
	</div>
	<main class="col-md-10">


	</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<section class="section-content bg padding-y">
<div class="container">

<div class="row">
	
	<div class="col-sm-2">
	</div>
	<main class="col-sm-10">

<?php if(isset($output)) :?>

<!-- Check if result is set -->
<?php
	$value = $output['result'];
	$countValue = count($value);

?>

<!--
[perpage] => 20
    [numberOfPages] => 32
    [numberOfResult] => 634
    [page] => 32
    [status] => 400
    [search] => mouse
    [whichpage] => 32

-->
<!-- Check if it is not null -->
<?php if($output['status'] === 400 && $countValue > 0):?>




<div class="alert alert-info">
  <strong>Number of result:</strong> <?= $output['numberOfResult']; ?> Items &nbsp; &nbsp;
  <strong>Page:</strong> <?= $output['whichpage']; ?> &nbsp; &nbsp;
  <strong>Result for:</strong> <?= $output['search']; ?> &nbsp; &nbsp;
  <strong>Number of pages :</strong> <?= $output['numberOfPages']; ?> 
</div> 


<!-- Count the result in the array -->
<?php for($i = 0; $i < $countValue; $i++) :?>

<!-- Foreach data inside the index -->




<?php 
if ($value[$i]['website'] === 'www.alibaba.com' || $value[$i]['website'] === 'www.newegg.com') {

	$value[$i]['image'] = 'http:'.$value[$i]['image'];

} else {

	if(!filter_var($value[$i]['description'], FILTER_VALIDATE_URL)) {


		$value[$i]['description'] = 'http://'.$value[$i]['website'].'/'.$value[$i]['description'];


	}


	if(!filter_var($value[$i]['image'], FILTER_VALIDATE_URL)) {

		$value[$i]['image'] = 'http://'.$value[$i]['website'].'/'.$value[$i]['image'];


	}	

}


if(
	$value[$i]['image'] === 'https://ir.ebaystatic.com/cr/v/c1/s_1x2.gif' || 
	$value[$i]['image'] === 'http://www.ebay.com/' ||
	$value[$i]['image'] === 'http://img.alicdn.com/tfs/TB1S_7kkY5YBuNjSspoXXbeNFXa-700-700.jpg_350x350.jpg'){


	continue;
}

	


	


	
?>



<article class="card card-product">
	<div class="card-body">
	<div class="row">
		<aside class="col-sm-3">
			<div class="img-wrap">
				

				<img src="<?= $value[$i]['image']?>">

			</div>
		</aside> <!-- col.// -->
		<article class="col-sm-6">
				<h5 class="title"> <?= $value[$i]['title']?></h5>
				<div class="rating-wrap  mb-2">
					<ul class="rating-stars">
						<li style="width:80%" class="stars-active"> 
							<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
							<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
							<i class="fa fa-star"></i> 
						</li>
						<li>
							<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
							<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
							<i class="fa fa-star"></i> 
						</li>
					</ul>

					<?php
					$review = '';

						if(isset($value[$i]['review'])){

							if($value[$i]['review'] !== '') {

								$review = $value[$i]['review'] . 'reviews';
							}
						}
					?>
					<div class="label-rating"><?= $review ?></div>
					
				</div> <!-- rating-wrap.// -->

				<!--
				<p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, Lorem ipsum dolor sit amet, consectetuer adipiscing elit, Ut wisi enim ad minim veniam </p>

			-->
				 <!-- <dl class="dlist-align">
				  <dt>Color</dt>
				  <dd>Black and white</dd>
				 </dl> item-property-hor .// 
				<dl class="dlist-align">
				  <dt>Material</dt>
				  <dd>Syntetic, wooden</dd>
				</dl>  <!-- item-property-hor .//
				<dl class="dlist-align">
				  <dt>Delivery</dt>
				  <dd>Russia, USA, and Europe</dd>
				</dl>  <!-- item-property-hor .// -->
				
				<dl class="dlist-align">
			<dt> 

		<img style="width:140px; 
			text-shadow: 0 1px black;
		    background: #333; /* For browsers that don't support RGBA */
		    background: rgba(0,0,0,0.18);
		    padding: 4px 8px;" src="<?= $logos[$value[$i]['website']];?>" alt="">

</dt>
			</dl> 
				
				
			
		</article> <!-- col.// -->
		<?php 

					if($key === 'www.amazon.com' || $key === 'www.ebay.com') {

						$price = $value[$i]['price'] ?? '';
						$original_price = $value[$i]['original_price'] ?? '';
						$discount = $value[$i]['discount_price'] ?? '';
						$shipping = $value[$i]['shipping'] ?? '';
					} else {


						
						$price = GetAEDToUSD($value[$i]['price']) ?? '';
						$original_price = GetAEDToUSD($value[$i]['original_price']) ?? '';
						$discount = $value[$i]['discount_price'] !== '' ? GetAEDToUSD($value[$i]['discount_price']) : '';
						$shipping = $value[$i]['shipping'] !== '' ? GetAEDToUSD($value[$i]['shipping']) : '';
					}
					

		?>


		<aside class="col-sm-3 border-left">
			<div class="action-wrap">
				<div class="price-wrap h4">
					<span class="price"> <?= $price ?> </span>	
					<br/>
					
					<del class="price-old"> <?= $original_price; ?></del>



				</div> <!-- info-price-detail // -->
				<p class="text-success"><?= $shipping ?? ''; ?></p>
				<p class="text-success"><?= $discount ?? '';?></p>

				<br>
				<p>
					<a href="<?= $value[$i]['description']; ?>" target="_blank" class="btn btn-primary"> Buy now </a>
					<a href="<?= $value[$i]['description']; ?>" target="_blank" class="btn btn-secondary"> Details  </a>
				</p>
				
			</div> <!-- action-wrap.// -->
			
		</aside> <!-- col.// -->
	</div> <!-- row.// -->
	</div> <!-- card-body .// -->
</article> <!-- card product .// -->




<?php endfor; ?>

<div class="wrapper">
  <div class="container">
    
    <div class="row">
      <div class="col-sm-12">
        <ul id="pagination-demo" class="pagination-sm pull-right"></ul>
      </div>
    </div>

    <div id="page-content" class="page-content">Page 1</div>
  </div>
</div>

<?php else: ?>

<!-- Check that if variable array is empty -->

<?php if($output['status'] === 404):?>



 

<div class="alert alert-info" role="alert">
Sorry, We are unable to find anything for <?= $output['search'] ;?>
</div>

<?php endif; ?>


<?php endif; ?>

<?php endif ;?>





</div> <!-- container .//  -->
</section>



