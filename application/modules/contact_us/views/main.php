<section id ="feature" class="section-padding">
	<div class="container">
    <div class="row">
		<div class="header-section">
			<h1 class=" text-left">Contact Us</h1>
			<hr>
		</div>
        <div class="col-sm-6">
            <div class="well">
				<h3 style="line-height:20%;"><i class="fa fa-home fa-1x" style="line-height:6%;color:#339966"></i> Perusahaan:</h3>               
                <p style="margin-top:6%;line-height:35%"><?php echo $data['company'];?></p>
                <br />
                <h3 style="line-height:20%;"><i class="fa fa-home fa-1x" style="line-height:6%;color:#339966"></i> Alamat:</h3>               
                <p style="margin-top:6%;line-height:35%"><?php echo $data['address'];?></p>
                <br />
                <h3 style="line-height:20%;"><i class="fa fa-envelope fa-1x" style="line-height:6%;color:#339966"></i> Telepon:</h3>
                <p style="margin-top:6%;line-height:35%"><?php echo $data['telephone'];?></p>
                <br />
                <h3 style="line-height:20%;"><i class="fa fa-user fa-1x" style="line-height:6%;color:#339966"></i> Fax:</h3>
                <p style="margin-top:6%;line-height:35%"><?php echo $data['fax'];?></p>
                <br />
				<h3 style="line-height:20%;"><i class="fa fa-user fa-1x" style="line-height:6%;color:#339966"></i> Email:</h3>
                <p style="margin-top:6%;line-height:35%"><?php echo $data['email'];?></p>
                <br />
				<h3 style="line-height:20%;"><i class="fa fa-user fa-1x" style="line-height:6%;color:#339966"></i> Office Hour:</h3>
                <p style="margin-top:6%;line-height:35%"><?php echo $data['office_hour'];?></p>
            </div>
        </div>
        <div class="col-sm-6">
            <iframe src="<?php echo $data['map'];?>" width="565" height="430" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
</div>
</section>