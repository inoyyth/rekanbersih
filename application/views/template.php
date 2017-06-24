<!DOCTYPE html>
<?php $this->load->view("fn_lib/lib_function"); ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jasa Bersih Rumah, Apartemen dan Kantor | rekanbersih.com</title>
    <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
    <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
    
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Candal|Alegreya+Sans">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/Mentor/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/Mentor/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/Mentor/css/imagehover.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/Mentor/css/style.css">
	<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/Mentor/css/carousel-new.css">-->
	<script src="<?php echo base_url(); ?>themes/Mentor/js/jquery.min.js"></script>
    <!-- =======================================================
        Theme Name: Mentor
        Theme URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
        Author: BootstrapMade.com
        Author URL: https://bootstrapmade.com
    ======================================================= -->
  </head>
  <body>
  
    <!--Navigation bar-->
    <nav class="navbar navbar-default navbar-fixed-top">
		<div class="row" style="background-color: #ffcc00;padding-left:10px;padding-right:10px;">
			<?php $top_contact = $this->db->query('select * from contact limit 1')->row_array(); ?>
			<!--<div class="container">-->
				<div class="col-lg-6 col-md-6 col-sm-6" style="font-weight: bolder;color: #000;font-size: 13px;">
					Hubungi Kami: <a href="tel:<?php echo $top_contact['telephone'];?>" style="color:#000;"><?php echo $top_contact['telephone'];?></a> | WhatsApp: <a href="tel:<?php echo $top_contact['mobile'];?>" style="color:#000;"><?php echo $top_contact['mobile'];?></a>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 text-right">
					<a href="#link"><i class="fa fa-twitter fa-fw"></i></a> | 
					<a href="#link"><i class="fa fa-facebook fa-fw"></i></a> | 
					<a href="#link"><i class="fa fa-google-plus fa-fw"></i></a> | 
					<a href="#link"><i class="fa fa-dribbble fa-fw"></i></a> | 
					<a href="#link"><i class="fa fa-linkedin fa-fw"></i></a> 
				</div>
			<!--</div>-->
		</div>
		<div style="padding: 10px;">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				</button>
				<!--<a class="navbar-brand" href="index.html">Men<span>tor</span></a>-->
				<img src="<?php echo base_url();?>themes/Mentor/img/rekanbersih-logo.png" width="130px">
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
					<?php
					$sql1 = $this->db->query("select * from menu where menu_parent_id='0' and menu_status='Y' order by menu_position asc")->result_array();
					foreach ($sql1 as $data1) {
						$sql_sub1 = $this->db->query("select * from menu where menu_parent_id='" . $data1['id'] . "'");
						if ($sql_sub1->num_rows() > 0) {
							if ($data1['menu_type'] == "4") {
								$menu1 = $data1['menu_link'];
							} else {
								$menu1 = base_url() . $data1['menu_link'];
							}
							?>
							<li>
								<a href="<?= $menu1; ?>" target="<?php echo menu_open($data1['menu_open']); ?>" style="font-size: 16px;color:#000;"><?= $data1['menu_name']; ?></a>
							</li>
							<?php
						} else {
							if ($data1['menu_type'] == "4") {
								$menu1 = $data1['menu_link'];
							} else {
								$menu1 = base_url() . $data1['menu_link'];
							}
							?>
							<li><a href="<?php echo $menu1; ?>" target="<?= menu_open($data1['menu_open']); ?>" style="font-size: 16px;color:#000;"><?= $data1['menu_name']; ?></a></li>
							<?php
						}
					}
					?>
				</ul>
			</div>
		</div>
    </nav>
    <!--/ Navigation bar-->
    <!--Modal box-->
    <div class="modal fade" id="login" role="dialog">
      <div class="modal-dialog modal-sm">
      
        <!-- Modal content no 1-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title text-center form-title">Login</h4>
          </div>
          <div class="modal-body padtrbl">

            <div class="login-box-body">
              <p class="login-box-msg">Sign in to start your session</p>
              <div class="form-group">
                <form name="" id="loginForm">
                 <div class="form-group has-feedback"> <!----- username -------------->
                      <input class="form-control" placeholder="Username"  id="loginid" type="text" autocomplete="off" /> 
            <span style="display:none;font-weight:bold; position:absolute;color: red;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginid"></span><!---Alredy exists  ! -->
                      <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback"><!----- password -------------->
                      <input class="form-control" placeholder="Password" id="loginpsw" type="password" autocomplete="off" />
            <span style="display:none;font-weight:bold; position:absolute;color: grey;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginpsw"></span><!---Alredy exists  ! -->
                      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
                  <div class="row">
                      <div class="col-xs-12">
                          <div class="checkbox icheck">
                              <label>
                                <input type="checkbox" id="loginrem" > Remember Me
                              </label>
                          </div>
                      </div>
                      <div class="col-xs-12">
                          <button type="button" class="btn btn-green btn-block btn-flat" onclick="userlogin()">Sign In</button>
                      </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!--/ Modal box-->
	<div style="padding-top:80px;">
    <?php echo $this->load->view($view);?>
	</div>
    <!--Footer-->
    <footer id="footer" class="footer">
      <div class="container text-center">

      <ul class="social-links">
        <li><a href="#link"><i class="fa fa-twitter fa-fw"></i></a></li>
        <li><a href="#link"><i class="fa fa-facebook fa-fw"></i></a></li>
        <li><a href="#link"><i class="fa fa-google-plus fa-fw"></i></a></li>
        <li><a href="#link"><i class="fa fa-dribbble fa-fw"></i></a></li>
        <li><a href="#link"><i class="fa fa-linkedin fa-fw"></i></a></li>
      </ul>
        ©2017 Mentor Theme. All rights reserved
        <div class="credits">
            <!-- 
                All the links in the footer should remain intact. 
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Mentor
            -->
            Designed by <a href="https://bootstrapmade.com/">bootstrapmade.com</a>
        </div>
      </div>
    </footer>
    <!--/ Footer-->
    
    <script src="<?php echo base_url(); ?>themes/Mentor/js/jquery.easing.min.js"></script>
    <script src="<?php echo base_url(); ?>themes/Mentor/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>themes/Mentor/js/custom.js"></script>
    <script src="<?php echo base_url(); ?>themes/Mentor/contactform/contactform.js"></script>
    <script src="<?php echo base_url(); ?>themes/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			$('.datepicker').datepicker();
		});
	</script>
  </body>
</html>