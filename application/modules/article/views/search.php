<div class="row"><!--Container row-->

        <!-- Blog Full Post
        ================================================== --> 
        <div class="span8 blog">

            <!-- Blog Post 1 -->
            <h5 class="title-bg">Search Results: "<font color='red'><?=$text;?></font>" There are <?=$total_data;?> article</h5>
            <ul class="popular-posts">
                <?php foreach($datax as $detailx){ ?>
                <li style="background-color: #D7D7D7;">
                    <a href="<?=base_url();?>article/index/<?=$detailx->id;?>"><img src="<?=base_url();?>adminuicon/assets/elfinder/<?=$detailx->article_image;?>" alt="<?=$detailx->article_name;?>" style="width: 70px;height: 70px;"></a>
                    <h6><a href="<?=base_url();?>article/index/<?=$detailx->id;?>"><?=$detailx->article_name;?></a></h6>
                    <em>Posted on <?=tgl_indo($detailx->sys_create_date);?></em>
                </li>
                <?php } ?>
            </ul>
            <!-- Pagination -->
            <div class="pagination">
                <?=$halaman;?>
            </div>

        </div><!--Close container row-->

        <!-- Blog Sidebar
        ================================================== --> 
        <div class="span4 sidebar">

            <!--Search-->
            <section>
                <div class="input-append">
                    <form action="<?=base_url();?>article/search/" method="post">
                        <input id="appendedInputButton" name="search_sr" size="16" type="text" placeholder="Search Article"><button class="btn" type="submit"><i class="icon-search"></i></button>
                    </form>
                </div>
            </section>

            <!--Categories-->
            <h5 class="title-bg">Categories</h5>
            <ul class="post-category-list">
                <?php foreach($list_category as $list_categoryx){ ?>
                <li><a href="<?=base_url();?>category_article/index/<?=$list_categoryx->id;?>"><i class="icon-plus-sign"></i><?=$list_categoryx->article_category_name;?></a></li>
                <?php } ?>
            </ul>

            <!--Popular Posts-->
            <h5 class="title-bg">Popular Posts</h5>
            <ul class="popular-posts">
                <?php foreach($list_article as $list_articlex){ ?>
                <li>
                    <a href="<?=base_url();?>article/index/<?=$list_articlex->id;?>"><img src="<?=base_url();?>adminuicon/assets/elfinder/<?=$list_articlex->article_image;?>" alt="<?=$list_articlex->article_name;?>" style="width: 70px;height: 70px;"></a>
                    <h6><a href="<?=base_url();?>article/index/<?=$list_articlex->id;?>"><?=$list_articlex->article_name;?></a></h6>
                    <em>Posted on <?=tgl_indo($list_articlex->sys_create_date);?></em>
                </li>
                <?php } ?>
            </ul>

            <!--Video Widget
            <h5 class="title-bg">Video Widget</h5>
            <iframe src="http://player.vimeo.com/video/24496773" width="370" height="208"></iframe>-->
        </div>

    </div>