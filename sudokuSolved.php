<?php
require "logic.php";

?>
<!DOCTYPE html>
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

        <form action="index.php" method="">
            <?php
            $board=getBoardArray();
            if(isBoardValid($board)){
                if (isSolvable($board)) {
                    drawSolvedBoard($board);
                }
                else{
                    echo "<p>No solution found.</p>";
                }
            }else{
                echo "<p>Sorry, input is not valid.</p>";
            }
            ?>
            <input type="submit" value="Try another!">
        </form>
    </div>

</body>

</html>