<?php
//http://localhost/test1/developer/api-rest/?user&unique=1
//http://carloscordova.com/developer/api-rest/?user&unique=1
//create by Carlos Cordova
//URL: http://carloscordova.com/
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
//error_reporting(E_ALL);
require_once('tools/db.php');
class Api {

private function request(){           
         $method = $_SERVER['REQUEST_METHOD'];

switch($method) {
  //case 'PUT':
    //  $this->updatedata();
    //  break;
 
  case 'DELETE':
      $this->deletedata();
      break;
 
  case 'GET':
       $this->getdata();
      break;
      case 'POST':
       $this->setdata();
      break;
 
  default:
      header('HTTP/1.1 405 Method Not Allowed');
      header('Allow: GET, PUT, DELETE');
      header('Content-Type: application/json');
      break;
  }



}
 //------------------------------------------------------------------------------------------- 
private function deletedata(){ 
 $db = new Db();	
  if(isset($_GET["user"]) && isset($_GET["unique"])){
		$data = $db->deleteconsulta($_GET["unique"]);
			if ($data["conect"]) {
			header("HTTP/1.1 200 OK");
		echo json_encode($data);
		}
		else{
				header("HTTP/1.1 500 Internal Server Error");
			echo json_encode(array("error"=>$data["error"],"msg"=>$data["msg"]));
		}

	}
	else{
		header("HTTP/1.1 400 Bad Request");
	}
}
 //------------------------------------------------------------------------------------------- 
private function getdata(){ 
 $db = new Db();	
	if(isset($_GET["user"]) && !isset($_GET["unique"])){
		$data = $db->getconsulta(true,0);
		if ($data["conect"]) {
			header("HTTP/1.1 200 OK");
		echo json_encode($data);
		}
		else{
				header("HTTP/1.1 500 Internal Server Error");
		echo json_encode(array("error"=>$data["error"],"msg"=>$data["msg"]));
		}
		
	}
	else if(isset($_GET["user"]) && isset($_GET["unique"])){
		$data = $db->getconsulta(false,$_GET["unique"]);
			if ($data["conect"]) {
			header("HTTP/1.1 200 OK");
		echo json_encode($data);
		}
		else{
				header("HTTP/1.1 500 Internal Server Error");
			echo json_encode(array("error"=>$data["error"],"msg"=>$data["msg"]));
		}

	}
	else{
		header("HTTP/1.1 400 Bad Request");
	}
}
 //------------------------------------------------------------------------------------------- 
private function setdata(){ 
 $db = new Db();	
	if(isset($_GET["user"])  && isset($_POST["json"])){

		$jsonval= $this->validajson($_POST["json"]);
		$dataval= $this->validadata($_POST["json"]);
		if ($jsonval && $dataval ) {
			//$decode= json_decode(json);
			$data = $db->setconsulta(json_decode($_POST["json"]),$_SERVER['HTTP_USER_AGENT'],$_SERVER['REMOTE_ADDR']);
					if ($data["conect"]) {
						$val=json_decode($_POST["json"]);
						 if (strtoupper($val->action)=="INSERT") {
      header("HTTP/1.1 201 Created");
      }
      else{
       	header("HTTP/1.1 200 OK");
      }
						
						echo json_encode($data);
					}
					else{
							header("HTTP/1.1 409 Conflict");
					echo json_encode(array("error"=>$data["error"],"msg"=>$data["msg"],"query"=>$data["sql"],"data"=>$data["data"]));
					}
		}
		else{
		header("HTTP/1.1 400 Bad Request");	
		}
	}	
	else{
		header("HTTP/1.1 400 Bad Request");
	}
}
 //------------------------------------------------------------------------------------------- 

private function validajson($json){
$json= json_decode($json);
$bandera=false;
		if ($json) {
						if (isset($json->id) && !empty($json->id) &&
							isset($json->nombre) && !empty($json->nombre) &&
							isset($json->apellido) && !empty($json->apellido) &&
							isset($json->ciudad) && !empty($json->ciudad) &&
							isset($json->pais) && !empty($json->pais) &&
							isset($json->genero) && !empty($json->genero) &&
								isset($json->action) && !empty($json->action) 
					) {
							$bandera=true;
						}else
					{
						$bandera=false;
					}
		}
		else
		{
			$bandera=false;
		}
		return $bandera;
}
private function validadata($json){
$json= json_decode($json);
$bandera=false;
	if (strtoupper($json->genero)=="H" || strtoupper($json->genero)=="M"){
		if (strtoupper($json->action)=="INSERT" || strtoupper($json->action)=="UPDATE"){
				$bandera=true;
						}else{
						$bandera=false;
					}

						}
						else{
						$bandera=false;
					}
	
		return $bandera;
}
public function procesarLlamada() {
$this->request();
}

	}//end class

 $api = new Api();
 $api->procesarLlamada();
?>
