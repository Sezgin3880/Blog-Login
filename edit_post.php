<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["id"])) {
  header("Location: index.php");
  exit;
}

$host = "localhost";
$user = "root";
$pass = "";
$db = "blog_posts";

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $sql = "UPDATE blogs SET title='$title', description='$description' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: blog.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

$id = $_GET['id'];
if (!isset($id)) {
    echo "No blog post found with the given ID.";
    exit;
}

$sql = "SELECT * FROM blogs WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "No blog post found with the given ID.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog Post</title>
    <!-- Tailwind CSS -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200">
    <div class="container mx-auto">
        <div class="bg-white p-5 rounded-lg shadow mt-10">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="mb-5">
                    <label class="block text-gray-700 font-bold mb-2" for="title">
                        Title
                    </label>
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="title" type="text" name="title" value="<?php echo $row['title']; ?>" required>
                </div>
                <div class="mb-5">
                    <label class="block text-gray-700 font-bold mb-2" for="description">
                        Description
                    </label>
                    <textarea class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="description" name="description" rows="5" required><?php echo $row['description']; ?></textarea>
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="submit">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 