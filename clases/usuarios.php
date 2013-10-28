<?
class usuario{
	private $id_usuario; //id de usuario
	private $username; //Alias para inicio de sesion de usuario
	private $clave; //password o contraseña de acceso para usuario
	private $fullname; //nombre completo de usuario
	private $fechaingreso; //fecha de registro
	private $fechavence; //fecha de vencimiento de clave (+90 dias despues de registrado)
	private $id_cliente; //nombre de cliente de donde se registra, 0 para usuarios versanet
	private $lastingreso; //fecha de ultimo ingreso
	private $gv_role; //Rol de usuario
	private $gv_restatus; //Estado del usuario
	public $mensaje;
	
	//private	$Permiso; //permiso para cada modulo respecto a usuario
	//private $id_modulo; // identificacion de modulo de acceso para usuario
	//private $id_tipo_usuario; //identificador de si es usuario registrado o de mas privilegios
		
	function __construct() //constructor de clase para usuario
	{
		$this->id_usuario = 0;
		$this->username = '';
		$this->clave = '';
		$this->fullname = '';
		$this->fechaingreso = '';
		$this->fechavence = '';
		$this->id_cliente = '';
		$this->lastingreso = '';
		$this->gv_role = '';
		$this->gv_restatus = '';
		$this->mensaje = ''; 
		//$this->id_modulo=array();
		//$this->id_tipo_usuario = '';
	}
	public function LoginUsuario($alias,$password, $enlace){
		$rol = '';
		$estado = '';
		$registrado = false;
		$hoy = date("Y-m-d");  
		
		$sql_login = "SELECT * FROM g_user WHERE nombre = '".$alias."' AND clave = '".$password."'";	
		$result_login = mysql_query($sql_login, $enlace);
		$cantidad_registros = mysql_num_rows($result_login);
		if($cantidad_registros == 1){
			while($filas=mysql_fetch_array($result_login)){
				$this->id_usuario = $filas['id_user'];
				$this->fullname = $filas['fullname'];
				$this->id_cliente = $filas['id_cliente'];
				$this->gv_role = $filas['gv_role'];
				$this->gv_restatus = $filas['gv_restatus'];
				$this->fechavence = $filas['fechavence'];
			}
			$resta = strtotime($this->fechavence) - strtotime($hoy);
			if($this->gv_restatus != 1){
				$this->mensaje = 'Su cuenta no se encuentra activa';
				$registrado = false;
				return $registrado;
			}else{$registrado = true;}
			if($resta<=0){
				$this->mensaje = 'Su contrase&ntilde;a ha expirado';
				$registrado = false;
				return $registrado;
			}else{$registrado = true; return $registrado;}
		}else{
			$registrado = false;
			return $registrado;
		}
		
	}
	
	public function datosBasicos(){
		return array($this->id_usuario, $this->fullname, $this->id_cliente, $this->gv_role);
	}
	
	public function getUltimoIngreso($id_usuario, $enlace){
		$query_acceso = "SELECT lastingreso FROM g_user WHERE id_user = " . $id_usuario;
		$result = mysql_query($query_acceso, $enlace);
		return mysql_result($result, 0, "lastingreso");
	}
	
	public function actualizarUltimoIngreso($enlace){
		$query_update = "UPDATE g_user SET lastingreso = '".date("Y-m-d H:i:s")."', login_now = 1 WHERE id_user = " . $this->id_usuario ;
		mysql_query($query_update, $enlace);
	}
	
	public function desconectar($enlace, $id_usuario){
		$query_update = "UPDATE g_user SET login_now = 0 WHERE id_user = " . $id_usuario ;
		mysql_query($query_update, $enlace);
	}
}// fin de clase Usuario
?>