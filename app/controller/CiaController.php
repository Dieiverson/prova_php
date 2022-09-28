<?php
    namespace App\Controller;
    require_once __DIR__ . "/GeneralController.php";
    require_once __DIR__ . "./../model/Cia.php";
    require_once __DIR__ . "./../model/Aeroporto.php";
 
    use App\Controller\GeneralController;
    use App\Model\Cia;
    use App\Model\Aeroporto;
    use Exception;

    $ciaClass = null;
    $aeroportoClass = null;
    class CiaController extends GeneralController
    {    
        function __construct()
        {
            $this->ciaClass = new Cia();
            $this->aeroportoClass = new Aeroporto();
        }

        function ciasScreen()
        {
            try
            {
                $cias = $this->ciaClass->obterCias();
               
                $this->load("cias_screen",["companhias" => $cias]);
            }   
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        } 

        function ciaScreen($data)
        {
            try
            {   $cia= null;
                if($data  != null)
                {
                    $id = filter_var($data['id']);                   
                    $cia= $this->ciaClass->obterPorId($id);                   
                } 
                $aeroportos = $this->aeroportoClass->obterAeroportos();             
                $this->load("cia_screen",["cia" => $cia, "aeroportos" => $aeroportos]);
            }   
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        } 
        
        function salvarCia($data)
        {
            try
            {                     
                $retorno = $this->ciaClass->salvarCia($data);  
                header("location:".URL_BASE."/Companhia");
            }   
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        } 

        function excluirCia($data)
        {
            try
            {   
                if($data["id"] == null)
                    die();               
                $retorno = $this->ciaClass->excluirCia(filter_var($data["id"]));  
                header("location:".URL_BASE."/Companhia");
            }   
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }         
    }
?>