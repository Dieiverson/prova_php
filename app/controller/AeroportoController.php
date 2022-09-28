<?php
    namespace App\Controller;
    require_once __DIR__ . "/GeneralController.php";
    require_once __DIR__ . "./../model/Aeroporto.php";
 
    use App\Controller\GeneralController;
    use App\Model\Aeroporto;
    use Exception;

    $aeroportoClass = null;
    class AeroportoController extends GeneralController
    {    
        function __construct()
        {
            $this->aeroportoClass = new Aeroporto();
        }

        function aeroportosScreen()
        {
            try
            {
                $aeroportos = $this->aeroportoClass->obterAeroportos();
                $this->load("aeroportos_screen",["aeroportos" => $aeroportos]);
            }   
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        } 

        function aeroportoScreen($data)
        {
            try
            {   $aeroporto = null;
                if($data  != null)
                {
                    $id = filter_var($data['id']);                   
                    $aeroporto = $this->aeroportoClass->obterPorId($id);                   
                }              
                $this->load("aeroporto_screen",["aeroporto" => $aeroporto]);
            }   
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        } 
        
        function salvarAeroporto($data)
        {
            try
            {                     
                $retorno = $this->aeroportoClass->salvarAeroporto($data);  
                header("location:".URL_BASE."/Aeroporto");
            }   
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        } 

        function excluirAeroporto($data)
        {
            try
            {   
                if($data["id"] == null)
                    die();               
                $retorno = $this->aeroportoClass->excluirAeroporto(filter_var($data["id"]));  
                header("location:".URL_BASE."/Aeroporto");
            }   
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        } 
    }
?>