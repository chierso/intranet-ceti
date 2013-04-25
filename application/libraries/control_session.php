<?php
		if(!defined('BASEPATH')) exit('No direct script access allowed');
		
		class Control_session
		{
			private $ci;
		    public function __construct()
		    {		    	
		        $this->ci = get_instance();
		     	$this->ci ->load->library('session');
		    }
			public function verifyLogin(){
				if ($this->ci ->session->userdata('Validado')=='true') 
		        {	       	     	
					redirect('home', 'refresh');
				}
			}
			public function verifyLoginOnHome(){
				if ($this->ci ->session->userdata('Validado')!='true') 
		        {        	     	
					redirect('login', 'refresh');
				}
			}
			
		} 
?>