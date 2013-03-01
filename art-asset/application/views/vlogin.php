<!DOCTYPE HTML>
<html>
<head>
<title>PT. Artistika Login</title>
<meta charset="UTF-8" />
<meta name="Designer" content="PremiumPixels.com">
<meta name="Author" content="$hekh@r d-Ziner, CSSJUNTION.com">
<meta name="Modified by" content="Antares Bugi">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/structure.css">
</head>

<body>
<header id="main">
Best View using Firefox 12.x
<?php if ($this->session->flashdata('message') != ''){
	$pesan = $this->session->flashdata('message');
	echo $pesan;
 }
 ?>
</header>

<form class="box login" action="<?php  echo base_url();?>login/checkin" method="post">
	<fieldset class="boxBody">
	  <!--<label>Username</label>-->
      
	  <input type="text"  id="user" name="user" tabindex="1" placeholder="User ID" required>
	  <!--<label><a href="#" class="rLink" tabindex="5">Forget your password?</a>Password</label>-->
	  <input type="password" id="pass" name="pass" tabindex="2" placeholder="Password" required>
	</fieldset>
	<footer>
	  <!--<label><input type="checkbox" tabindex="3">Keep me logged in</label>-->
	  <input type="submit" class="btnLogin" value="Login" tabindex="4">
	</footer>
</form>
<footer id="main">
Modified by Antares Bugi<br>
  <a href="http://wwww.cssjunction.com">Simple Login Form (HTML5/CSS3 Coded) by CSS Junction</a> | <a href="http://www.premiumpixels.com">PSD by Premium Pixels</a>
</footer>

<script type="text/javascript">
				// <![CDATA[
				function focusInput()
				{
					var username = document.getElementById('user');
					var password = document.getElementById('pass');
					if (username.value == '') {
						username.focus();
					} else {
						password.focus();
					}
				}
				
				window.setTimeout('focusInput()', 500);
				// ]]>
</script>
            
</body>
</html>
