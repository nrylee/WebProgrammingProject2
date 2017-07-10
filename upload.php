<?php
if (isset($_POST['submit'])) {
	$file = $_FILES['file'];

	$fileName = $file['name'];
	$fileTmpName = $file['tmp_name'];
	$fileSize = $file['size'];
	$fileError = $file['error'];
	$fileType = $file['type'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	$allowed = array('jpg', 'jpeg', 'png');

	if (in_array($fileActualExt, $allowed)) {
		if ($fileError === 0) {
			if ($fileSize < 1000000) {
				$fileNameNew = uniqid('', true).".".$fileActualExt;
				$fileDestination = 'avatar/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				header("Location: profile.php?uploadsuccess");
			} else {
				echo "Your file is too big";
			}
		} else {
			echo "Error uploading file";
		}
	} else {
		echo "Files of this type cannot be uploaded";
	}
}

if (isset($_POST['pokerface'])) {
	$file = $_FILES['file'];

	$fileName = $file['name'];
	$fileTmpName = $file['tmp_name'];
	$fileSize = $file['size'];
	$fileError = $file['error'];
	$fileType = $file['type'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	$allowed = array('jpg', 'jpeg', 'png');

	if (in_array($fileActualExt, $allowed)) {
		if ($fileError === 0) {
			if ($fileSize < 1000000) {
				$fileNameNew = uniqid('', true).".".$fileActualExt;
				$fileDestination = 'pokerface/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				header("Location: profile.php?uploadsuccess");
			} else {
				echo "Your file is too big";
			}
		} else {
			echo "Error uploading file";
		}
	} else {
		echo "Files of this type cannot be uploaded";
	}
}