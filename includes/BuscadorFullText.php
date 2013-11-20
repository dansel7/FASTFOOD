<?php
/**
 * Clase BuscadorFullText.
 * Es responsable de entregarnos el codigo de una consulta para la Base de datos
 * MySQL con motor MyIsam, basandose en los Indices FullText.
 * Ver http://dev.mysql.com/doc/refman/5.0/es/fulltext-search.html
 * Ver http://dev.mysql.com/doc/refman/5.0/es/fulltext-fine-tuning.html
 * Ver http://dev.mysql.com/doc/refman/5.0/es/information-functions.html
 *
 * @package     varias creado en el projecto opet
 * @copyright   2010 - ObjetivoPHP
 * @license     Gratuito (Free) http://www.opensource.org/licenses/gpl-license.html
 * @author      Marcelo Castro (ObjetivoPHP)
 * @link        objetivophp@gmail.com
 * @version     2.1.0 (27/12/2009 - 21/11/2010)
 * @since       ver uso de str_word_count( $_POST['buscar'], 1, '+-~<>');
 *              para proxima version
 * @since       Continua  serie BuscadorGenerico 4.4.6 del 21/05/2007.
 */
class BuscadorFullText
{
    /**
     * Contiene la cadena de busqueda, generalmente su contenido se correlaciona
     * con un campo en el formulario de busqueda.
     * @var string
     */
    private $_textoDeBusqueda;

    /**
     * Contiene la tabla de la base en la cual se realizara la consulta.
     * @var string
     */
    private $_tablaMysql;

    /**
     * Coleccion de campos que se retornaran como resultado.
     * @var array
     */
    private $_colCamposResultado = array();

    /**
     * Coleccion de campos que se utilizan para la busqueda de tipo fulltext.
     * @var array
     */
    private $_colCamposFullText = array();

    /**
     * Coleccion de parametros adiccionales a incluirle a la consulta.
     * Todos se añaden con tipo AND.
     * @var array
     */
    private $_colParametros = array();

    /**
     * Contiene el tipo de consulta que se realizo.
     * @var string
     */
    private $_tipoConsulta = 'FULLTEXT';

    /**
     * Configura si utiliza SQL_CALC_FOUND_ROWS en la consulta mysql para luego extraer la
     * cantidad de resultados con limit.
     * @var boolean
     */
    private $_SQL_CALC_FOUND_ROWS = true;

    /**
     * Contiene el metodo de envio del Formulario.
     * Utilizado en los metodos getValue y addParametros.
     * @var string 
     */
    private $_metodoEnvio = 'POST';

    /**
     * Contiene los operadores para parametros variables permitidos.
     * @var array
     */
    private static $_operadores = array('=', '<=>', '<>', '!=', '<=', '<',
                                        '>', 'IS', 'IS NOT', 'IS NULL',
                                        'IS NOT NULL');

    /**
     * Metodo __construct.
     * Crea un objeto BuscadorFullText
     * @param   string  $buscar Cadena de busqueda puede contener +-~><
     * @param   string  $tabla  Nombre de la Tabla MySQL a usar en la consulta.
     * @return  void
     */
    public function  __construct($buscar, $tabla)
    {
        $this->_textoDeBusqueda = addslashes($buscar);
        $this->_tablaMysql      = addslashes($tabla);
    }

    /**
     * Metodo addCamposResultado.
     * Ingresa los campos que se usaran como resultado de la consulta.
     * @param   string/array  $campo Contiene el o los nombres de los campos.
     * @return  void
     */
    public function addCamposResultado($campo)
    {
        if (is_string($campo)) {
            $campo  = explode(',', $campo);
        }
        if (is_array($campo)) {
            foreach ($campo as $valor) {
                $this->_colCamposResultado[] = $valor;
            }
        }
    }

    /**
     * Metodo limitarLargo.
     * Limita el largo de un campo a un determinado numero de caracteres.
     * @version 2.1.0 (21/11/2010)
     * @param   string  $campo      nombre de campo.
     * @param   integer $caracteres Cantidad de caracteres que retornara la consulta.
     * @return  void
     */
    public function limitarLargo($campo, $caracteres)
    {
        $clave  = array_search($campo, $this->_colCamposResultado);
        if ($clave !== false) {
            $caracteres = ($caracteres > 0)? $caracteres : 250;
            $this->_colCamposResultado[$clave] = 'LEFT(`' . $campo . '`, ' .$caracteres . ') as ' . $campo;
        }
    }

