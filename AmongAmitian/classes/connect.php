<?php

class Database
{
   private $host= "localhost";
   private $username="root";
   private $password="";
   private $db="amomgdb";

   function connect()
   {
      $connection = mysqli_connect($this->host,$this->username,$this->password,$this->db);
      return $connection;
   }

   function read($query)
   {
       $conn = $this->connect();
       $results = mysqli_query($conn,$query);
       if(!$results)
   	   {
   	  	return false;
   	   }
   	   else
   	   {  
   	   	  $data=false;
           }  
          // $row = mysqli_fetch_assoc($results); 
          while($row = mysqli_fetch_assoc($results))
           {
	          $data[]=$row;
           }
           return $data;
   }
   
   function save($query)
   {
   	  $conn = $this->connect();
   	  $results = mysqli_query($conn,$query);
        if(!$results)
         {
         return false;
         }
         else
         {
            return true;
         }
   
   }  

}

$DB = new Database();

$query = "select * from users";
$data = $DB->read($query);

//echo "<pre>";
//print_r($data);

//echo "</pre>";  
