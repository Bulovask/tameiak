<style>
    table h2 {
        text-align: center;
        margin: 0;
        padding: 0;
        font-size: 30px;
    }
</style>

<section>
    <table>
        <thead>
            <tr>
                <td colspan="9">
                    <h2>Produtos Registrados</h2>
                </td>
            </tr>
            <tr>
                <th>ID</th>
                <th>CÓDIGO DE BARRAS</th>
                <th>NOME</th>
                <th>DESCRIÇÃO</th>
                <th>PREÇO</th>
                <th>ESTOQUE</th>
                <th>DATA DE CADASTRO</th>
                <th>ATIVO</th>
                <th>AÇÕES</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/DAO/ProdutoDAO.php";
            $tentativa = ProdutoDAO::listar_produtos([]);
            if($tentativa["status"]) {
                $produtos = $tentativa["msg"];
                foreach($produtos as $produto) { ?>
                <tr>
                    <td><?php echo $produto["id"] ?></td>
                    <td><?php echo $produto["codigoBarra"] ?></td>
                    <td><?php echo $produto["nome"] ?></td>
                    <td><?php echo $produto["descricao"] ?></td>
                    <td><?php echo $produto["preco"] ?></td>
                    <td><?php echo $produto["quantidadeEstoque"] ?></td>
                    <td><?php echo $produto["dataCadastro"] ?></td>
                    <td><?php echo $produto["ativo"] ?></td>
                    <td>
                        <a href="/tameiak/edit_product.php?id=<?php echo $produto['id']?>" class="btn">Editar</a>
                        <a href="/tameiak/control/delete_product.php?id=<?php echo $produto['id']?>" class="btn btn-reset">Apagar</a>
                    </td>
                </tr>
            <?php }} ?>
        </tbody>
    </table>
</section>
<a href="/tameiak/add_product.php" class="btn">Cadastrar Produtos</a>