<?php 

// Escape special character to protect sql injection
function escape( $string ) {

    global $connection;

    return mysqli_real_escape_string( $connection, trim( $string ) );

}

// Users Online
function users_online() {

    if ( isset( $_GET['onlineusers'] ) ) {
        
        global $connection;

        if ( !$connection ) {

            session_start();
            include("../includes/db.php");

            $session = session_id();
            $time = time();
            $time_out_in_seconds = 05;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_query = mysqli_query( $connection, $query );
            $count = mysqli_num_rows( $send_query );

            if ( $count == NULL ) {

                mysqli_query( $connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");    

            }else{

                mysqli_query( $connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");

            }

            $users_online_query = mysqli_query( $connection, "SELECT * FROM users_online WHERE time > '$time_out_in_seconds'");

            echo $count_user = mysqli_num_rows( $users_online_query );

        }
        
    } // get request isset

}

users_online();



// Confirm Database Query
function confirmQuery( $result ) {
    global $connection;

    if ( !$result ) {
        die( "QUERY FAILED" . mysqli_error( $connection ) );
    }
}

// Insert category data into the database
function insert_categories() {
	global $connection;

    if ( isset( $_POST['submit'] ) ) {
        $cat_title = $_POST['cat_title'];
        
        if ( $cat_title == "" || empty( $cat_title ) ) {
            echo "This field should not be empty."; 
        }else {
            $query = "INSERT INTO categories(cat_title)"; 
            $query .= "VALUE('{$cat_title}')";
            
            $create_category_query = mysqli_query( $connection, $query );
            if ( !$create_category_query ) {
                die( 'QUERY FAILED' . mysqli_error( $connection ) );
            }
        }
    }
}

// Find all categories
function findAllCategories() {
	global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query( $connection, $query );
    
    while ( $row = mysqli_fetch_assoc( $select_categories ) ) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        
        $output  = "<tr>";
        $output .= "<td>{$cat_id}</td>";
        $output .= "<td>{$cat_title}</td>";
        $output .= "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        $output .= "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        $output .= "</tr>";
        
        echo $output;
    }
}


// Delete category data from the database
function deleteCategories() {
	global $connection;
    
    if ( isset( $_GET['delete'] ) ) {
        
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
        $delete_query = mysqli_query( $connection, $query );
        header("Location: categories.php");
    }
}



?>

