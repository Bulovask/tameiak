<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="/ssm.bk/public/css/style.css">
</head>
<body class="header-main-grid">
    <?php include_once "view/components/header-default.php" ?>
    
    <main>

        <?php
            $action_form = "control/admin-login.php";
            $title_form = "Administrador";
            $user_type = "admin";
            include_once "view/sections/login.php" 
        ?>
        
    </main>
</body>
</html>