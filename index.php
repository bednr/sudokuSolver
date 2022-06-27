<!DOCTYPE html>
<?php
require "logic.php";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>SudokuSolver</title>
</head>

<body>

    <h1>Sudoku Solver</h1>

<div class="formContainer">
    <form action="sudokuSolved.php" method="POST">
        <?php
        drawInputBoard();
        ?>
    </form>
</div>
</body>
</html>