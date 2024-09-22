<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="container w-75">
        <div class="card">
            <div class="card-header">
                <h2>my table idk</h2>
            </div>
            <div class="card-body d-flex flex-column">
    <a class="btn btn-success p-3 m-2" href="addProduct.php">ADD PRODUCT</a>

    <!-- Search and Category Filter Form -->
    <form class="d-flex p-2 " method="GET" action="">
        <input class="flex-grow-1" type="text" name="search" placeholder="Search products..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <select class="flex-grow-1"name="category">
            <option value="">All Categories</option>
            <option value="Electronics" <?php if (isset($_GET['category']) && $_GET['category'] == 'Electronics') echo 'selected'; ?>>Electronics</option>
            <option value="Clothing" <?php if (isset($_GET['category']) && $_GET['category'] == 'Clothing') echo 'selected'; ?>>Clothing</option>
            <option value="Books" <?php if (isset($_GET['category']) && $_GET['category'] == 'Books') echo 'selected'; ?>>Books</option>
            <!-- Add more categories as needed -->
        </select>
        <button class="btn btn-primary flex-grow-1" type="submit">Search</button>
    </form>
    </div>
    <?php
        require_once "classes/products.class.php";
        $productObj = new Products;

        // Get search and category filter from URL parameters
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $category = isset($_GET['category']) ? $_GET['category'] : '';

        // Fetch filtered products
        $products = $productObj->showAllProduct($search, $category);
    ?>
<div class="card-body">
    <table class="table table-striped" border="1">
        <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Availability</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
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
                    <a class="btn btn-success" href="editproduct.php?id=<?php echo $product['id']; ?>">Edit</a>
                    <a class="btn btn-danger" href="deleteProduct.php?id=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                </td>
            </tr>
        <?php
            $i++;
        }
        ?>
        </tbody>
    </table>
</div>

    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
