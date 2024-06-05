<section id="login-section" class="center">
    <form id="form">
        <h2>LOGIN - <?php echo $title_form ?></h2>
        <?php include_once "view/components/input-user-id.php" ?>
        <?php include_once "view/components/input-user-password.php" ?>
        <input name="user-type" type="text" value="<?php echo $user_type ?>" hidden="true" invisibled/>
        <div>
            <button type="reset">Limpar</button>
            <button id="submit" type="button">Entrar</button>
        </div>

        <script>
            (() => {
                const form = document.getElementById("form");
                const submit = document.getElementById("submit");

                async function login() {
                    const res = await fetch("<?php echo $action_form ?>", {
                        method: "POST",
                        body: new FormData(form)
                    });
                    
                    if(res.ok) {
                        const token = await res.json();
                        alert(token)
                    } else {
                        alert("houve um erro! Tente novamente");
                    }
                }

                submit.addEventListener("click", () => {
                    login();
                }, false);
            })();
        </script>
    </form>
</section>    