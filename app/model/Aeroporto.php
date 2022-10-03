<?php
    namespace App\Model;
    require_once __DIR__ . "../../../source/Connection.php";     
    use Exception;
    use Source\Connection;     
   
    class Aeroporto
    {
        public $id;
        public $nome;
        public $sigla;      
     
        function __construct($id = null, $nome = null, $sigla = null) 
        {
            $this->id           = $id;
            $this->nome         = $nome;
            $this->sigla         = $sigla;       
        }

        public function salvarAeroporto($aeroporto)
        {
            try 
            {   
                $connection = new Connection();
                $pdo        = $connection->connect();
                if($aeroporto["id"] == null)
                {            
                    $select     = $pdo->prepare("INSERT INTO aeroporto SET                                                        
                                                        nome = :nome,
                                                        sigla = :sigla"); 
                    $select->bindValue("nome",filter_var($aeroporto["nome"])); 
                    $select->bindValue("sigla",filter_var($aeroporto["sigla"])); 
                }
                else
                {
                    $select     = $pdo->prepare("UPDATE aeroporto SET                                                       
                                                        nome = :nome,
                                                        sigla = :sigla
                                                WHERE id_aeroporto = :id"); 
                    $select->bindValue("nome",filter_var($aeroporto["nome"])); 
                    $select->bindValue("sigla",filter_var($aeroporto["sigla"])); 
                    $select->bindValue("id",filter_var($aeroporto["id"])); 
                }
                $select->execute();
                if($select->rowCount() > 0)
                    return true;   
                else
                    return false;
            }
            catch(\Exception $ex)
            {            
                throw new Exception("Exceção ao salvar aeroporto. Detalhes: " . $ex->getMessage());              
            }  
        }

        public function obterAeroportos()
        {
            try 
            { 
                $aeroportos = array(); 
                $connection = new Connection();
                $pdo        = $connection->connect();
                $select     = $pdo->prepare("SELECT id_aeroporto,
                                                    nome,
                                                    sigla
                                            FROM aeroporto");
                $select->execute();
                while($query = $select->fetch(\PDO::FETCH_ASSOC))
                {       
                    $aeroporto = self::AeroportoFromArray($query);                             
                    $aeroportos[] =  $aeroporto;
                }
                return $aeroportos;
            }
            catch(\Exception $ex)
            {            
                throw new Exception("Exceção ao obter aeroportos. Detalhes: " . $ex->getMessage());              
            }  
        }

        public function excluirAeroporto($id)
        {
            try 
            {          
                $connection = new Connection();
                $pdo        = $connection->connect();
                $select     = $pdo->prepare("DELETE FROM aeroporto
                                            WHERE id_aeroporto = :id"); 
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
                    throw new Exception("Erro ao excluir aeroporto: Há aviões ou companhias aéreas vinculadas a esse aeroporto. Exclua-as antes de excluir o aeroporto.");              
                else
                    throw new Exception("Exceção ao excluir aeroporto. Detalhes: " . $ex->getMessage());              

            }  
        }

        public function obterPorId($id)
        {
            try 
            {               
                $connection = new Connection();
                $pdo        = $connection->connect();
                $select     = $pdo->prepare("SELECT id_aeroporto,
                                                    nome,
                                                    sigla
                                            FROM aeroporto
                                            WHERE id_aeroporto = :id"); 
                $select->bindValue("id",$id); 
                $select->execute();
                if($select->rowCount() > 0)
                {
                   
                    $query      = $select->fetch(\PDO::FETCH_ASSOC);                                          
                    $aeroporto  = self::AeroportoFromArray($query);                                                               
                    return $aeroporto;
                }       
            }
            catch(\Exception $ex)
            {            
                throw new Exception("Exceção ao obter aeroporto. Detalhes: " . $ex->getMessage());              
            }  
        }

        public static function AeroportoFromArray($array)
        {
            $aeroporto          = new Aeroporto();
            $aeroporto->id      = $array["id_aeroporto"] ?? "";
            $aeroporto->nome    = $array["nome"] ?? "";
            $aeroporto->sigla   = $array["sigla"] ?? "";                       
            return $aeroporto;                
        } 
    }
    