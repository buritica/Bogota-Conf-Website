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
			$message->to = $a->email;
			$message->attendee = $a;
			
			//user saved, get remaining tickets
			$all = new Attendee();
			if($a->ticket_type == 'student'){
				$remain = $this->get_remaining_tickets(2);
				$message->template = 'email/purchase_instructions_student';
			}else{
				$remain = $this->get_remaining_tickets(1);
				$message->template = 'email/purchase_instructions_pro';
			}
			
			
			//if we have remaining tickets, send email and success response
			if($remain > 0){
				$message->subject = 'Instrucciones para confirmar tu compra';
				
				//set templates & update tickets
				if($a->ticket_type == 'student'){
					$message->template = 'email/purchase_instructions_student';
					$this->update_tickets(2,$remain-1);
				}else{
					$message->template = 'email/purchase_instructions_pro';
					$this->update_tickets(1,$remain-1);
				}
				
				//set messages
				$results->flash = '<p>Gracias '.first_name($a->name).', tu cupo ha sido reservado. S&iacute;gue las instrucciones que hemos enviado a tu email para completar la transacci&oacute;n.</p>';

				$results->message = '	<h3>Cupo Reservado</h3><hr />
						<p>Gracias '.first_name($a->name).', tu cupo ha sido reservado. S&iacute;gue las instrucciones que hemos enviado a tu email para completar la transacci&oacute;n.</p><hr />
						<a href="#" class="button" data-link="lightbox-close">Cerrar</a>';			

				
			}else{//add to queue
				$message->template = 'email/waiting';
				$message->subject = 'Te hemos agregado a la lista de espera';
				
				//set messages
				$results->flash = '<p>Gracias '.first_name($a->name).', te hemos agregado a la lista de espera. Si se liberan cupos te enviaremos un email en el mismo orden en el que te registraste.</p>';

				$results->message = '	<h3>Lista de Espera</h3><hr />
					<p>Gracias '.first_name($a->name).', te hemos agregado a la lista de espera. Si se liberan cupos te enviaremos un email en el mismo orden en el que te registraste.</p><hr />
					<a href="#" class="button" data-link="lightbox-close">Cerrar</a>';
			}
			//send email
			$this->send_email($message);
		}else{
			$results->success = FALSE;
			$results->errors = $a->error->string;
		}
		
		//return results
		if(!is_ajax()){
			if($results->success == TRUE){

				$this->session->set_flashdata('message',$results->flash);
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
	
	public function confirmar_consignacion($email=''){

		$this->load->helper('form');
		$a = new Attendee();
		$a->get_by_email($email);
		if(!$a->id){
			redirect('/');
		}
		
		$data->attendee = $a;

		$data->pro_remain = $this->get_remaining_tickets(1);
		$data->student_remain = $this->get_remaining_tickets(2);
		
		$data->title = 'Confirmar Consignación';
		$data->time_class = $this->day_or_night(); //css classes day or night;
		$data->main_class = 'home'; //css classes for the body
		$data->body_class = 'weather';
		$data->left_content = 'confirm_deposit';
		$data->sidebar = 'sidebar_info';
		$data->pro_remain = $this->get_remaining_tickets(1);
		$data->student_remain = $this->get_remaining_tickets(2);
		$this->load->view('template/columns_animated', $data);
		
	}
	
	public function subir_consignacion($email=''){
		
		$a = new Attendee();
		$a->get_by_email($email);
		if(!$a->id){
			redirect('/');
		}
		
		$new_name = explode('.com', $email);
		if(ENV == 'dev'){
			$config['upload_path'] = '../private/uploads/';
		}else{
			$config['upload_path'] = '../../private/uploads/';
		}
		$config['allowed_types'] = 'jpg|png';
		$config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$config['file_name'] = $a->id.$new_name[0];
		

		$this->load->library('upload', $config);		
		
		if(!$this->upload->do_upload('file')){
			$data->errors = array('error' => $this->upload->display_errors());
			
			$this->load->helper('form');

			if(!$a->id){
				redirect('/');
			}

			$first_name = explode(" ",$a->name);
			$data->name = $first_name[0];
			$data->attendee = $a;

			$data->pro_remain = $this->get_remaining_tickets(1);
			$data->student_remain = $this->get_remaining_tickets(2);

			$data->title = 'Confirmar Consignación';
			$data->time_class = $this->day_or_night(); //css classes day or night;
			$data->main_class = 'home'; //css classes for the body
			$data->body_class = 'weather';
			$data->left_content = 'confirm_deposit';
			$data->sidebar = 'sidebar_info';
			$data->pro_remain = $this->get_remaining_tickets(1);
			$data->student_remain = $this->get_remaining_tickets(2);
			$this->load->view('template/columns_animated', $data);
		}else{
			$data = $this->upload->data();

			$config = array( 'email' => 'juanpablo@buritica.org', 'password' => 'Axfxi666');
			$dbx = $this->load->library('DropboxUploader', $config);
			$dbx = new DropboxUploader($config);
		
      $dbx->upload($data['full_path'], 'bconf');
			$a->upload = 1;
			$a->save();
			
			//TODO:aqui mandamos el mail diciendo que recibimos la imagen
			$message->template = 'email/upload_confirmation';
			$message->subject = 'Consignación Recibida';
			$message->to = $a->email;
			$message->attendee = $a;
			
			$this->send_email($message);
			
			$message = '<p>Excelente, hemos recibido tu imágen y estamos verificando tu consignación.</p>
			<p>En el momento en el que sea confirmada, te enviaremos tus entradas.</p>
			';
			$this->session->set_flashdata('message',$message);
			redirect('/');
		}
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
	
	protected function send_email($data){
		
		user_notify_postmark($data);
	
	}	
	
 	protected function get_remaining_tickets($id){
		
		$t = new Ticket();
		$t->get_by_id($id);
		// fb($t->type);
		return $t->remain;		
	}
	
	protected function update_tickets($id,$quantity){
		$t = new Ticket();
		$t->get_by_id($id);
		// fb($t->type);
		$t->remain = $quantity;
		$t->save();
	}
	
}


/* End of file main.php */
/* Location: ./application/controllers/main.php */