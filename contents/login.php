<form action="control/login.php" method="post">
    <h1>Entre no Sistema</h1>
    <div>
        <label for="id">IDENTIFICAÇÃO:</label>
        <input id="id" name="id" type="text" placeholder="ID ou CPF" autocomplete="username" required>
    </div>
    <div>
        <label for="password">SENHA:</label>
        <div class="password-input">
            <input id="password" name="password" type="password" placeholder="Senha" autocomplete="current-password" required>
            <button id="password-view-btn" type="button" class="eye-open"></button>
        </div>
    </div>
    <div>
        <button id="reset" class="btn-reset" type="reset">Limpar</button>
        <button id="submit" class="btn-access" type="submit" disabled>Entrar</button>
    </div>
</form>

<script>
    (function() {
        const id = document.getElementById("id");
        const passwordViewBtn = document.getElementById("password-view-btn");
        const passwordElem = document.getElementById("password");
        const submit = document.getElementById("submit");
        const reset = document.getElementById("reset");

        function valid() {
            // válidar cpf ou id e a senha para habilitar/desabilitar o botão de enviar
            if(/^#\d+|\d{3}\.\d{3}\.\d{3}-\d\d$/.test(id.value) && passwordElem.value != "") {
                submit.removeAttribute("disabled");
            }
            else {
                submit.setAttribute("disabled", true);
            }
        }

        // VALIDAR ID/CPF
        id.oninput = e => {
            // id
            if(/^#/.test(id.value)) {
                id.value = "#" + id.value.replace(/\D/g, "");
            }
            // cpf
            else if(e.inputType != "deleteContentBackward") {
                value = id.value.replace(/\D+/g, "");

                if(value.length > 11) {value = value.slice(0,11)}
                
                if(value.length < 6) {
                    value = value.replace(/(\d{3})(\d{0,2})/, "$1.$2");
                }
                else if(value.length < 9) {
                    value = value.replace(/(\d{3})(\d{3})(\d{0,3})/, "$1.$2.$3");
                }
                else {
                    value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{0,2})/, "$1.$2.$3-$4");
                }
        
                id.value = value;
            }
            valid();
        }

        reset.onclick = () => setTimeout(valid, 10);


        // VER/ESCONDER SENHA
        passwordViewBtn.onclick = () => {
            if(passwordElem.getAttribute("type") == "password") {
                passwordElem.setAttribute("type", "text");
                passwordViewBtn.classList.remove("eye-open");
                passwordViewBtn.classList.add("eye-close");
            } else {
                passwordElem.setAttribute("type", "password");
                passwordViewBtn.classList.remove("eye-close");
                passwordViewBtn.classList.add("eye-open");
            }
            passwordElem.focus();
        }

        // FOCUS/BLUR no pai de #password
        passwordElem.onfocus = () => {
            passwordElem.parentElement.classList.add("focus");
        }
        passwordElem.onblur = () => {
            passwordElem.parentElement.classList.remove("focus");
        }

        passwordElem.oninput = e => {
            valid();
        }
    })();
</script>