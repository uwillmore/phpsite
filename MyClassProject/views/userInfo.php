
<?php
/**
 * Created by PhpStorm.
 * User: Ute
 * Date: 11/2/2015
 * Time: 7:50 PM
 */

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

Include_once ('include/header.php');
?>

<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <h3 class="text-center">Name: <?= $user->getName() ?></h3>
        <form action="RunUserInfo.php" method="get">
            <input type="hidden" name="UID" value="<?= $user->getUID() ?>">
            <input type="hidden" name="name" value="<?= $user->getName() ?>">
            <input type="hidden" name="UserRole" value="<?= $user->getRole() ?>"><br>

            <?php if ($user->getRole () === 1){ ?>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input class="form-control" placeholder="Enter Email" id="email" type="text" name="email" value="<?= $user->getMail() ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" placeholder="password" value="<?= $password ?>" pattern=".{5,10}" title="5 to 50 characters" required>
                </div>
                <div class="text-center">
                    <button type="submit"  class='btn btn-default btn-block'>Log In</button>
                </div>
            <?php } else { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <input class="form-control" placeholder="Enter Email" id="email" type="text" name="email" value="<?= $user->getMail() ?>">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">NEXT</button>
                        </span>
                        </div><!-- /input-group -->
                    </div>
                </div>
                <!--<button type="submit"  class='btn btn-default btn-block'>NEXT</button>-->
            <?php } ?>
        </form>
    </div>
</div>

</div>
</body>
</html>