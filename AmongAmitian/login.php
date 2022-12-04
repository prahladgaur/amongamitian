<?php
session_start();
include("classes/connect.php");
include("classes/login.php");

/*$DB = new Database();

    $sql = "select * from users";
    $results = $DB->read($sql);

    foreach ($results as $row) {

        $id = $row['id'];
        $password = hash("sha1", $row['password']);

        $sql = "update users set password = '$password' where id= '$id' limit 1";
       // echo "<pre>";
        //echo $sql;
        //echo "</pre>";
        $DB->save($sql);
    }
   die;*/

$email = "";
$password = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = new Login();
    $results = $login->evaluate($_POST);

    if ($results != "") {
        echo "<div style='text-align:center;font-size:12px;color:black;'>";
        echo "<br>The following errors occured:<br><br>";
        echo $results;
        echo "</div>";
    } else {
        header("Location:index.php");
        die;
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
}



?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AmongAmitian</title>

    <style>
        body {
            background-image: url("images/background.jpg");
            background-repeat: none;
        }

        #bar {
            height: 100px;
            color: pink;
            padding: 4px;
            border-radius: 4px;
            width: 90%;
            margin-left: 70px;
        }
        
        #amity_logo
        {
            margin-right: 20px;
            font-family:  'Alegreya Sans SC';
        }

        #header_tab {

            width: 120px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            padding: 4px;
            color: white;
            margin-bottom: 70px;
            margin-right: 20px;
            border-radius: 4px;
            float: right;
            margin-top: 30px;
        }
        #header_tab:hover{
            color: white;
            cursor: pointer;
            background-color: black;
        }

        #bar2 {
            box-shadow: inset 0 -3em 3em rgba(0, 0, 0, 0.3), 0 0 0 2px #ffffff21, 0.3em 0.3em 1em rgba(0, 0, 0, 0.3);
            background-color: #ffffff21;
            width: 800px;
            height: 400px;
            border-radius: 5px;
            margin: auto;
            margin-top: 50px;
            font-weight: bold;
            padding: 10px;
            padding-top: 50px;
            text-align: center;
            float: center;
            color: white;
            font-size: 20px;
        }

        #text {
            height: 40px;
            width: 300px;
            padding: 5px;
            outline: none;
            color: white;
            font-size: 25px;
            background-color: #ffffff21;
            background: transparent;
        }
        input{
            outline: none;
            border: none;
            border-bottom: 1px solid white;
        }
        ::placeholder {
            color: white;
            font-size: 25px;
            font-style: inherit;
        }

        #button {
            box-shadow: inset 0 -3em 3em rgba(0, 0, 0, 0.3), 0 0 0 2px #ffffff21, 0.3em 0.3em 1em rgba(0, 0, 0, 0.3);
            background-color: #ffffff21;

            width: 300px;
            height: 40px;
            border-radius: 4px;
            font-weight: bold;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 20px;

        }
        #button:hover{
            background-color: black;
        }
    </style>
</head>

<body style="font-family: tahoma; background-color: #e9ebee;">

    <div id="bar">
        <div id="amity_name" style="font-size: 80px;margin-left:10px;color:white;font-family: 'Alegreya Sans SC';">AMONGAMITIAN
         
        <!--SIGN UP-->
            <a href="signup.php">
                <div id="header_tab"> SIGNUP</div>
            </a> 

            <!--ABOUT-->
            <a href="#">
                <div id="header_tab">About</div>
            </a>

            <!--PROGRAMS-->
            <a href="#">
                <div id="header_tab">Programs</div>
            </a>   

            <!--SCHOLARSHIPS-->
            <a href="#">
                <div id="header_tab">Scholarships</div>
            </a>

            <!--COMPUS-->
            <a href="#">
                <div id="header_tab">Compus</div>
            </a>
        

        </div>
    </div>
    <div id="bar2">
        <form method="post">
            Log in to AmongAmitian<br><br>


            <input name="email" value="<?php echo $email ?>" type="text" id="text" placeholder="Email or Username"><br><br>
            <input name="password" value="<?php echo $password ?>" type="password" id="text" placeholder="Password"><br><br>

            <input type="submit" id="button" value="Log in"><br><br>
            <div style="font-size:20px;">Not a Member?<a style="color:black" href="signup.php">click here</a> to sign up</div>
            <br><br>

        </form>
    </div>

   
</body>

</html>