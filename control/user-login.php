<?php

$user_id = $_POST['user-id'];
$user_password = $_POST['user-password'];
$user_type = $_POST['user-type'];

if(isset($user_id, $user_password, $user_type)) {
    if($user_type == "user") {
        
    } else {
        echo "Só um administrador pode acessar a área administrativa";
    }
};