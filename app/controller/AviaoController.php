<?php
    namespace App\Controller;
    require_once __DIR__ . "/GeneralController.php";
    require_once __DIR__ . "./../model/Aviao.php";
    require_once __DIR__ . "./../model/Cia.php";
 
    use App\Controller\GeneralController;
    use App\Model\Aviao;
    use App\Model\Cia;
    use Exception;

    $aviaoClass = null;
    $ciaClass = null;
    class AviaoController extends GeneralController
    {    
        function __construct()
        {
            $this->aviaoClass = new Aviao();
            $this->ciaClass = new Cia();
        } 
        
        function avioesScreen()
        {
            try
            {
                $avioes = $this->aviaoClass->obterAvioes();
                $this->load("avioes_screen",["avioes" => $avioes]);
            }   
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        } 

        function aviaoScreen($data)
        {
            try
            {   $aviao = null;
                if($data  != null)
                {
                    $id = filter_var($data['id']);                   
                    $aviao = $this->aviaoClass->obterPorId($id);                   
                }           
                $cias = $this->ciaClass->obterCias();      
                $this->load("aviao_screen",["aviao" => $aviao, "cias" => $cias]);
            }   
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        } 
        
        function salvarAviao($data)
        {
            try
            {                     
                $retorno = $this->aviaoClass->salvarAviao($data);  
                header("location:".URL_BASE."/Aviao");
            }   
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        } 

        function excluirAviao($data)
        {
            try
            {   
                if($data["id"] == null)
                    die();               
                $retorno = $this->aviaoClass->excluirAviao(filter_var($data["id"]));  
                header("location:".URL_BASE."/Aviao");
            }   
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        } 
    }
?>