<?php
    error_reporting(0);
    ini_set('display_errors', 0); 
    require_once "classes/function.php";
    require_once "classes/books.php";
    $title = $auth_name = $genre = $publisher = $pub_date = $edition = $no_of_copies = $format = $age_group = $rating = '';
    $book_idErr = $titleErr = $auth_nameErr = $genreErr = $publisherErr = $pub_dateErr = $editionErr = $no_of_copiesErr = $formatErr = $age_groupErr = $ratingErr = '';

    $bookObj = new Books;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['clear_database']) && $_POST['clear_database'] == '1') {
            $bookObj->clearDatabase();
        } 
        elseif (isset($_POST['submit'])) {
            $title = clean_input($_POST['title']);
            if (empty($title)) {
                $titleErr = "Title is required";
            }

            $auth_name = clean_input($_POST['auth_name']);
            if (empty($auth_name)) {
                $auth_nameErr = "Author name is required";
            }

            $genre = clean_input($_POST['genre']);
            if (empty($genre)) {
                $genreErr = "Genre is required";
            }

            $publisher = clean_input($_POST['publisher']);
            if (empty($publisher)) {
                $publisherErr = "Publisher is required";
            }

            $pub_date = clean_input($_POST['pub_date']);
            if (empty($pub_date)) {
                $pub_dateErr = "Publication date is required";
            }

            $edition = clean_input($_POST['edition']);
            if (empty($edition)) {
                $editionErr = "Edition is required";
            } elseif (!is_numeric($edition)) {
                $editionErr = "Edition must be a number";
            }

            $no_of_copies = clean_input($_POST['no_of_copies']);
            if (empty($no_of_copies)) {
                $no_of_copiesErr = "Number of copies is required";
            } elseif (!is_numeric($no_of_copies)) {
                $no_of_copiesErr = "Number of copies must be a number";
            }

            $format = clean_input($_POST['format']);
            if (empty($format)) {
                $formatErr = "Format is required";
            }

            $age_group = isset($_POST['age_group']) ? $_POST['age_group'] : array();
            if (empty($age_group)) {
                $age_groupErr = "At least one age group must be selected";
            }

            $age_group_str = implode(',', $age_group);

            $rating = clean_input($_POST['rating']);
            if (empty($rating)) {
                $ratingErr = "Rating is required";
            } elseif (!is_numeric($rating)) {
                $ratingErr = "Rating must be a number";
            }

            if (empty($titleErr) && empty($auth_nameErr) && empty($genreErr) && empty($publisherErr) && empty($pub_dateErr) && empty($editionErr) && empty($no_of_copiesErr) && empty($formatErr) && empty($age_groupErr) && empty($ratingErr)) {
                $bookObj->title = $title;
                $bookObj->auth_name = $auth_name;
                $bookObj->genre = $genre;
                $bookObj->publisher = $publisher;
                $bookObj->pub_date = $pub_date;
                $bookObj->edition = $edition;
                $bookObj->no_of_copies = $no_of_copies;
                $bookObj->format = $format;
                $bookObj->age_group = $age_group_str;
                $bookObj->rating = $rating;

                $bookObj->add();
            }
        }
    }

    $books = $bookObj->getBooks();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="form">
        <h2>Add a New Book to the Library</h2>
        <form action="index.php" method="post">
            <label for="title">Book Title</label>
            <input type="text" id="title" name="title" placeholder="Enter Book Title" required>
            <label for="auth_name">Author's Name</label>
            <input type="text" id="auth_name" name="auth_name" placeholder="Enter Lead Author's Name" required>
            <label for="genre">Genre</label>
            <select name="genre" id="genre" required>
                <option value="" selected>-- Select --</option>
                <option value="fiction">Fiction</option>
                <option value="biography">Biography</option>
                <option value="history">History</option>
                <option value="drama">Drama</option>
                <option value="poetry">Poetry</option>
            </select>
            <label for="publisher">Publisher</label>
            <input type="text" name="publisher" id="publisher" placeholder="Enter Publisher's Company Name" required>
            <label for="pub_date">Publication Date</label>
            <input type="date" name="pub_date" id="pub_date" required>
            <label for="edition">Edition</label>
            <input type="number" name="edition" id="edition" placeholder="Enter Edition Number" required>
            <label for="no_of_copies">Number of Copies</label>
            <input type="number" name="no_of_copies" id="no_of_copies" placeholder="Enter number of available copies" required>
            <label>Format</label>
            <div class="format">
                <input type="radio" name="format" id="hardbound" value="hardbound" required>
                <label for="hardbound">Hardbound</label>
                <input type="radio" name="format" id="softbound" value="softbound">
                <label for="softbound">Softbound</label>
            </div>
            <label>Age Group</label>
            <div class="age_group">
                <input type="checkbox" name="age_group[]" id="kids" value="kids">
                <label for="kids">Kids</label>
                <input type="checkbox" name="age_group[]" id="teens" value="teens">
                <label for="teens">Teens</label>
                <input type="checkbox" name="age_group[]" id="adults" value="adults">
                <label for="adults">Adults</label>
            </div>
            <label for="rating">Book Rating</label>
            <div class="book_rating">
                1 star
                <input type="range" name="rating" id="rating" min="1" max="5" required> 5 stars
            </div>
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="4" cols="10" placeholder="Describe the book (optional)"></textarea>
            <input id="cta" type="submit" name="submit" value="Save Book">
        </form>

        <form action="index.php" method="post">
            <input type="hidden" name="clear_database" value="1">
            <button id="cta2" type="submit" onclick="return confirm('Are you sure you want to delete all records?');">Clear Database</button>
        </form>
    </div>

    <div class="table">
        <h2>Books in the Library</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Publisher</th>
                    <th>Publication Date</th>
                    <th>Edition</th>
                    <th>Number of Copies</th>
                    <th>Format</th>
                    <th>Age Group</th>
                    <th>Rating</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (empty($books)) { ?>
                    <tr>
                        <td colspan="11" align="center">
                            <span class="search">No products found.</span>
                        </td>
                    </tr>

                <?php 
                    }
                foreach ($books as $book): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($book['book_id'])?></td>
                        <td><?php echo htmlspecialchars($book['title']); ?></td>
                        <td><?php echo htmlspecialchars($book['auth_name']); ?></td>
                        <td><?php echo htmlspecialchars($book['genre']); ?></td>
                        <td><?php echo htmlspecialchars($book['publisher']); ?></td>
                        <td><?php echo htmlspecialchars($book['pub_date']); ?></td>
                        <td><?php echo htmlspecialchars($book['edition']); ?></td>
                        <td><?php echo htmlspecialchars($book['no_of_copies']); ?></td>
                        <td><?php echo htmlspecialchars($book['format']); ?></td>
                        <td><?php echo htmlspecialchars($book['age_group']); ?></td>
                        <td><?php echo htmlspecialchars($book['rating']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
