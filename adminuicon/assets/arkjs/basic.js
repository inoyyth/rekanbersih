


function get_base64_img(_this) {
    
    if (_this.files && _this.files[0]) {

        var reader = new FileReader();

        reader.onload = function (e) {
            $("#"+$(_this).data('img_id'))
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
        };

        reader.readAsDataURL(_this.files[0]);

    }
}


