<div style="min-height:400px;width: 100%;background-color: #ffffff21;text-align: center;">
	<div style="padding: 20px;">
	<?php 
	  
	    $image_class = new Image();
	    $post_class = new Post();
	    $user_class = new User();

	    $followers = $post_class->get_likes($user_data['userid'],"user");

	    if(is_array($followers))
	    {
	    	foreach ($followers as $follower) {
	    		
	    		$FRIEND_ROW = $user_class->get_user($follower['userid']);
	    		include("user1.php");
	    	}

	    }
	    else
	    {
	    	echo "No followers was found!";
	    }

	?>
	</div>
</div>
