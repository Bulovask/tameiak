<form action="control/add_user.php" method="post">
    <h1>Cadastrar Novo Usuário</h1>
    <div>
        <label for="nome">NOME:</label>
        <input id="nome" name="nome" type="text" placeholder="Nome Completo" autocomplete="name" required>
    </div>
    <div>
        <label for="cpf">CPF:</label>
        <input id="cpf" name="cpf" type="text" placeholder="CPF" autocomplete="off">
    </div>
    <div>
        <label for="funcao">FUNÇÃO:</label>
        <select name="funcao" id="funcao">
            <?php
                include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/DAO/funcaoUsuarioDAO.php";
                foreach(FuncaoDAO::pegar_funcoes() as $i => $value) {
                    echo "<option value='".$value["id"]."'>".$value["nome"]."</option>";
                }
            ?>
        </select>
    </div>
    <div>
        <label for="senha">SENHA:</label>
        <div class="password-input">
            <input id="senha" name="senha" type="password" placeholder="Senha" autocomplete="current-password" required>
            <button id="password-view-btn" type="button" class="eye-open"></button>
        </div>
    </div>
    <div>
        <button id="reset" class="btn-reset" type="reset">Limpar</button>
        <button id="submit" class="btn-access" type="submit" disabled>Cadastrar</button>
    </div>
</form>


<script>
    (function() {
        const nome = document.getElementById("nome");
        const cpf = document.getElementById("cpf");
        const passwordViewBtn = document.getElementById("password-view-btn");
        const passwordElem = document.getElementById("senha");
        const submit = document.getElementById("submit");
        const reset = document.getElementById("reset");

        function valid() {
            // válidar nome, cpf e a senha para habilitar/desabilitar o botão de enviar
            if(/^$|\d{3}\.\d{3}\.\d{3}-\d\d$/.test(cpf.value) && passwordElem.value != "" && nome.value != "") {
                submit.removeAttribute("disabled");
            }
            else {
                submit.setAttribute("disabled", true);
            }
        }

        // VALIDAR NOME
        nome.oninput = valid;

        // VALIDAR CPF
        cpf.oninput = e => {
            // cpf
            if(e.inputType != "deleteContentBackward") {
                value = cpf.value.replace(/\D+/g, "");

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
        
                cpf.value = value;
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