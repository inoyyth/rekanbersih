<!doctype html>
        
	<link rel="stylesheet" href="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/themes/base/jquery.ui.all.css">
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/jquery-1.10.2.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.button.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.position.js"></script>
        <script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.mouse.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.draggable.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.position.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.resizable.js"></script>
        
        <script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.dialog.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.menu.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.autocomplete.js"></script>
        <script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.accordion.js"></script>
        <script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.datepicker.js"></script>
        <script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.tabs.js"></script>
	<script src="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/ui/jquery.ui.tooltip.js"></script>
	<link rel="stylesheet" href="<?=base_url();?>assets/themes/panel/jquery-ui/development-bundle/demos/demos.css">
        
        
        
	<style>
	.custom-combobox {
		position: relative;
		display: inline-block;
                font-size: 10px;
	}
	.custom-combobox-toggle {
		position: absolute;
		top: 0;
		bottom: 0;
		margin-left: -1px;
		padding: 0;
		/* support: IE7 */
		*height: 1.7em;
		*top: 0.1em;
	}
	.custom-combobox-input {
		margin: 0;
		padding: 0.3em;
	}
	</style>
	<script>
            (function( $ ) {
	$.widget( "custom.combobox", {
			_create: function() {
				this.wrapper = $( "<span>" )
					.addClass( "custom-combobox" )
					.insertAfter( this.element );

				this.element.hide();
				this._createAutocomplete();
				this._createShowAllButton();
			},

			_createAutocomplete: function() {
				var selected = this.element.children( ":selected" ),
					value = selected.val() ? selected.text() : "";

				this.input = $( "<input>" )
					.appendTo( this.wrapper )
					.val( value )
					.attr( "title", "" )
					.addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: $.proxy( this, "_source" )
					})
					.tooltip({
						tooltipClass: "ui-state-highlight"
					});

				this._on( this.input, {
					autocompleteselect: function( event, ui ) {
						ui.item.option.selected = true;
						this._trigger( "select", event, {
							item: ui.item.option
						});
					},

					autocompletechange: "_removeIfInvalid"
				});
			},

			_createShowAllButton: function() {
				var input = this.input,
					wasOpen = false;

				$( "<a>" )
					.attr( "tabIndex", -1 )
					.attr( "title", "Show All Items" )
					.tooltip()
					.appendTo( this.wrapper )
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass( "ui-corner-all" )
					.addClass( "custom-combobox-toggle ui-corner-right" )
					.mousedown(function() {
						wasOpen = input.autocomplete( "widget" ).is( ":visible" );
					})
					.click(function() {
						input.focus();

						// Close if already visible
						if ( wasOpen ) {
							return;
						}

						// Pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
					});
			},

			_source: function( request, response ) {
				var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
				response( this.element.children( "option" ).map(function() {
					var text = $( this ).text();
					if ( this.value && ( !request.term || matcher.test(text) ) )
						return {
							label: text,
							value: text,
							option: this
						};
				}) );
			},

			_removeIfInvalid: function( event, ui ) {

				// Selected an item, nothing to do
				if ( ui.item ) {
					return;
				}

				// Search for a match (case-insensitive)
				var value = this.input.val(),
					valueLowerCase = value.toLowerCase(),
					valid = false;
				this.element.children( "option" ).each(function() {
					if ( $( this ).text().toLowerCase() === valueLowerCase ) {
						this.selected = valid = true;
						return false;
					}
				});

				// Found a match, nothing to do
				if ( valid ) {
					return;
				}

				// Remove invalid value
				this.input
					.val( "" )
					.attr( "title", value + " didn't match any item" )
					.tooltip( "open" );
				this.element.val( "" );
				this._delay(function() {
					this.input.tooltip( "close" ).attr( "title", "" );
				}, 2500 );
				this.input.data( "ui-autocomplete" ).term = "";
			},

			_destroy: function() {
				this.wrapper.remove();
				this.element.show();
			}
		});
	})( jQuery );
        $(function() {
		$( ".combobox" ).combobox();
		$( "#toggle" ).click(function() {
			$( "#combobox" ).toggle();
		});
	});
	$(function() {
                $( ".accordion" ).accordion();
                $( ".datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
                        dateFormat: "yy-mm-dd"
		});
                $( ".tabs" ).tabs();
                //$( "#combobox2" ).combobox();
                $('#dialog').dialog();
                
                $( ".dialog_image" ).dialog({
			autoOpen: false,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

		$( ".opener_image" ).click(function() {
			$( ".dialog_image" ).dialog( "open" );
                        var isi = $("#gb1").val();
                        $("#isi").text(isi);
		});
                $( ".close_image" ).click(function() {
			$( ".dialog_image" ).dialog( "close" );
		});
	})
        
        function validate(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
        }
    
        function formatAngka(angka) {
        if (typeof(angka) != 'string') angka = angka.toString();
        var reg = new RegExp('([0-9]+)([0-9]{3})');
        while(reg.test(angka)) angka = angka.replace(reg, '$1.$2');
        return angka;
        }
   
        function rupiah(nilai){
            t= Math.round(nilai);
            n = t.toString().substr(-3);
            b = parseInt(n);
            if(b < 500 ){
                v = t - b;
            }else{
                v = t +( 1000 - b );
            }
            return v;
        }

        // nilai total ditulis langsung, bisa dari hasil perhitungan lain
        var total = 4500,
         bayar = 0,
         kembali = 0;
         $('.rupiah').on('keypress', function(e) {
         var c = e.keyCode || e.charCode;
         switch (c) {
          case 8: case 9: case 27: case 13: return;
          case 65:
           if (e.ctrlKey === true) return;
         }
         if (c < 48 || c > 57) e.preventDefault();
        }).on('keyup', function() {
         var inp = $(this).val().replace(/\./g, '');

         // set nilai ke variabel bayar
         bayar = new Number(inp);
         $(this).val(formatAngka(inp));

         // set kembalian, validasi
        });
        // masukkan angka total dari variabel
        //$('#input-total').val(formatAngka(total));

        // tambah event keypress untuk input bayar
        function xcx(){
        $('.rupiah').on('keypress', function(e) {
         var c = e.keyCode || e.charCode;
         switch (c) {
          case 8: case 9: case 27: case 13: return;
          case 65:
           if (e.ctrlKey === true) return;
         }
         if (c < 48 || c > 57) e.preventDefault();
        }).on('keyup', function() {
         var inp = $(this).val().replace(/\./g, '');

         // set nilai ke variabel bayar
         bayar = new Number(inp);
         $(this).val(formatAngka(inp));

         // set kembalian, validasi
        });
        }
           
	</script>