<?php

class Signup
{
	private $error = "";
	public function evaluate($data)
	{
        foreach ($data as $key => $value)
         {
        	// code...
        	if(empty($value))
        	{
        		$this->error = $this->error.$key." is empty! ";
        	}

            if($key=="email")
            {
                if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $value))
                {
                $this->error = $this->error."Invalid Email! ";
                }
            }

            if($key=="first_name")
            {
                if(is_numeric($value))
                {
                $this->error = $this->error."first name cant be a numeric ";
                }

                if(strstr($value, " "))
                {
                $this->error = $this->error."first name cant have spaces ";
                }
            }

             if($key=="last_name")
            {
                if(is_numeric($value))
                {
                $this->error = $this->error."last name cant be a numeric ";
                }

                if(strstr($value, " "))
                {
                $this->error = $this->error."first name cant have spaces";
                }
            }

        }

        if($this->error == "")
        {
            $this->create_user($data);
        }
        else
        {
        	return $this->error;
        }
	}

	public function create_user($data)
	{
    
    $first_name = ucfirst($data['first_name']);
    $last_name = ucfirst($data['last_name']);
    $gender = $data['gender'];
    $email = $data['email'];
    $password = $data['password'];

    $password = hash("sha1", $password);
    //create these
    $url_address = strtolower($first_name).".".strtolower($last_name);
    $userid = $this->create_userid();

	$query = "insert into users 
	(userid,first_name,last_name,gender,email,password,url_address)
	values
	('$userid','$first_name','$last_name','$gender','$email','$password','$url_address')";

	//return $query;
    $DB = new Database();
    $DB->save($query);
	}

	private function create_url()
	{
       
       
	}
	private function create_userid()
	{
       $length = rand(4,19);
       $number = "";
       for ($i=0; $i <$length ; $i++) { 
        // code...
        $new_rand = rand(0,9);
        $number = $number.$new_rand;
       }
       return $number;
	}
}