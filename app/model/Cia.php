<?php
    namespace App\Model;
    require_once __DIR__ . "../../../source/Connection.php";     
    use Exception;
    use Source\Connection;     
   
    class Cia
    {
        public $id;
        public $nome;
        public $tipo;
        public $idAeroporto;
        public $aeroporto;     

        public function salvarCia($cia)
        {
            try 
            {   
                $connection = new Connection();
                $pdo        = $connection->connect();
                if($cia["id"] == null)
                {            
                    $select     = $pdo->prepare("INSERT INTO cia_aerea SET                                                        
                                                        nome = :nome,
                                                        tipo = :tipo,
                                                        id_aeroporto = :id_aeroporto"); 
                    $select->bindValue("nome",filter_var($cia["nome"])); 
                    $select->bindValue("tipo",filter_var($cia["tipo"])); 
                    $select->bindValue("id_aeroporto",filter_var($cia["aeroporto"])); 
                }
                else
                {
                    $select     = $pdo->prepare("UPDATE cia_aerea SET                                                        
                                                            nome = :nome,
                                                            tipo = :tipo,
                                                            id_aeroporto = :id_aeroporto
                                                WHERE id_cia = :id"); 
                    $select->bindValue("nome",filter_var($cia["nome"])); 
                    $select->bindValue("tipo",filter_var($cia["tipo"])); 
                    $select->bindValue("id_aeroporto",filter_var($cia["aeroporto"]));  
                    $select->bindValue("id",filter_var($cia["id"]));  
                }
                $select->execute();
                if($select->rowCount() > 0)
                    return true;   
                else
                    return false;
            }
            catch(\Exception $ex)
            {            
                throw new Exception("Exceção ao salvar cia. Detalhes: " . $ex->getMessage());              
            }  
        }

        public function obterCias()
        {
            try 
            { 
                $cias = array(); 
                $connection = new Connection();
                $pdo        = $connection->connect();
                $select     = $pdo->prepare("SELECT c.id_cia,
                                                    c.nome,
                                                    c.tipo,
                                                    c.id_aeroporto,
                                                    a.nome as aeroporto
                                            FROM cia_aerea c
                                            LEFT JOIN aeroporto a on a.id_aeroporto = c.id_aeroporto");
                $select->execute();
                while($query = $select->fetch(\PDO::FETCH_ASSOC))
                {       
                    $cia = self::CiaFromArray($query);                             
                    $cias[] =  $cia;
                }
                return $cias;
            }
            catch(\Exception $ex)
            {            
                throw new Exception("Exceção ao obter cias. Detalhes: " . $ex->getMessage());              
            }  
        }

        public function excluirCia($id)
        {
            try 
            {          
                $connection = new Connection();
                $pdo        = $connection->connect();
                $select     = $pdo->prepare("DELETE FROM cia_aerea
                                            WHERE id_cia = :id"); 
                $select->bindValue("id",$id); 
                $select->execute();
                if($select->rowCount() > 0)
                    return true;
                else
                    return false;                
            }
            catch(\Exception $ex)
            {            
                if($ex->getCode() == 23000)      
                    throw new Exception("Erro ao excluir companhia aérea: Há aviões vinculados a essa companhia. Exclua-os antes de excluir a companhia.");              
                else
                    throw new Exception("Exceção ao excluir companhia aérea. Detalhes: " . $ex->getMessage());             
            }  
        }

        public function obterPorId($id)
        {
            try 
            {               
                $connection = new Connection();
                $pdo        = $connection->connect();
                $select     = $pdo->prepare("SELECT c.id_cia,
                                                    c.nome,
                                                    c.tipo,
                                                    c.id_aeroporto,
                                                    a.nome as aeroporto
                                            FROM cia_aerea c
                                            LEFT JOIN aeroporto a on a.id_aeroporto = c.id_aeroporto
                                            WHERE c.id_cia = :id"); 
                $select->bindValue("id",$id); 
                $select->execute();
                if($select->rowCount() > 0)
                {
                   
                    $query      = $select->fetch(\PDO::FETCH_ASSOC);                                          
                    $cia  = self::CiaFromArray($query);                                                               
                    return $cia;
                }       
            }
            catch(\Exception $ex)
            {            
                throw new Exception("Exceção ao obter cia. Detalhes: " . $ex->getMessage());              
            }  
        }

        public static function CiaFromArray($array)
        {
            $cia              = new Cia();
            $cia->id          = $array["id_cia"] ?? "";
            $cia->nome        = $array["nome"] ?? "";
            $cia->tipo        = $array["tipo"] ?? "";  
            $cia->idAeroporto = $array["aeroporto"] ?? "";  
            $cia->aeroporto   = $array["aeroporto"] ?? "";                       
            return $cia;                   
        } 
    }
    