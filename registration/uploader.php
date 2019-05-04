<?php
if(isset($_POST['submit'])){
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