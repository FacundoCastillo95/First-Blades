<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @package	CodeIgniter - Esto es media
 * @author	Ger
 * @copyright	Copyright (c) 2018, Esto es Vixnet, Inc. (http://www.estoes.me/vixnet)
 * @link	http://estoes.me/vixnet
 * @since	Version 1.0.0
 *
 */

class Api_handler
{
	/**
	 * Campo para filtrar rows unicos.
	 *
	 * @var	int
	 */
	protected $id;

	/**
	 * Filtra los campos de la consulta SQL.
	 *
	 * @var	string[]
	 */
	protected $fields = array();

	/**
	 * Campo que filtra por búsquedas SQL.
	 *
	 * @var	string
	 */
	protected $search;

	/**
	 * Campo que limita rows de la consulta SQL.
	 *
	 * @var	int
	 */
	protected $limit;

	/**
	 * Campo que limita los campos por pagina de la consulta SQL.
	 *
	 * @var	int
	 */
	protected $per_page;

	/**
	 * Campo que posiciona la pagina de la consulta SQL.
	 *
	 * @var	int
	 */
	protected $page;

	/**
	 * Campo que condiciona el tipo de orden ASC o DESC.
	 *
	 * @var	int
	 */
	protected $order_type;

	/**
	 * Campo que setea el orden de la consulta SQL.
	 *
	 * @var	string
	 */
	protected $order_col;

	/**
	 * Resultado de la query
	 *
	 * @var	bool
	 */
	protected $_result;

	/**
     * List all supported methods, the first will be the default format
     *
     * @var array
     */
    protected $_get_supported_fields = [
            'id',
            'fields',
            'search',
            'limit',
            'per_page',
            'page',
            'order_type',
            'order_col'
        ];

	
	public function __construct()
	{
		$this->ci = &get_instance();
	}

	// --------------------------------------------------------------------

    /**
     *  Validamos los campos de la query
     *
     * @return  bool
     */
    public function _get_check($config, $table)
    {
    	//Chequeamos que no haya pasado ningun parametro.
    	foreach($config as $key => $query)
    	{
    		if(!in_array($key, $this->_get_supported_fields)) return FALSE;
    	}

    	return FALSE;
    }

	// --------------------------------------------------------------------

    /**
     *  Validamos los campos de la query Fields
     *
     * @return  bool
     */

	public function fields($table, $fields)
	{
		//Los transformamos en un array
        $fields = explode(',', $fields);

        //Inicializamos los campos correctos en 0
        $table_fields = array();

        //Recorremos los campos
        foreach($fields as $field)
        {
        	//Comprobamos que existan los campos en la db
            if ($this->ci->db->field_exists($field, $table))
            {
            	$table_fields[] = $table.'.'.$field;
            }
        }

        //Los parseamos para usarlos.
        $table_fields = implode (", ", $table_fields);

        //Devolvemos los campos filtrados
        return $table_fields;
	}

	// --------------------------------------------------------------------

    /**
     *  Validamos los campos de la query Fields
     *
     * @return  bool
     */

	public function order_col($table, $col)
	{
		//Comprobamos que existan los campos en la db
        if ($this->ci->db->field_exists($col, $table))
        {
        	return TRUE;
        }
        else
        {
        	return FALSE;
        }
	}

	// --------------------------------------------------------------------

    /**
     *  Calculamos el offset
     *
     * @return  bool
     */
	public function offset($page, $per_page)
	{
		return ($page * $per_page) - $per_page;
	}

	// --------------------------------------------------------------------

    /**
     *  Seteamos el log y los mensajes.
     *
     * @return  bool
     */
	private function error($key)
	{
		return FALSE;
	}
}