<?php 
//http://localhost/test1/developer/api-rest/?user&unique=1
//http://carloscordova.com/developer/api-rest/?user&unique=1
//create by Carlos Cordova
//URL: http://carloscordova.com/
class Db{
  private $conexion;  private $servername = "localhost"; private $username = "root"; private $password = ""; private $dbname = "cordova_developer";
  private function conect(){ 
 
$this->conexion = new mysqli($this->servername, $this->username, $this->password,$this->dbname);
if ($this->conexion->connect_error) {
  return array("conect"=>false);
}
return array("conect"=>true);
  }
 //-------------------------------------------------------------------------------------------   
  public function deleteconsulta($num){ 
    $conect =$this->conect();
    if ($conect["conect"]) {
  $sql="UPDATE  `api_user` SET  `datedelete`=NOW() WHERE  `datedelete` is null and `id` = ".intval($num)." ;";   
   
if ($this->conexion->query($sql) === TRUE) {
 
  $this->conexion->close();
 
        return array("conect"=>true,"msg"=>" record delete successfully");
    } 
      else{
         return array("conect"=>false,"error"=>"error al eliminar","msg"=>"created failed: " . $this->conexion->error,"query"=>$sql,"data"=>$val);
      }
 
 
    }else{
 return array("conect"=>false,"error"=>"error al conectar","msg"=>"Connection failed: " . $this->conexion->connect_error);
 
    }
   }
  
 //-------------------------------------------------------------------------------------------    
  public function getconsulta($val,$num){ 
    $conect =$this->conect();
    if ($conect["conect"]) {
      $sql="";
      if ($val) {
        $sql = "SELECT * FROM api_user where datedelete is null";
      }else{
 $sql = "SELECT * FROM api_user where  datedelete is null and id=".intval($num);
      }
    
$result = $this->conexion->query($sql);
$rows=array();
if ($result->num_rows > 0) {
  
  while($row = $result->fetch_assoc()) {
  $rows[]=$row;
  }
}
$this->conexion->close();
return array("conect"=>true,"msg"=>"Connection ok", "data"=>$rows);

    }else{
 return array("conect"=>false,"error"=>"error al conectar","msg"=>"Connection failed: " . $this->conexion->connect_error);
//echo $this->conexion->connect_error;
    }
   }
  //------------------------------------------------------------------------------------------- 
   public function setconsulta($val,$agent,$remote){ 
    $conect =$this->conect();
    if ($conect["conect"]) {
      $sql="";
      if (strtoupper($val->action)=="INSERT") {
       $sql="INSERT INTO  `api_user` (`nombre`, `apellido`, `ciudad`, `pais`, `genero`, `useragente`, `remoteip`) VALUES 
      ('".$this->conexion->real_escape_string($val->nombre)."', '".$this->conexion->real_escape_string($val->apellido)."', '".$this->conexion->real_escape_string($val->ciudad)."', '".$this->conexion->real_escape_string($val->pais)."', '".$this->conexion->real_escape_string($val->genero)."', '".$agent."', '".$remote."');";
      }
      else{
         $sql="UPDATE  `api_user` SET `nombre`='".$this->conexion->real_escape_string($val->nombre)."', `apellido`='".$this->conexion->real_escape_string($val->apellido)."', `ciudad`='".$this->conexion->real_escape_string($val->ciudad)."', `pais`='".$this->conexion->real_escape_string($val->pais)."', `genero`='".$this->conexion->real_escape_string($val->genero)."', `useragente`='".$agent."', `remoteip`='".$remote."' , `dateupdate`=NOW() WHERE `id` = ".intval($val->id)." and datedelete is null ;";
      }
     
        
//$result = $this->conexion->query($sql);
if ($this->conexion->query($sql) === TRUE) {
 
 if (strtoupper($val->action)=="INSERT") {
     $latest_id =  mysqli_insert_id($this->conexion);  
      return array("conect"=>true,"msg"=>"New record  successfully","latest_id"=>$latest_id);
      }
      else{
        return array("conect"=>true,"msg"=>" record update successfully");
      }
      $this->conexion->close();
} else {
  
  if (strtoupper($val->action)=="INSERT") {
      return array("conect"=>false,"error"=>"error al insertar","msg"=>"created failed: " . $this->conexion->error,"query"=>$sql,"data"=>$val);
      }
      else{
         return array("conect"=>false,"error"=>"error al actualizar","msg"=>"created failed: " . $this->conexion->error,"query"=>$sql,"data"=>$val);
      }
 
}
  
    }else{
 return array("conect"=>false,"error"=>"error al conectar","msg"=>"Connection failed: " . $this->conexion->connect_error);
//echo $this->conexion->connect_error;
    }
   }
  //------------------------------------------------------------------------------------------- 
   
}
?>