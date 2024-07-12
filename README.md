# Site em PHP de operações CRUD

Trabalho feito para uma prova de entrevista para uma empresa. [Enunciado Original](https://github.com/dlimars/prova-php-entrevista)

![image](https://github.com/kimcen/PHP-CRUD/assets/52336601/22ed73be-153c-48e3-bf35-8ee68cf5a625)

Este é um Crud simples, totalmente desenvolvido em PHP, sem a utilização de frameworks, onde é possível Criar/Editar/Excluir/Listar usuários. O sistema também possui a capacidade de vincular/desvincular várias cores ao usuário.

#### Tecnologias utilizadas
Utilzado CSS com elementos de botões, tabela e do plugin Modal do Bootstrap para Pop Ups. [See Here](https://getbootstrap.com/docs/4.0/components/modal/)


#### Estrutura do código
- Na pagina de usuários a tabela é formatada com bootstrap e os resultados são acessados atraves de uma única consulta de SQL. Ao clicar no botão de Adicionar usuário, um pop up permite a entrada de valores que serão inseridos no banco de dados. Os dados inseridos já são sanitizados devido à utilização da função `bindValue`;
- O botão de atualizar o usuário redireciona para uma página em que se pode inserir os novos valores, e redireciona de volta a página dos usuários com uma mensagem informando se a operação foi bem sucedida ou não;
- O botão de deleta apenas deleta o usuário e retorna uma mensagem;
- A página de cores funciona da mesma maneira;
- As ações de crud são acionadas através dos seus respectivos scripts de php, que executam funcões da classe `Connection`;
- Todas as operações na tabela `user_colors` são feitas indiretamente através de operações com as outras tabelas, que atualizam `user_colors` adequadamente.


##### Estrutura de banco de dados

```sql
    tabela: users
        id      int not null auto_increment primary key
        name    varchar(100) not null
        email   varchar(100) not null
```
```sql
    tabela: colors
        id      int not null auto_increment primary key
        name    varchar(50) not null
```
```sql
    tabela: user_colors
        color_id  int
        user_id   int
```

##### Utilização
- Este projeto conta com uma base sqlite com alguns registros já inseridos. 
- Para utilizar o banco de dados contido na pasta `database/db.sqlite` é necessário que a sua instalação do php tenha a extensão do sqlite instalada e ativada
- O Php possui um servidor embutido, você consegue dar start ao projeto abrindo o terminal de comando na pasta baixada e executando `php -S 0.0.0.0:7070` e em seguida abrir o navegador em `http://localhost:7070`