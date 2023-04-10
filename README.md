Create a new PHP script named "account-registration.php".
Use the mysqli extension to connect to a MySQL database. The database should have a table named "accounts" with columns for "account_number", "first_name", "last_name", "account_type", "routing_number", and "image_filename".
Create an HTML form that includes the following fields:
First Name (input type="text", name="first_name")
Last Name (input type="text", name="last_name")
Account Type (input type="radio", name="account_type", value="checking" or "saving")
Account Number (input type="text", name="account_number")
Confirm Account Number (input type="text", name="confirm_account_number")
Routing Number (input type="text", name="routing_number")
Image Upload (input type="file", name="image_upload")
Submit Button (input type="submit", name="submit")
Use PHP to validate the form data:
Check that all fields are non-empty.
Check that the account number and confirm account number fields match.
Check that the account number does not already exist in the database. If it does, log an error message to a file named "error.log" with the IP address, date, time, and serialized form data. Send an email to the admin with the same information.
If the account number is valid, save the form data and image file to the database and to a directory named "uploads". Log a success message to a file named "success.log" with the IP address, date, time, and serialized form data.
Display a success or error message to the user, depending on whether the form data was valid.

Your test requirements might include the following criteria:

The script should use the mysqli extension to connect to the database.
The script should validate all form data and handle errors appropriately.
The script should save valid form data and image files to the database and to a directory named "uploads".
The script should log errors and successes to separate log files with the IP address, date, time, and serialized form data.
The script should send an email to the admin with error details if the account number already exists in the database.
The script should use only core PHP functions and not rely on any third-party libraries or frameworks.

You might also want to specify test cases that cover different scenarios, such as:

Valid input data with a new account number
Valid input data with an existing account number
Invalid input data, such as missing or mismatched fields
Invalid image file types