<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>
        <meta charset="UTF-8" />

        <title>Hotspot</title>

        <meta name="description" content="" />
        <meta name="keywords" value="" />

        <!--jQuery Hotspot-->
        <script type="text/javascript" src="<?= base_url(); ?>assets/hotspot/js/lib/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/hotspot/js/hotspot.builder.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/hotspot/js/hotspot.js"></script>

        <link rel="stylesheet" href="<?= base_url(); ?>assets/hotspot/css/layout.css" type="text/css" />
        <link rel="stylesheet" href="<?= base_url(); ?>assets/hotspot/css/hotspot.builder.css" type="text/css" />
        <link rel="stylesheet" href="<?= base_url(); ?>assets/hotspot/css/hotspot.css" type="text/css" />

        <script type="text/javascript" src="<?= base_url(); ?>assets/hotspot/js/lib/modernizr-2.min.js"></script>
        <!--End of jQuery Hotspot-->


    </head>
    <body style="overflow: scroll;height: auto;">
        <div class="container col-lg-16" id="shell">
            <form name="save_image_setting" action="" method="POST" >
                
            <input type="hidden" name="article_id" value="<?php echo $article->article_id; ?>"/>
            <input type="hidden" name="image_number" value="<?php echo $image_number; ?>"/>
            
            <!--Buka form-->
            <div class="container col-lg-16" id="hb-shell">
                <div id="hb-top-wrap" class="hb-main-wrap">
                    <div id="hb-global-settings-wrap">
                        <h1>Global Settings</h1>
                        <table>
                            <tr>
                                <td width="100">Show tooltips on: </td>
                                <td>
                                    <select id="show-select" autocomplete="off">
                                        <option value="mouseover" selected>Mouseover</option>
                                        <option value="click">Click</option>
                                        <option value="always">Always Visible</option>
                                    </select>
                                    <div class="form-help">This option determines how the user will trigger the tooltips - when he clicks on the spot, when he hovers the mouse over it, or the tooltips will be visible all the time. This is not active in the content builder.</div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="hb-main-wrap" class="hb-main-wrap">
                    <div id="hb-settings-wrap">
                        <h2>Selected Spot Settings</h2>
                        <table>
                            <tr>
                                <td width="100">Spot visibility: </td>
                                <td>
                                    <select id="visible-select">
                                        <option value="visible">Visible</option>
                                        <option value="invisible" selected>Invisible</option>
                                    </select>
                                    <div class="form-help">Determines the visibility of the spot. If set to "invisible", the user will not know that there is a spot, unless he triggers it. <br />The spot will not look the same in the final product as it looks in the content builder.</div>
                                </td>
                            </tr>
                            <tr>
                                <td width="100">Tooltip width: </td>
                                <td>
                                    <input type="text" id="tooltip-width">
                                    <!-- <br /> -->
                                    <input type="checkbox" id="tooltip-auto-width" checked value="Auto"><label for="tooltip-auto-width">Auto</label>
                                    <div class="form-help">If you need a fixed value for the tooltip set a number in pixels (without "px") in the text field. If you don't, then check "Auto".</div>
                                </td>
                            </tr>
                            <tr>
                                <td>Popup position: </td>
                                <td>
                                    <select id="position-select">
                                        <option value="left" selected>Left</option>
                                        <option value="right">Right</option>
                                        <option value="top">Top</option>
                                        <option value="bottom">Bottom</option>
                                    </select>
                                    <div class="form-help">Choose where you want the popup to appear, relative to the spot that it belongs to.</div>
                                </td>
                            </tr>
                            <tr>
                                <td>Content: </td>
                                <td>
                                    <textarea id="content" autocomplete="off"></textarea>
                                </td>
                            </tr>
                            <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
                            <tr>
                                <td>Delete?</td>
                                <td><input type="button" id="delete" value="Delete Spot"></td>
                            </tr>
                        </table>
                    </div>
                    
                    <div id="hb-map-wrap">
                        <?php
                        
                        $available_image = false;
                        
                        /*
                        if(!empty($article->article_html_image_1) && $image_number == 1) {
                            echo $article->article_html_image_1;
                            echo '<script type="text/javascript">'.$article->article_javascript_image_1.'</script>';
                            $available_image = true;
                        }
                        
                        if(!empty($article->article_html_image_2) && $image_number == 2) {
                            echo $article->article_html_image_2;
                            echo '<script type="text/javascript">'.$article->article_javascript_image_2.'</script>';
                            $available_image = true;
                        }
                        
                        $available_image = false;
                        */
                        
                        if(!$available_image) {
                        ?>
                        <img src="<?php echo base_url() . '../userfiles/Image/article/' . $image_name; ?>">
                        <?php
                        }
                        ?>
                    </div>
                    
                    <div class="clear"></div>
                </div>
                <div class="hb-main-wrap" id="submit-wrap">
                    <div id="result" class="ndd-button-green-regular">Change Preview</div>
                </div>		
                <div id="hb-bottom-wrap" class="hb-main-wrap">
                    <h1>Live Preview</h1>
                    <div id="hb-live-preview" style="width:1000px;"></div>
                </div>


                <div style="display:none;">
                    
                    <div id="hb-bottom-wrap" class="hb-main-wrap">	
                        <div class="left">
                            <h1>HTML Code</h1>
                            <textarea id="hb-html-code" name="html_code" autocomplete="off"></textarea>
                        </div>

                        <div class="right">
                            <h1>JavaScript Code</h1>
                            <textarea id="hb-javascript-code" name="javascript_code" autocomplete="off"></textarea>
                        </div>
                        <div class="clear"></div>			
                    </div>
                </div>

            </div>
            
            <div class="hb-main-wrap" id="submit-wrap">
                <input type="submit" name="save_image" class="ndd-button-green-regular" value="Save"/>
            </div>

            <!--Tutup Form-->
        </form>
        </div>


    </body>

</html>