    /**
     * Metodo addCamposFullText.
     * Ingresa los campos que se usaran para la consulta.
     * @param   string/array  $campo Contiene el o los nombres de los campos.
     * @return  void
     */
    public function addCamposFullText($campo)
    {
        if (is_string($campo)) {
            $campo  = explode(',', $campo);
        }
        if (is_array($campo)) {
            foreach ($campo as $valor) {
                $this->_colCamposFullText[] = $valor;
            }
        }
    }

    /**
     * Metodo addParametrosVariables.
     * Inserta un parametro a la consulta.
     * @param   string  $campo      Nombre del campo en el formulario de consulta, debe
     *                              coincidir con el de la base de datos.
     * @param   string  $operador   operador de consulta = > < etc.
     * @return  void
     */
    public function addParametrosVariables($campo, $operador)
    {
        $valor      = ($this->_metodoEnvio == 'POST')? $_POST[$campo] : $_GET[$campo];
        if (!in_array($operador, self::$_operadores)) {
            trigger_error('Operador de Consulta no valido en Metodo ' . __METHOD__, E_USER_ERROR);
        }
        $parametro  = $campo . ' ' . $operador . " '" . addslashes($valor) . "'";
        $this->_colParametros[] = $parametro;
    }

    /**
     * Metodo addParametrosFijos.
     * Agrega parametros fijos en la consulta.
     * @param   string  $parametros parametro tipo campo='valor'
     * @return  void
     */
    public function addParametrosFijos($parametros)
    {
        $this->_colParametros[] = $parametros;
    }

    /**
     * Metodo setSqlCalcFoundRows.
	 * Configura si debe ponerse en la consulta MySQL la clausula SQL_CALC_FOUND_ROWS.
	 * @param 	boolean $boolean    true por si, false por no.
	 * @return 	void
	 */
	public function setSqlCalcFoundRows($boolean)
	{
        $this->_SQL_CALC_FOUND_ROWS	= ($boolean)? true:false;
    }

    /**
     * Metodo setMetodoEnvio.
     * Configura por que metodo se envia el formulario (GET, POST).
     * @param   string  $metodo Metodo a utilizarce para levantar las variables
     *                          del formulario.
     * @return  void
     */
    public function setMetodoEnvio($metodo = 'POST')
    {
        ($metodo == 'GET')? $this->_metodoEnvio = 'GET' : $this->_metodoEnvio = 'POST';
    }

    /**
     * Metodo getValue.
     * Retorna una cadena que se puede colocar dentro del value de un campo
     * de busqueda.
     * @param   string  $campo  Nombre del campo que se debe levantar.
     * @param   string  $metodo metodo POST o GET. Por defecto POST.
     * @return  string  Cadena tipo value.
     */
    public function getValue($campo)
    {
        $valor  = ($this->_metodoEnvio == 'POST')? $_POST[$campo] : $_GET[$campo];
        return stripslashes(str_replace('"', "'", $valor));
    }
    
    /**
     * Metodo getConsultaMysql.
     * Genera una consulta MySQL, para un buscador dependiendo de el largo de la
     * cadena utiliza like o modo fulltext.
     * @param   string  $texto
     * @return  string  Consulta MySQL para busqueda.
     */
	public function getConsultaMysql($texto='')
	{
        // Veo si cambia el texto de busqueda o si lo mantiene.
        $this->_textoDeBusqueda	= ($texto)? addslashes($texto) : $this->_textoDeBusqueda;
        // Comienzo a generar la consulta MySql
		$mySqlQuery				= (strlen($this->_textoDeBusqueda) < 4)?
                                $this->_getConsultaLike($this->_textoDeBusqueda) :
                                $this->_getConsultaFullText($this->_textoDeBusqueda);
        // Agregamos los Parametros a la consulta
        if ($this->_colParametros) {
            $mySqlQuery        .= ' && (' . implode(' && ', $this->_colParametros) . ' ) ';
        }
        // Cerramos la consulta
		$mySqlQuery				= ($this->_tipoConsulta == 'FULLTEXT')? $mySqlQuery . " ORDER BY puntuacion DESC" : $mySqlQuery;
		$mySqlQuery				= $mySqlQuery . ' LIMIT %d, %d';
		return $mySqlQuery;
	}

