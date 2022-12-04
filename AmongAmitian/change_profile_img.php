<?php

 session_start();
  
  include("classes/connect.php");
  include("classes/login.php");
  include("classes/user.php");
  include("classes/post.php");
  include("classes/image.php");

  $login = new Login();
  $user_data = $login->check_login($_SESSION['amomgamity_userid']);
  

  //posting something here
  if($_SERVER['REQUEST_METHOD']== "POST")
  {
    
 
     if ($_FILES['file']['type'] == "image/jpeg") 
     {

        if(isset($_FILES['file']['name']) && $_FILES['file']['name']!= "")
        {

            $allowed_size = (1024*1024)*7;
            if ($_FILES['file']['size'] < $allowed_size)
            {
            //everything is fine

                $folder = "uploads/". $user_data['userid']. "/";

                //create folder
                if(!file_exists($folder))
                {
                    mkdir($folder,0777,true);
                }

                $image = new Image();

                $filename = $folder. $image->generate_filename(15). ".jpg";
                 move_uploaded_file($_FILES['file']['tmp_name'] , $filename);

                 $change = "profile";
              
                   // check for mode
                    if (isset($_GET['change'])) 
                    {
                        $change =$_GET['change'];
                    }

                 
                 
                if($change == "cover")
                {
      
                        if(file_exists($user_data['cover_image']))
                        {
                            unlink($user_data['cover_image']);
                        }
                        $image->resize_image($filename ,$filename ,1600,1600);
                }
                else
                {
                        if(file_exists($user_data['profile_image']))
                        {
                            unlink($user_data['profile_image']);
                        }
                        $image->resize_image($filename ,$filename ,1500,1500);
                }


                if(file_exists($filename))
                {
                    $userid = $user_data['userid'];

                    
                    if($change == "cover")
                    {
                      $query = "update users set cover_image = '$filename' where userid = '$userid' limit 1 ";
                      $_POST['is_cover_image'] = 1;
   
                    }
                    else
                    {
                        $query = "update users set profile_image = '$filename' where userid = '$userid' limit 1 ";
                        $_POST['is_profile_image'] = 1;
 
                    }

              
                    $DB = new Database();
                    $DB->save($query);

                    //create a post

                    $post = new Post();
                    $_POST['is_profile_image'] = 1;
                    $post->create_post($userid,$_POST, $filename);

                    header("Location: profile.php");
                    die;
                }
            }
            else
            {
            echo "<div style='text-align:center;font-size:12px;color:black;'>";
            echo "<br>The following errors occured:<br><br>";
            echo "only image of size of 3MB or lower are allowed!";
            echo "</div>";
            }
        }
        else
        {
            echo "<div style='text-align:center;font-size:12px;color:black;'>";
            echo "<br>The following errors occured:<br><br>";
            echo "Only images of jpeg type are allowed!";
            echo "</div>";
        }

    

         
    }
    else
    {
        echo "<div style='text-align:center;font-size:12px;color:black;'>";
        echo "<br>The following errors occured:<br><br>";
        echo "please add a valid image";
        echo "</div>";
    }
    
    
}


?>  

<!DOCTYPE html>
<html>
    <head>
        <title>
            change profile image
        </title>
        <style type="text/css">
            #blue_bar{
                height: 50px;
                background-color: skyblue;
                color: #d9dfeb;
                border-radius: 4px;
            }
            #search_bar{
                width: 400px;
                height: 20px;
                border-radius: 5px;
                border: none;
                padding: 4px;
                font-size: 14px;
                background-image: url();
                background-repeat: no-repeat;
                background-position: right;
            }
            
            #post_button{
                float: right;
                background-color: #405d9b ;
                border: none;
                color: white;
                padding: 4px;
                font-size: 14px;
                border-radius: 2px;
                width: 70px;
            }
            #post_bar{
                margin-top: 20px;
                background-color: white;
                padding: 10px;
            }
            #post{
                padding: 4px;
                font-size: 13px;
                display: flex;
                margin-bottom: 20px;
            }

        </style>
</head>

<!--       ******* 
    staring of body   
          ********
-->
<body style="font-family: tahoma; background-color: lightblue;">

 
<?php include("header.php"); ?>

<!-- cover area   -->
    <div style="width: 800px; margin:auto; min-height: 400px;">
        
    

<!-- below cover area   -->
    <div style="display: flex;">
  
   

        <!--  posts area   -->
         <div style="min-height:400px;flex:2.5;padding: 20px;padding-right: 0px;">
             
             <form method="post" enctype="multipart/form-data">
                 <div style="border:solid thin #aaa;padding: 10px;background-color: white;">
                     
                     <input type="file" name="file">
                     <input id="post_button" type="submit" value="Change">
                     <br>
                     <div style="text-align: center;">
                        <br><br>
                     <?php

                            $change = "profile";

                      
                           // check for mode
                            if (isset($_GET['change']) && $_GET['change'] == "profile") 
                            {
                                
                                 echo "<img src='$user_data[profile_image]' style='max-width:500px' >";
                            }
                            else
                            {
                                 $change =$_GET['change'];
                                echo "<img src='$user_data[cover_image]' style='max-width:500px' >";

                            }
                     ?>
                         
                     </div>

                 </div>
            </form>
            
         </div>
    </div>
    </div>
</body>
</html>
