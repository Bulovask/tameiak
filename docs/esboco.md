# Banco de Dados
## Tabelas
- Produto
- CategoriaProduto
- Categoria
- Venda
- Pedido
- Usuario
- FuncaoUsuario

### Explicação das relações entre as tabelas
*CategoriaProduto* é a tabela que associa multiplas categorias a um ou mais produtos.
*Pedido* é a tabela que associa múltiplos produtos a uma venda.
*Usuario* possui uma única função.

## Uso
### Adicionando usuário
```sql
INSERT INTO Usuario(
    nome, cpf,
    idFuncaoUsuario, hash_senha
) VALUE (
    :nome, :cpf, 
    :idFuncaoUsuario, :hash_senha
);
```

### Removendo Usuário
