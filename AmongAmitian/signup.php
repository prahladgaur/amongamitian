<?php

include("classes/connect.php");
include("classes/signup.php");
$first_name = "";
$last_name = "";
$gender = "";
$email = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $signup = new Signup();
    $results = $signup->evaluate($_POST);

    if ($results != "") {
        echo "<div style='text-align:center;font-size:12px;color:black;'>";
        //echo "<br>The following errors occured:<br><br>";
        echo "<script>alert('$results')</script>";
        echo "</div>";
    } else {
        header("Location:login.php");
        die;
    }


    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
}



?>




<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AmongAmitian</title>

    <style>
        body {
            background-image: url("images/background.jpg");
            display: column;
        }

        #bar {
            
            height: 100px;
            color: pink;
            padding: 4px;
            border-radius: 4px;
            width: 90%;
            margin-left: 70px;
        }

        #header_tab {

            width: 120px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            padding: 4px;
            color: white;
            margin-bottom: 30px;
            margin-right: 20px;
            border-radius: 4px;
            float: right;
            margin-top: 30px;
        }

        #header_tab:hover {
            color: white;
            cursor: pointer;
            background-color: black;
        }

        #bar2 {
            box-shadow: inset 0 -3em 3em rgba(0, 0, 0, 0.3), 0 0 0 2px #ffffff21, 0.3em 0.3em 1em rgba(0, 0, 0, 0.3);
            background-color: #ffffff21;
            width: 800px;
            height: 600px;
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

        ::placeholder {
            color: white;
            font-size: 25px;
            font-style: inherit;
        }
        input{
            outline: none;
            border: none;
            border-bottom: 1px solid white;
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

        #button {
            box-shadow: inset 0 -3em 3em rgba(0, 0, 0, 0.3), 0 0 0 2px #ffffff21, 0.3em 0.3em 1em rgba(0, 0, 0, 0.3);
            background-color: #ffffff21;

            width: 300px;
            height: 40px;
            border-radius: 4px;
            font-weight: bold;
            border: none;
            background-color: rgb(59, 89, 152);
            color: white;
            cursor: pointer;
            
        }
       
    </style>
</head>

<body style="font-family: tahoma; ">

    <div id="bar">
        <div style="font-size: 80px;font-family: 'Alegreya Sans SC';margin-left:10px;color:white">AMONGAMITIAN
             <!--LOGIN-->
            <a href="login.php">
                <div id="header_tab">LOGIN</div>
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
        Sign up to AmongAmitian<br><br>

        <form method="post" action="">
            <input value="<?php echo $first_name ?>" name="first_name" type="text" id="text" placeholder="First name"><br><br>
            <input value="<?php echo $last_name ?>" name="last_name" type="text" id="text" placeholder="Last name"><br><br>

            Gender:<br>
            <select value="gender" name="gender" id="text">
                <option><?php echo $gender ?></option>
                <option>male </option>
                <option>female</option>
            </select>
            <br><br>
            <input value="<?php echo $email ?>" name="email" type="text" id="text" placeholder="Email"><br><br>
            <input name="password" type="password" id="text" placeholder="Password"><br><br>
            <input name="password2" type="password" id="text" placeholder="Confirm Password"><br><br>
            <input type="submit" id="button" value="Sign up"><br><br>
            <div style="">Already a Member! <a style="color:black" href="login.php">Click here</a> to Login
            <br><br><br>

        </form>
    </div>

</body>

</html>