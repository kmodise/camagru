<?php
// $ccc = New dbhandler extends dbhandler();
// $ccc->connect();
class createuser{
    private $email;
    private $name;
    private $uname;
    private $passw;
    private $conns;
    public function __construct($email, $name, $uname, $passw)
    {
        include('./connection.php');
        $this->conns = $conn;
        $this->email = $email;
        $this->name = $name;
        $this->uname = $uname;
        $this->passw = $passw;
    }    
    public function add_user(){
        $sql = 'INSERT INTO users(username, fullname, email, passwd) VALUES (:username, :fullname, :email, :passwd)'; echo 'a';
        $stmt = $this->conns->prepare($sql); echo 'b';
        $stmt->bindParam(":username", $this->uname);  echo 'c';
        $stmt->bindParam(":fullname", $this->name);  echo 'd';
        $stmt->bindParam(":email", $this->email);  echo 'e';
        $stmt->bindParam(":passwd", hash("md5",$this->passw)); echo 'f'; 
        $stmt->execute(); echo 'g';
        echo "qwe";
    }
    public function __destruct(){
        $this->conns = NULL;
    }
}
?>