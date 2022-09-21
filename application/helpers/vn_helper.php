<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * This helper makes the life more easy
	 *
	 * @copyright  2018 Vixnet Technologies
	 * @license    -
	 * @version    Release: 2.0
	 * @link       https://estoes.me/vixnet
	 */
	
	// --------------------------------------------------------------------
	
	/**
	* Chrome library debug
	*
	* @param  -
	* @return status
	*/
	if(!function_exists('cdg'))
	{
		function cdg($log)
		{
			ChromePhp::log($log);
		}
	}

	// --------------------------------------------------------------------
	
	/**
	* Imprimimos un array legible, estopeamos para debuggear o no con un 1
	*
	* @param  -
	* @return status
	*/
	if(!function_exists('pre'))
	{
		function pre($arr = array(), $param = null)
		{
			print "<pre>";
			print_r($arr);
			print "</pre>";
			if(empty($param))
			{
				exit;
			}
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	* Generamos un random seguro de enteros
	* http://php.net/manual/en/function.openssl-random-pseudo-bytes.php#104322
	*
	* @param  -
	* @return int
	*/
	
	if ( ! function_exists('secure_random_int'))
	{
		function secure_random_int($min=0,$max=32)
		{
			$range = $max - $min;
			if ($range == 0) return $min; // not so random...
			$log = log($range, 2);
			$bytes = (int) ($log / 8) + 1; // length in bytes
			$bits = (int) $log + 1; // length in bits
			$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
			do {
				$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes, $s)));
				$rnd = $rnd & $filter; // discard irrelevant bits
				if($s === FALSE)
				{
					throw new Exception("openssl_random_pseudo_bytes generated non secure bytes!");
				}
			} while ($rnd >= $range);
			return $min + $rnd;
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	* Generamos un random seguro de strings
	*
	* @param  -
	* @return string
	*/
	if ( ! function_exists('secure_random_string'))
	{
		function secure_random_string($type = 'alnum', $len = 8)
		{
			switch($type)
			{
				case 'basic'    : return mt_rand();
					break;
				case 'alnum'    :
				case 'numeric'  :
				case 'nozero'   :
				case 'alpha'    :
						switch ($type)
						{
							case 'alpha'    :   $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
								break;
							case 'alnum'    :   $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
								break;
							case 'numeric'  :   $pool = '0123456789';
								break;
							case 'nozero'   :   $pool = '123456789';
								break;
						}
						$str = '';
						for ($i=0; $i < $len; $i++)
						{
							$str .= substr($pool, secure_random_int(0, strlen($pool) -1), 1);
						}
						return $str;
					break;
				case 'unique'   :
				case 'md5'      :
							return md5(uniqid(secure_random_int()));
					break;
				case 'encrypt'  :
				case 'sha1' :
							$CI =& get_instance();
							$CI->load->helper('security');
							return do_hash(uniqid(secure_random_int(), TRUE), 'sha1');
					break;
			}
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	* Guardamos el log en una base de datos para manejar errores
	* La funcion trabaja con la tabla vn_system_logs.sql
	*
	* @param  string, string, int
	* @return views
	*/
	if ( ! function_exists('sys_log'))
	{
		function sys_log($message, $type = null, $show = null)
		{
			//Obtenemos la instancia de CI
			$ci=& get_instance();
			//Cargamos la libreria
			$ci->load->library('user_agent');
			//Detectamos si hay un post y guardamos el envio.
			if ($ci->input->post()) {
				$post_data = $ci->input->post();
				$post_data['password'] = '';
				$post_data['password_match'] = '';
				$log['log_tracker'] = serialize($post_data);
			}
			
			//Si tiene mensaje lo guardamos para enviar.
			if (!empty($message)) {
				$log['log_message'] = $message;
			}
			//Controller
			if (!empty($ci->router->class)) {
				$log['log_controller'] = $ci->router->class;
			}
			//Metodo
			if (!empty($ci->router->class)) {
				$log['log_method'] = $ci->router->method;
			}
			//Metodo
			if (!empty($type)) {
				$log['log_type'] = $type;
			}
			$log['log_date']      = date('Y-m-d');
			$log['log_gmt']       = date('H:i:s');
			$log['log_url']       = current_url();
			$log['log_browser']   = $ci->agent->browser() . ' ' . $ci->agent->version();
			$log['log_ip']        = $ci->input->ip_address();
			$log['log_status']    = 1;
			$query = $ci->db->insert('vn_system_logs', $log);
			if( (!empty($type)) && ($type == 'error') && ($show == 1))
			{
				show_error($message, '404');
			}
		}
	}
	
	// --------------------------------------------------------------------
	/**
	* Devolvemos un checked si el post es correcto.
	*
	* @param  -
	* @return string
	*/
	if(!function_exists('post_checkbox'))
	{
		function post_checkbox($checkbox)
		{
			if(!empty($checkbox))
			{
				echo 'checked';
			}
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	* Convertimos una fecha en ingles en español
	*
	* @param  date
	* @return date
	*/
	if(!function_exists('date_es'))
	{
		function date_es($date, $div = null)
		{
			$ci=& get_instance();
			
			$pos = strpos($date, " ");

			if($pos !== false)
			{
				$time = explode(" ", $date);
				$date = $time[0];
				$hora = $time[1];
			}

			$pos = strpos($date, "/");

			if($pos === false)
			{
				$d = "-";
			}
			else
			{
				$d = "/";
			}

			$p = explode($d, $date);

			if(!is_null($div))
			{
				$d = $div;
			}

			$date = $p[2] . $d . $p[1] . $d . $p[0];

			if(!empty($hora))
			{
				$date = $date . " - " . $hora;
			}
		
			return $date;
		}
	}
	
	// --------------------------------------------------------------------

	/**
	 * Armamos un array de información para utilizar
	 *
	 * @param  data from database
	 * @return array
	 */

	if (!function_exists('drop_data'))
	{
		function drop_data($query = array())
		{
			$ci=& get_instance();
			$new_data = array();
			
			$ci->db->select($query['table'].'.*');
			$ci->db->from($query['table']);
			// WHERE STATUS
			if( !empty($query['where_field']) && !empty($query['where_value']))
			{
				$ci->db->where($query['where_field'], $query['where_value']);
			}
			// WHERE STATUS
			if( !empty($query['order_by_field']) && !empty($query['order_by_value']))
			{
				$ci->db->order_by($query['order_by_field'], $query['order_by_value']);
			}
			$data = $ci->db->get();
			$rows = $data->result();
			if(!empty($rows))
			{
				foreach($rows as $row)
				{   
					if(!empty($row->$data['field_id']))
					{
						if(!empty($row->$data['field_value']))
						{
							$new_data[$row->$data['field_id']] = $row->$data['field_value'];
						}
					}
				}
				return $new_data;
			}
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Guardamos el log en una base de datos para manejar errores
	 * La funcion trabaja con la tabla vn_system_logs.sql
	 *
	 * @param  string, string, int
	 * @return views
	 */

	if (!function_exists('sys_log'))
	{
		function sys_log($message, $type = null, $show = null)
		{
			//Obtenemos la instancia de CI
			$ci = & get_instance();
			//Cargamos la libreria
			$ci->load->library('user_agent');

			//Detectamos si hay un post y guardamos el envio.
			if ($ci->input->post())
			{
				$post_data                   = $ci->input->post();
				$post_data['password']       = '';
				$post_data['password_match'] = '';
				$log['log_tracker']          = serialize($post_data);
			}

			//Si tiene mensaje lo guardamos para enviar.
			if (!empty($message))
			{
				$log['log_message'] = $message;
			}

			//Controller
			if (!empty($ci->router->class))
			{
				$log['log_controller'] = $ci->router->class;
			}

			//Metodo
			if (!empty($ci->router->class))
			{
				$log['log_method'] = $ci->router->method;
			}

			//Metodo
			if (!empty($type))
			{
				$log['log_type'] = $type;
			}

			if($type = "activity")
			{
				$log['user_id'] = $ci->ion_auth->user()->row()->id;
			}

			$log['log_date']    = date('Y-m-d');
			$log['log_gmt']     = date('H:i:s');
			$log['log_url']     = current_url();
			$log['log_browser'] = $ci->agent->browser() . ' ' . $ci->agent->version();
			$log['log_ip']      = $ci->input->ip_address();
			$log['log_status']  = 1;

			$query = $ci->db->insert('vn_system_logs', $log);

			if ((!empty($type)) && ($type == 'error') && ($show == 1))
			{
				show_error($message, '404');
			}
		}
	}

	// --------------------------------------------------------------------
	
	/**
	 * Enviamos un correo a un grupo
	 *
	 * @param  string, string, int
	 * @return views
	 */

	if (!function_exists('send_email'))
	{
        function send_email($recipients, $subject, $body)
		{
			$ci = & get_instance();
			$ci->load->library('email');

			$config['protocol'] = 'smtp';
	        $config['smtp_host'] = 'ssl://smtp.gmail.com';
	        $config['smtp_port'] = '465';
	        $config['smtp_timeout'] = '7';
	        $config['smtp_user'] = 'soporte@estoes.me';
	        $config['smtp_pass'] = 'soporte123!1';
	        $config['charset'] = 'utf-8';
	        $config['newline'] = "\r\n";
	        $config['mailtype'] = 'html'; // or html
	        $config['validation'] = TRUE; // bool whether to validate email or not     

			$ci->email->initialize($config);

			$ci->email->from('admin@estoes.me', 'First Blades');
            $ci->email->bcc($recipients); 

			$ci->email->subject($subject);
			$ci->email->message($body);  

			$ci->email->send();
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Armamos un array de información para utilizar
	 *
	 * @param  data from database
	 * @return status
	 */

	if (!function_exists('make_drop_data'))
	{
		function make_drop_data($data = array())
		{
			$ci = & get_instance();

			$new_data = array();
			$ci->load->model('Simple_Db_Model');
			$rows     = $ci->Simple_Db_Model->get_drop($data);

			if (!empty($rows))
			{
				foreach ($rows as $row)
				{
					if (!empty($row->$data['field_id']))
					{
						if (!empty($row->$data['field_value']))
						{
							$new_data[$row->$data['field_id']] = $row->$data['field_value'];
						}
					}
				}

				return $new_data;
			}
		}
	}

	if (!function_exists('thumb'))
	{
		function thumb($url, $width, $height = null, $alignment = null, $quality = null)
		{
			if (is_null($quality))
			{
				$quality = 100;
			}

			$script = base_url("assets/scripts/load.php?src=");
			$string = $script . urlencode($url) . "&q=" . $quality . "&w=" . $width;

			if(!is_null($alignment))
			{
				$string .= "&a=" . $alignment;
			}

			if(!is_null($height))
			{
				$string .= "&h=" . $height;
			}

			return $string;
		}
	}

	if(!function_exists('assets_url'))
	{
		function assets_url($url = null, $versionate = TRUE)
		{
			if(defined('ASSETS_VERSION') && $versionate) 
			{
				// Si es entorno de desarrollo, se anexa un time para no hacer engorroso el cambio de constante.
				if (ENVIRONMENT != "production") {
					return base_url('assets/'.$url.'?v='.ASSETS_VERSION.'-'.time());
				}
				return base_url('assets/'.$url.'?v='.ASSETS_VERSION);
			}
			else 
			{
				return base_url('assets/'.$url);
			}
		}
	}

	if (!function_exists('clean'))
	{
		function clean($string) 
		{
			//Remplazo caracteres español
			$string = str_replace("á","a",$string);
			$string = str_replace("Á","A",$string);
			$string = str_replace("é","e",$string);
			$string = str_replace("É","E",$string);
			$string = str_replace("í","i",$string);
			$string = str_replace("Í","I",$string);
			$string = str_replace("ó","o",$string);
			$string = str_replace("Ó","O",$string);
			$string = str_replace("ú","u",$string);
			$string = str_replace("Ú","U",$string);
			$string = str_replace("ñ","n",$string);
			$string = str_replace("Ñ","N",$string);

			//Remplazo espacios con guiones.
			$string = str_replace(' ', '-', $string);

			//Lowercase
			$string = strtolower($string);
			
			//Remuevo caracteres especiales.
			$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);

			//Si es mayor a 150, lo recorto.
			//Para evitar problemas en la URL.
			if (strlen($string) > 150)
			{
				$str = substr($str, 0, 150);
			}

			return $string;
		}
	}

	if (!function_exists('crop'))
	{
		function crop($string, $long)
		{
			//Elimino html tags.
			$fstring = mb_substr(strip_tags($string), 0, $long, "UTF-8");

			if(strlen($string) > $long)
			{
				$fstring .= "...";
			}

			return $fstring;
		}
	}

	if (!function_exists('vn_paginate'))
	{
		function vn_paginate($paginate = array()) 
		{
			$cant_paginas = ceil($paginate['total'] / $paginate['porpagina']);
			$pagina = $paginate['pagina'];

			$array_paginas = array(); //Todo el paginado
			$array_anteriores = array(); //Anteriores
			$array_siguientes = array(); //Siguientes
			$data = array(); //Return

			for ($i = 1; $i <= $paginate['limit']; $i++)
			{
				//Agrego las anteriores
				if($pagina - $i > 0)
				{
					array_unshift($array_anteriores, $pagina - $i);
				}

				//Agrego las posteriores
				if($pagina + $i <= $cant_paginas)
				{
					$array_siguientes[] = $pagina + $i;
				}
			}

			$array_paginas = array_merge($array_anteriores, array($pagina), $array_siguientes);

			$data['pagina_actual'] = $pagina;
			$data['array_paginas'] = $array_paginas;
			$data['ultima_pagina'] = $cant_paginas;

			return $data;
		}
	}

	if(!function_exists('vn_alert'))
	{
		function vn_alert($title = null, $text = null, $type = "default", $icon = "fa fa-info")
		{
			if(!is_null($text) && !is_null($title))
			{
				$ci = & get_instance();

				$ci->session->set_flashdata('vn_alert_title', $title);
				$ci->session->set_flashdata('vn_alert_text', $text);
				$ci->session->set_flashdata('vn_alert_type', $type);
				$ci->session->set_flashdata('vn_alert_icon', $icon);
			}
		}
	}

	if (!function_exists('vn_history'))
	{
		function vn_history()
		{
			//Declaraciones
			$ci=& get_instance();
			$history = array();
			$cant_history = 10;

			//Si no existe variable de sessión
			if(empty($ci->session->userdata('vn_history')))
			{
				//La creo y seteo el primer valor
				$history[] = current_url();
				$ci->session->set_userdata('vn_history', $history);
			}
			else
			{
				//Si existe...
				$history = $ci->session->userdata('vn_history');

				//Veo si tiene el máximo de URLS, borro la última y acomodo.
				if(count($history) == $cant_history)
				{
					unset($history[0]);
					$history = array_values($history);
				}

				//Y agrego nueva URL
				$history[] = current_url();
				$ci->session->set_userdata('vn_history', $history);
			}
		}
	}

	if(!function_exists('vn_back'))
	{
		function vn_back($num)
		{
			$ci=& get_instance();

			$history = $ci->session->userdata('vn_history');
			if(!empty($history))
			{
				$cant = count($history);
				$back = $cant - $num;
				redirect($history[$back]);
			}
		}
	}

	// --------------------------------------------------------------------
	if(!function_exists('traduc_mes'))
	{
		function traduc_mes($mes)
		{
			$meses = array(
				1 => 'Enero',
				2 => 'Febrero',
				3 => 'Marzo',
				4 => 'Abril',
				5 => 'Mayo',
				6 => 'Junio',
				7 => 'Julio',
				8 => 'Agosto',
				9 => 'Septiembre',
				10 => 'Octubre',
				11 => 'Noviembre',
				12 => 'Diciembre'
				);
			return $meses[$mes];
		}
	}

	// --------------------------------------------------------------------
	if(!function_exists('urlF'))
	{
		function urlF($id = null, $categoria = null, $title = null)
		{
			return base_url('articulo/' . slug($categoria) . '/' .slug($title) . '/' . $id);
		}
	}

	// --------------------------------------------------------------------
	if(!function_exists('slug'))
	{
		function slug($string = null)
		{
			return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
		}
	}
		
	if (!function_exists('encodeURL'))
	{
		function encodeURL($string) {
			$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
			$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
			return str_replace($entities, $replacements, urlencode($string));
		}
	}


	if (!function_exists('lang'))
    {
        function lang($text)
        {
            $ci=& get_instance();

            //Si no existe, geo localizo.
            if(!$ci->session->userdata('language'))
            {
                $ip = $_SERVER['REMOTE_ADDR'];

                $handler = curl_init("http://ip-api.com/json/" . $ip);  
                curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec ($handler);  
                curl_close($handler);
                $response = json_decode($response);

                if(!empty($response->countryCode))
                {
                    $spanish = array('AR', 'BO', 'CH', 'CO', 'CR', 'CU', 'DO', 'EC', 'SV', 'GQ', 'GT', 'HN', 'MX', 'NI', 'PA', 'PY', 'PE', 'ES', 'UY', 'VE');
                    $code = $response->countryCode;

                    if (in_array($code, $spanish))
                    {
                        $ci->session->set_userdata('language', 'spanish');
                    }
                    else
                    {
                        $ci->session->set_userdata('language', 'english');
                    }
                }
                else
                {
                    //Default si no geolocaliza: Spanish.
                    $ci->session->set_userdata('language', 'spanish');
                }
            }

            $idiom = $ci->session->userdata('language');

            $ci->lang->load('web', $idiom);

            $translated = $ci->lang->line($text);
            if ($translated) 
            {
                return $translated;
            }
            else
            {
                return $text;
            };
        }
    }