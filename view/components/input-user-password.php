<div>
    <label for="user-password">Senha</label>
    
    <style>
        #view-password {
            position: absolute;
            right: 0;
            background-color: transparent;
            background-image: url('public/img/eye-open.png');
            background-size: auto 100%;
            background-repeat: no-repeat;
            padding: 0;
            margin: 0;
            border: none;
            width: 3ch;
            height: 95%;
            flex-grow: 0;
            box-sizing: border-box;
        }
    </style>
    <div style="display: flex; gap: 0; position: relative">
        <input style="flex-shrink: 1;" name="user-password" id="user-password" type="password" placeholder="Digite sua senha" autocomplete="current-password">
        <button id="view-password" type="button"></button>
    </div>
    <script>
        (() => {
            const viewPassword = document.getElementById("view-password");
            const userPassword = document.getElementById("user-password");
            viewPassword.addEventListener("click", () => {
                if(userPassword.getAttribute("type") == "password") {
                    userPassword.setAttribute("type", "text");
                    viewPassword.style.backgroundImage = "url('public/img/eye-close.png')";
                } else {
                    userPassword.setAttribute("type", "password");
                    viewPassword.style.backgroundImage = "url('public/img/eye-open.png')";
                }
            });
        })();
    </script>
</div>