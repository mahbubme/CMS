<?php 

	if ( isset( $_POST['create_user']) ) {
		$user_firstname = $_POST['user_firstname'];
		$user_lastname = $_POST['user_lastname'];
		$user_role = $_POST['user_role'];

		// $user_image = $_FILES['image']['name'];
		// $post_image_temp = $_FILES['image']['tmp_name'];
		// move_uploaded_file( $post_image_temp, "../images/{$post_image}" );

		$username = $_POST['username'];
		$user_email = $_POST['user_email'];
		$user_password = $_POST['user_password'];
		// $date = date('d-m-y');

		$query  = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) ";
		$query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}') ";

		$create_post_query = mysqli_query( $connection, $query );

		confirmQuery( $create_post_query );
	}

?>



<form action="" method="post" enctype="multipart/form-data">
	
	<div class="form-group">
		<label for="user_firstname">Firstname</label>
		<input type="text" class="form-control" name="user_firstname">
	</div>

	<div class="form-group">
		<label for="user_lastname">Lastname</label>
		<input type="text" class="form-control" name="user_lastname">
	</div>

	<div class="form-group">
		<label for="user_role">User Role</label><br>
		<select name="user_role" id="">
			<option value="subscriber">Select Options</option>
			<option value="admin">Admin</option>	
			<option value="subscriber">Subscriber</option>	
		</select>
	</div>

	<!-- <div class="form-group">
		<label for="image">Post Image</label>
		<input type="file" class="form-control" name="image">
	</div> -->

	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" name="username">
	</div>

	<div class="form-group">
		<label for="user_email">Email</label>
		<input type="email" class="form-control" name="user_email">
	</div>

	<div class="form-group">
		<label for="user_password">Password</label>
		<input type="password" class="form-control" name="user_password">
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="create_user" value="Add User">
	</div>
</form>