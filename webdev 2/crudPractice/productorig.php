<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>
<body>
    <a href="addProduct.php">ADD PRODUCT</a>

    <!-- Search and Category Filter Form -->
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search products..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <select name="category">
            <option value="">All Categories</option>
            <option value="Electronics" <?php if (isset($_GET['category']) && $_GET['category'] == 'Electronics') echo 'selected'; ?>>Electronics</option>
            <option value="Clothing" <?php if (isset($_GET['category']) && $_GET['category'] == 'Clothing') echo 'selected'; ?>>Clothing</option>
            <option value="Books" <?php if (isset($_GET['category']) && $_GET['category'] == 'Books') echo 'selected'; ?>>Books</option>
            <!-- Add more categories as needed -->
        </select>
        <button type="submit">Search</button>
    </form>

    <?php
        require_once "classes/products.class.php";
        $productObj = new Products;

        // Get search and category filter from URL parameters
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $category = isset($_GET['category']) ? $_GET['category'] : '';

        // Fetch filtered products
        $products = $productObj->showAllProduct($search, $category);
    ?>

    <table border="1">
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Availability</th>
            <th>Actions</th>
        </tr>
        <?php if (empty($products)) { ?>
            <tr>
                <td colspan="6">No products found.</td>
            </tr>
        <?php
        }
        $i = 1;
        foreach ($products as $product) { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['category']; ?></td>
                <td><?php echo $product['price']; ?></td>
                <td><?php echo $product['availability']; ?></td>
                <td>
                    <a href="editproduct.php?id=<?php echo $product['id']; ?>">Edit</a>
                    <a href="deleteProduct.php?id=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                </td>
            </tr>
        <?php
            $i++;
        }
        ?>
    </table>
</body>
</html>
