<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {	

	public function index(){	
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
		$data->pro_remain = $this->get_remaining_tickets(1);
		$data->student_remain = $this->get_remaining_tickets(2);
		
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
			$this->load->view('tickets',$data);
		}
	}
	
	public function comprar($type){
		$data->ticket_type = $type;
		if(!is_ajax()){
			$data->title = 'Comprar';
			$data->time_class = $this->day_or_night(); //css classes day or night;
			$data->main_class = 'home'; //css classes for the body
			$data->left_content = 'lightbox_tickets';
			$data->sidebar = 'sidebar_info';
			$data->pro_remain = $this->get_remaining_tickets(1);
			$data->student_remain = $this->get_remaining_tickets(2);
			$this->load->view('template/columns_animated', $data);
		}else{
			$this->load->view('lightbox_tickets',$data);
		}
	}
	
	public function purchase_tickets(){

		$a = new Attendee();
		$a->name = ucwords($this->input->post('name'));
		$a->email = $this->input->post('email');
		$a->ticket_type = $this->input->post('ticket_type');
		$a->translation = $this->input->post('translation');
		$a->tshirt = $this->input->post('tshirt');
		$a->save();
		
		if($a->id){
			$results->success = TRUE;
			$first_name = explode(" ", $a->name);
			$results->message = '	<h3>Cupo Reservado</h3>
			
			<hr />
				<p>Gracias '.$first_name[0].', tu cupo ha sido reservado. S&iacute;gue las instrucciones que hemos enviado a tu email para completar la transacci&oacute;n.</p>
				<hr />
				<a href="#" class="button" data-link="lightbox-close">Cerrar</a>
			';
		}else{
			$results->success = FALSE;
			$results->errors = $a->error->string;
		}
		
		if(!is_ajax()){
			if($results->success == TRUE){
				$results->message = '<p>Gracias '.$first_name[0].', tu cupo ha sido reservado. S&iacute;gue las instrucciones que hemos enviado a tu email para completar la transacci&oacute;n.</p>';
				$this->session->set_flashdata('message',$results->message);
				redirect('/');
			}else{
				$data->title = 'Ooops...';
				$data->time_class = $this->day_or_night(); //css classes day or night;
				$data->main_class = 'home'; //css classes for the body
				$data->left_content = 'lightbox_tickets';
				$data->sidebar = 'sidebar_info';
				$data->pro_remain = $this->get_remaining_tickets(1);
				$data->student_remain = $this->get_remaining_tickets(2);
				$data->errors = $results->errors;
				$data->ticket_type = $a->ticket_type = $this->input->post('ticket_type');
				
				$this->load->view('template/columns_animated', $data);
			}

		}else{
			echo json_encode($results);
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
		
		redirect('/');
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
	
	public function basic(){
		$data->title = 'Basic';
		$data->time_class = $this->day_or_night(); //css classes day or night;
		$data->main_class = 'home'; //css classes for the body
		$data->body_class = 'weather';
		$data->basic_content = 'Hola Mundo';
		$this->load->view('template/basic_animated', $data);
	}
	
	protected function day_or_night(){
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
	
	protected function new_purchase(){
		if(!is_ajax()){
			echo 'not ajax';
		}else{
			
		}
	}
	
	public function test(){
		
	}

}


/* End of file main.php */
/* Location: ./application/controllers/main.php */