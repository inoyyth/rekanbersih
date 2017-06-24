<link type="text/css" rel="stylesheet" href="http://onlinehtmltools.com/tab-generator/skins/skin10/top.css"></script>
    <div class="tabs_holder">
     <ul>
      <?php $no=0; $jum=count($data); foreach($data as $dt){ $no++; if($no==$jum){$act=' class="tab_selected"';}else{$act="";} ?>
         <li <?=$act;?>><a href="#your-tab-id-<?=$no;?>"><?=$dt->year;?></a></li>
      <?php } ?>
     </ul>
     <div class="content_holder">
      <?php $no=0; foreach($data as $dt){ $no++;?>
      <div id="your-tab-id-<?=$no;?>">
       <?=$dt->content;?>
      </div>
      <?php } ?>
     </div><!-- /.content_holder -->
    </div><!-- /.tabs_holder -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://onlinehtmltools.com/tab-generator/skinable_tabs.min.js"></script>
<script type="text/javascript">
  $('.tabs_holder').skinableTabs({
    effect: 'simple_fade',
    skin: 'skin10',
    position: 'top'
  });
</script>