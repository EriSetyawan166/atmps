<?php
if(isset($_POST['selisih'])) {
    $selisih = $_POST['selisih'];
    if ($selisih > 25) {
        echo 'true';
    } else {
        echo 'false';
    }
}
?>
