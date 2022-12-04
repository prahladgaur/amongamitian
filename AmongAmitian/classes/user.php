<?php

 class User
 {  
     //////////////////////////////
     //GET DATA            ///
     ///////////////////////////////
      public function get_data($id)
      {
          $query = "select * from users where userid = '$id' limit 1 ";
          $DB = new Database();
          $results = $DB->read($query);

          if($results)
          {
               $row = $results[0];
               return $row;
          }else
          {
               return false;
          }
      }
     //////////////////////////////
     //GET USER            ///
     ///////////////////////////////
      public function get_user($id)
      {
          
          $query = "select * from users where userid = '$id' limit 1";
          $DB = new Database();
          $results = $DB->read($query);
          if($results)
          {
               return $results[0];
          }
          else
          {
               return false;
          }
      }

     //////////////////////////////
     //GET FRIENDS           ///
     ///////////////////////////////
      public function get_friends($id)
      {
          
          $query = "select * from users where userid != '$id' ";
          $DB = new Database();
          $results = $DB->read($query);
          if($results)
          {
               return $results;
          }
          else
          {
               return false;
          }
      }

      //////////////////////////////
     //GET following             ///
     ///////////////////////////////
     public function get_following($id, $type)
     {    
          $DB = new Database();
          $type = addslashes($type);

          if(is_numeric($id))
          {
               
          //get following details
            $sql = "select following from likes where type = '$type' && contentid = '$id' limit 1";
            $results = $DB->read($sql);
            if(is_array($results))
            {
               $following = json_decode($results[0]['following'],true);
               return $following;
              }
          }

          return false;

     }

     //////////////////////////////
     //follow user              ///
     ///////////////////////////////
     public function follow_user($id,$type,$amomgamity_userid)
     {  
          $DB = new Database();
               
            //save likes details
            $sql = "select following from likes where type = '$type' && contentid = '$amomgamity_userid' limit 1";
            $result = $DB->read($sql);
           ///print_r($result);
           //die;
            if(is_array($result) && strlen(trim($result[0]["following"])))
            {

               //if(is_array($result) && strlen(trim($result[0]["following"]))){
               $likes = json_decode($result[0]['following'],true);
              
               $user_ids = array_column($likes, "userid");
               print_r($user_ids);
               die;

               if(!in_array($id, $user_ids))
               {

                    $arr["userid"] = $id;
                    $arr["date"] = date("Y-m-d H:i:s");

                    $likes[] = $arr;

                    $likes_string = json_encode($likes);
                    $sql = "update likes set following = '$likes_string' where type= '$type' && contentid='$amomgamity_userid' limit 1";
                    $DB->save($sql);

                     

                }
                else
                {
                    $key = array_search($id, $user_ids);
                    unset($likes[$key]);

                    $likes_string = json_encode($likes);
                    $sql = "update likes set following = '$likes_string' where type= '$type' && contentid='$amomgamity_userid' limit 1";
                    $DB->save($sql);

                     
                }
            }
            else
            { 
               $arr["userid"] = $id;
               $arr["date"] = date("Y-m-d H:i:s");

               $arr2[] = $arr;

               $following = json_encode($arr2);
                $sql = "insert into likes (type,contentid,following) values ('$type','$amomgamity_userid','$following') ";
                $DB->save($sql);

               
     
            }
          
     }

 }