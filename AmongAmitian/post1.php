 <style>
    .name_usr
    {
        color:white;
        font-size: 20px;
        font-weight:bold;
        color: white;
        font-style: none;
        font-family: 'Alegreya Sans SC' ;
    }
   

</style>



 <div id="post">
    <div>

        <?php

            $image = "images/profile_image_male.jpg";
            if($ROW_USER['gender'] == 'Female')
            {
                $images = "images/profile_image_female.jpg";

            }

            if(file_exists($ROW_USER['profile_image']))
            {
                 $image = $image_class->get_thumb_profile($ROW_USER['profile_image']);

            }
            
         ?>   

        <img src="<?php echo $image ?>" style="width: 75px;margin-right: 4px;border-radius: 50%;">
    </div>
    <div style="width: 1000%;">
        <div class="name_usr">

            <?php

                echo "<a href='profile.php?id=$ROW[userid]'>";

                 echo htmlspecialchars($ROW_USER['first_name']) ." ". htmlspecialchars($ROW_USER['last_name']); 

                 echo "</a>";
                 
                 if($ROW['is_profile_image'])
                 {
                    $pronoun = "his";
                    if($ROW_USER['gender'] == "Female")
                    {
                        $pronoun ="her";
                    }
                    echo "<span style='font-weight:normal; color:#aaa;'> updated $pronoun profile image </span>";
                 
                  }
                  
                    else if($ROW['is_cover_image'])
                    {
                        $pronoun = "his";
                        if($ROW_USER['gender'] == "Female")
                        {
                            $pronoun ="her";
                        }
                        echo "<span style='font-weight:normal; color:#aaa;'> updated $pronoun cover image </span>";
                }
             
        
             ?>
        </div>

         <?php echo htmlspecialchars($ROW['post']) ?>

        <br/><br/>
         <?php

            if(file_exists($ROW['image']))
            {
                $post_image = $image_class->get_thumb_post($ROW['image']);
                 echo "<img src='$post_image' style='width:80%;' />";
            }

         ?>

        <br/><br/>
         <?php
            $likes = "";

            $likes = ($ROW['likes'] > 0) ? "(".$ROW['likes'].")" : "";
 
        ?>

        <a href="like.php?type=post&id=<?php 
             echo $ROW['postid'];
            
         ?>">
          Like<?php echo $likes ?></a> . 

          <?php 
            $comments = "";
            if($ROW['comments']>0)
            {
                $comments = "(" .$ROW['comments'] . ")";
            }



            ?>
        <a href="single_post.php?id=<?php echo $ROW['postid'] ?>"><b>Comments<?php echo $comments ?></b></a> . 
        <span style="color:#999;">
        
          <?php echo $ROW['date']; ?>

       </span>

       <?php 
           if($ROW['has_image'])
           {
               echo "<a href='image_view.php?id=$ROW[postid]' >";
               echo ".View full Image.";
               echo "</a>";
 
           }


       ?>
       <span style="color:#999;float: right;">
          
          <?php 
                 $post = new Post();

                 if($post->i_own_post($ROW['postid'],$_SESSION['amomgamity_userid']))
                 {

                        echo "
                        <a href='edit.php?id=$ROW[postid]'>
                        Edit 
                        </a>. 
                        <a href='delete.php?id=$ROW[postid]'>
                        Delete
                        </a>";
             }

             

          ?>
       </span>
       <?php 
                $i_liked = false;
                if(isset($_SESSION['amomgamity_userid']))
                {


                    $DB = new Database();
                   

                    $sql = "select likes from likes where type = 'post' && contentid = '$ROW[postid]' limit 1";
                    $results = $DB->read($sql);
                    if(is_array($results))
                    {
                        $likes = json_decode($results[0]['likes'],true);

                        $user_ids = array_column($likes, "userid");

                        if(in_array($_SESSION['amomgamity_userid'], $user_ids))
                        {
                            $i_liked = true;
                        }
                    }               
                }


             if($ROW['likes']>0)
             {
                echo "<br/>";
                echo "<a href='likes.php?type=post&id=$ROW[postid]'>";

                if($ROW['likes'] == 1)
                {
                    if($i_liked)
                    {
                        echo "<span style='float:left';>You liked this post</span>";
                    }
                    else
                    {
                        echo "<span style='float:left';>1 person liked this post</span>";
                    }
                }

                else
                {
                    if($i_liked)
                    {
                        $text = "others";
                        if($ROW['likes'] - 1 == 1)
                        {
                            $text = "other";
                        }
                        echo "<span style='float:left';>You and ".($ROW['likes']-1)." $text  liked this post</span>";

                    }
                    else
                    {
                        echo "<span style='float:left';>".$ROW['likes']." other liked this post</span>";

                    }
                }
                echo "</a>";
                
             }

        ?>     
      
    </div>
</div>
              