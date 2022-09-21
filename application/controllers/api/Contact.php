<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Contact extends REST_Controller {

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}

	public function index_post()
	{
		$post = $this->post(); 
		if (empty($post)) 
		{
			$this->response([
				'status' => FALSE,
				'message' => 'No se ha ingresado información.'
			], REST_Controller::HTTP_BAD_REQUEST);
		}
		else
		{
			$this->form_validation->set_rules('name', "Por favor ingresá tu nombre.", 'required');
			$this->form_validation->set_rules('email', "Por favor ingresá tu e-mail.", 'required|valid_email');
			$this->form_validation->set_rules('message', "Por favor ingresá tu teléfono.", 'required');

			if ($this->form_validation->run() == true)
			{
				$data = array(
					'name' => $post['name'],
					'email' => $post['email'],
					'message' => $post['message']
				);
				
				if(!empty($post['company'])){
					$data['company'] = $post['company']; 
				}

				if(!empty($post['subject'])){
					$data['subject'] = $post['subject']; 
				}
				
				if(!empty($post['attachments'])){
					$data['attachments'] = $post['attachments']; 
				}

				// Setting the newsletter. 
				$mensaje_body = $this->load->view('communications/contact_view', $data, TRUE);

				// If dev/testing
				$email_to = 'nico.cappabianca@estoes.me';
				// If production
				if (ENVIRONMENT == "production")
				{
					$email_to = 'contacto@first-blades.com'; 
				}
				// Send the e-mail and 200 response :) 
				send_email($email_to, 'First Blades - Nuevo contacto', $mensaje_body);
				$this->response([
					'status' => TRUE,
					'message' => 'Mensaje enviado!'
				], REST_Controller::HTTP_OK);
			}
			else
			{
				$this->response([
					'status' => FALSE,
					'message' => 'Hay campos requeridos sin completar.'
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
	}
}