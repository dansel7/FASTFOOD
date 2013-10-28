<?php
class clase_database
{
	private $db_host;
	private $db_usuario;
	private $db_clave;
	private $db_nombre;
	
	//Metodo que inicializa los parametros de conexion al servidor de bases de datos
	function __construct()
	{
	  $this->db_host='mysql4.000webhost.com';
	  $this->db_usuario='a4875231_ffsv';
	  $this->db_clave='DL091030';
	  $this->db_nombre='a4875231_ffsv';
	}
	
	//Metodo que conecta al servidor de BD
	public function crear_conexion()
	{
	  $link=mysql_connect($this->db_host, $this->db_usuario, $this->db_clave);
	  mysql_select_db($this->db_nombre);
	  return $link;
	}
	
	//Metodo para cerrar la conexion al servidor de BD
	public function cerrar_conexion($link)
	{
	  mysql_close($link);
	}
	
	//Metodo que obtiene el ultimo Id que se ha insertado de una tabla determinada, especialemente cuando el id es autonumerico
	public function ObtenerUltimoIncremento($link, $id_incremento, $tabla){
		$query = "SELECT LAST_INSERT_ID(".$id_incremento.") AS UltimoId FROM ".$tabla." ORDER BY ".$id_incremento." DESC LIMIT 1";
		$result = mysql_query($query, $link);
		return mysql_result($result, 0, "UltimoId");
	}
	
	//Metodo para recuperar informacion de la BD
	public function enviarQuery($link, $query){
		$result = mysql_query($query, $link);
		return $result;
	}
	
	//Metodo para obtener numero de filas retornadas
	public function countRows($result){
		return mysql_num_rows($result);
	}
	
	
	//Metodo que elimina un registro de una tabla que se pasa por parametros
	public function EliminarRegistros($enlace, $tabla, $condicion){
		$sql = "DELETE FROM " . $tabla . " WHERE " . $condicion ;
		if (mysql_query($sql,$enlace))
		{		
			return true;		
		}
		else
		{
			return false;
		}
	}
	
	//Metodo para decodificar la informacion dado un id/nombre de variable obtener su valor
	public function decodificarInfo($enlace, $tabla, $campoOut, $campoIn, $codigo){
		$sql_decodificar = "SELECT ".$campoOut." as valor FROM " . $tabla . " WHERE " . $campoIn . " = '".$codigo."'";
		$result_decodificar = mysql_query($sql_decodificar, $enlace);
		return mysql_result($result_decodificar, 0, "valor");
	}
	
	//Metodo para subir un archivo de imagen
	public function SubirImagen($img){
		if (is_uploaded_file($img['tmp_name'])) {
			if ($img['type'] == "image/jpeg" || $img['type'] == "image/pjpeg"){
				move_uploaded_file($img['tmp_name'], "../productos/".$img['name']);
			}else{
				echo "Formato no valido para fichero de imagen";
			}
		} else {
			echo "Error al cargar imagen: " . $_FILES['imagen']['name'];
		}
		return $img['name'];
	}
	
	//Metodo para subir un archivo de imagen
	public function SubirArchivo($archivo){
		$nombre_archivo = date("dmY") . $archivo['name'];
		if (is_uploaded_file($archivo['tmp_name'])) {
			move_uploaded_file($archivo['tmp_name'], "../cotizaciones/" . $nombre_archivo);
		} else {
			echo "Error al cargar archivo ";
		}
		return $nombre_archivo;
	}

	
	//Metodo para enviar informacion a la BD, agregando registros o actualizando existentes
	public function formulario_a_database($link, $tabla, $excepciones='', $editor='', $sql_tipo='', $sql_condicion=NULL)
	{
	  $campos = '';
	  $valores = '';
	 
	  foreach ($_POST as $campo => $valor)
	  {
		if (!preg_match("/$campo, /", $excepciones))
		{
		  $campos .= "$campo='".trim(addslashes($valor))."', ";
		  
		}
	  }
	  $campos = preg_replace('/, $/', '', $campos);
	  $valores = preg_replace('/, $/', '', $valores);
	 
	  if ($sql_tipo == 'insert')
	  {
		$sql = "INSERT INTO ".$tabla." SET ".$campos;
		
	  }
	  else if ($sql_tipo=='update')
	  {
		if (!isset($sql_condicion))
		{
		  return 0;
		}
		$sql = "UPDATE ".$tabla." SET ".$campos." WHERE ".$sql_condicion;
	  }
	  else
	  {
		return 0;
	  }
	  //echo $sql;
	  if (mysql_query($sql,$link))
	  {		
		  return true;		
	  }
	  else
	  {
		echo mysql_error($link);
		return false;
	  }
	}
	
	function mesActual(){
		$mes = date("m");
		switch($mes){
			case 1:
				return "Enero";
				break;
			case 2:
				return "Febrero";
				break;
			case 3:
				return "Marzo";
				break;
			case 4:
				return "Abril";
				break;
			case 5:
				return "Mayo";
				break;
			case 6:
				return "Junio";
				break;
			case 7:
				return "Julio";
				break;
			case 8:
				return "Agosto";
				break;
			case 9:
				return "Septiembre";
				break;
			case 10:
				return "Octubre";
				break;
			case 11:
				return "Noviembre";
				break;
			case 12:
				return "Diciembre";
				break;
		}
	}
}
?>