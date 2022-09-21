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
class Upload extends REST_Controller {

	function __construct()
	{
		// Construct the parent class
		parent::__construct();

		$this->load->library('S3');
		// Configure limits on our controller methods
		// Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
		$this->methods['file_get']['limit'] = 5000; // 500 requests per hour per user/key
		$this->methods['file_post']['limit'] = 1000; // 100 requests per hour per user/key
		$this->bucket = 'vixnetapi';
		$this->bucket_url = 'https://s3-us-west-2.amazonaws.com/vixnetapi/';
		$this->max_size = 20; //MB
	}

	public function file_post()
	{
		//File was empty
		if(empty($_FILES))
		{
			$this->response([
				'status' => FALSE,
				'message' => 'select file to upload'
			], REST_Controller::HTTP_BAD_REQUEST);
		}
		else
		{
			$files_rejected = array();
			$files_passed = array();
			foreach ($_FILES as $file_pos => $file) {
				foreach ($file['size'] as $f_pos => $size) {
					if ($size > ($this->max_size * 1000000)) {
						$files_rejected[] = array(
							"status_code" => "max_size_exceeded",
							"name" => $file['name'][$f_pos],
							"type" => $file['type'][$f_pos],
							"tmp_name" => $file['tmp_name'][$f_pos],
							"error" => $file['error'][$f_pos],
							"size" => $file['size'][$f_pos],
							"message" => "El archivo superó el peso permitido."
						);
					}
					else
					{
						$files_passed[] = array(
							"name" => $file['name'][$f_pos],
							"type" => $file['type'][$f_pos],
							"tmp_name" => $file['tmp_name'][$f_pos],
							"error" => $file['error'][$f_pos],
							"size" => $file['size'][$f_pos]
						);
					}
				}
			}

			if (sizeof($files_passed) < 1) 
			{
				$this->response([
					"rejected" => $files_rejected
				], REST_Controller::HTTP_OK);
			}
			else
			{
				$files_uploaded;

				//Corregimos el array multiple
				//$parsedFiles = $this->reArrayFiles($files_passed); //$_FILES

				//print_r($parsedFiles); exit;

				foreach($files_passed as $k => $fileToUpload)
				{
					# Nombre de carpeta
					$folder = 'first-blades';
					//Agrego el nombre unico al archivo, limpiar nombre para que no haya problemas con los espacios.
					$appIdFileName = $folder . "/" . time() . '-' . $this->clean($fileToUpload['name']);

					$responseUpload = $this->s3Upload(
						$fileToUpload['tmp_name'],
						$appIdFileName
					);

					if(!empty($responseUpload))
					{
						$fileData = [
							'name' => $fileToUpload['name'],
							'size'  => $fileToUpload['size'],
							'url'   => $this->bucket_url . $appIdFileName,
							'type'  => $fileToUpload['type']
						];
					
						$message = [
							'status' => TRUE,
							'status_code' => 'uploaded',
							'name'  => $fileToUpload['name'],
							'size'      => $fileToUpload['size'],
							'url'       => $this->bucket_url . $appIdFileName,
							'type'      => $fileToUpload['type'],
							'message'   => 'success'
						];
						
						$files_uploaded[$k] = $message;
					}
				}
				$response = array(
					"uploaded" => $files_uploaded,
					"rejected" => $files_rejected
				);
				$this->response($response, "OK"); // OK (200) being the HTTP response
			}
		}
	}
	
	private function s3upload($tmpFile, $uniqName)
	{
		return $this->s3->putObjectFile($tmpFile, $this->bucket, $uniqName, S3::ACL_PUBLIC_READ);
	}

	//Parse de array multiple de archivos
	private function reArrayFiles(&$file_post) 
	{
		$key= key($_FILES);
		$file_post = $_FILES[$key];
		$file_ary = array();
		$file_count = count($file_post['name']);
		$file_keys = array_keys($file_post);

		for ($i=0; $i<$file_count; $i++) {
			foreach ($file_keys as $key) {
				$file_ary[$i][$key] = $file_post[$key][$i];
			}
		}

		return $file_ary;
	}

	private function clean($string) 
	{
		//Remplazo caracteres español
			$string = str_replace("á","a",$string);
			$string = str_replace("Á","A",$string);
			$string = str_replace("à","a",$string);
			$string = str_replace("À","A",$string);
			$string = str_replace("ä","a",$string);
			$string = str_replace("Ä","A",$string);
			$string = str_replace("Å","A",$string);
			$string = str_replace("å","a",$string);
			$string = str_replace("Ă","A",$string);
			$string = str_replace("Ą","A",$string);
			$string = str_replace("ã","A",$string);
			$string = str_replace("Ã","A",$string);
			$string = str_replace("æ","A",$string);
			$string = str_replace("Æ","A",$string);

			$string = str_replace("é","e",$string);
			$string = str_replace("É","E",$string);
			$string = str_replace("è","e",$string);
			$string = str_replace("È","E",$string);

			$string = str_replace("í","i",$string);
			$string = str_replace("Í","I",$string);
			$string = str_replace("ì","i",$string);
			$string = str_replace("Ì","I",$string);
			$string = str_replace("î","i",$string);
			$string = str_replace("Î","I",$string);

			$string = str_replace("ó","o",$string);
			$string = str_replace("Ó","O",$string);
			$string = str_replace("ò","o",$string);
			$string = str_replace("Ò","O",$string);
			$string = str_replace("õ","o",$string);
			$string = str_replace("Õ","O",$string);
			$string = str_replace("ô","o",$string);
			$string = str_replace("Ô","O",$string);
			$string = str_replace("œ","o",$string);
			$string = str_replace("Œ","O",$string);
			$string = str_replace("ø","o",$string);
			$string = str_replace("Ø","O",$string);

			$string = str_replace("ú","u",$string);
			$string = str_replace("Ú","U",$string);
			$string = str_replace("ù","u",$string);
			$string = str_replace("Ù","U",$string);
			$string = str_replace("û","u",$string);
			$string = str_replace("Û","U",$string);

			$string = str_replace("ç","c",$string);
			$string = str_replace("Ç","C",$string);

			$string = str_replace("ð","d",$string);
			$string = str_replace("Ð","D",$string);

			$string = str_replace("ñ","n",$string);
			$string = str_replace("Ñ","N",$string);

			$string = str_replace("¿","",$string);
			$string = str_replace("¡","",$string);
			$string = str_replace("?","",$string);
			$string = str_replace("!","",$string);

			//Remplazo espacios con guiones.
			$string = str_replace(' ', '-', $string);

			//Lowercase
			$string = strtolower($string);
			
			//Remuevo caracteres especiales.
			$string = preg_replace('/[^A-Za-z0-9\-.]/', '', $string);

			//Si es mayor a 150, lo recorto.
			//Para evitar problemas en la URL.
			if (strlen($string) > 150)
			{
				$str = substr($str, 0, 150);
			}

			return $string;
	}
}