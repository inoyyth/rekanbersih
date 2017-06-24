<!--Banner-->
<section id ="feature" class="section-padding">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
	<?php foreach($slider as $kSlider=>$vSlider) { ?>
	<li data-target="#myCarousel" data-slide-to="<?php echo $kSlider;?>" class="<?php echo ($kSlider==0?'active':'');?>"></li>
	<?php  } ?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
	<?php foreach($slider as $kSlider=>$vSlider) { ?>	
    <div class="item slides <?php echo ($kSlider==0?'active':'');?>">
      <img src="<?php echo base_url();?>adminuicon/assets/elFinder-2.1.24/<?php echo $vSlider['image_slider'];?>" width="100%;">
    </div>
	<?php } ?>
  </div>
  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <!--<span class="glyphicon glyphicon-chevron-left"></span>-->
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <!--<span class="glyphicon glyphicon-chevron-right"></span>-->
    <span class="sr-only">Next</span>
  </a>
</div>
</section>
<!--/ Banner-->
<section id ="feature" class="section-padding" style="margin-top: -90px;">
	<div class="container">
		<div class="row">
			<div class="header-section">
				<h1 class="text-left"><?php echo $index_article['article_name'];?></h1>
				<hr>
				<?php echo $index_article['article_description'];?>
			</div>
        </div>
	</div>
