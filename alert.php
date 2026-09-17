<?php
if (isset($success_msg)) {
    foreach($success_msg as $success_msg){
        echo '<script>swal("'.$success_msg.'", "", "success");</script>';
    }
}
if (isset($warning_msg)) {
    foreach($warning_msg as $warning_msg){
        echo '<script>swal("'.$warning_msg.'", "", "warning");</script>';
    }
}
?>