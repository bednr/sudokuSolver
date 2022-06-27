<?php
const GRID_SIZE = 9;

function getBoardArray(): array
{
    return fillArray();
}

function fillArray(): array
{
    $board = [];
    for ($i = 0; $i < GRID_SIZE; $i++) {
        for ($j = 0; $j < GRID_SIZE; $j++) {
            $cell = $_POST["r" . $i . "c" . $j];
            if ($cell < 10 && $cell > 0) {
                $board[$i][$j] = $cell;
            } else {
                $board[$i][$j] = 0;
            }
        }
    }
    return $board;
}


function isNumberValid(int $num, int $row, int $col, array $board): bool
{
    for ($i = 0; $i < GRID_SIZE; $i++) {
        if ($num == $board[$row][$i]) {
            return false;
        }
        if ($num == $board[$i][$col]) {
            return false;
        }
    }

    $boxRow = floor($row / 3) * 3;
    $boxCol = floor($col / 3) * 3;

    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            if ($num == $board[$boxRow + $i][$boxCol + $j]) {
                return false;
            }
        }
    }

    return true;
}

// input array is passed by reference!
function isSolvable(array &$board): bool
{
    for ($i = 0; $i < GRID_SIZE; $i++) {
        for ($j = 0; $j < GRID_SIZE; $j++) {
            if ($board[$i][$j] == 0) {
                for ($num = 1; $num <= GRID_SIZE; $num++) {
                    if (isNumberValid($num, $i, $j, $board)) {
                        $board[$i][$j] = $num;
                        if (isSolvable($board)) {
                            return true;
                        } else {
                            $board[$i][$j] = 0;
                        }
                    }
                }
                return false;
            }
        }
    }

    return true;
}

function fillArrayOneToNineWithZeroes(): array
{
    $arr = [];
    for ($i = 1; $i < 10; $i++) {
        $arr[$i] = 0;
    }
    return $arr;
}

function isBoardValid(array $board): bool
{
    $colChecker = fillArrayOneToNineWithZeroes();
    $rowChecker = fillArrayOneToNineWithZeroes();
    $boxChecker = fillArrayOneToNineWithZeroes();

    for ($i = 0; $i < GRID_SIZE; $i++) {
        for ($j = 0; $j < GRID_SIZE; $j++) {
            $numInRow = $board[$i][$j];
            $numInCol = $board[$j][$i];

            if ($numInRow != 0) {
                if (++$rowChecker[$numInRow] > 1) {
                    return false;
                }
            }

            if ($numInCol != 0) {
                if (++$colChecker[$numInCol] > 1) {
                    return false;
                }
            }

            if (($i + 1) % 3 == 0 && ($j + 1) % 3 == 0) {
                $boxRow = floor($i / 3) * 3;
                $boxCol = floor($j / 3) * 3;

                for ($a = 0; $a < 3; $a++) {
                    for ($b = 0; $b < 3; $b++) {
                        $numInBox = $board[$boxRow + $a][$boxCol + $b];
                        if ($numInBox != 0 && ++$boxChecker[$numInBox] > 1) {
                            return false;
                        }
                    }
                }
                $boxChecker = fillArrayOneToNineWithZeroes();
            }
        }
        $colChecker = fillArrayOneToNineWithZeroes();
        $rowChecker = fillArrayOneToNineWithZeroes();
    }

    return true;
}

function drawSolvedBoard(array $board): void
{
    for ($i = 0; $i < GRID_SIZE; $i++) {
        for ($j = 0; $j < GRID_SIZE; $j++) {
            if ($j != 0 && $j % 3 == 0) {
                echo "&nbsp";
            }
            echo "<input type='number' readonly value='" . $board[$i][$j] . "'";
            if ($i % 3 == 0) {
                echo " style='margin-top: 8px'";
            }
            echo ">";
        }
        echo "<br/>";
    }
}

function drawInputBoard(): void
{
    for ($i = 0; $i < GRID_SIZE; $i++) {
        for ($j = 0; $j < GRID_SIZE; $j++) {
            if ($j != 0 && $j % 3 == 0) {
                echo "&nbsp";
            }
            echo "<input type='number' min=1 max=9 name='r{$i}c{$j}'";
            if ($i % 3 == 0) {
                echo " style='margin-top: 8px'";
            }
            echo ">";
        }
        echo "<br/>";
    }
    echo "<input type='submit' value='Solve!'>";
}
