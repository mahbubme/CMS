<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Change To Admin</th>
            <th>Change To Subscriber</th>
            <th>Edit</th>
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
                $output .= "<td>{$user_lastname}</td>";
                $output .= "<td>{$user_email}</td>";
                $output .= "<td>{$user_role}</td>";
				$output .= "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
                $output .= "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
                $output .= "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
                $output .= "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
                $output .= "</tr>";

                echo $output;
            }

        ?>
    </tbody>
</table>

<?php 

	// Change user role to Admin from the database
    if ( isset( $_GET['change_to_admin'] ) )  {
        $the_user_id = $_GET['change_to_admin']; 

        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$the_user_id}";
        $change_to_admin_query = mysqli_query( $connection, $query );
        header( "Location: users.php" );
    }

    
    // Change user role to subscriber from the database
    if ( isset( $_GET['change_to_sub'] ) )  {
        $the_user_id = $_GET['change_to_sub']; 

        $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$the_user_id}";
        $change_to_subscriber_query = mysqli_query( $connection, $query );
        header( "Location: users.php" );
    }


    // Delete user from the database
    if ( isset( $_GET['delete'] ) )  {

        if ( isset( $_SESSION['user_role'] ) ) {

            if ( $_SESSION['user_role'] == 'admin' ) {

                $the_user_id = mysqli_real_escape_string( $connection,  $_GET['delete'] );

                $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
                $delete_user_query = mysqli_query( $connection, $query );
                header( "Location: users.php" );
            }

        }

    }
    
?>