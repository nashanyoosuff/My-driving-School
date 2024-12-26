<?php include"includes/admin_header.php"; ?>

    <div id="wrapper">
        
        <!-- Navigation -->
        <?php include"includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcone To Admin
                            <small>Author</small>
                        </h1>


                        <?php 

                        if (isset($_GET['source'])) {
                            $source = $_GET['source'];
                        }
                        else {
                            $source = "";
                        }

                        switch ($source) {
                            case 'add_Learners':
                                include "includes/add_Learners.php";
                                break;
                            
                            case 'update':
                                include "includes/update.php";
                                break;

                            default: ?>
                                <table class="table table-bordered table-hover"> 
                                <thead>
                                    <tr>
                                        <th>Learners_Id</th>
                                        <th>Admin_Name</th>
										<th>Learners_Name</th>
                                        <th>District</th>
                                        <th>City</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Date</th>
									
                                       
                                    </tr>
                                </thead>

                                <tbody>
                                    
                                    <?php 
									    $curr_user_id = $_SESSION['s_id'];

                                        $query = "SELECT *  FROM  posts where user_id = '$curr_user_id'";
                                        $select_posts = mysqli_query($connection,$query);

                                        while($row = mysqli_fetch_assoc($select_posts)) {
                                            $Learners_id = $row['post_id'];
                                            $admin_name = $row['post_author'];
                                            $Learners_name = $row['post_title'];
											$image = $row['post_image'];
                                            $District = $row['District'];
                                            $City = $row['City'];
											$category = $row['post_category_id'];
											$date = $row['post_date'];
                                           	$confirm = $row['confirm'];
                                        
                                       

                                     ?>
                                    <tr>
                                        <td><?php echo $Learners_id  ?></td>
                                        <td><?php echo $admin_name ?></td>
                                        <td><?php echo $Learners_name ?></td>
                                        <td><?php echo $District ?></td>
										<td><?php echo $City ?></td>
                                        <td>
										<?php 
										
										if($confirm == 'Published'){
											echo"<span style='color:green'>$confirm</span>";
										}
										else{
											echo"<span style='color:red'>$confirm</span>";
										}
								?>
										</td>
                                        <td><img width="100" src="../images/<?php echo $image ?>"></td>
                                        <td><?php echo $date ?></td>
                                       <td> <?php echo "<td><a href='Learners.php?delete=$Learners_id'>Delete</a></td>"; ?></td>
                                       <td> <?php echo "<td><a href='Learners.php?source=update&Learners_id=$Learners_id'>Update</a></td>"; ?></td>
                                      
                                    </tr>
                                    <?php }?>
                                </tbody>
                                </table><?php
                                break;
                        }
                        // if ($source = 'add_Learners') {
                        //        include "includes/add_Learners.php";   
                        // }
                        // elseif ($source = '') {
                        //     
                        // }   
                        ?>



                        <?php 

                        if (isset($_GET['delete'])) {
                            
                            $Learners_idd = $_GET['delete'];
                            $query = "DELETE FROM posts WHERE post_id = {$Learners_idd} ";

                            $delete_Learners = mysqli_query($connection,$query);
                            if(!$delete_Learners) {
                                die("Query Failed" . mysqli_error($delete_Learners));
                            }
                            header("Location: Learners.php");
                        }

                        ?>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include"includes/admin_footer.php"; ?>


