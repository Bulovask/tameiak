<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?></title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <header>
        <span class="logo">Tameiak</span>
        <div>
            <button class="btn-menu" onclick="history.back()">Voltar</button>
            <?php if(isset($menu_type)) { ?>
                <button class="btn-menu" onclick="
                    document.getElementById('main-side-menu').classList.remove('hidden');
                    document.getElementById('main-side-menu-shadow').classList.remove('hidden');
                ">☰</button>
            <?php } ?>
        </div>
    </header>
    <main>
        <?php include_once $content ?>
        
        <div class="popup-container">
            <?php
                include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/view/components/popup.php";
                if(isset($_SESSION["msgs"])) {
                    foreach($_SESSION["msgs"] as $type => $msg) {
                        popup($type, $msg);
                        unset($_SESSION["msgs"][$type]);
                    }
                }
            ?>
        </div>
    </main>
    <footer>
        
    </footer>
    <?php if(isset($menu_type)) { ?>
    <div id="main-side-menu-shadow" class="hidden"></div>
    <aside id="main-side-menu" class="hidden">
        <button class="btn-menu" onclick="
            document.getElementById('main-side-menu').classList.add('hidden');
            document.getElementById('main-side-menu-shadow').classList.add('hidden');
        ">x</button>
        <nav>
            <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/view/components/$menu_type/menu.php" ?>
        </nav>
    </aside>
    <?php }?>
</body>
</html>