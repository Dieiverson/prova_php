<?php
    namespace App\Model;
    require_once __DIR__ . "../../../source/Connection.php";     
    use Exception;
    use Source\Connection;     
   
    class Aviao
    {
        public $id;
        public $marca;
        public $modelo;
        public $idCia;
        public $cia;
     
        function __construct($id = null, $marca = null, $modelo = null, $idCia = null) 
        {
            $this->id           = $id;
            $this->marca        = $marca;
            $this->modelo       = $modelo;
            $this->idCia        = $idCia;           
        }
        public function salvarAviao($aviao)
        {
            try 
            {   
                $connection = new Connection();
                $pdo        = $connection->connect();
                if($aviao["id"] == null)
                {            
                    $select     = $pdo->prepare("INSERT INTO aviao SET                                                        
                                                        marca = :marca,
                                                        modelo = :modelo,
                                                        id_cia = :id_cia"); 
                    $select->bindValue("marca",filter_var($aviao["marca"])); 
                    $select->bindValue("modelo",filter_var($aviao["modelo"])); 
                    $select->bindValue("id_cia",filter_var($aviao["companhia"])); 
                }
                else
                {
                    $select     = $pdo->prepare("UPDATE aviao SET                                                        
                                                            marca = :marca,
                                                            modelo = :modelo,
                                                            id_cia = :id_cia
                                                WHERE id_aviao = :id"); 
                    $select->bindValue("marca",filter_var($aviao["marca"])); 
                    $select->bindValue("modelo",filter_var($aviao["modelo"])); 
                    $select->bindValue("id_cia",filter_var($aviao["companhia"])); 
                    $select->bindValue("id",filter_var($aviao["id"]));  
                }
                $select->execute();
                if($select->rowCount() > 0)
                    return true;   
                else
                    return false;
            }
            catch(\Exception $ex)
            {            
                throw new Exception("Exceção ao salvar avião. Detalhes: " . $ex->getMessage());              
            }  
        }

        public function obterAvioes()
        {
            try 
            { 
                $avioes = array(); 
                $connection = new Connection();
                $pdo        = $connection->connect();
                $select     = $pdo->prepare("SELECT id_aviao,
                                                    a.marca,
                                                    a.modelo,                                                    
                                                    a.id_cia,
                                                    c.nome as companhia
                                            FROM aviao a
                                            LEFT JOIN cia_aerea c on c.id_cia = a.id_cia");
                $select->execute();
                while($query = $select->fetch(\PDO::FETCH_ASSOC))
                {       
                    $aviao = self::AviaoFromArray($query);                             
                    $avioes[] =  $aviao;
                }
                return $avioes;
            }
            catch(\Exception $ex)
            {            
                throw new Exception("Exceção ao obter aviões. Detalhes: " . $ex->getMessage());              
            }  
        }

        public function excluirAviao($id)
        {
            try 
            {          
                $connection = new Connection();
                $pdo        = $connection->connect();
                $select     = $pdo->prepare("DELETE FROM aviao
                                            WHERE id_aviao = :id"); 
                $select->bindValue("id",$id); 
                $select->execute();
                if($select->rowCount() > 0)
                    return true;
                else
                    return false;                
            }
            catch(\Exception $ex)
            {            
                throw new Exception("Exceção ao excluir avião. Detalhes: " . $ex->getMessage());              
            }  
        }

        public function obterPorId($id)
        {
            try 
            {               
                $connection = new Connection();
                $pdo        = $connection->connect();
                $select     = $pdo->prepare("SELECT id_aviao,
                                                    a.marca,
                                                    a.modelo,                                                    
                                                    a.id_cia,
                                                    c.nome as companhia
                                            FROM aviao a
                                            LEFT JOIN cia_aerea c on c.id_cia = a.id_cia
                                            WHERE a.id_aviao = :id"); 
                $select->bindValue("id",$id); 
                $select->execute();
                if($select->rowCount() > 0)
                {                   
                    $query = $select->fetch(\PDO::FETCH_ASSOC);                                          
                    $aviao = self::AviaoFromArray($query);                                                               
                    return $aviao;
                }       
            }
            catch(\Exception $ex)
            {            
                throw new Exception("Exceção ao obter avião. Detalhes: " . $ex->getMessage());              
            }  
        }

        public static function AviaoFromArray($array)
        {
            $aviao          = new Aviao();
            $aviao->id      = $array["id_aviao"] ?? "";
            $aviao->marca   = $array["marca"] ?? "";
            $aviao->modelo  = $array["modelo"] ?? "";  
            $aviao->idCia   = $array["id_cia"] ?? "";  
            $aviao->cia     = $array["companhia"] ?? "";                       
            return $aviao;                   
        } 
    }
    