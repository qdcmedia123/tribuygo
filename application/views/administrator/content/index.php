

<section class="section-content bg padding-y">
<div class="container">

<div class="row">
	
	<div class = "col-sm-3">
	</div>
	<main class="col-sm-9">


	<?php if($status === 'success'): ?>

	<div class="alert alert-success" role="alert">
  		<?=  ucfirst ($status).' '. $message; ?>
	</div>

	<?php else :?>
		<div class="alert alert-danger" role="alert">
 <?=  ucfirst ($status).' '. $message; ?>
</div>
	<?php endif ;?>


	


	</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<!-- ========================= SECTION  ========================= -->
<section class="section-name bg-white padding-y">
<div class="container">

<!--
<h4>Another section if needed</h4>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

-->
</div><!-- container // -->
</section>
<!-- ========================= SECTION  END// ========================= -->


