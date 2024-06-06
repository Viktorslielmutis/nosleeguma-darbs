<?php
session_start();
require_once "db.php";

// Check if the user is logged in, if not then redirect him to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$id = $_SESSION["id"];

// Fetch product details from the database
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $qry = mysqli_query($conn,"SELECT * FROM products WHERE product_id='$id'");
    if (!$qry) {
        die("Error in SQL query: " . mysqli_error($conn));
    }
    $data = mysqli_fetch_array($qry); // fetch product data

    // Fetch selected categories for the product
    $categoryQry = mysqli_query($conn, "SELECT category_id FROM product_categories WHERE product_id='$id'");
    $selectedCategories = [];
    while ($row = mysqli_fetch_assoc($categoryQry)) {
        $selectedCategories[] = $row['category_id'];
    }
}

// Function to handle and display errors
function displayError($errorMessage) {
    return "<div class='error-message'>$errorMessage</div>";
}

// Array to store error messages for each input field
$errorMessages = array();

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
    if (empty($_POST['categories'])) {
        $errorMessages[] = "Lūdzu izvēlieties kategorijas.";
    }

    // Check if there are any errors
    if (empty($errorMessages)) {
        // Check if a new image file is uploaded
        if (!empty($_FILES["Img_URL"]["name"])) {
            // Handle image upload
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["Img_URL"]["name"]);

            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["Img_URL"]["tmp_name"], $target_file)) {
                // Update database with new image path
                $new_img_url = $target_file;
                // Remove the old image file
                if (!empty($data['img_url'])) {
                    unlink($data['img_url']);
                }
            } else {
                displayError("Sorry, there was an error uploading your file.");
            }
        } else {
            // No new image file uploaded, retain the existing image path
            $new_img_url = $_POST['current_img_url'];
        }

        // Update other fields in the database
        $virsraksts = $_POST['virsraksts'];
        $teksts = $_POST['teksts'];
        $cena = $_POST['cena'];

        // Prepare and execute the SQL statement to update the product
        $stmt = $conn->prepare("UPDATE products SET virsraksts=?, teksts=?, img_url=?, cena=? WHERE product_id=?");
        $stmt->bind_param("ssssi", $virsraksts, $teksts, $new_img_url, $cena, $id);

        if ($stmt->execute()) {
            // Update product categories
            $stmt = $conn->prepare("DELETE FROM product_categories WHERE product_id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $categories = $_POST['categories'];
            foreach ($categories as $category_id) {
                $stmt = $conn->prepare("INSERT INTO product_categories (product_id, category_id) VALUES (?, ?)");
                $stmt->bind_param("ii", $id, $category_id);
                $stmt->execute();
            }

            echo "Produkts izlabots veiksmīgi.";
        } else {
            displayError("Error updating product: " . $stmt->error);
        }
        $stmt->close();
    } else {
        // Display error messages for empty fields
        foreach ($errorMessages as $errorMessage) {
            echo displayError($errorMessage);
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
    <title>Edit Product</title>
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
                        <label id="first">Virsraksts</label>
                        <input type="text" name="virsraksts" value="<?php echo htmlspecialchars($data['virsraksts']); ?>" >
                    </div>
                    
                    <div class="ievietotbox2">
                        <label id="first">Teksts</label>
                        <input type="text" name="teksts" value="<?php echo htmlspecialchars($data['teksts']); ?>" >
                    </div>

                    <div class="ievietotbox2">
                        <label id="first">Cena (€)</label>
                        <input type="number" name="cena" value="<?php echo htmlspecialchars($data['cena']); ?>" >
                    </div>

                    <div class="ievietotbox2">
                        <label for="file">Izvēlies bildi:</label>
                        <input type="file" name="Img_URL" id="file" accept="image/*" >
                        <?php if (!empty($data['img_url'])): ?>
                            <img src="<?php echo $data['img_url']; ?>" alt="Current Image" style="width: 100px; height: auto;">
                            <input type="hidden" name="current_img_url" value="<?php echo $data['img_url']; ?>">
                        <?php endif; ?>
                    </div>
                    
                    <div class="ievietotbox2">
                        <label for="categories">Izvēlies kategoriju:</label><br>
                        <select name="categories[]" id="categories" multiple>
                            <?php
                            // Fetch categories from the database
                            $sql = "SELECT * FROM categories";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $selected = in_array($row["category_id"], $selectedCategories) ? 'selected' : '';
                                    echo '<option value="' . $row["category_id"] . '" ' . $selected . '>' . $row["name"] . '</option>';
                                }
                            } else {
                                echo '<option value="">No categories found</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="ievietotbox2">
                        <input id="insertbutton" type="submit" name="submit" value="Izlabot">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
