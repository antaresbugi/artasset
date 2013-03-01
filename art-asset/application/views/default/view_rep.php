<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title><?php echo $title ?></title>
	
	<link rel="stylesheet" href="<?php echo base_url();?>css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    
<?php $this->load->view($script) ?>
</head>
<body onLoad="window.print() ">
    <!-- main body -->
    <section id="mainan" class="column">
	<?php $this->load->view($body) ?>
    </section>
    <!-- end of main body -->
</body>
</html>