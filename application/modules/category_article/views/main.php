<div class="breadcrumbs">
    <a href="<?php echo base_url();?>">Home</a> / 
    <span style="text-transform: capitalize;"> Category Article </span> / 
    <span style="text-transform: capitalize;"><?php echo $title;?></span>
</div>
<div class="row-fluid">
    <!--Edit Sidebar Content here-->
    <div class="span3 sidebar">  
        <div class="sidebox">
            <h4 class="sidebox-title">Reference Article</h4>
            <ul>
                <?php foreach($list_article as $data_list_article){?>
                <li><a href="<?php echo base_url();?>article/index/<?php echo $data_list_article->id;?>/<?php echo url($data_list_article->article_name);?>"><?php echo $data_list_article->article_name;?></a></li>
                <?php } ?>
            </ul>
            <h4 class="sidebox-title">Categories Article</h4>
            <ul>
                <?php foreach($list_category as $data_list_category){?>
                  <li><a href="<?php echo base_url();?>category_article/index/<?php echo $data_list_category->id;?>/<?php echo url($data_list_category->article_category_name);?>"><?php echo $data_list_category->article_category_name;?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <!--/End Sidebar Content -->    
    <!--Edit Main Content Area here-->
    <div class="span9" id="divMain" style="text-align: justify;">
        <div class="span12" id="divMain">
            <h1><?php echo url_return($title);?></h1>
            <hr>
            <?php foreach($datax as $data_category){?>
            <a href="<?php echo base_url();?>article/index/<?php echo $data_category->id;?>/<?php echo url($data_category->article_name);?>"><h3 style="text-transform: capitalize;"><?php echo $data_category->article_name;?></h3></a>
            <div class="row-fluid">		
                <div class="span2">                           
                    <img src="<?php echo base_url();?>adminuicon/assets/elfinder/<?php echo $data_category->article_image;?>" class="img-polaroid" style="margin:5px 0px 15px;width: 104px;height: 110px;" alt="<?php echo $data_category->article_name;?>">   
                </div>          
                <div class="span10" style="text-align: justify;">            
                    <?php echo remove_image(wordlimitx($data_category->article_description,30));?>
                </div>		 
            </div>
            <?php } ?>
	</div>                      
    </div>
    <div class="row">
        <div class="col-md-12">
            <nav>
              <?=$halaman;?>
            </nav>
        </div>
    </div>
</div>