<!DOCTYPE html>
<!--[if lt IE 7]><html lang="en" class="no-js ie lt-ie9 lt-ie8 lt-ie7"></html><![endif]-->
<!--[if IE 7]><html lang="en" class="no-js ie lt-ie9 lt-ie8"></html><![endif]-->
<!--[if IE 8]><html lang="en" class="no-js ie lt-ie9"></html><![endif]-->
<!--[if IE 9]><html lang="en" class="no-js ie lt-ie10"></html><![endif]-->
<!--[if gt IE 9]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<title><?php echo $title; ?></title>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<link rel="stylesheet" href="<?php echo base_url("public/css/bootstrap.min.css")?>">
	<link rel="stylesheet" href="<?php echo base_url("public/css/style.css")?>">    
</head> 
<body> 
	<div class="container">
    	<?php echo $this->load->view($content) ?>
    	<?php echo $this->load->view('template/_footer') ?> 
    </div> <!-- /container -->   
</body>
</html>