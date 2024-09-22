<?php
    require_once "classes/products.class.php"; // Include the class with the delete method

    if (isset($_GET['id'])) { // Check if the product ID is passed
        $productObj = new Products(); // Instantiate the Products class
        $id = $_GET['id']; // Get the product ID from the URL

        // Call the delete function from your class
        if ($productObj->delete($id)) {
            // Redirect or display success message
            header("Location: product.php?message=ProductDeleted");
        } else {
            // Display error message
            echo "Error deleting product!";
        }
    } else {
        // If no ID is passed, display an error
        echo "Invalid product ID!";
    }
    exit(); // End the script
