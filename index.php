<?php include('header.php'); ?>
<link rel="stylesheet" type="text/css" href= 'style.css'>
<div class="main_content">
    <div class="inside_header">
        <h1 style="padding-bottom: 10px;font-size: 56px;">Welcome</h2>
    </div>
    
    <div id="main_text">

        <p>Este é um Crud simples, totalmente desenvolvido em PHP, sem a utilização de frameworks, onde é possível Criar/Editar/Excluir/Listar usuários. O sistema também possui a capacidade de vincular/desvincular várias cores ao usuário.</p>
        <h4 id="tecnologias-utilizadas">Tecnologias utilizadas</h4>
        <p>Utilzado CSS com elementos de botões, tabela e do plugin Modal do Bootstrap para Pop Ups.</p>
        <h4 id="estrutura-do-c-digo">Estrutura do código</h4>
        <ul>
        <li>Na pagina de usuários a tabela é formatada com bootstrap e os resultados são acessados atraves de uma única consulta de SQL. Ao clicar no botão de Adicionar usuário, um pop up permite a entrada de valores que serão inseridos no banco de dados. Os dados inseridos já são sanitizados devido à utilização da função <code>bindValue</code>;</li>
        <li>O botão de atualizar o usuário redireciona para uma página em que se pode inserir os novos valores, e redireciona de volta a página dos usuários com uma mensagem informando se a operação foi bem sucedida ou não;</li>
        <li>O botão de deleta apenas deleta o usuário e retorna uma mensagem;</li>
        <li>A página de cores funciona da mesma maneira;</li>
        <li>As ações de crud são acionadas através dos seus respectivos scripts de php, que executam funcões da classe <code>Connection</code>;</li>
        <li>Todas as operações na tabela <code>user_colors</code> são feitas indiretamente através de operações com as outras tabelas, que atualizam <code>user_colors</code> adequadamente.</li>
        </ul>
        <h5 id="estrutura-de-banco-de-dados">Estrutura de banco de dados</h5>
        <pre><code class="lang-sql">    tabela: users
                id      <span class="hljs-type">int</span> <span class="hljs-built_in">not</span> <span class="hljs-built_in">null</span> auto_increment primary <span class="hljs-built_in">key</span>
                name    varchar(<span class="hljs-number">100</span>) <span class="hljs-built_in">not</span> <span class="hljs-built_in">null</span>
                email   varchar(<span class="hljs-number">100</span>) <span class="hljs-built_in">not</span> <span class="hljs-built_in">null</span>
        </code></pre>
        <pre><code class="lang-sql">    tabela: colors
                id      <span class="hljs-type">int</span> <span class="hljs-built_in">not</span> <span class="hljs-built_in">null</span> auto_increment primary <span class="hljs-built_in">key</span>
                name    varchar(<span class="hljs-number">50</span>) <span class="hljs-built_in">not</span> <span class="hljs-built_in">null</span>
        </code></pre>
        <pre><code class="lang-sql">    tabel<span class="hljs-variable">a:</span> user_colors
                color_id  <span class="hljs-keyword">int</span>
                user_id   <span class="hljs-keyword">int</span>
        </code></pre>
        
    </div>
</div>

<?php include('footer.php'); ?> 
    