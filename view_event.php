<?php include 'admin/db_connect.php' ?>
<?php
if(isset($_GET['id'])){
$qry = $conn->query("SELECT e.*,v.venue FROM events e inner join venue v on v.id=e.venue_id where e.id= ".$_GET['id']);
foreach($qry->fetch_array() as $k => $val){
	$$k=$val;
}
}
?>
<style type="text/css">
	.imgs{
		margin: .5em;
		max-width: calc(100%);
		max-height: calc(100%);
	}
	.imgs img{
		max-width: calc(100%);
		max-height: calc(100%);
		cursor: pointer;
	}
	#imagesCarousel,#imagesCarousel .carousel-inner,#imagesCarousel .carousel-item{
		height: 40vh !important;background: black;

	}
	#imagesCarousel{
		margin-left:unset !important ;
	}
	#imagesCarousel .carousel-item.active{
		display: flex !important;
	}
	#imagesCarousel .carousel-item-next{
		display: flex !important;
	}
	#imagesCarousel .carousel-item img{
		margin: auto;
		margin-top: unset;
		margin-bottom: unset;
	}
	#imagesCarousel img{
		width: calc(100%)!important;
		height: auto!important;
		/*max-height: calc(100%)!important;*/
		max-width: calc(100%)!important;
		cursor :pointer;
	}
	#banner{
		display: flex;
		justify-content: center;
	}
	#banner img{
		max-width: calc(100%);
		max-height: 50vh;
		cursor :pointer;
	}
	<?php if(!empty($banner)): ?>
	 header.masthead {
	    background: url(admin/assets/uploads/<?php echo $banner ?>);
	    background-repeat: no-repeat;
	    background-size: cover;
	}
	<?php endif; ?>
</style>
<header class="masthead">
	<div class="container-fluid h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-4 align-self-end mb-4 pt-2 page-title">
                    	<h4 class="text-center text-white"><b><?php echo ucwords($event) ?></b></h4>
                        <hr class="divider my-4" />
						<p class="text-center text-white"><small><b><i>Venue: <?php echo ucwords($venue) ?></small></i></b></p>
                     
                    </div>
                    
                </div>
            </div>
</header>
<section></section>
<div class="container">
	<div class="col-lg-12">
		<div class="card mt-4 mb-4">
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						
					</div>
					<div class="col-md-12" id="content">
						
						<div id="imagesCarousel" class="carousel slide col-sm-4 float-left  ml-0 mx-4"  data-ride="carousel">

							  <div class="carousel-inner">
							  
						<?php 
					  		$images = array();
					  		if(isset($id)){
					  			$fpath = 'admin/assets/uploads/event_'.$id;
					  			$images= scandir($fpath);
					  		}
					  		$i = 1;
					  		foreach($images as $k => $v):
					  			if(!in_array($v,array('.','..'))):
					  				$active = $i == 1 ? 'active' : '';
			  					
					  	?>
					  		 <div class="carousel-item <?php echo $active ?>">
						      <img class="img-fluid" src="<?php echo $fpath.'/'.$v ?>" alt="">
						    </div>
					  	<?php
					  			$i++;
					  			else:
			  						unset($images[$v]);
					  			endif;
				  			endforeach;
					  	?>
					  	 <a class="carousel-control-prev" href="#imagesCarousel" role="button" data-slide="prev">
						    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
						    <span class="sr-only">Previous</span>
						  </a>
						  <a class="carousel-control-next" href="#imagesCarousel" role="button" data-slide="next">
						    <span class="carousel-control-next-icon" aria-hidden="true"></span>
						    <span class="sr-only">Next</span>
						  </a>
					  		</div>
					  		<ol class="carousel-indicators">
					  			<?php for($v = 0 ;$v< ($i-1);$v++): ?>
							    <li data-target="#imagesCarousel" data-slide-to="<?php echo $v ?>" class="<?php echo ($v == 0) ?'active' : '' ?>"></li>
					  			<?php endfor; ?>
						  </ol>
						</div>
					<p class="">
						
						<p><b><i class="fa fa-calendar"></i> <?php echo date("F d, Y h:i A",strtotime($schedule)) ?></b></p>
						<?php echo html_entity_decode($description); ?>
					</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<hr class="divider" style="max-width: calc(100%);"/>
						<div class="text-center">
							<button class="btn btn-primary" id="register" type="button">Register</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('#imagesCarousel img,#banner img').click(function(){
		viewer_modal($(this).attr('src'))
	})
	 $('#register').click(function(){
        uni_modal("Submit Registration Request","registration.php?event_id=<?php echo $id ?>")
    })
</script>
