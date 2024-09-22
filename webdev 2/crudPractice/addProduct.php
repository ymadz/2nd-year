<?php
require_once "classes/products.class.php";
require_once "classes/function.php";

$name = $category = $price = $availability = '';
$nameErr = $categoryErr = $priceErr = $availabilityErr = '';

$productObj = new Products;

if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['add'])) {
    $name = clean_input($_POST['name']);
    $category = clean_input($_POST['category']);
    $price = clean_input($_POST['price']);
    $availability = clean_input($_POST['availability']);

    if (empty($name)) {
        $nameErr = "Name is required";
    }

    if (empty($category)) {
        $categoryErr = "Category is required";
    }

    if (empty($price)) {
        $priceErr = "Price is required";
    } else if (!is_numeric($price)) {
        $priceErr = "Price must be a number";
    } else if ($price < 1) {
        $priceErr = "Price must be greater than 0";
    }

    if (empty($availability)) {
        $availabilityErr = "Availability is required";
    }

    if (empty($nameErr) && empty($categoryErr) && empty($priceErr) && empty($availabilityErr)) {
        $productObj->name = $name;
        $productObj->category = $category;
        $productObj->price = $price;
        $productObj->availability = $availability;

        if ($productObj->addProduct()) {
            header("Location: product.php");
        } else {
            echo "Something went wrong when adding the new product.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Add Product</h1>
    <form action="addProduct.php" method="post">
        <span class="error">* Required fields</span><br><br>

        <label for="name">Name<span class="error"> *</span></label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>"><br>
        <span class="error"><?php echo $nameErr; ?></span><br>

        <label for="category">Category<span class="error"> *</span></label>
        <input type="text" name="category" id="category" value="<?php echo htmlspecialchars($category); ?>"><br>
        <span class="error"><?php echo $categoryErr; ?></span><br>

        <label for="price">Price<span class="error"> *</span></label>
        <input type="text" name="price" id="price" value="<?php echo htmlspecialchars($price); ?>"><br>
        <span class="error"><?php echo $priceErr; ?></span><br>

        <label for="availability">Availability</label><span class="error">*</span>
            <br>
            <input type="radio" value="In Stock" name="availability" id="instock" <?= ($availability == 'In Stock') ? 'checked' : '' ?>>
            <label for="instock">In Stock</label>
            <br>
            <input type="radio" value="No Stock" name="availability" id="nostock" <?= ($availability == 'No Stock') ? 'checked' : '' ?>>
            <label for="nostock">No Stock</label>
            <br>
            <?php if (!empty($availabilityErr)): ?>
                <span class="error"><?= $availabilityErr ?></span><br>
            <?php endif; ?>
            <br>

        <input type="submit" name="add" value="Add Product">
    </form>
</body>
</html>


