<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

	function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        $template = template();
        $template['custom_title'] = lang('Nuestros servicios');
        $template['custom_description'] = lang('Somos una empresa independiente argentina con sede en la Ciudad de Buenos Aires que nace en el 2019 especializándose en la reparación de palas de aerogeneradores  y aportando soluciones en la instalación, puesta en marcha y mantenimiento de activos en proyectos de energías renovables. Tenemos una marcada orientación internacional, participando de proyectos y desarrollando tareas en Latinoamérica, Europa y Asia');

        $data['hero'] = $this->load->view('sections/services/components/hero_view', '', TRUE);
        $data['services'] = $this->load->view('sections/services/components/services_view', '', TRUE);
        $data['work'] = $this->load->view('sections/services/components/work_view', '', TRUE);
        // $data['clients'] = $this->load->view('sections/services/components/clients_view', '', TRUE);
        
        
        $template['section'] = $this->load->view('sections/services/section_view', $data, TRUE);
        $this->load->view('themes/main_view', $template); 
	}
}