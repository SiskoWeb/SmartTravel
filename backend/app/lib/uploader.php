<?php

  function uploadImage($fileInput, $targetDir)
{
   
    if ($_FILES[$fileInput]) {
        $targetPath = $targetDir . basename($_FILES[$fileInput]['name']);
        $imageFileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($imageFileType, $allowedExtensions) &&
            move_uploaded_file($_FILES[$fileInput]['tmp_name'], $targetPath)) {
            return $targetPath; // Return the path of the uploaded image
        } else {
            return false; // Failed to upload image or invalid file extension
        }
    } else {
        return false; // No file submitted
    }
}

?>
