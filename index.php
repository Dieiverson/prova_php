<?php
    require_once __DIR__ . "/vendor/autoload.php";
    require_once __DIR__ . "/app/controller/AeroportoController.php";
    require_once __DIR__ . "/app/controller/CiaController.php";
    require_once __DIR__ . "/app/controller/AviaoController.php";

    use App\Model\Aeroporto;
    use CoffeeCode\Router\Router;

    $router = new Router(URL_BASE);
    $router->namespace("app\controller");

    $router->group("Aeroporto");
    $router->get("/","AeroportoController:aeroportosScreen");
    $router->get("/Atualizar/{id}","AeroportoController:aeroportoScreen");
    $router->get("/Cadastrar","AeroportoController:aeroportoScreen");
    $router->get("/Excluir/{id}","AeroportoController:excluirAeroporto");
    $router->post("/Salvar","AeroportoController:salvarAeroporto");

    $router->group("Companhia");
    $router->get("/","CiaController:ciasScreen");
    $router->get("/Atualizar/{id}","CiaController:ciaScreen");
    $router->get("/Cadastrar","CiaController:ciaScreen");
    $router->get("/Excluir/{id}","CiaController:excluirCia");
    $router->post("/Salvar","CiaController:salvarCia");

    $router->group("Aviao");
    $router->get("/","AviaoController:avioesScreen");
    $router->get("/Atualizar/{id}","AviaoController:aviaoScreen");
    $router->get("/Cadastrar","AviaoController:aviaoScreen");
    $router->get("/Excluir/{id}","AviaoController:excluirAviao");
    $router->post("/Salvar","AviaoController:salvarAviao");



   
    $router->group("error");
    $router->get("/{errcode}","ErrorController:error");
    $router->dispatch();

    if($router->error()){

    } 
?>  