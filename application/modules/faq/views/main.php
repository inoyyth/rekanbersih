<section id ="feature" class="section-padding">
	<div class="container">
		<div class="row">
			<h1>FAQ</h1>
			<hr>
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			<?php foreach($faq as $data_faq){?>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="heading<?php echo $data_faq->id;?>">
						<h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $data_faq->id;?>" aria-expanded="true" aria-controls="collapse<?php echo $data_faq->id;?>">
							  <?php echo $data_faq->question;?>
							</a>
						</h4>
					</div>
				  <div id="collapse<?php echo $data_faq->id;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $data_faq->id;?>">
						<div class="panel-body" style="text-align: justify;">
							<?php echo $data_faq->answered;?>
						</div>
				  </div>
				</div>
			<?php } ?>
			</div>
		</div>	
	</div>
</div>