	/**
	 * Genera la consulta tipo Like.
	 * @param 	string		$texto	Texto de busqueda.
	 * @return	string		Cadena para consulta MySQL con LIKE.
	 */
	private function _getConsultaLike($texto)
	{	$this->_tipoConsulta= 'LIKE';
		$inicio				= ($this->_SQL_CALC_FOUND_ROWS)? 'SELECT SQL_CALC_FOUND_ROWS ':'SELECT ';
        $camposResultados   = (count($this->_colCamposResultado))? implode(', ', $this->_colCamposResultado) : '*';
		$consulta			= $inicio . $camposResultados . " FROM " . $this->_tablaMysql . " WHERE ( ";

		foreach($this->_colCamposFullText as $campo)
		{
            $consulta		= $consulta . " " . $campo . " LIKE '%%" . $texto . "%%' OR ";
		}
		$consulta			= substr($consulta,0,strlen($consulta)-3) ." ) ";
		return $consulta;
	}

	/**
	 * Genera la consulta fulltext.
	 * @param 	string		$texto	Texto de busqueda
	 * @return	string		Cadena para consulta MySQL tipo FULLTEXT.
	 */
	private function _getConsultaFullText($texto)
	{
        $this->_tipoConsulta= 'FULLTEXT';

        $camposFullText     = implode(', ', $this->_colCamposFullText);
		$parsearTexto		= $this->_cadenaFullText($texto);
		$inicio				= ($this->_SQL_CALC_FOUND_ROWS)? 'SELECT SQL_CALC_FOUND_ROWS ':'SELECT ';
		$camposResultados   = (count($this->_colCamposResultado))? implode(', ', $this->_colCamposResultado) : '*';
        $consulta			= $inicio . " " . $camposResultados . ",
       						MATCH( $camposFullText ) AGAINST ('$parsearTexto' IN BOOLEAN MODE) AS puntuacion
       						FROM $this->_tablaMysql
       						WHERE MATCH( $camposFullText ) AGAINST ('$parsearTexto' IN BOOLEAN MODE) ";
		return 	$consulta;
	}

    /**
     * Metodo cadenaFullText.
     * Genera la cadena que ira en parte  AGAINST, de la consulta MySQL.
     * @param   string  $texto  Texto digitado por el usuario.
     * @return  string
     */
    private function _cadenaFullText($texto)
    {
        $patron     = array('/\s\s+/',                      // Quito espacios en blanco de mas
                            '/\'/',                         // Cambio comillas simples por dobles
                            '/([\+\-\~\<\>])(\s)/',         // junto los simbolos con las palabras de busqueda
                            '/([\w]*)([\+\-\~\<\>\)])/',    // Separo los simbolos de las palabras que los anteceden);
                            '/\*/',
                            '/\s\s+/');                     // Vuelvo a sacar espacios en blanco por las dudas
        $remplazo   = array(' ', '"','\1', '\1 \2', '', ' ');
        $texto      = preg_replace($patron, $remplazo, $texto);

        // Separamos las cadenas entre comillas.
        $datos      = explode('"', str_replace('\\', '', $texto));
       
        $cantidad   = count($datos);
        for ($index = 0; $index < $cantidad; $index++) {
            if(($index % 2) == 0 && $datos[$index] ) {
                $partes         = explode(' ', trim($datos[$index]));
                $datos[$index]  = implode('* ', $partes) . '* ';
            } elseif ($datos[$index]) {
                // Ordeno en caso que sea una cadena entrecomillada
                $simbolo    = substr($datos[$index - 1], strlen($datos[$index - 1])-3,1);
                $datos[$index]  = '"' . $datos[$index] .'"';
                if (strpos("+-~<>", $simbolo) !== false) {
                    $datos[$index]  = $simbolo . $datos[$index];
                    $datos[$index-1]= substr($datos[$index-1], 0, strlen($datos[$index - 1])-3);
                }
            }
        }
        $texto  = implode(' ', $datos);
        
        // Correcciones Finales
        $patron     = array('/\(\*/', '/\)\*/', '/[\+\-\~\<\>]\*/');
        $remplazo   = array('(', ')', '');
        $texto      = preg_replace($patron, $remplazo, $texto);
        return $texto;
    }
}
