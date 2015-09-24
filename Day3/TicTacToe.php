
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 9/15/2015
 * Time: 7:56 PM
 * Original from Nathan's GIT account at:
 * https://gist.github.com/nw/1fbd5016787edf60eb4b#file-ttt-php
 *
 * I just added comments as I figured out the code.
 */
<?php

// player is either X or O
// note that player is an array too
$players = ["X", "O"];

// get current cell clicked
$current_player_idx = getPlayerIdx();
print "current Playeridx after get current idx is " . $current_player_idx . "<br />";
// see if cell was clicked by X or O
$player = $players[$current_player_idx];
print "Player after get current player at current idx is " . $player . "<br />";

// Toggle player to get ready for next turn
$next_player_idx = getNextPlayerIdx($current_player_idx);
print "Next Player idx after get next idx is " . $next_player_idx . "<br />";
// Board is an array to represent the playing field
$board = [
    [null, null, null],
    [null, null, null],
    [null, null, null]
];


if(isset($_POST['select'])){
    // explode gets all POST parameters, separates by comas and stuffs them into
    // an array called parts.
    $parts = explode(',', $_POST['select']);
    // the submitted cell is the one that was clicked and we need the value in that cell
    $board[$parts[0]][$parts[1]] = $player; // sets piece
    // now get the value of the board array, row by row one column at the time.
    if(isset($_POST['board'])) {
        forEach ($_POST['board'] as $rowidx => $row) {
            forEach ($row as $colidx => $col) {
                $board[$rowidx][$colidx] = $col;
            }
        }

    }
}


function debug($val){
    $output = print_r($val, true);
    echo "<pre>". $output ."</pre>";
}


// determine which cell was clicked/submitted. if the cel at the index of the
// board array is blank, display the input field as a submit field. If the cell
// contains a value, display the value of the cell as a hidden field.
function getCell($row, $col){

    global $board;

    print "Row is " .$row . " and col is " . $col . "<br/>";
    $val = $board[$row][$col];

    print "val in getcell is" . $val . "<br />";
    // If the Value of the current cell is NULL, redisplay the cell as submit
    // field, showing the row and column index for reference
    if(is_null($val)){
        print "Val in get cell is NULL<br \>";
        return "<input type='submit' value='$row,$col' name='select' />";
    } else {
        // Value was not NULL? the display the value, to show field was selected and by
        // whom (X or O) and save the row and column index in a hidden field, so we can
        // remember which cells of the board are used already when we redisplay the board
        // to the user again.
        print "Val in get cell is set to " . $val . "<br \>";
        return "<h1>$val</h1><input type='hidden' name='board[$row][$col]' value='$val' />";
    }
}

// get the current index into the player array, so we know if X or O
// played on this turn.
function getPlayerIdx(){

    $val = 1;

    if(isset($_POST['player'])){
        print "player was set" . "<br />";

        $val = intval($_POST['player']);
    }
print "Get idx returning " . $val . "<br \>";
    return $val;
}

// Toggle the index into player array to change
// the player name from X to O or from O to X
// depending on the currrent player name
function getNextPlayerIdx($idx){
    global $players;

    // the current index to the player array hold the current player, X or O
    // if we increment that index, we are either out of bounds ( val >= 2)
    // in which case the next player name is at players[0], or the index is to
    // to the next player name is set to 1.
    // It may have been easier logic to just reset the index with am if statement,
    // i.e. if val == 0 then
    //          val = 1
    //      else
    //          val = 0
    // that's all this function does. He just uses the length of the array to do this.
    // Since we know the length of the array and there can not be more than 2 players,
    // the if statement is simpler to code and understand.
    $val = $idx;

    print "idx in get next idx is " . $idx . "<br />";
    print "val in get next idx is " . $val . "<br />";
    $val++;
    print "val in get next idx is after increment" . $val . "<br />";
    if($val >= count($players)) $val = 0;

    print " returning val " . $val . "<br />";
    return $val;

}


?>

<html>
<head>
    <title>Tic Tac Toe</title>
</head>
<body>
<form method="POST">

    <comment Note whose turn it is.
    <input type="hidden" value="<?= $next_player_idx; ?>"  name="player" />
    <table border="1", cellspacing="0" cellpadding="25">
        <tr>
            <td><?= getCell(0,0); ?></td>
            <td><?= getCell(0,1); ?></td>
            <td><?= getCell(0,2); ?></td>
        </tr>
        <tr>
            <td><?= getCell(1,0); ?></td>
            <td><?= getCell(1,1); ?></td>
            <td><?= getCell(1,2); ?></td>
        </tr>
        <tr>
            <td><?= getCell(2,0); ?></td>
            <td><?= getCell(2,1); ?></td>
            <td><?= getCell(2,2); ?></td>
        </tr>
    </table>
</form>
<?= debug($board); ?>
</body>
</html>

