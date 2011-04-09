<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @file-name: utilities_helper.php
 * @file-description: Utility functions for ComoUnLulo
 * @author: Juan Pablo Buritica - comounlulo
 * ComoUnLulo - Community Based Services
 * Copyright (C) 2010  Juan Pablo Buritica - ComoUnLulo.com
 * Licensed Under GNU GPLv3 - <http://www.gnu.org/licenses/>
 */

//checks the user session to make sure the user is logged in.
if(! function_exists('is_logged_in')){
	function is_logged_in(){
		$CI =& get_instance();
		$is_logged = $CI->session->userdata('is_logged_in');
		if ( $is_logged == TRUE){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

//checks the user session to make sure the user is an administrator
if(! function_exists('is_admin')){
	function is_admin(){
		$CI =& get_instance();
		$is_admin = $CI->session->userdata('is_admin');
		if ( $is_admin == TRUE){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

//checks if link is active, and adds active class accordingly
if(!function_exists('active_link')){
	function active_link($uri, $text){
		$CI =& get_instance();
		if($CI->input->server('REQUEST_URI') == "/".$uri){
			echo '<a id="vr-'.strtolower($text).'" href="'.base_url().$uri.'" class="active">'.$text.'</a>';
		}else{
			echo '<a id="vr-'.strtolower($text).'" href="'.base_url().$uri.'">'.$text.'</a>';
		}
	}
}

//check if request was done with ajax
if(!function_exists('is_ajax')){
	function is_ajax(){
		$CI =& get_instance();
		//if request done with ajax return true
		if($CI->input->server('HTTP_X_REQUESTED_WITH') && $CI->input->server('HTTP_X_REQUESTED_WITH') == "XMLHttpRequest"){
			return TRUE;
		}else{//not ajax, return false
			return FALSE;
		}
	}
}

//db object to array from name
if(!function_exists('db_to_array_n')){
	function db_to_array_n($items){
		
		foreach ($items as $item){
			$array[$item->id] = $item->name;
		}
		return $array;
	}
}

//modal responses
if(!function_exists('modal_response')){
	function modal_response($title,$messages, $aHref=NULL,$aVal=NULL){
		echo '<h2>'.$title.'</h2>';
		foreach ($messages as $message){
			echo '<p>'.$message.'</p>';
		}
		if(isset($aHref)){
			echo '<a href="'.$aHref.'" class="button orange continue">';
			if(isset($aVal)){
				echo $aVal;
			}else{
				echo 'Continuar';
			}
			echo '</a>';
		}
	}
}

//load panels
if(!function_exists('load_panel')){
	function load_panel($panel, $data = NULL){
		$CI =& get_instance();
		if(is_ajax()){
			$CI->load->view($panel, $data);
		}else{
			$data->main_content = $panel;
			$CI->load->view('templates/color',$data);
		}
	}
}

//notify user
if(!function_exists('user_notify')){
	function user_notify($view, $subject, $to, $data){
		$CI =& get_instance();
		
		$CI->load->library('email');
		
		$config['protocol'] = 'sendmail';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
		
		$CI->email->initialize($config);
		$CI->email->from('notificaciones@comounlulo.com', 'ComoUnLulo');
		$CI->email->to($to); 
		
		$CI->email->subject($subject);
		$message = $CI->load->view($view, $data, TRUE);
		$CI->email->message($message);	
		
		$CI->email->send();
		
	}
}

//notify user
if(!function_exists('user_notify_postmark')){
	function user_notify_postmark($view, $subject, $to, $data){
		$CI =& get_instance();
		
		$CI->load->library('postmark');
		
		$message = $CI->load->view($view, $data, TRUE);
		$message_plain = $CI->load->view($view.'_plain', $data, TRUE);
		
		$CI->postmark->to($to);
		$CI->postmark->subject($subject);
		$CI->postmark->message_plain($message_plain);
		$CI->postmark->message_html($message);
		$CI->postmark->send();
	}
}

//encrypt
if(!function_exists('string_encrypt')){
	function string_encrypt($str){
		if (!empty($str)){
		$CI =& get_instance();
		$str = sha1($str.$CI->config->item('encryption_key'));
		return $str;
		}
	}
}