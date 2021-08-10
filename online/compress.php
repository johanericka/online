<!doctype html>
<html>
    <head>
        <title>How to Compress Image size while Uploading with PHP</title>
    </head>
	<body>
		<?php
        if(isset($_POST['upload'])){

            // Getting file name
            $filename = $_FILES['imagefile']['name'];
         
            // Valid extension
            $valid_ext = array('png','jpeg','jpg');

            // Location
            $location = "uploads/".$filename;

            // file extension
            $file_extension = pathinfo($location, PATHINFO_EXTENSION);
            $file_extension = strtolower($file_extension);

            // Check extension
            if(in_array($file_extension,$valid_ext)){  

                // Compress Image
                compressImage($_FILES['imagefile']['tmp_name'],$location,60);

            }else{
                echo "Invalid file type.";
            }
        }

        // Compress image
        function compressImage($source, $destination, $quality) {

            $info = getimagesize($source);

            if ($info['mime'] == 'image/jpeg') 
                $image = imagecreatefromjpeg($source);

            elseif ($info['mime'] == 'image/gif') 
                $image = imagecreatefromgif($source);

            elseif ($info['mime'] == 'image/png') 
                $image = imagecreatefrompng($source);

            imagejpeg($image, $destination, $quality);

        }

        ?>

        <!-- Upload form -->
        <form method='post' action='' enctype='multipart/form-data'>
            <input type='file' name='imagefile' >
            <input type='submit' value='Upload' name='upload'>    
        </form>
	</body>
</html>