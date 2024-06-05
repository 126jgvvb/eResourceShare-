<?php
session_start();

class user{  
    function __construct(){
        $this->dbhost="127.0.0.1";
        $this->dbuser="root";
        $this->dbpass="";
        $this->db="datacenter";
        $this->bcryptOptions=(array('cost'=>14));
       $this->conn=new   mysqli($this->dbhost,$this->dbuser,$this->dbpass,$this->db) or  die("failed   to    create  database".($this->conn)->error);
    
        $sql='CREATE    DATABASE  IF NOT EXISTS  datacenter';
       ($this->conn)->query($sql);
    
        $sql='CREATE    TABLE   IF  NOT EXISTS  user( username  VARCHAR(30)  NOT NULL,password   VARCHAR(70)  NOT NULL)';
        ($this->conn)->query($sql);
    }

    public function createUser($user,$password){
        //user exists?
        $sql="SELECT * FROM user WHERE username='$user'";
        $result=($this->conn)->query($sql);
        if($result->num_rows>0){
            $_SESSION["password_set"]=false;
            header("Location:/temper/login.php");
            echo "<span style='red'>user already exists</span>";
        }
              //new user
        $passwd=password_hash($password,PASSWORD_BCRYPT,$this->bcryptOptions);
        $sql="INSERT INTO user (username,password) VALUES ('$user','$passwd')";
        ($this->conn)->query($sql);

        $_SESSION["password_set"]=true;
        header("Location:/temper/uploader.php");
    }

    public function LoginUser($username,$password){
        $client=explode(" ",$username);
        $client=$client[0];
        //getting username
        $sql="SELECT * FROM user WHERE username='$client'";
        $users=($this->conn)->query($sql);
        $users=$users->fetch_assoc(); //to array format

        if($client!=$users["username"]){ //given name == database name??
          echo "<p>invalid username</p";
          return;
    }

        //getting_password  from    database_for comparison
        $sql="SELECT * FROM user WHERE username='$client'";
        $result=($this->conn)->query($sql);
       
       $clientpassword=$password;
       
     if($result->num_rows>0){
       while($rw=$result->fetch_assoc()){
           if(password_verify($clientpassword,$rw["password"])){
               $_SESSION["password_set"]=true;
           echo "<script>function sh(){return window.location.href='/temper/uploader.php'}; sh()</script>";
           }
           else   echo    "<p><span   style='color:red'>Invalid password,try  again</span></p>";
       }
       }

    }

}
?>