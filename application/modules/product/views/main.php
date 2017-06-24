<!--Courses-->
<section id ="courses" class="section-padding">
  <div class="container">
	<div class="row">
	  <div class="header-section text-center">
		<h2>FORM BOOKING</h2>
		<p>Kirimkan permintaan survei dan pembersihan kerumah Anda SEKARANG! kami akan mengirimkan team dan dapatkan layanan terbaik dari kami.</p>
		<hr class="bottom-line">
	  </div>
	</div>
  </div>
	<div class="container">
		<div class="row"  style="margin-top:20px;">
			<div id="tabx" class="well well-sm  bg-white borderZero"  uib-dropdown >
				<div class="btn-group date-block btn-group-justified font-small dropdown" data-toggle="buttons">
					<label href="#utama" data-toggle="tab" class="btn btn-default  next font-small semiBold" title="Next Day" style="font-size:12px; border-radius:0;">
					   Pembersihan Utama
					</label>
					<label  href="#berkala" data-toggle="tab" class="btn btn-default previous text-right font-small semiBold" title="Previous Day" style="font-size:12px;">
						Pembersihan Berkala
					</label>
					<label href="#lainnya" data-toggle="tab" class="btn date-buttons btn-default text-right semiBold" style="font-size:12px;" >
						Jasa Lainnya
					</label>
				</div>
			</div>
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane fade active in" id="utama">
					
				</div>
				<div class="tab-pane fade" id="berkala">
				
				</div>
				<div class="tab-pane fade" id="lainnya">
				
				</div>
			</div>
		</div>
	</div>
</section>
<!--/ Courses-->
<script type="text/javascript">
	$(document).ready(function (){
		$('#tabx label[href="#utama"]').tab('show');
		$("#utama").load("product/page_utama/");
		
		$('#tabx label[href="#utama"]').on('shown.bs.tab', function (e) {
			$("#utama").load("product/page_utama/");
		});
		$('#tabx label[href="#berkala"]').on('shown.bs.tab', function (e) {
			$("#berkala").load("product/page_berkala/");
		});
		$('#tabx label[href="#lainnya"]').on('shown.bs.tab', function (e) {
			$("#lainnya").load("product/page_lainnya/");
		});
	});
</script>