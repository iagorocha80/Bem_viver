# TPDAM- Aplicação Web: Bem Fazer - Guia do utilizador:

A aplicação pode ser acessada por meio da seguinte URL: http://34.65.1.64/ e logo após acessar o utilizador se depara com uma página na qual há, em uma barra flutuante, a opção de login. Ao realizar login o utilizador vai ser redirecionado para a página de Administrador ou então para a página de Operador, a depender de como o mesmo está cadastrado.


# Funcionalidades da página de Operador

Operadores podem realizar a inscrição de utentes em serviços, alterar serviços, realizar backups da lista de utentes ou backup da lista de operadores ou backup da lista de serviços já realizados, operadores também podem realizar o upload em lote de utentes (atráves de um arquivo XML).

## Funcionalidades da página de Administrador

Administradores podem realizar todas as funções dos operadores  e algumas mais, as funções únicas de administrador são: inserção de serviço, inserção de prestador de serviço, inserção de utente (via formulário) e Registo de operador.

## Validação de entradas

Muitos dos formulários presentes na aplicação usam utilizam de dupla validação. Sendo a validação client-side realizada em JavaScript e a validação server-side realizada em PHP como uma forma de garantir que por algum erro os dados mal formatados não acabem na base de dados.

## Ferramentas de segurança

No registo de um Operador/Administrador utilizam-se métodos para criptografar a senha do mesmo e também as rotas (página adm ou página op) estão bloqueadas para usuários que não sejam da categoria a qual a página pertence.

Aluno: Iago Gomes - 66453
```
