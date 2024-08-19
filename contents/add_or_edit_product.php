<?php 
    include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/DAO/ProdutoDAO.php";
    include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/control/msg.php";

    if(isset($_GET["id"]) && ctype_digit($_GET["id"]) > 0) {
        $title = "Editar Produto Existente";
        $produto = ProdutoDao::pegar_produto_por_id($_GET["id"]);
        if(!$produto instanceof Produto) {
            sendMsg("error", $produto["msg"]);
            header("Location: /tameiak/list_products.php");
            exit();
        }
        $action = "edit_product.php";
        $edit = TRUE;
    } else {
        $title = "Cadastrar Novo Produto";
        $action = "add_product.php";
        $edit = FALSE;
    }
?>

<form action="control/<?php echo $action ?>" method="post">
    
    <h1><?php echo $title ?></h1>
    <?php if($edit) { ?>
        <input style="display: none" name="id" type="text" value="<?php echo $produto->getID()?>">
    <?php } ?>
    <div>
        <label for="codigoBarra">CÓDIGO DE BARRA:</label>
        <input id="codigoBarra" name="codigoBarra" type="text" placeholder="Código de barra" autocomplete="off" required
            <?php echo $edit ? "value='".$produto->getCodigoBarra()."'" : "" ?>>
    </div>
    <div>
        <label for="nome">NOME:</label>
        <input id="nome" name="nome" type="text" placeholder="Nome Completo" autocomplete="name" required
            <?php echo $edit ? "value='".$produto->getNome()."'" : "" ?>>
    </div>
    <div>
        <label for="descricao">DESCRIÇÃO:</label>
        <textarea id="descricao" name="descricao" type="text" placeholder="Descrição" autocomplete="off"><?php echo $edit ? $produto->getDescricao() : NULL ?></textarea>
    </div>
    <div>
        <label for="preco">PREÇO:</label>
        <input id="preco" name="preco" type="number" placeholder="Preço" step="0.01" autocomplete="off" required
            <?php echo $edit ? "value='".$produto->getPreco()."'" : "" ?>>
    </div>
    <div>
        <label for="quantidadeEstoque">ESTOQUE:</label>
        <input id="quantidadeEstoque" name="quantidadeEstoque" type="number" placeholder="Quantidade em estoque" autocomplete="off" required
            <?php echo $edit ? "value='".$produto->getQuantidadeEstoque()."'" : "" ?>>
    </div>
    <div>
        <label for="ativo">ATIVO:</label>
        <input id="ativo" name="ativo" type="checkbox"
            <?php echo $edit && $produto->getAtivo() ? "checked" : "" ?>>
    </div>
    <div>
        <button id="reset" class="btn-reset" type="reset">Limpar</button>
        <button id="submit" class="btn-access" type="submit" disabled><?php echo $edit ? "Salvar" : "Cadastrar"?></button>
    </div>
</form>
<a href="/tameiak/list_products.php" class="btn">Listar Produtos</a>


<script>
    (function() {
        const codigoBarra = document.getElementById("codigoBarra");
        const nome = document.getElementById("nome");
        const preco = document.getElementById("preco");
        const estoque = document.getElementById("quantidadeEstoque");
        const submit = document.getElementById("submit");
        const reset = document.getElementById("reset");

        function valid() {
            // válidar nome para habilitar/desabilitar o botão de enviar
            if(nome.value != "" && codigoBarra.value != "" && preco.value != "" && estoque.value != "") {
                submit.removeAttribute("disabled");
            }
            else {
                submit.setAttribute("disabled", true);
            }
        }
        valid();
        // VALIDAR CAMPOS
        nome.oninput = valid;
        codigoBarra.oninput = valid;
        preco.oninput = valid;
        estoque.oninput = valid;

        reset.onclick = () => setTimeout(valid, 10);
    })();
</script>