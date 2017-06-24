<!--Contact-->
    <section id ="contact" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="header-section text-center">
            <h2>Berlangganan Sekarang Juga !!!</h2>
            <p>Dapatkan diskon menarik untuk setiap jasa yang kami sediakan khusus untuk member</p>
            <hr class="bottom-line">
          </div>
          <div id="sendmessage">Your message has been sent. Thank you!</div>
          <div id="errormessage">Your Message Not Sent. Error !</div>
          <form id="form-inquiry" method="post" role="form" class="contactForm">
              <div class="col-md-6 col-sm-6 col-xs-12 left">
                <div class="form-group">
                    <input type="text" name="name" class="form-control form" id="name" placeholder="Nama Lengkap" data-rule="required" required="true" />
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" data-rule="required" data-rule="email" data-msg="Please enter a valid email" required="true" />
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="handphone" id="subject" placeholder="No.Handphone" data-rule="required" required="true" />
                    <div class="validation"></div>
                </div>
				<div class="form-group">
                    <input type="text" class="form-control" name="address" id="subject" placeholder="Alamat" data-rule="required" required="true" />
                    <div class="validation"></div>
                </div>
              </div>
              
              <div class="col-md-6 col-sm-6 col-xs-12 right">
                <div class="form-group">
                    <textarea class="form-control" name="message" rows="5" data-rule="required" placeholder="Pesan"></textarea>
                    <div class="validation"></div>
                </div>
              </div>
              
              <div class="col-xs-12">
                <!-- Button -->
                <button type="submit" id="submit" name="submit" class="form contact-form-button light-form-button oswald light">SEND</button>
              </div>
          </form>
          
        </div>
      </div>
    </section>
    <!--/ Contact-->
	<script>
		$(document).ready(function (){
			$("#form-inquiry").submit(function(e) {
				var $btn = $("#submit").button('loading');
				var url = "<?php echo base_url();?>home/save_inquiry"; // the script where you handle the form input.
				$.ajax({
					   type: "POST",
					   dataType:"json",
					   url: url,
					   data: $("#form-inquiry").serialize(), // serializes the form's elements.
					   success: function(data)
					   {
						   $("#sendmessage").show();
						   setTimeout(function(){ $("#sendmessage").hide(1000); }, 3000);
						   $btn.button('reset');
						   $('#form-inquiry')[0].reset();
						   //alert(data); // show response from the php script.
					   },
					   error: function(data){
						   $("#errormessage").show();
						   setTimeout(function(){ $("#errormessage").hide(1000); }, 3000);
						   $btn.button('reset');
					   }
					 });
				e.preventDefault(); // avoid to execute the actual submit of the form.
			});
		});
	</script>