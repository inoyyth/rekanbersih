<div id="slider1_container" style="position: relative; width: 960px;margin-left: -2%;
        height: 300px; overflow: hidden;">

        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url(<?=base_url();?>assets/slider/img/loading.gif) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div>
        
        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 960px; height: 300px;
            overflow: hidden;">
            <?php
            foreach($list_detail as $list){?>
            <div>
                <a u=image href="<?=$list->image_url;?>" target="_<?=$list->slider_target;?>"><img src="<?=base_url();?>assets/elfinder/<?=$list->image_slider;?>" style="border: 1px solid" /></a>
                <div u=caption t="*" class="captionOrange"  style="position:absolute; left:<?=$list->left;?>px; top: <?=$list->top;?>px; width:<?=$list->width;?>px; height:<?=$list->height;?>px;background-color: <?=$list->background_color;?>;"> 
                    <a href="<?=$list->link;?>" target="_<?=$list->caption_target;?>" style="text-decoration: none; color: <?=$list->text_color;?>"><?=$list->caption;?></a>
                </div>
            </div>
            <?php } ?>
        </div>
        <!-- bullet navigator container -->
        <div u="navigator" class="jssorb01" style="position: absolute; bottom: 16px; right: 10px;">
            <!-- bullet navigator item prototype -->
            <div u="prototype" style="POSITION: absolute; WIDTH: 12px; HEIGHT: 12px;"></div>
        </div>
        <!-- Bullet Navigator Skin End -->
        
        
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssora05l" style="width: 40px; height: 40px; top: 123px; left: 8px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssora05r" style="width: 40px; height: 40px; top: 123px; right: 8px">
        </span>
        <!-- Arrow Navigator Skin End -->
        <a style="display: none" href="http://www.jssor.com">javascript image slider</a>
    </div>
<?php $this->load->view('slider');?>
<?php $this->load->view('combobox_autocomplete');?>