</section>
<!--Feature-->
    <!--<section id ="feature" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="header-section text-center">
            <h2>Kategori Jasa & Harga</h2>
            <p>Berikut adalah kategori jasa terbaik kami yang dapat anda nikmati. Serta list harga yang murah dan menarik untuk anda nikmati</p>
            <hr class="bottom-line">
          </div>
          <div class="feature-info">
		  <?php 
			$icon_product_category = array('fa fa-home','fa fa-building','fa fa-wrench');
			foreach($product_category as $k=>$v) { 
	      ?>
            <div class="fea">
              <div class="col-md-4">
                <div class="heading pull-right">
                  <h4><?php echo $v['article_name'];?></h4>
                  <?php echo $v['article_description'];?>
                </div>
                <div class="fea-img pull-left">
                  <i class="<?php echo $icon_product_category[$k];?>"></i>
                </div>
              </div>
            </div>
		  <?php } ?>
        </div>
        </div>
      </div>
    </section>-->
    <!--/ feature-->
    <!--Organisations-->
    <!--<section id ="organisations" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">         
              <div class="orga-stru">
                <h3>65%</h3>
                <p>Say NO!!</p>
                <i class="fa fa-male"></i>
              </div>  
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">         
              <div class="orga-stru">
                <h3>20%</h3>
                <p>Says Yes!!</p>
                <i class="fa fa-male"></i>
              </div>  
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">         
              <div class="orga-stru">
                <h3>15%</h3>
                <p>Can't Say!!</p>
                <i class="fa fa-male"></i>
              </div>  
            </div>
          </div>
          <div class="col-md-6">
            <div class="detail-info">
              <hgroup>
                <h3 class="det-txt"> Is inclusive quality education affordable?</h3>
                <h4 class="sm-txt">(Revised and Updated for 2016)</h4>
              </hgroup>
              <p class="det-p">Donec et lectus bibendum dolor dictum auctor in ac erat. Vestibulum egestas sollicitudin metus non urna in eros tincidunt convallis id id nisi in interdum.</p>
            </div>
          </div>
        </div>
      </div>
    </section>-->
    <!--/ Organisations-->
    <!--Cta-->
    <!--<section id="cta-2">
      <div class="container">
        <div class="row">
            <div class="col-lg-12">
              <h2 class="text-center">Subscribe Now</h2>
              <p class="cta-2-txt">Sign up for our free weekly software design courses, we’ll send them right to your inbox.</p>
             <div class="cta-2-form text-center">
              <form action="#" method="post" id="workshop-newsletter-form">
                    <input name="" placeholder="Enter Your Email Address" type="email">
                    <input class="cta-2-form-submit-btn" value="Subscribe" type="submit">
                </form>
             </div>   
            </div>
        </div>
      </div>
    </section>-->
    <!--/ Cta-->
    <!--work-shop-->
    <section id="work-shop" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="header-section text-center">
            <h2>Jasa Layanan REKANBERSIH.COM</h2>
            <p>Berikut daftar jasa layanan kami yang kami sediakan sesuai dengan kebutuhan anda</p>
            <hr class="bottom-line">
          </div>
		  <?php foreach($hot_product as $vProduct) { ?>
		  <div class="col-md-4 col-sm-4">
            <div class="price-table">
              <!-- Plan  -->
              <div class="pricing-head">
                <h4><?php echo $vProduct['product_name'];?></h4>
				<p>Luas Area: <?php echo $vProduct['length_area'];?> <?php echo (strlen($vProduct['length_unit']) < 1 ?$vProduct['length_unit']:"m<sup>".substr($vProduct['length_unit'],1,1)."</sup>");?></p>
               <span class="amount"><sup>Rp.</sup><?php echo formatrp(substr($vProduct['product_price'],0,-3));?></span>.000
              </div>
          
              <!-- Plean Detail -->
              <div class="price-in mart-15">
                <a href="<?php echo base_url('product');?>" class="btn btn-bg green btn-block">PURCHACE</a> 
              </div>
            </div>
          </div>
		  <?php } ?>
	    </div>
		<div class="row">
			<div class="intro-para text-center quote">
				<a href="<?php echo base_url('product');?>" class="btn"><h2>Cek Jasa Kami Yang Lainnya</h2></a>
          </div>
		</div>
      </div>
    </section>
    <!--/ work-shop-->
    <!--Faculity member-->
    <!--<section id="faculity-member" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="header-section text-center">
            <h2>Meet Our Faculty Member</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem nesciunt vitae,<br> maiores, magni dolorum aliquam.</p>
            <hr class="bottom-line">
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="pm-staff-profile-container" >
              <div class="pm-staff-profile-image-wrapper text-center">
                <div class="pm-staff-profile-image">
                  <img src="img/mentor.jpg" alt="" class="img-thumbnail img-circle" />
                </div>   
              </div>                                
              <div class="pm-staff-profile-details text-center">  
                <p class="pm-staff-profile-name">Bryan Johnson</p>
                <p class="pm-staff-profile-title">Lead Software Engineer</p>
                
                <p class="pm-staff-profile-bio">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec et placerat dui. In posuere metus et elit placerat tristique. Maecenas eu est in sem ullamcorper tincidunt. </p>
              </div>     
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="pm-staff-profile-container" >
              <div class="pm-staff-profile-image-wrapper text-center">
                <div class="pm-staff-profile-image">
                  <img src="img/mentor.jpg" alt="" class="img-thumbnail img-circle" />
                </div>   
              </div>                                
              <div class="pm-staff-profile-details text-center">  
                <p class="pm-staff-profile-name">Bryan Johnson</p>
                <p class="pm-staff-profile-title">Lead Software Engineer</p>
                
                <p class="pm-staff-profile-bio">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec et placerat dui. In posuere metus et elit placerat tristique. Maecenas eu est in sem ullamcorper tincidunt. </p>
              </div>     
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="pm-staff-profile-container" >
              <div class="pm-staff-profile-image-wrapper text-center">
                <div class="pm-staff-profile-image">
                    <img src="img/mentor.jpg" alt="" class="img-thumbnail img-circle" />
                </div>   
              </div>                                
              <div class="pm-staff-profile-details text-center">  
                <p class="pm-staff-profile-name">Bryan Johnson</p>
                <p class="pm-staff-profile-title">Lead Software Engineer</p>
                
                <p class="pm-staff-profile-bio">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec et placerat dui. In posuere metus et elit placerat tristique. Maecenas eu est in sem ullamcorper tincidunt. </p>
              </div>     
            </div>
          </div>
        </div>
      </div>
    </section>-->
    <!--/ Faculity member-->
    <!--Testimonial-->
    <section id="testimonial" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="header-section text-center">
            <h2 class="white">Apa kata customer kami?</h2>
            <!--<p class="white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem nesciunt vitae,<br> maiores, magni dolorum aliquam.</p>-->
            <hr class="bottom-line bg-white">
          </div>
		  <?php foreach($customer_comment as $k=>$v) { ?>
          <div class="col-md-4 col-sm-4">
            <div class="text-comment">
              <p class="text-par"><?php echo $v['customer_comment'];?></p>
              <p class="text-name"><?php echo ($v['customer_title']==1?"Mr.":"Mrs.");?> <?php echo $v['customer_name'];?> - <?php echo $v['customer_job'];?></p>
            </div>
          </div>
		  <?php } ?>
        </div>
      </div>
    </section>
    <!--/ Testimonial-->
    <!--Courses-->
    <!--<section id ="courses" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="header-section text-center">
            <h2>Courses</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem nesciunt vitae,<br> maiores, magni dolorum aliquam.</p>
            <hr class="bottom-line">
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-6 padleft-right">
            <figure class="imghvr-fold-up">
              <img src="img/course01.jpg" class="img-responsive">
              <figcaption>
                  <h3>Course Name</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam atque, nostrum veniam consequatur libero fugiat, similique quis.</p>
              </figcaption>
              <a href="#"></a>
            </figure>
          </div>
          <div class="col-md-4 col-sm-6 padleft-right">
            <figure class="imghvr-fold-up">
              <img src="img/course02.jpg" class="img-responsive">
              <figcaption>
                  <h3>Course Name</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam atque, nostrum veniam consequatur libero fugiat, similique quis.</p>
              </figcaption>
              <a href="#"></a>
            </figure>
          </div>
          <div class="col-md-4 col-sm-6 padleft-right">
            <figure class="imghvr-fold-up">
              <img src="img/course03.jpg" class="img-responsive">
              <figcaption>
                  <h3>Course Name</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam atque, nostrum veniam consequatur libero fugiat, similique quis.</p>
              </figcaption>
              <a href="#"></a>
            </figure>
          </div>
          <div class="col-md-4 col-sm-6 padleft-right">
            <figure class="imghvr-fold-up">
              <img src="img/course04.jpg" class="img-responsive">
              <figcaption>
                  <h3>Course Name</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam atque, nostrum veniam consequatur libero fugiat, similique quis.</p>
              </figcaption>
              <a href="#"></a>
            </figure>
          </div>
          <div class="col-md-4 col-sm-6 padleft-right">
            <figure class="imghvr-fold-up">
              <img src="img/course05.jpg" class="img-responsive">
              <figcaption>
                  <h3>Course Name</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam atque, nostrum veniam consequatur libero fugiat, similique quis.</p>
              </figcaption>
              <a href="#"></a>
            </figure>
          </div>
          <div class="col-md-4 col-sm-6 padleft-right">
            <figure class="imghvr-fold-up">
              <img src="img/course06.jpg" class="img-responsive">
              <figcaption>
                  <h3>Course Name</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam atque, nostrum veniam consequatur libero fugiat, similique quis.</p>
              </figcaption>
              <a href="#"></a>
            </figure>
          </div>
        </div>
      </div>
    </section>-->
    <!--/ Courses-->
    <?php echo $this->load->view('home/inquiry');?>