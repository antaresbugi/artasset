<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8"/>
	<title><?php echo $title ?> I Admin Panel</title>
	
	<link rel="stylesheet" href="<?php echo base_url();?>css/layout.css" type="text/css" media="screen" />    
    <style type="text/css">
			@import "<?php echo base_url();?>css/layout/demo_page.css";										
			@import "<?php echo base_url();?>css/layout/demo_table_jui.css";
            @import "<?php echo base_url();?>css/smoothness/jquery-ui-1.8.4.custom.css" ;
			@import "<?php echo base_url();?>css/layout/jquery.jgrowl.css";
			
			.ui-autocomplete-loading {background: url(../images/icn_user.png) center no-repeat;}
     </style>
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    
<?php $this->load->view($script) ?>
</head>
<body>
	<!-- header bar -->
     <?php $this->load->view($header) ?>
    <!-- end of header bar -->
	
	<!-- secondary bar -->
    <?php $this->load->view($secondbar) ?>
    <!-- end of secondary bar -->
	
    <!-- sidebar -->
	<?php $this->load->view($sidebar) ?>
    <!-- end of sidebar -->
	
    <!-- main body -->
    <section id="main" class="column">
	<?php $this->load->view($body) ?>
    </section>
    <!-- end of main body -->
</body>
</html>