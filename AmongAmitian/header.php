<!-- Top Bar   --->

<?php
    $image_class = new Image();
    $corner_image = "images/profile_image_male.jpg";
    if ($user_data['gender'] == "Female") {
        $corner_image = "images/profile_image_female.jpg";
    } 
    if (file_exists($user_data['profile_image'])) {
        $corner_image = $image_class->get_thumb_profile($user_data['profile_image']);
    }
?>


<style>
    #blue_bar {
            
            height: 100px;
            background-color: none;
            color: pink;
            padding: 4px;
            border-radius: 4px;
            width: 90%;
            margin-left: 70px;
            position: fixed;

    }

    #head_logo {
        
        font-size: 70px;
        text-align: left;
        margin-left: 20px;
        text-decoration:none;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;

    }
    #head_logo :hover{
        color:red;
    }

    .corner_img {
        float: right;
      
       
    }
    .corner_img:hover .content a{
        display: block;
        z-index: 1;
    }
    .content{
        min-width: 80px;
        position: absolute;
    }
    .content a{
        text-decoration: none;
        color: white;
        background-color:#ffffff21;
        font-size: 18px;
        padding:3px;
        display: none;
        transition: 0.3s all;
    }
    .content a:hover{
        opacity: 0.7;
    }

    #search_bar {
        width: 150px;
        height: 20px;
        border-radius: 5px;
        border: none;
        float:center;
        padding: 4px;
        
        font-size: 14px;
        background-image: url("images/search.png");
        background-repeat: no-repeat;
        background-position: right;
    }
</style>



<div id="blue_bar">
<div id="head_logo" style="width: 98%;  ">

    <form method="get" action="search.php">

            <a href="index.php" style="color:white;font-family: 'Alegreya Sans SC';text-decoration:none;" >AMONGAMITIAN</a>
             <input type="text" id="search_bar" name='find' placeholder="Search for people">

            
            <div class="corner_img">
               <a href="#">
                <div class="content">
                  
                    <a href="#">profile</a>
                    <a href="#">about</a>
                    <a href="logout.php">
                     <span >logout</span></a>
                </div>
                <a href="profile.php">
                    <img src="<?php echo $corner_image ?>" style="width: 80px;height: 80px;margin-top:8px;border-radius:50%; ">
                </a>
               </a>
            </div>
           
            </form>

        </div>
   

</div>