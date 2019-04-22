<?php

$array = array(
     array(
        'url' => 'https://uae.souq.com',
        'logo' => 'https://cf1.s3.souqcdn.com/public/style/img/en/souqAmazon-logo-v2.pngg'
    ),
     array(
        'url' => 'https://www.carrefouruae.com',
        'logo' => 'https://hybrisprod.azureedge.net/sys-master-prod/static_images/carrefour.svg'
    ),
	 array(
        'url' => 'https://www.erosdigitalhome.ae',
        'logo' => 'https://cdn.erosdigitalhome.ae/pub/media/logo/default/english.png'
    ),
	 array(
        'url' => 'https://www.axiomtelecom.com',
        'logo' => 'https://bab-assets2.babapi.ooo/img/lookandfeel/8687242/af55ef6287b71_axiomlogo.png.999xx.png'
    ),
	 array(
        'url' => 'https://www.letstango.com',
        'logo' => 'https://www.letstango.com/skin/frontend/default/ltreact/images/lets-tango-logo-light.png'
    ),
	array(
        'url' => 'https://www.jumbo.ae',
        'logo' => 'https://bab-assets3.babapi.ooo/img/lookandfeel/0441617/da39a3ee5e6b4b0d3255b_jumbo.png.999xx.png'
    ),
	array(
        'url' => 'https://www.noon.com',
        'logo' => 'https://k.nooncdn.com/s/app/2019/com-www-bigalog/f668c69a972129bbd6f74d6331994b19084e8636/static/images/noon_logo_black_english.svg'
    ),
	array(
        'url' => 'https://uae.microless.com',
        'logo' => 'https://uae.microless.com/cdn/microless-svg-logo-next.svg'
    ),
	array(
        'url' => 'https://www.amazon.com',
        'logo' => 'https://hybrisprod.azureedge.net/sys-master-prod/h3c/h2c/9018177585182/1224609_main.jpg_200Wx200H'
    ),
	
);
?>

<section class="section-content bg padding-y" style = "min-height: 400px;">
<div class="container">

<div class="row">
	
	<div class = "col-sm-3">
	</div>
	<main class="col-sm-9">

	<?php

	$output = $this->session->flashdata('output') ?? '';

	// Check json encud is true 
	$decode = json_decode($output, true);


		
	?>

	

	</main> <!-- col.// -->
</div>

</div>



	



<?php if($decode !== false) :?>

	<!-- Check if result set -->
	<?php if(isset($decode['result'])) :?>

	<?php if(count($decode['result']) > 0) :?>


<section class="section-content bg padding-y">
<div class="container">

<div class="row">
	
	<div class="col-sm-2">
	</div>
	<main class="col-sm-10">


<?php 
	// Count 
$length = count($decode['result']);

$getData = $decode['result'];
?>

<?php for($i = 0 ; $i < $length; $i++)  :?>


<?php $eachBlock = $getData[$i]; ?>

<?php foreach($eachBlock as $key => $value) :?>

<?php
	$value['description'] = filter_var($value['description'], FILTER_VALIDATE_URL) ? $value['description'] : 'http://'.$key.'/'.$value['description'];
?>
<article class="card card-product">
	<div class="card-body">
	<div class="row">
		<aside class="col-sm-3">
			<div class="img-wrap"><img src="<?= $value['image'] ?? ''?>"></div>
		</aside> <!-- col.// -->
		<article class="col-sm-6">
				<h4 class="title"><?= $value['title'] ?? '';?> </h4>
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

					if(isset($value['review'])){

						if($value['review'] !== '') {

							$review = $value['review'] .' Reviews';
						} else {

							$review = '';
						}
					}

					?>
					<div class="label-rating"><?= $review ?>  </div>
					<div class="label-rating"> <!-- 154 orders --> </div>
				</div> <!-- rating-wrap.// -->
				
				<!--
				<p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, Lorem ipsum dolor sit amet, consectetuer adipiscing elit, Ut wisi enim ad minim veniam </p>
				-->

				<!--

				<dl class="dlist-align">
				  <dt>Color</dt>
				  <dd>Black and white</dd>
				</dl> 
				<dl class="dlist-align">
				  <dt>Material</dt>
				  <dd>Syntetic, wooden</dd>
				</dl>  
				<dl class="dlist-align">
				  <dt>Delivery</dt>
				  <dd>Russia, USA, and Europe</dd>
				</dl>  
			-->
			
		</article> <!-- col.// -->
		<aside class="col-sm-3 border-left">
			<div class="action-wrap">
				<div class="price-wrap h4">
					
						<span class="price"> <?= $value['price'] ?? ''; ?> </span>	
					
					


					<del class="price-old"> <?= $value['original_price'] ?? ''; ?></del>


				</div> <!-- info-price-detail // -->
				<p class="text-success"><?= $value['shipping'] ?? ''?></p>
				<br>
				<p>
					<a href="<?= $value['description']; ?>" class="btn btn-primary"  target="_blank"> Buy now </a>
					<a href="<?= $value['description']; ?>" class="btn btn-secondary"  target="_blank"> Details  </a>
				</p>
				<a href="#"><i class="fa fa-heart"></i> Add to wishlist</a>
			</div> <!-- action-wrap.// -->
		</aside> <!-- col.// -->
	</div> <!-- row.// -->
	</div> <!-- card-body .// -->
</article>
	



<?php endforeach ;?>

<?php endfor; ?>
	

</main> <!-- col.// -->
</div>


	<?php endif; ?>
	<?php endif; ?>

<?php endif; ?>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION  END// ========================= -->


