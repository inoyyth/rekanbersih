<!--Courses-->
<section id ="courses" class="section-padding">
  <div class="container">
	<div class="row">
	  <div class="header-section text-center">
		<h2><?php echo $sub_category['article_subcategory_name'];?></h2>
		<?php echo $sub_category['article_subcategory_description'];?>
		<hr class="bottom-line">
	  </div>
	</div>
  </div>
  <div class="container">
	<div class="row">
		<?php 
			foreach($datax as $k=>$v) { 
			$head_article = explode("</p>",$v['article_description']);
			log_message('debug',print_r($head_article[1],true));
		?>
		<div class="col-md-4 col-sm-6 padleft-right">
			<figure class="imghvr-fold-up">
				<img src="<?php echo base_url();?>adminuicon/assets/elFinder-2.1.24/<?php echo $v['article_image'];?>" class="img-responsive">
				<figcaption>
					<h3><?php echo $v['article_name'];?></h3>
					<p><?php echo $head_article[0];?></p>
					<div style="position:fixed;
   left:0px;
   bottom:10px;
   height:30px;
   width:100%;
   background:#999;">
					<button class="btn btn-success btn-block">Selengkapnya</button>
					</div>
				</figcaption>
				<a href="<?php echo base_url();?>article/index/<?php echo $v['id'];?>/<?php echo url($v['article_name']);?>"></a>
			</figure>
		</div>
		<?php } ?>
	</div>
  </div>
</section>
    <!--/ Courses-->