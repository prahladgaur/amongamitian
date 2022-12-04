 <style>
  #post_bar{
    font-size: 40px;
  }

  .posting{
    min-height:200px;
    flex:6;
    padding: 20px;
    padding-right: 0px;
    
    
    
  }
 
  #post_btn{
    float:right;
  }



</style>
 
 
 <div style="display:flex;width:90%;margin:auto">
  
   <!--  friends area   -->
        <div id="friends_bar" style="min-height:400px;">
            
                <b style="color:black">Following</b><br>

                <?php 
                       
                       if($friends)
                       {
                       foreach ($friends as $friend) 
                        {
                          $FRIEND_ROW = $user->get_user($friend['userid']);
                          include("user1.php");
                        }
                      } 
                    ?>
                
            
        </div>

        <!--  posts area   -->
         <div class="posting" >
             
             <div style="padding:10px;background-color: #00800000;">

                <form method="post" enctype="multipart/form-data">
                 <textarea name="post" placeholder="what's in your mind?" style="font-size:30px ;color:white;border:none;background-color:#00800000"></textarea>
                 <input type="file" name="file">
                 <input id="post_btn" type="submit" value="post">
                 <br>
                 </form>
             </div>

             <!--  Posts  -->
             <div id="post_bar">
                   <!--user 1 post -->
                    <?php 
                       
                       if($posts)
                       {
                       foreach ($posts as $ROW) 
                        {
                          $user = new User();  

                          $ROW_USER = $user->get_user($ROW['userid']); 
                          include("post1.php");
                        }
                      }  
                    ?>
                 
                 
             </div>
         </div>
    </div>