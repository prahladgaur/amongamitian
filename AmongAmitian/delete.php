<?php

  include("classes/autoload.php");
 
  $login = new Login();
  $user_data = $login->check_login($_SESSION['amomgamity_userid']);
  
  $Post = new Post();

  if(isset($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "delete.php"))
  {
      $_SESSION['return_to'] = $_SERVER['HTTP_REFERER'];
  }

  $ERROR = "";
  if(isset($_GET['id']))
  { 
    
        $ROW = $Post->get_one_post($_GET['id']);

        if(!$ROW)
        {
            $ERROR = "No such post was found";
        }
        else
        {
            if($ROW['userid']!= $_SESSION['amomgamity_userid'])
            {
                $ERROR = "Access denied! you cant delete this file!";
            }
        }
   }
   else
   {
        $ERROR = "No such post was found";

    }
  

  //if something was posted
  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
   
    $Post->delete_post($_POST['postid']);
    header("Location:".$_SESSION['return_to']);
    die;
  }

?>  

<!DOCTYPE html>
<html>
    <head>
        <title>
            Delete
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
            #pf_pic{
                width: 150px;
                
                border-radius: 50%;
                border: solid 2px white;
            }
            #menu_button{
                width: 100px;
                display: inline-block;
                margin: 2px;
            }
            #friends_img{
                width: 75px;
                float: left;
                margin: 8px;
                border-radius: 10%;
            }
            #friends_bar{
                min-height: 700px;
                margin-top: 20px;                
                padding: 8px;
                color: #405d9b;
                text-align: center;
                font-size: 20px;


            }
            #friends{
                clear: both;
                font-size: 12px;
                font-weight: bold;
                color: #405d9b;
            }
            textarea{
                width: 100%;
                font-size: none;
                font-weight: bold;
                color: #405d9b;
                height: 60px;

            }
            #post_button{
                float: right;
                background-color: #405d9b ;
                border: none;
                color: white;
                padding: 4px;
                font-size: 14px;
                border-radius: 2px;
                width: 50px;
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
             
             <div style="border: solid thin #aaa; padding: 10px; background-color: white;">

                 <h2>delete post</h2>
                 <form method="post">
                    <br>
                      
                        <?php 

                              if($ERROR != "")
                               {
                                echo $ERROR;
                            }
                            else

                           {
                               echo "Are you sure you want to delete this post??<br><br>";
                      
                               $user = new User();
                               $ROW_USER = $user->get_user($ROW['userid']);
                         
                               include("post1_delete.php");
                               //echo $row['post'];

                              echo "<input type='hidden' name='postid' value='$ROW[postid]'>";
                               echo "<input id='post_button' type='submit' value='Delete'>";
                           }
                        ?>
                                             
                   
                    <br>
                </form>
             </div>

            
          
         </div>
    </div>
    </div>
</body>
</html>
