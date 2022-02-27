<?php
require '../connect.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');

    $select_post = "SELECT * FROM post where post_stat != 1 AND post_type != 3";
                        $run_post = mysqli_query($conn,$select_post);
                        while ($row_post = mysqli_fetch_array($run_post)) {
                            $post_name = $row_post['post_name'];
                            $post_id = $row_post['post_id'];
                            $post_date = $row_post['post_date'];
                            
                            $post_view = $row_post['post_view'];
                            $post_like = $row_post['post_like'];
                            $post_dislike = $row_post['post_dislike'];
                            $current_point = $post_view + $post_like - $post_dislike;
                            $post_point = 0;

                            
                            $now_time = strtotime("now");
                            $old_time = strtotime("$post_date");
                            $minute = round(abs($now_time - $old_time) / 60,2);

                            $hour = $minute / 60;
                            $post_point = $current_point -(0.04167)*$current_point*$hour;
                            
                            $update = "UPDATE post SET post_point = '$post_point' where post_id = '$post_id'";
                            $run = mysqli_query($conn,$update);
                            
                        }