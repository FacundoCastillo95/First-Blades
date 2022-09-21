<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH."third_party/MX/Lang.php";

class MY_Lang extends MX_Lang {

	# Override de logging de líneas no existentes.
	public function line($line, $log_errors = TRUE)
	{
		$value = isset($this->language[$line]) ? $this->language[$line] : FALSE;

		// Because killer robots like unicorns!
		if ($value === FALSE && $log_errors === TRUE)
		{
			# No mostrará nada, si no existe la linea deberá continuar de todos modos.
		}

		return $value;
	}
}