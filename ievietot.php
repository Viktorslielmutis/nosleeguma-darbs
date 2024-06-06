<?php
session_start();

// Check if the user is logged in, if not then redirect him to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$id = $_SESSION["id"];
require_once "db.php";

// Function to handle and display errors
function displayError($errorMessage) {
    return "<div class='error-message'>$errorMessage</div>";
}

// Array to store error messages for each input field
$errorMessages = array();
$successMessage = '';

if (isset($_POST['submit'])) {
    // Validate input fields
    if (empty($_POST['virsraksts'])) {
        $errorMessages[] = "Lūdzu ievietojiet virsrakstu.";
    }
    if (empty($_POST['teksts'])) {
        $errorMessages[] = "Lūdzu ievietojiet tekstu.";
    }
    if (empty($_POST['cena'])) {
        $errorMessages[] = "Lūdzu ievietojiet cenu.";
    }
    if (empty($_FILES["Img_URL"]["name"])) {
        $errorMessages[] = "Lūdzu izvēlieties attēlu.";
    }
    if (empty($_POST['categories'])) {
        $errorMessages[] = "Lūdzu izvēlieties kategorijas.";
    }

    // Check if there are any errors
    if (empty($errorMessages)) {
        $target_dir = "uploads/"; // Specify the target directory where you want to store the uploaded files
        $target_file = $target_dir . basename($_FILES["Img_URL"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($_FILES["Img_URL"]["tmp_name"]);
        if ($check === false) {
            $errorMessages[] = "Šis fails nav bilde.";
            $uploadOk = 0;
        }

        // Check file size (adjust as needed)
        if ($_FILES["Img_URL"]["size"] > 1000000) {
            $errorMessages[] = "Šis fails ir par lielu.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedFormats)) {
            $errorMessages[] = "Tikai JPG, JPEG, PNG, un GIF formāti ir atļauti.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 1) {
            // If everything is ok, try to upload the file
            if (move_uploaded_file($_FILES["Img_URL"]["tmp_name"], $target_file)) {
                // Insert data into the database
                $virsraksts = $_POST['virsraksts'];
                $teksts = $_POST['teksts'];
                $cena = $_POST['cena'];

                // Prepare the SQL statement to prevent SQL injection
                $stmt = $conn->prepare("INSERT INTO products (user_id, virsraksts, teksts, img_url, cena) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("isssd", $id, $virsraksts, $teksts, $target_file, $cena);

                if ($stmt->execute()) {
                    // Get the last inserted product ID
                    $lastInsertedProductId = $stmt->insert_id;

                    // Insert product categories
                    if (isset($_POST['categories']) && is_array($_POST['categories'])) {
                        $categoryStmt = $conn->prepare("INSERT INTO product_categories (product_id, category_id) VALUES (?, ?)");
                        foreach ($_POST['categories'] as $categoryId) {
                            $categoryStmt->bind_param("ii", $lastInsertedProductId, $categoryId);
                            $categoryStmt->execute();
                        }
                        $categoryStmt->close();
                    }

                    $successMessage = '<div class="ievietosana-zina">Produkts veiksmīgi ievietots!</div>';
                } else {
                    $errorMessages[] = "Error inserting product: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $errorMessages[] = "Sorry, there was an error uploading your file.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-z8Esh+4kymgcWTnF2ODFr/lF+2f1CRRfHxWZuT7g1PiV+Lly3Q2NwCJhY9P+dweA" crossorigin="anonymous">
    <title>Veikals</title>
</head>
<body>
<div class="container-ievietot">

<nav class="navigation-login"> 
        <a href="home.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="20" width="20"><path d="M205 34.8c11.5 5.1 19 16.6 19 29.2v64H336c97.2 0 176 78.8 176 176c0 113.3-81.5 163.9-100.2 174.1c-2.5 1.4-5.3 1.9-8.1 1.9c-10.9 0-19.7-8.9-19.7-19.7c0-7.5 4.3-14.4 9.8-19.5c9.4-8.8 22.2-26.4 22.2-56.7c0-53-43-96-96-96H224v64c0 12.6-7.4 24.1-19 29.2s-25 3-34.4-5.4l-160-144C3.9 225.7 0 217.1 0 208s3.9-17.7 10.6-23.8l160-144c9.4-8.5 22.9-10.6 34.4-5.4z"/></svg></a>
    </nav>

    <div class="ievietotboxmain">
        <div class="teksts">
            <form class="formievietot" method="post" enctype="multipart/form-data">
                <?php
                // Display error messages
                foreach ($errorMessages as $errorMessage) {
                    echo displayError($errorMessage);
                }
                ?>

                <div class="ievietotbox1">
                    <label id="first">Virsraksts</label>
                    <input type="text" name="virsraksts" >
                </div>
                
                <div class="ievietotbox2">
                    <label id="first">Teksts</label>
                    <input type="text" name="teksts" >
                </div>

                <div class="ievietotbox2">
                    <label id="first">Cena (€)</label>
                    <input type="number" name="cena" >
                </div>

                <div class="ievietotbox2">
                    <label for="file">Izvēlies bildi:</label>
                    <input type="file" name="Img_URL" id="file" accept="image/*" >
                </div>
                
                <div class="ievietotbox2">
                    <label for="categories">Izvēlies kategoriju:</label><br>
                    <select name="categories[]" id="categories" multiple >
                        <?php
                        // Fetch categories from the database
                        $sql = "SELECT * FROM categories";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row["category_id"] . '">' . $row["name"] . '</option>';
                            }
                        } else {
                            echo '<option value="">No categories found</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="ievietotbox2">
                    <input id="insertbutton" type="submit" name="submit" value="Ievietot">
                </div>
            </form>

            <?php
            // Display success message
            if ($successMessage) {
                echo $successMessage;
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>