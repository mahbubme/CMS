<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php 

            $query = "SELECT * FROM users";
            $select_users = mysqli_query( $connection, $query );

            while ( $row = mysqli_fetch_assoc( $select_users ) ) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];

                $output  = "<tr>";
                $output  = "<td>{$user_id}</td>";
                $output .= "<td>{$username}</td>";
                $output .= "<td>{$user_firstname}</td>";

                // $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                // $select_categories_id = mysqli_query( $connection, $query );

                // while ( $row = mysqli_fetch_assoc( $select_categories_id ) ) {
                //     $cat_id = $row['cat_id'];
                //     $cat_title = $row['cat_title'];
                
                //     $output .= "<td>{$cat_title}</td>";
                // }

                $output .= "<td>{$user_lastname}</td>";
                $output .= "<td>{$user_email}</td>";
                $output .= "<td>{$user_role}</td>";

                //  $query = "SELECT * FROM posts WHERE post_id=$comment_post_id";
                //  $select_post_id_query = mysqli_query( $connection, $query );

                //  while ( $row = mysqli_fetch_assoc( $select_post_id_query ) ) {
                //  $post_id = $row['post_id'];
                //  $post_title = $row['post_title'];

				// 	$output .= "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
				// }
				
                $output .= "<td><a href='comments.php?approve='>Approve</a></td>";
                $output .= "<td><a href='comments.php?unapprove='>Unapprove</a></td>";
                $output .= "<td><a href='comments.php?delete='>Delete</a></td>";
                $output .= "</tr>";

                echo $output;
            }

        ?>
    </tbody>
</table>

<?php 

	// Approve comment from the database
    if ( isset( $_GET['approve'] ) )  {
        $the_comment_id = $_GET['approve']; 

        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$the_comment_id}";
        $approve_comment_query = mysqli_query( $connection, $query );
        header( "Location: comments.php" );
    }

    
    // Unapprove comment from the database
    if ( isset( $_GET['unapprove'] ) )  {
        $the_comment_id = $_GET['unapprove']; 

        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$the_comment_id}";
        $unapprove_comment_query = mysqli_query( $connection, $query );
        header( "Location: comments.php" );
    }


    // Delete comment from the database
    if ( isset( $_GET['delete'] ) )  {
        $the_comment_id = $_GET['delete']; 

        $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
        $delete_query = mysqli_query( $connection, $query );
        header( "Location: comments.php" );
    }
    
?>