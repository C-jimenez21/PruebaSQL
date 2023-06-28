<?php
    require "../vendor/autoload.php";
    $dotenv = Dotenv\Dotenv::createImmutable("../")->load();
    new \App\connect();
    $router = new \Bramus\Router\Router();
    
    $router->mount("/persona", function() use($router){
        $router->post("/", function(){
            $_DATA = json_decode(file_get_contents("php://input"));
            $cox = new \App\Connect();
            $res = $cox->con->prepare("INSERT INTO persona(Nombre, Apellido1, Apellido2, DNI) VALUES (:nom, :ap1, :ap2, :dni)");
            $res->bindParam(":nom", $_DATA->nom);
            $res->bindParam(":ap1", $_DATA->ap1);
            $res->bindParam(":ap2", $_DATA->ap2);
            $res->bindParam(":dni", $_DATA->dni);
            $res->execute();
            print_r($res->rowCount());
        });
        $router->put("/", function (){
            $_DATA = json_decode(file_get_contents("php://input"));
            $cox = new \App\Connect();
            $res = $cox->con->prepare("UPDATE persona SET Nombre = :nom, Apellido1 = :ape1, Apellido2 = :ape2, DNI = :dni WHERE id = :id");
            $res->bindParam(':id', $_DATA->id);
            $res->bindParam(':nom', $_DATA->nom);
            $res->bindParam(':ape1', $_DATA->ape1);
            $res->bindParam(':ape2', $_DATA->ape2);
            $res->bindParam(':dni', $_DATA->dni);
            $res->execute();
            print_r($res->rowCount());
        });

        $router->get("/", function(){
            $cox = new \App\Connect();
            $res = $cox->con->prepare("SELECT * FROM persona");
            $res->execute();
           echo json_encode($res->fetchAll(\PDO::FETCH_ASSOC));
        });
        
        $router->delete("/", function(){
            $_DATA = json_decode(file_get_contents("php://input"));
            $cox = new \App\Connect();
            $res = $cox->con->prepare("DELETE FROM persona WHERE id = :id");
            $res->bindParam(":id", $_DATA->id);
            $res->execute();
            print_r($res->rowCount());
        });
        
    });
    
    $router->mount("/coche", function() use ($router){
        $router->get("/", "\App\crudCoche@getAll");
        $router->post("/", "\App\crudCoche@postAll");
        $router->put("/", "\App\crudCoche@putAll");
        $router->delete("/", "\App\crudCoche@deleteAll");
    });
    
    
    
    $router->run();
?>