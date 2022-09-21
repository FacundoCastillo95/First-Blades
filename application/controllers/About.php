<?php defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

	function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        $template = template();
        $template['custom_title'] = lang('Quiénes somos'); 
        $template['custom_description'] = lang('Somos una empresa independiente argentina con sede en la Ciudad de Buenos Aires que nace en el 2019 especializándose en la reparación de palas de aerogeneradores  y aportando soluciones en la instalación, puesta en marcha y mantenimiento de activos en proyectos de energías renovables. Tenemos una marcada orientación internacional, participando de proyectos y desarrollando tareas en Latinoamérica, Europa y Asia');

        $data['hero'] = $this->load->view('sections/about/components/hero_view', '', TRUE);
        $data['content'] = $this->load->view('sections/about/components/content_view', '', TRUE);
        $data['mission'] = $this->load->view('sections/about/components/mission_view', '', TRUE);
        
        
        $template['section'] = $this->load->view('sections/about/section_view', $data, TRUE);
        $this->load->view('themes/main_view', $template); 
	}
}