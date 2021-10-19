<?php

class MyDatabase{
    private $connection;

    public function __construct($servername, $username, $password, $dbname){
        $this->connection = mysqli_connect($servername, $username,$password, $dbname);

        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function __destruct(){
        mysqli_close($this->connection);
    }

    public function query($sql){
        $databaseResult = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($databaseResult) <= 0)
            return [];

        return mysqli_fetch_all($databaseResult,MYSQLI_ASSOC);
    }

    public function insert($sql,$usuario,$clave,$hash){
        //$this->connection->__construct();
        //$consulta2 = "INSERT INTO usuario (usuario, clave) VALUES (? , ?)";
        $comm = $this->connection->prepare($sql);

        $comm->bind_param("sss",$usuario, $clave,$hash); //ss string , ssi integer , ssb bolean
        $comm->execute();

        //$this->connection->close();
    }

    public function update($sql){
        mysqli_query($this->connection, $sql);
    }
}