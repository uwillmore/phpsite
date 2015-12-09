<?php
include_once ('include/header.php');
if (!isset ($_SESSION)) {
    session_start();
}
?>
<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <form action="RunIndex.php" method="get">
            <div class="row">
                <div class="col-lg-12">
                    <div class="input-group">
                        <input name="UserName" type="text" class="form-control" placeholder="Enter User Name">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">NEXT</button>
                        </span>
                    </div><!-- /input-group -->
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>