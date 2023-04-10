<!DOCTYPE html>
<html>
<head>
	<title>accounts</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
	<style type="text/css">
		.error{
			color: red;
		    font-size: 14px;
		    font-weight: bold;
		}
	</style>
</head>
<body>
	<?php
	session_start();
	$data = array();
	$values = array();
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// print_r($_POST);
		// print_r($_FILES);
		$db = mysqli_connect('localhost','root','','phpaccounts');
		if (isset($_POST['submit_account_details']) && $_POST['submit_account_details']=="Submit") {
			if($_POST['first_name']==""){
				$data['first_name'] = "First Name is required";
			}else{
				$values['first_name'] = $_POST['first_name'];
			}
			if($_POST['last_name']==""){
				$data['last_name'] = "Last Name is required";
			}else{
				$values['last_name'] = $_POST['last_name'];
			}
			if($_POST['account_type']==""){
				$data['account_type'] = "Account type is required";
			}else{
				$values['account_type'] = $_POST['account_type'];
			}
			if($_POST['account_number']==""){
				$data['account_number'] = "Account number is required";
			}else{
				$values['account_number'] = $_POST['account_number'];
			}
			if($_POST['confirm_account_number']==""){
				$data['confirm_account_number'] = "Confirm Account number is required";
			}else{
				$values['confirm_account_number'] = $_POST['confirm_account_number'];
			}
			if($_POST['routing_number']==""){
				$data['routing_number'] = "Routing Number is required";
			}else{
				$values['routing_number'] = $_POST['routing_number'];
			}
			if($_FILES['image_upload']['name']==""){
				$data['image_upload'] = "Image is required";
			}else{
				$uploaddir = '/uploads/';
				$uploadfile = $uploaddir . basename($_FILES['image_upload']['name']);
				move_uploaded_file($_FILES['image_upload']['tmp_name'], $uploadfile);
				
			}
			if($_POST['account_number']!=$_POST['confirm_account_number']){
				$data['confirm_account_number'] = "Account Number and Confirm Account Number must match";
			}



		}
	}
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6 card mt-5">
				<form class="p-3" action="" enctype="multipart/form-data" method="POST">
					<div class="form-group">
						<label for="first_name">First Name</label>
						<input type="text" class="form-control" id="first_name" name="first_name" aria-describedby="emailHelp" placeholder="Enter fist name" value="<?php echo isset($values['first_name'])?$values['first_name']:'';?>">
						<small class="error"><?php echo isset($data['first_name'])?$data['first_name']:"";?></small>
					</div>
					<div class="form-group">
						<label for="last_name">Last Name</label>
						<input type="text" class="form-control" id="last_name"name="last_name" placeholder="Enter last name" value="<?php echo isset($values['last_name'])?$values['last_name']:'';?>">
						<small class="error"><?php echo isset($data['last_name'])?$data['last_name']:"";?></small>
					</div>
					<div class="form-group">
						<label for="account_type">Account Type</label><br>
						<input type="radio" name="account_type" value="checking" checked> <label>Checking</label>
						<input type="radio" name="account_type" value="Saving"> <label>Saving</label>
						<small class="error"><?php echo isset($data['account_type'])?$data['account_type']:"";?></small>
					</div>
					<div class="form-group">
						<label for="account_number">Account Number</label>
						<input type="text" class="form-control" id="account_number"name="account_number" placeholder="Account Number" value="<?php echo isset($values['account_number'])?$values['account_number']:'';?>">
						<small class="error"><?php echo isset($data['account_number'])?$data['account_number']:"";?></small>
					</div>
					<div class="form-group">
						<label for="confirm_account_number">Confirm Account Number</label>
						<input type="text" class="form-control" id="confirm_account_number"name="confirm_account_number" placeholder="Confirm account number" value="<?php echo isset($values['confirm_account_number'])?$values['confirm_account_number']:'';?>">
						<small class="error"><?php echo isset($data['confirm_account_number'])?$data['confirm_account_number']:"";?></small>
					</div>
					<div class="form-group">
						<label for="routing_number">Routing Number</label>
						<input type="text" class="form-control" id="routing_number"name="routing_number" placeholder="Routing Number" value="<?php echo isset($values['routing_number'])?$values['routing_number']:'';?>">
						<small class="error"><?php echo isset($data['routing_number'])?$data['routing_number']:"";?></small>
					</div>
					<div class="form-group">
						<label for="image_upload">Image Upload</label>
						<input type="file" class="form-control" id="image_upload" name="image_upload">
						<small class="error"><?php echo isset($data['image_upload'])?$data['image_upload']:"";?></small>
					</div>
					<input type="submit" class="btn btn-primary" name="submit_account_details" value="Submit">
				</form>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
</body>
</html>
