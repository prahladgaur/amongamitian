<?php

include("classes/autoload.php");

$login = new Login();
$user_data = $login->check_login($_SESSION['amomgamity_userid']);

?>

<!DOCTYPE html>
<html>

<head>
    <title>
        AmongAmitian
    </title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style type="text/css">
        body {
            font-family: tahoma;
            background-image: url("images/sky.jpg");
        }

        #blue_bar {
            height: 100px;
            color: #d9dfeb;
            border-radius: 4px;

        }

        #search_bar {
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

        #pf_pic {
            width: 150px;

            border-radius: 50%;
            border: solid 2px white;
        }

        #menu_button {
            width: 100px;
            display: inline-block;
            border-radius: 5%;
            margin: 10px 70px 10px 70px;
        }

        #menu_button:hover {
            background-color: white;
            cursor: pointer;

            opacity: .8;
            transition: .2s;

            box-shadow: 8px 8px 8px 1px rgba(0.8, 0.8, 0.8, 0.8);
        }

        #friends_img {
            width: 75px;
            float: left;
            margin: 8px;
            border-radius: 10%;
        }

        #friends_bar {
            min-height: 700px;
            margin-top: 20px;
            padding: 8px;
            color: #405d9b;
            text-align: center;
            font-size: 20px;


        }

        #friends {
            clear: both;
            font-size: 12px;
            font-weight: bold;
            color: #405d9b;
        }

        textarea {
            width: 100%;
            font-size: none;
            font-weight: bold;
            color: #405d9b;
            height: 60px;
            background-color: #ffffff21;



        }
        .menu_tab{
            
            margin-top: 100px;
        }

        #post_button {
            float: right;
            background-color: #405d9b;
            border: none;
            color: white;
            padding: 4px;
            font-size: 14px;
            border-radius: 2px;
            width: 50px;
        }

        #post_bar {
            margin-top: 20px;
            background-color: #ffffff21;
            padding: 10px;
        }

        #post {
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

<body>

    <div style="position: fixed;">
    <?php include("header.php"); ?>
    <div class="menu_tab" style="text-align:center">
        <a href="index.php">
            <div id="menu_button"><img src="images/timelin.png" style="height:40px;width:40px;"></div>
        </a>

        <a href="profile.php?section=about&id=<?php echo $user_data['userid'] ?>">
            <div id="menu_button"><img src="images/info.png" style="height:40px;width:40px;"></div>
        </a>

        <a href="profile.php?section=followers&id=<?php echo $user_data['userid'] ?>">
            <div id="menu_button"><img src="images/followers.png" style="height:40px;width:40px;"> </div>
        </a>

        <a href="profile.php?section=following&id=<?php echo $user_data['userid'] ?>">
            <div id="menu_button"><img src="images/following.png" style="height:40px;width:40px;"> </div>
        </a>


        <a href="profile.php?section=photos&id=<?php echo $user_data['userid'] ?>">
            <div id="menu_button"><img src="images/picture1.png" style="height:40px;width:40px;"> </div>
        </a>


        <?php

        if ($user_data['userid'] == $_SESSION['amomgamity_userid']) {
            echo '<a href="profile.php?section=settings&id=' . $user_data['userid'] . '"><div id="menu_button"><img src="images/setting.png" style="height:40px;width:40px;"></div></a>';
        }
        ?>
    </div>
    </div>

    <!-- cover area   -->
    <div style="display:flex;width:90%;margin:auto">



        <!-- below cover area   -->
        <div style="display:flex;width:90%;margin:auto">



            <!--  posts area   -->
            <div style="min-height:400px;flex:2.5;padding: 20px; width: 90%;">

                <div style="border:solid thin #aaa;padding: 10px; background-color: #ffffff21;">

                    <form method="post" enctype="multipart/form-data">
                        <textarea name="post" placeholder="what's in your mind?" style="font-size:30px ;color:black"></textarea>
                        <input type="file" name="file">
                        <input id="post_button" type="submit" value="post">
                        <br>
                    </form>
                </div>

                <!--  Posts  -->
                <div id="post_bar">
                    <!--user 1 post -->
                    <?php
                    $post = new Post();
                    $posts = $post->get_posts($_SESSION['amomgamity_userid']);

                    if ($posts) {
                        foreach ($posts as $ROW) {
                            $user = new User();

                            $ROW_USER = $user->get_user($ROW['userid']);
                            include("post1.php");
                        }
                    }
                    ?>

                </div>
                <div id="post_bar">
                    <?php

                    $DB = new Database();
                    $user_class = new User();
                    $image_class = new Image();

                    $followers = $user_class->get_following($_SESSION['amomgamity_userid'], "user");

                    $followers_ids = false;
                    if (is_array($followers)) {
                        $followers_ids = array_column($followers, "userid");
                        $followers_ids = implode("','", $followers_ids);
                    }
                    if ($followers_ids) {
                        $myuserid = $_SESSION['amomgamity_userid'];
                        $sql = "select * from posts where parent = 0 and userid = '$myuserid' || userid in('" . $followers_ids . "') order by id desc limit 30";
                        $posts = $DB->read($sql);
                    }
                    if (isset($posts) && $posts) {
                        foreach ($posts as $ROW) {
                            $user = new User();

                            $ROW_USER = $user->get_user($ROW['userid']);
                            include("post1.php");
                        }
                    }
                    ?>


                </div>
            </div>
        </div>
    </div>
</body>

</html>