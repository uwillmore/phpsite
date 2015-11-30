
<form name="GetName" method="post" Action="RunUserSignUp.php">
    <div>
        Enter your First Name

        <input name="FirstName" placeholder="First Name" /></br>
    </div>
    <div>
        Enter your Last Name

        <input name="LastName" placeholder="Last Name" /></br>
    </div><br>
    <div>
        <label for="title">Title:</label>

        <?php
            $myMenu = new selectMenu;
            $myMenu->setOptions($TitleArray);
            echo $myMenu->makeMenu("Select a Title", "Title");
        ?>
    </div><br>
    <div>
        <label for="beatle">Beatle:</label>
        <?php  $myMenu = new selectMenu;
        $myMenu->setOptions($BeatleArray);
        echo $myMenu->makeMenu("Select a Beatle", "Beatle");
        ?>
    </div><br>


    <input type="submit" value="Create User Name">

    <input type="reset" value="reset">
</form>

<style>
    div {margin-top: 5px; }
    textarea, input { border: dotted 1px blue; }

</style>