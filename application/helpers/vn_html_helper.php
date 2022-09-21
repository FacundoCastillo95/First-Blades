<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * HTML Helper
	 *
	 * @copyright  2018 Vixnet Technologies
	 * @license    -
	 * @version    Release: 2.0
	 * @link       https://estoes.me/vixnet
	 */
	
	// --------------------------------------------------------------------
	
	/**
	* Get template
	*
	* @param  -
	* @return object
	*/

	if(!function_exists('template'))
	{
		function template()
		{
			$ci =& get_instance();

			//Get class and method for active links purposes
			$data_menu['class'] = $ci->router->fetch_class();
			$data_menu['method'] = $ci->router->fetch_method();

			$template['header'] = $ci->load->view('themes/header_view', '', TRUE);
			$template['footer'] = $ci->load->view('themes/footer_view', '', TRUE);
			
			return $template;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Establecemos la clase active en la sección corriente del menú
	 *
	 * @param string
	 * @return string
	 */
	if (!function_exists('active_menu'))
	{
		function active_menu($the_section = null)
		{
			$ci=& get_instance();
			$class  = $ci->router->class;

			if($class == $the_section)
			{
				return 'active';
			}
		}
	}