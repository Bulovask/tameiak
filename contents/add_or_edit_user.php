<?php 
    include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/DAO/funcaoUsuarioDAO.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/DAO/UsuarioDAO.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/control/msg.php";

    if(isset($_GET["id"]) && ctype_digit($_GET["id"]) > 0) {
        $title = "Editar Usuário Existente";
        $usuario = UsuarioDao::pegar_usuario_por_id($_GET["id"]);
        if(!$usuario instanceof Usuario) {
            sendMsg("error", $usuario["msg"]);
            header("Location: /tameiak/list_users.php");
            exit();
        }
        $action = "edit_user.php";
        $edit = TRUE;
    } else {
        $title = "Cadastrar Novo Usuário";
        $action = "add_user.php";
        $edit = FALSE;
    }
?>

<form action="control/<?php echo $action ?>" method="post">
    
    <h1><?php echo $title ?></h1>
    <?php if($edit) { ?>
        <input style="display: none" name="id" type="text" value="<?php echo $usuario->getID()?>">
    <?php } ?>
    <div>
        <label for="nome">NOME:</label>
        <input id="nome" name="nome" type="text" placeholder="Nome Completo" autocomplete="name" required
            <?php echo $edit ? "value='".$usuario->getNome()."'" : "" ?>>
    </div>
    <div>
        <label for="cpf">CPF:</label>
        <input id="cpf" name="cpf" type="text" placeholder="CPF" autocomplete="off"
            <?php echo $edit ? "value='".preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $usuario->getCPF())."'" : "" ?>>
    </div>
    <div>
        <label for="funcao">FUNÇÃO:</label>
        <select name="funcao" id="funcao" <?php echo $edit && $usuario->getID() == 1 ? "disabled" : "" ?>>
            <?php
                foreach(FuncaoDAO::pegar_funcoes() as $i => $value) {
                    if($edit) {
                        $selected = $usuario->getFuncao() === $value["id"] ? "selected" : "";
                    } else {$selected = "";}
                    echo "<option value='".$value["id"]."'$selected>".$value["nome"]."</option>";
                }
            ?>
        </select>
    </div>
    <div>
        <label for="senha">SENHA:</label>
        <div class="password-input">
            <input id="senha" name="senha" type="password" placeholder="Senha" autocomplete="current-password" 
                <?php echo $edit ? "" : "required"?>>
            <button id="password-view-btn" type="button" class="eye-open"></button>
        </div>
    </div>
    <div>
        <button id="reset" class="btn-reset" type="reset">Limpar</button>
        <button id="submit" class="btn-access" type="submit" disabled><?php echo $edit ? "Salvar" : "Cadastrar"?></button>
    </div>
</form>
<a href="/tameiak/list_users.php" class="btn">Listar Usuários</a>


<script>
    (function() {
        const edit = <?php echo $edit ? "true" : "false" ?>;
        const nome = document.getElementById("nome");
        const cpf = document.getElementById("cpf");
        const passwordViewBtn = document.getElementById("password-view-btn");
        const passwordElem = document.getElementById("senha");
        const submit = document.getElementById("submit");
        const reset = document.getElementById("reset");

        function valid() {
            // válidar nome, cpf e a senha para habilitar/desabilitar o botão de enviar
            if(/^$|\d{3}\.\d{3}\.\d{3}-\d\d$/.test(cpf.value) && (passwordElem.value || edit) != "" && nome.value != "") {
                submit.removeAttribute("disabled");
            }
            else {
                submit.setAttribute("disabled", true);
            }
        }
        valid();
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