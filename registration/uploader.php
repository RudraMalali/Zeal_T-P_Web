<?php
if(isset($_POST['submit'])){
$con=new MongoClient();
$datab=$con->Zeal_TP;
$collection=$con->Students;

$ftypeerr=$emptfielderr=$emailerr=" ";

	$f_name=$_POST['full_name'];
	$email=$_POST['email'];
	$institute=$_POST['institute_name'];
	$dept=$_POST['department'];
	$rollno=$_POST['roll_no'];
	$contactno=$_POST['contact_no'];

	if(empty($f_name)||empty($email)||empty($institute)||empty($dept)||empty($rollno)||empty($contactno))
	{
		$emptfielderr="All details are mandatory!Please fill the complete form!";
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  	$emailErr = "Invalid email format!Please check your Email-Id!"; 
	} 

	$document = array( 
		"name" =>$f_name, 
		"email" => $email, 
		"institute" =>$institute,
		"department" =>$dept,
		"rollno" =>$rollno,
		"contact_no"=>$contactno
	 );

	 $collection->insert($document);

	$file = $_FILES['file_cv'];
	
	$fileName = $_FILES['file_cv']['name'];
	$fileTmpName = $_FILES['file_cv']['tmp_name'];
	$fileSize = $_FILES['file_cv']['size'];
	$fileError = $_FILES['file_cv']['error'];
	$fileType = $_FILES['file_cv']['type'];
	
	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));
	
	$allowed = array('jpg','jpeg','png','pdf');
	
	if(in_array($fileActualExt,$allowed)){
		if($fileError == 0){
			if($fileSize < 5000000){
				$fileNameNew = uniqid('',true).".".$fileActualExt;
				$fileDestination = 'uploads/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				header("Location: index.html?UploadSuccess");
			}
			else{
				echo "Your file is too big";
			}
		}
		else{
			echo "There was an Error uploading File";
		}
	}
	else{
		echo "You cannot upload files of this type";
	}
}
?>