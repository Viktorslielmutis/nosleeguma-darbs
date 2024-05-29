<?php
include "db.php"; // Using database connection file here
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$id = $_GET['id'];

$qry = mysqli_query($conn,"select * from products where product_id='$id'");

if (!$qry) {
    die("Error in SQL query: " . mysqli_error($conn));
}

$data = mysqli_fetch_array($qry); // fetch data

if (!$data) {
    die("No product found with ID: $id");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $virsraksts = $_POST['virsraksts'];
    $teksts = $_POST['teksts'];
    $cena = $_POST['cena'];

    // Handle file upload
    if(isset($_FILES['Img_URL']) && $_FILES['Img_URL']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["Img_URL"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is an actual image
        $check = getimagesize($_FILES["Img_URL"]["tmp_name"]);
        if ($check === false) {
            echo "This file is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["Img_URL"]["size"] > 1000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // If everything is ok, try to upload the file
        } else {
            if (move_uploaded_file($_FILES["Img_URL"]["tmp_name"], $target_file)) {
                // Update the database with new image URL
                $img_url = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // No new image uploaded, use the existing image URL
        $img_url = $data['img_url'];
    }

    // Update query
    $update_query = "UPDATE products SET virsraksts='$virsraksts', teksts='$teksts', cena='$cena', img_url='$img_url' WHERE product_id='$id'";

    if (mysqli_query($conn, $update_query)) {
        // Redirect user after updating record
        header("Location: profile.php");
        exit; // Make sure to stop script execution after sending the header
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
    <div class="container-ievietot">
        <nav class="navigation-login"> 
            <a href="home.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="20" width="20"><path d="M205 34.8c11.5 5.1 19 16.6 19 29.2v64H336c97.2 0 176 78.8 176 176c0 113.3-81.5 163.9-100.2 174.1c-2.5 1.4-5.3 1.9-8.1 1.9c-10.9 0-19.7-8.9-19.7-19.7c0-7.5 4.3-14.4 9.8-19.5c9.4-8.8 22.2-26.4 22.2-56.7c0-53-43-96-96-96H224v64c0 12.6-7.4 24.1-19 29.2s-25 3-34.4-5.4l-160-144C3.9 225.7 0 217.1 0 208s3.9-17.7 10.6-23.8l160-144c9.4-8.5 22.9-10.6 34.4-5.4z"/></svg></a>
        </nav>

        <div class="ievietotboxmain">
            <div class="teksts">
                <form class="formievietot" method="post" enctype="multipart/form-data">
                    <div class="ievietotbox1">
                        <label id="first">Visraksts</label>
                        <input type="text" name="virsraksts" value="<?php echo $data['virsraksts']; ?>" required>
                    </div>
                    
                    <div class="ievietotbox2">
                        <label id="first">Teksts</label>
                        <input type="text" name="teksts" value="<?php echo $data['teksts']; ?>" required>
                    </div>

                    <div class="ievietotbox2">
                        <label id="first">Cena (€)</label>
                        <input type="number" name="cena" value="<?php echo $data['cena']; ?>" required>
                    </div>

                    <div class="ievietotbox2">
                        <label for="file">Choose an image:</label>
                        <input type="file" name="Img_URL" id="file" accept="image/*">
                        <?php if (!empty($data['img_url'])): ?>
                            <img src="<?php echo $data['img_url']; ?>" alt="Current Image" style="width: 100px; height: auto;">
                        <?php endif; ?>
                    </div>
                    
                    <div class="ievietotbox2">
                        <input id="insertbutton" type="submit" name="submit" value="Izlabot">
                    </div>
                </form>
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo "Izlabots";
                }?>
            </div>
        </div>
    </div>
</body>
</html>
