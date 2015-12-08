<?php
include_once ('include/header.php');
if (!isset ($_SESSION)) {
    session_start();
}
?>
<body>
<form action="RunIndex.php" method="get">


    <input name="UserName" placeholder="Please enter your user name." />

    <input type="submit" value="NEXT">

</form>
</body>
</html>