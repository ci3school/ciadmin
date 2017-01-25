<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
    class Template 
    {
        var $ci;
         
        function __construct() 
        {
            $this->ci =& get_instance();
        }
		function load($tpl_view, $body_view = null, $directory = null, $data = null) 
		{
				$data['body'] = $this->ci->load->view($directory.'/'.$body_view, $data, TRUE);
				$this->ci->load->view($directory.'/layouts/'.$tpl_view, $data);
		}
    }