</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<?php
    if (isset($scripts)) {
        foreach ($scripts as $script) {
            echo "<script type='text/javascript'>";
                readfile('views/js/' . $script);
            echo "</script>";
        }
    }
?>

</body>
</html>
