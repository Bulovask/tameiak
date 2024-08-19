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
                <td colspan="4">
                    <h2>Usuários Registrados</h2>
                </td>
            </tr>
            <tr>
                <th>ID</th>
                <th>CPF</th>
                <th>NOME</th>
                <th>FUNÇÃO</th>
                <th>AÇÕES</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/DAO/UsuarioDAO.php";
            $tentativa = UsuarioDAO::listar_usuarios([]);
            if($tentativa["status"]) {
                $usuarios = $tentativa["msg"];
                foreach($usuarios as $usuario) { ?>
                <tr>
                    <td>#<?php echo $usuario["id"] ?></td>
                    <td><?php echo preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $usuario["cpf"]) ?></td>
                    <td><?php echo $usuario["nome"] ?></td>
                    <td><?php echo $usuario["funcao"] ?></td>
                    <td>
                        <a href="/tameiak/edit_user.php?id=<?php echo $usuario['id']?>" class="btn">Editar</a>
                        <a href="/tameiak/control/delete_user.php?id=<?php echo $usuario['id']?>" class="btn btn-reset"
                            <?php echo $usuario["id"] == 1 ? "style='display:none'" : "" ?>>Apagar</a>
                    </td>
                </tr>
            <?php }} ?>
        </tbody>
    </table>
</section>
<a href="/tameiak/add_user.php" class="btn">Cadastrar Usuários</a>