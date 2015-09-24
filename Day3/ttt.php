<?php
$players = ["X", "O"];

$current_player_idx = getPlayerIdx();
print "current Playeridx after get current idx is " . $current_player_idx . "<br />";
$player = $players[$current_player_idx];
print "Player after get current player at current idx is " . $player . "<br />";
$next_player_idx = getNextPlayerIdx($current_player_idx);
print "Next Player idx after get next idx is " . $next_player_idx . "<br />";
$board = [
    [null, null, null],
    [null, null, null],
    [null, null, null]
];


if(isset($_POST['select'])){
    print " select was set on POST<br />";
    $parts = explode(',', $_POST['select']);
    $board[$parts[0]][$parts[1]] = $player; // sets piece

    if(isset($_POST['board'])) {
        print "Board is also set on POST<br />";
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


function getCell($row, $col){

    global $board;

    $val = $board[$row][$col];
print "val in getcell is" . $val . "<br />";
    if(is_null($val)){
        print " Val was null";
        return "<input type='submit' value='$row,$col' name='select' />";
    } else {
        print "val was not null";
        return "<h1>$val</h1><input type='hidden' name='board[$row][$col]' value='$val' />";
    }
}


function getPlayerIdx(){

    $val = 1;

    if(isset($_POST['player'])){
        print "player was set" . "<br />";
        $val = intval($_POST['player']);
    }
print "player is: " . $val . "<br />";
    return $val;
}

function getNextPlayerIdx($idx){
    global $players;

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

