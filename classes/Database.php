<?php 
class Database{
    private $serverName;
    private $userName;
    private $password;
    private $datatable;
    private $dbCon;        
    
    function __construct($_servername,$_username,$_password,$_datatable){
        $this->serverName = $_servername;
        $this->userName = $_username;
        $this->password = $_password;
        $this->datatable = $_datatable;      
    }
    
    function connectToDatabase(){
        if(empty($this->dbCon)){
            $this->dbCon = new mysqli($this->serverName,$this->userName,$this->password,$this->datatable);
             if ($this->dbCon->connect_errno) {
                die("Verbindung fehlgeschlagen: " . $this->dbCon->connect_error);
             }
            $this->dbCon->query('SET CHARACTER SET utf8');
        }
    }
    
    function query($queryString){
        $query = $this->dbCon->query($queryString);             
        return $query;
    }
    
    function isConnected(){
        return !empty($this->dbCon);
    }
    
    
    
    function disconnetFromDatabase(){
        if(!empty($dbCon)){
            $dbCon->close();
        }
    }

    
}


?>