
<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 11/2/2015
 * Time: 7:50 PM
 */
Include_once ('include/header.php');

if(!isset($_SESSION['current_user'])){
    include_once ('index.php');
}else{
    $user = $_SESSION['current_user'];
}

/* URW DEBUG
print ("Should have user from session<br>");
print_r ($user);
print ("ready to start form <br>");
*/
?>

<html>
<body>
<form action="RunUserInfo.php" method="get">

    <input type="hidden" name="UID" value="<?= $user->getUID() ?>">
    <input type="Hidden" name="name" value="<?= $user->getName() ?>">
    <input type="hidden" name="UserRole" value="<?= $user->getRole() ?>"><br>
    <label>Name: </label><?= $user->getName() ?><br><br>
    <label>Email:</label><input type="text" name="email" value="<?= $user->getMail() ?>"><br><br>

    <?php if ($user->getRole () === 1){ ?>
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="password" value="<?= $password ?>" pattern=".{5,10}" title="5 to 50 characters" required>
            <br><br>
            <input type="submit" value="Login"  class='button'>
    <?php } else {?>
        <input type="submit" value="NEXT"  class='button'>
    <?php }?>
</form>

</body>
</html>