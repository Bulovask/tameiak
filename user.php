<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entre no Sistema</title>
    <link rel="stylesheet" href="/ssm.bk/public/css/style.css">
</head>
<body class="header-main-grid">
    <?php include_once "view/components/header-default.php" ?>
    
    <main>

        <?php
            $action_form = "control/user-login.php";
            $title_form = "Usuário";
            $user_type = "user";
            include_once "view/sections/login.php";
        ?>

    </main>
</body>
</html>

