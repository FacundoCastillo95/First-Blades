<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lang extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = $this->input->get('lang');

		if(!empty($data))
		{
			// Esta función evita que se rompa el funcionamiento del lang. 
			switch ($data) {
				// Switches para los respectivos idiomas configurados. 
				case 'spanish':
					$this->session->set_userdata('language', 'spanish');
					break;
				case 'english':
					$this->session->set_userdata('language', 'english');
					break;
				// En caso que sea otro valor que llegue por un POST malintencionado por AJAX, mostrará el spanish por defecto. 
				default:
					$this->session->set_userdata('language', 'spanish');
					break;
			}
		}
	}

	function unlang()
	{
		$this->session->unset_userdata('language');
	}
}