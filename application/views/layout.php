<!DOCTYPE html> 
<html> 
    <head> 
        <link href="/css/style.css" rel="stylesheet" type="text/css" /> 
        <title>Mi titulo</title> 
    </head> 
 
    <body> 
 
        <?php echo $this->load->view('_header') ?> 
        <div id="content"> 
                 <?php echo $this->load->view($content) ?> 
        </div> 
 
        <?php echo $this->load->view('_footer') ?>       
 
    </body> 
</html>