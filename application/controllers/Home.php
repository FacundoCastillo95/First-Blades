<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        $template = template();
        $template['custom_title'] = lang('Inicio');
        $template['custom_description'] = lang('Somos una empresa independiente argentina con sede en la Ciudad de Buenos Aires que nace en el 2019 especializándose en la reparación de palas de aerogeneradores  y aportando soluciones en la instalación, puesta en marcha y mantenimiento de activos en proyectos de energías renovables. Tenemos una marcada orientación internacional, participando de proyectos y desarrollando tareas en Latinoamérica, Europa y Asia');

        $data['hero'] = $this->load->view('sections/home/components/hero_view', '', TRUE);
        $data['services'] = $this->load->view('sections/home/components/services_view', '', TRUE);
        $data['about'] = $this->load->view('sections/home/components/about_view', '', TRUE);
        $data['joint_venture'] = $this->load->view('sections/home/components/joint_venture_view', '', TRUE);
        $data['contact'] = $this->load->view('sections/home/components/contact_view', '', TRUE);
        
        $template['section'] = $this->load->view('sections/home/section_view', $data, TRUE);
        $this->load->view('themes/main_view', $template); 
	}
}