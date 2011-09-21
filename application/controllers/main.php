<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {	


	public function index()
	{	
		$data->title = 'La primera conferencia de programaci&oacute;n en Bogot&aacute;.';
		$data->time_class = $this->day_or_night(); //css classes day or night;
		$data->main_class = 'home'; //css classes for the body
		$data->body_class = 'weather';
		$data->main_content = 'home';
		$this->load->view('template/main_animated', $data);
	}
	
	public function speakers(){
		$data->title = 'La primera conferencia de programaci&oacute;n en Bogot&aacute;.';
	}
	
	public function store_email(){
		
		if($this->input->post('email')){			

			$u = new User();
			$u->email = $this->input->post('email');
			$u->save();
		
			if($u->id){
				$message = ':) Gracias, ya tenemos tu mail, apenas tengamos mas información te contamos, siguenos en @bogotaconf';
				
				//send notification
				$data->email = $this->input->post('email');
				user_notify_postmark('email/maillist', 'Hemos guardado tu email.', $this->input->post('email'), $data);
				
			}else{
				$message = ':( No pudimos guardar tu email, porfavor intenta de nuevo';
			}
			
			if(is_ajax()){

				echo json_encode(array('message'=>$message));
			}else{
				$this->session->set_flashdata('message',$message);
				redirect('main');
			}
		}else{
			redirect('main');
		}
	}
	
	//friends page
	public function friends(){
		
		$data->title = 'Amigos de Bogotaconf';
		$data->time_class = $this->day_or_night(); //css classes day or night;
		$data->main_content = 'friends';
		$this->load->view('template/main', $data);
	}
	
	protected function email($email){
		
		$data->email = $email;
		user_notify_postmark('email/maillist', 'Hemos guardado tu email.', $email, $data);
	}
	
	protected function day_or_night()
	{
		$current_time = date("G");
		// $current_time = 5;
		
		if ( $current_time == 18 || $current_time == 6)
		{
			$time = 'dusk';
		}
		else if ( $current_time < 7 || 18 < $current_time )
		{
			$time = 'night';
		}
		else
		{
			$time = 'day';
		}
		
		return $time;
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */