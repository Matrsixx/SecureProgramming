<?php 
    class Transaction{
        public static $instance = null;
        
        public static function getInstance(){
            if(self::$instance == null){
                self::$instance = new Transaction();
            }
            return self::$instance;
        }

        public function getTransaction($type, $id){
            $conn = Database::getInstance()->getConnection();
            
            if($type == "Ongoing"){
                $query = "SELECT * FROM transactionheader JOIN tenant ON tenant.id=transactionheader.TenantId WHERE transactionheader.TransactionProgress=1 AND transactionheader.UsersId=?";
            }else if($type == "Past"){
                $query = "SELECT * FROM transactionheader JOIN tenant ON tenant.id=transactionheader.TenantId WHERE transactionheader.TransactionProgress=0 AND transactionheader.UsersId=?";
            }
            
            $stmt = $conn->prepare($query);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            return $result;        
        }
    }
?>