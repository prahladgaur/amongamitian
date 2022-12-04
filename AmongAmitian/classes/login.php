<?php


class Login
{
	private $error = "";
	public function evaluate($data)
	{
    
        $email = addslashes($data['email']);
        $password = addslashes($data['password']);
        

    	$query = "select * from users where email='$email' limit 1 ";
    	

    	//return $query;
        $DB = new Database();
        $results=$DB->read($query);

        if($results)
           {
               $row = $results[0];
               if($this->hash_text($password) == $row['password'])
                   {
                   	  //create session data
                       $_SESSION['amomgamity_userid'] = $row['userid'];
                   }
               else
                   {
                        $this->error.= "Wrong email or password<br>";
                   }
           }
        else
           {
        	   $this->error.= "Wrong email or password<br>";
           }
        return $this->error;
	}

//password hashing function
   private function hash_text($text)
   {
      $text = hash("sha1", $text);
      return $text;
   }

   public function check_login($id)
   {      
    if(is_numeric($id))
    {
        $query= "select * from users where userid = '$id' limit 1";

        $DB = new Database();
        $results =$DB->read($query);

        if($results)
        {
            $user_data = $results[0];
            return $user_data;
        }
        else
        {
            header("Location: login.php");
            die;
        }
              
                
    }
    else
    {
        header("Location: login.php");
         die;
    }
  }

}