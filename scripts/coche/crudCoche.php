<?php
namespace App;
class crudCoche extends connect{
    public $_DATA;
    function __construct(){
        parent::__construct();
        $this->_DATA =(file_get_contents('php://input')=="") ? ["Mensaje"=>"Envien datos"] : json_decode(file_get_contents('php://input',true));
    }
    public function getAll(){
        $res = $this->con->prepare("SELECT * FROM persona");
        $res->execute();
        echo json_encode($res->fetchAll(\PDO::FETCH_ASSOC));
    }
    public function postAll(){
        $res =$this->con->prepare("INSERT INTO persona(Nombre, Apellido1, Apellido2, DNI) VALUES(:nom,:ape1,:ape2,:dni)");
        $res->bindParam(':nom', $this->_DATA->nom);
        $res->bindParam(':ape1', $this->_DATA->ape1);
        $res->bindParam(':ape2', $this->_DATA->ape2);
        $res->bindParam(':dni', $this->_DATA->dni);
        $res->execute();
        print_r($res->rowCount());
    }
    public function putAll(){
        $res = $this->con->prepare("UPDATE persona SET Nombre = :nom, Apellido1 = :ape1, Apellido2 = :ape2, DNI = :dni WHERE id = :id");
        $res->bindParam(':id', $this->_DATA->id);
        $res->bindParam(':nom', $this->_DATA->nom);
        $res->bindParam(':ape1', $this->_DATA->ape1);
        $res->bindParam(':ape2', $this->_DATA->ape2);
        $res->bindParam(':dni', $this->_DATA->dni);
        $res->execute();
        print_r($res->rowCount());
    }
    public function deleteAll(){
        $res = $this->con->prepare("DELETE FROM persona WHERE id = :id");
        $res->bindParam(':id', $this->_DATA->id);
        $res->execute();
        print_r($res->rowCount());
    }
}

?>