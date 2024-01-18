<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['username']) || !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
?>


<html lang="fr">
<head>
    <script src="../script/switch_mode.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/Choice_Edit.css">
    <title>Choice_Edit</title>
</head>
<body>
<a class="Edit_admin" href="Edit_admin.php">Edit projet</a><a class="Edit_blog" href="Edit_blog.php">Edit blog</a><a class="Edit_skills" href="Edit_Skills.php">Edit Skills</a>
</body>

</html>
