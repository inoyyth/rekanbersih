<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">setTimeout("window.close();", 15000);</script>
<script language="javascript">
   function setModel(id,category_name,url){
     window.opener.document.forms[0].kodex.value = "brand_commerce/index/"+id+"/"+url;
     window.opener.document.forms[0].menu_value.value = category_name;
     window.self.close();
     setTimeout("window.close();", 15000);
     bersih();
   }
  </script>
  <style>
      .table tr:hover{
          background-color: #99B3FF;
      }
  </style>
  <?php
    function url($url) {
     $url = preg_replace('~[^\pL0-9_]+~u', '-', $url);
     $url = trim($url, "-");
     $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
     $url = strtolower($url);
     $url = preg_replace('~[^-a-z0-9_]+~', '', $url);
     return $url;
    }
  ?>
<body><div align="center">
<div style="margin-top: 5px; margin-bottom: 5px;">List Brand Commerce</div>
<form method="post" action="<?=base_url();?>menu/brand_commerce_search">
    <div style="margin-top: 5px; margin-bottom: 5px;">
        Search By: 
        Keyword:
        <input type="text" name="name_sr">
        <input type="submit" name="search" value="Search"/>
    </div>
    <table class="table" style="border: solid 1px;" width="95%" border="1" cellspacing="0" cellpadding="0">
        <tr style="background-color: #f22;">
            <th width="74">ID</th>
            <th width="160">Category</th>
        </tr>
  <?php
	 foreach($data as $articlex) { ?>
  <tr>
    <td align="center">&nbsp;<?php echo  $articlex->id; ?></td>
    <td align="center">
        <a href="javascript:setModel(
           '<?php echo $articlex->id; ?>',
           '<?php echo $articlex->brand_name; ?>',
           '<?php echo url($articlex->brand_name); ?>'
        );" style="color:#FF0000">
        <?php echo $articlex->brand_name; ?></a>
    </td>
  </tr>
  <?php } ?>
</table>
<div class="pagination"><?=$halaman;?></div>
</form>