<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Contact Form in PHP</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    .container {
      max-width: 500px;
      margin: 50px auto;
      text-align: left;
      font-family: sans-serif;
    }
    form {
      border: 1px solid #1A33FF;
      background: #ecf5fc;
      padding: 40px 50px 45px;
    }
    .form-control:focus {
      border-color: #000;
      box-shadow: none;
    }
    label {
      font-weight: 600;
    }
    
    .error {
      color: red;
      font-weight: 400;
      display: block;
      padding: 6px 0;
      font-size: 14px;
    }
    .form-control.error {
      border-color: red;
      padding: .375rem .75rem;
    }    
  </style>
</head>
<body>
  <div class="container mt-5">
    
    <?php
      include('config/database.php');
      if(!empty($_POST["send"])) {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $account_type = $_POST["account_type"];
        $account_number = $_POST["account_number"];
        $chk_acno = $connection->query("SELECT * FROM accounts where account_number='{$account_number}' ");
        $usr = $chk_acno->fetchAll();
        if(count($usr)>0){
        	$response = array(
                "status" => "alert-danger",
                "message" => "This account number is allready exist"
            );
        }else{
        
		        $routing_number = $_POST["routing_number"];
		        if($_FILES['image_upload']['name']!=""){
		        	$uploaddir = 'uploads/';
					$uploadfile = $uploaddir . basename($_FILES['image_upload']['name']);
					move_uploaded_file($_FILES['image_upload']['tmp_name'], $uploadfile);
					$image = $uploadfile;
		        }else{
		        	$image = "";
		        }
		        
		        // Recipient email
		        // $toMail = "ssnnoouu@gmail.com";
		        // $email = "sumant2k10cs14@gmail.com";
		        
		        // Build email header
		        // $header = "From: " . $first_name . "<". $email .">\r\n";
		        // Send email
		        // if(mail($toMail, $subject, $message, $header)) {
		            // Store contactor data in database
		            $sql = $connection->query("INSERT INTO accounts(account_number, first_name, last_name, account_type, routing_number, image_filename, created_at)
		            VALUES ('{$account_number}', '{$first_name}', '{$last_name}', '{$account_type}', '{$routing_number}', '{$image}', now())");
		        	$sql = "";
		            if(!$sql) {
		              die("MySQL query failed.");
		            } else {
		              $response = array(
		                "status" => "alert-success",
		                "message" => "Account details added successfully"
		              );              
		            }
		        // } else {
		        //     $response = array(
		        //         "status" => "alert-danger",
		        //         "message" => "Message coudn't be sent, try again"
		        //     );
		        // }
	        }
      }  
    ?>
    <!-- Messge -->
    <?php if(!empty($response)) {?>
      <div class="alert text-center <?php echo $response['status']; ?>" role="alert">
        <?php echo $response['message']; ?>
      </div>
    <?php }?>
    <!-- Contact form -->
    <form action="" name="contactForm" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>Fist Name</label>
        <input type="text" class="form-control" name="first_name" id="first_name">
      </div>
      <div class="form-group">
        <label>Last Name</label>
        <input type="text" class="form-control" name="last_name" id="last_name">
      </div>
      <div class="form-group">
          <label for="account_type">Account Type</label><br>
          <input type="radio" name="account_type" value="checking" checked> <label>Checking</label>
          <input type="radio" name="account_type" value="Saving"> <label>Saving</label>
      </div>
      <div class="form-group">
        <label>Account Number</label>
        <input type="text" class="form-control" name="account_number" id="account_number">
      </div>
      <div class="form-group">
        <label>Confirm Account Number</label>
        <input type="text" class="form-control" name="confirm_account_number" id="confirm_account_number">
      </div>
      <div class="form-group">
        <label>Routing Number</label>
        <input type="text" class="form-control" name="routing_number" id="routing_number">
      </div>
      <div class="form-group">
        <label for="image_upload">Image Upload</label>
        <input type="file" class="form-control" id="image_upload" name="image_upload">
      </div>
      <input type="submit" name="send" value="Send" class="btn btn-dark btn-block">
    </form>
  </div>
  <!-- JavaScript -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
  
  <script>
    $(function() {
      $("form[name='contactForm']").validate({
        // Define validation rules
        rules: {
          first_name: "required",
          account_type: "required",
          routing_number: "required",    
          account_number: {
            required: true,
            number: true,
            minlength: 10,
            maxlength: 14            
          },          
          confirm_account_number: {
            required: true,
            equalTo: "#account_number"
          },
          image_upload: {
            required: true,
            extension: "jpg|jpeg|png|ico|bmp|webp"
    	  }
        },
        // Specify validation error messages
        messages: {
          first_name: "Please provide first name.",
          account_number: {
            required: "Please provide a account number",
            minlength: "Account number must be min 14 characters long",
            maxlength: "Account number must not be more than 14 characters long"
          },
          confirm_account_number: {
            required : 'Confirm account number is required',
            equalTo : 'Confirm account number not matching',
          },
          image_upload: {
            required: "Please upload file.",
            extension: "Please upload file in these format only (jpg, jpeg, png, ico, bmp)."
          }
        },
        submitHandler: function(form) {
          form.submit();
        }
      });
    });    
  </script>
</body>
</html>