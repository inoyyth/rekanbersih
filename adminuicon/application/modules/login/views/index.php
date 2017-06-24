<html lang="id">
<head>
	<meta charset="utf-8">

	<title>Urbanicon Website Administration</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/themes/panel/css/style.css">
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<!--<script type="text/javascript">
$(document).ready( function () {
$("#tg").show(5000);
});
</script> -->
<body>
<div id="login-form">
    <div class="logo">
        <img src="<?php echo base_url();?>assets/logo_desalite.png" style="width: 150px;" />
    </div>
        <h3>Welcome Administration</h3>
            <fieldset>
                <form id="login" action="login/verivy_login" method="post">
                <input id="username" name="username" type="username" required="true" placeholder="Username" />
                <input id="password" name="password" type="password" required="true" placeholder="Password" />
                <input type="submit" id="submit" value="Login"/>
                <footer class="clearfix">
                <p><span class="info">?</span><a href="#">Forgot Password</a></p>
                </footer>
                </form>
            </fieldset>
    </div> <!-- end login-form -->
</body></html>