<?php

include("classes/autoload.php");

$login = new Login();
$user_data = $login->check_login($_SESSION['amomgamity_userid']);

$USER = $user_data;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $profile = new Profile();
    $profile_data = $profile->get_profile($_GET['id']);

    if (is_array($profile_data)) {
        $user_data = $profile_data[0];
    }
}




//postings starts from here
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['first_name'])) {
        $settings_class = new Settings();
        $settings_class->save_settings($_POST, $_SESSION['amomgamity_userid']);
    } else {
        $post = new Post();
        $id = $_SESSION['amomgamity_userid'];
        $results = $post->create_post($id, $_POST, $_FILES);

        if ($results == "") {
            header("Location: profile.php");
            die;
        } else {
            echo "<div style='text-align:center;font-size:12px;color:black;'>";
            echo "<br>The following errors occured:<br><br>";
            echo $results;
            echo "</div>";
        }
    }
}
//collect posts
$post = new Post();
$id = $user_data['userid'];

$posts = $post->get_posts($id);

//collect friends   
$user = new User();

$friends = $user->get_following($user_data['userid'], "user");
$image_class = new Image();
?>

<!DOCTYPE html>
<html>

<head>
    <title>
        AmongAmitian
    </title>
    <style type="text/css">

        body {
            font-family: tahoma;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url("images/sky.jpg");
        }

        #blue_bar {
            height: 100px;
            border-radius: 4px;
        }

        #textbox {
            width: 100%;
            height: 20px;
            border-radius: 5px;
            border: solid thin grey;
            padding: 4px;
            font-size: 14px;
            background-color: none;
            margin: 10px;
        }

        #pf_pic {
            width: 250px;
            margin-top: -200px;
            border-radius: 50%;
            border: solid 2px white;
        }
        .menu_tab{
            
            margin-top: 100px;
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
            background-color: none;
            box-shadow: inset 0 -2em 1em rgba(0, 0, 0, 0.1), 0 0 0 2px #ffffff21, 1em 1em 1em rgba(0, 0, 0, 0.3);
            border-radius: 6px;
            min-height: 700px;
            margin-top: 20px;
            color: #aaa;
            padding: 8px;
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
            color: white;
            height: 100px;
            border: none;
            border-color: #aaa;
            box-shadow: inset 0 -2em 1em rgba(0, 0, 0, 0.1), 0 0 0 2px #ffffff21 , 1em 1em 1em rgba(0, 0, 0, 0.3);

        }

        #post_button {
            float: center;
            background-color: #ffffff21;
            border: none;
            color: white;
            padding: 4px;
            margin-top: 2px;
            margin-bottom: 2px;
            font-size: 15px;
            border-radius: 2px;
            min-width: 50px;
            cursor: pointer;
        }

        #post_bar {
            margin-top: 20px;
            background-color:none;
            padding: 10px;
            border-radius: 6px;
            box-shadow: inset 0 -2em 1em rgba(0, 0, 0, 0.1), 0 0 0 2px #ffffff21, 1em 1em 1em rgba(0, 0, 0, 0.3);
        }

        #post {
            padding: 4px;
            font-size: 13px;
            display: flex;
            border-radius: 4px;
            margin-bottom: 20px;
            background-color: none;
            box-shadow: inset 0 -2em 1em rgba(0, 0, 0, 0.1), 0 0 0 2px #ffffff21, 1em 1em 1em rgba(0, 0, 0, 0.3);
        }

        .user_name {
            font-size: 40px;
            color: black;
            font-family: 'Alegreya Sans SC';
            font-weight: bold;
        }

        .cover_area {
            text-align: center;
            border-radius:7px; 
            background-color:none;
            color: black;
            margin-top: 100px;
            margin-top: 20px;
            box-shadow: inset 0 -1em 1em rgba(0, 0, 0, 0.1), 0 0 0 2px #ffffff21 , 1em 1em 1em rgba(0, 0, 0, 0.3);
        }


       
    </style>
</head>

<!--       ******* 
    starting of body   
          ********
-->

<body>
   <div>
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
    <div style="width: 90%; margin:auto; min-height: 400px;background-color: none;">

        <div class="cover_area" >

            <?php

                $image = "images/cover_image.jpg";
                if (file_exists($user_data['cover_image'])) {
                    $image = $image_class->get_thumb_cover($user_data['cover_image']);
                }
            ?>
            
            <img src="<?php echo $image ?>" style="width:99.5%;border-radius:10px;margin-top:4px;">

            <span style="font-size:12px">
                <?php

                $image = "images/profile_image_male.jpg";
                if ($user_data['gender'] == "Female") {
                    $image = "images/profile_image_female.jpg";
                }

                if (file_exists($user_data['profile_image'])) {
                    $image = $image_class->get_thumb_profile($user_data['profile_image']);
                }

                ?>

                <img id="pf_pic" src="<?php echo $image ?>"><br />

                <a style="text-decoration: none;" href="change_profile_img.php?change=profile">Change Profile</a>|
                <a style="text-decoration: none;" href="change_profile_img.php?change=cover">Change Cover </a>

            </span>
            <br>

            <div class="user_name">
                <a href="profile.php?id=<?php echo $user_data['userid'] ?>">
                    <?php echo $user_data['first_name'] . " " . $user_data['last_name'] ?>
                </a>
               
                <br>
                </div>
                <?php
                    $mylikes = "";
                    if ($user_data['likes'] > 0) {
                        $mylikes = "(" . $user_data['likes'] . "Followers)";
                    }
                ?>
                <a href="like.php?type=user&id=<?php echo $user_data['userid'] ?>">
                    <input id="post_button" type="button" value="Follow <?php echo $mylikes ?>" style="margin-right: 10px; ">
                </a>
               
                
            
            <br>
           
        </div>
    </div>

        <!-- below cover area   -->
        <?php

        $section = "default";
        if (isset($_GET['section'])) {
            $section = $_GET['section'];
        }

        if ($section == "default") {
            include("profile_content_default.php");
        } elseif ($section == "followers") {
            include("profile_content_followers.php");
        } elseif ($section == "following") {
            include("profile_content_following.php");
        } elseif ($section == "about") {
            include("profile_content_about.php");
        } elseif ($section == "settings") {
            include("profile_content_settings.php");
        } elseif ($section == "photos") {
            include("profile_content_photos.php");
        }

        ?>

    </div>
</body>

</html>