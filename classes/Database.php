<?php 

class Database{
    private $serverName;
    private $userName;
    private $password;
    private $dbCon;
            
    __consturct($sname,$uname,$pw){
        this.$serverName = $sname;
        this.$userName = $uname;
        this.$password = $pw;
    }
    
    function connectToDatabase(){
        if(empty($dbCon)){
            $dbCon = new mysqli($serverName,$userName,$password);
        }
    }
    
    function query($queryString){
        
    }
    
    function isConnected(){
        return !empty($dbCon);
    }
    
    function disconnetFromDatabase(){
        if(!empty($dbCon)){
            $dbCon->close();
        }
    }

    
}


?>