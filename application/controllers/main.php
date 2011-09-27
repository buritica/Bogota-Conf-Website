<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {	
	// protected $firebug = NULL;
	

	public function index()
	{	
		if(!is_ajax()){
			$data->title = 'La primera conferencia de programaci&oacute;n en Bogot&aacute;.';
			$data->time_class = $this->day_or_night(); //css classes day or night;
			$data->main_class = 'home'; //css classes for the body
			$data->body_class = 'weather';
			$data->left_content = 'speakers';
			$data->sidebar = 'sidebar_info';
			$data->pro_remain = $this->get_remaining_tickets(1);
			$data->student_remain = $this->get_remaining_tickets(2);
			$this->load->view('template/columns_animated', $data);
		}else{
			$this->load->view('speakers');
		}
	}
	
	public function conferencistas(){
		if(!is_ajax()){
			$data->title = 'La primera conferencia de programaci&oacute;n en Bogot&aacute;.';
			$data->time_class = $this->day_or_night(); //css classes day or night;
			$data->main_class = 'home'; //css classes for the body
			$data->body_class = 'weather';
			$data->left_content = 'speakers';
			$data->sidebar = 'sidebar_info';
			$data->pro_remain = $this->get_remaining_tickets(1);
			$data->student_remain = $this->get_remaining_tickets(2);
			$this->load->view('template/columns_animated', $data);
		}else{
			$this->load->view('speakers');
		}
	}
	
	public function panelistas(){
		if(!is_ajax()){
			$data->title = 'Panelistas';
			$data->time_class = $this->day_or_night(); //css classes day or night;
			$data->main_class = 'home'; //css classes for the body
			$data->body_class = 'weather';
			$data->left_content = 'panelists';
			$data->sidebar = 'sidebar_info';
			$data->pro_remain = $this->get_remaining_tickets(1);
			$data->student_remain = $this->get_remaining_tickets(2);
			$this->load->view('template/columns_animated', $data);
		}else{
			$this->load->view('panelists');
		}
	}
	
	public function entradas(){
		if(!is_ajax()){
			$data->title = 'Entradas';
			$data->time_class = $this->day_or_night(); //css classes day or night;
			$data->main_class = 'home'; //css classes for the body
			$data->body_class = 'weather';
			$data->left_content = 'tickets';
			$data->sidebar = 'sidebar_info';
			$data->pro_remain = $this->get_remaining_tickets(1);
			$data->student_remain = $this->get_remaining_tickets(2);
			$this->load->view('template/columns_animated', $data);
		}else{
			$this->load->view('tickets');
		}
	}
	
	public function update_tickets($id,$quantity){
		$t = new Ticket();
		$t->get_by_id($id);
		// fb($t->type);
		$t->remain = $quantity;
		if($t->save()){
			fb('Tickets remaining for '.$t->type.' updated to: '.$t->remain, 'Success');
		}else{
			fb('Updating tickets failed', 'Error:');
		}
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
	
	
	public function test(){
		
	}
	
	public function basic(){
		$data->title = 'Basic';
		$data->time_class = $this->day_or_night(); //css classes day or night;
		$data->main_class = 'home'; //css classes for the body
		$data->body_class = 'weather';
		$data->basic_content = 'Hola Mundo';
		$this->load->view('template/basic_animated', $data);
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
	
	protected function email($email){
		
		$data->email = $email;
		user_notify_postmark('email/maillist', 'Hemos guardado tu email.', $email, $data);
	}	
	
 	protected function get_remaining_tickets($id){
		
		$t = new Ticket();
		$t->get_by_id($id);
		// fb($t->type);
		return $t->remain;
		
	}
}


/* End of file main.php */
/* Location: ./application/controllers/main.php */