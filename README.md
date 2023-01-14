# api-flash-service
Essa API foi desenvolvida para alimentar uma aplicação mobile chamada Flash Service, utilizando PHP e PostgreSql.


Acesse a Pasta "Common-Class", navegue até o arquivo Database para configurar o banco de dados.

Como a aplicação utiliza o PDO. basta escolher qual banco irá utilizar, e preencher os dados referentes a conexão, como no exemplo abaixo:

private $array = array ('sgbd'		=> 'PostgreSQL',
                        'host'		=> 'hostExemplo',
                        'name'		=> 'bancoExemplo',
                        'port'		=> '5432',
                        'schema'	=> 'public',
                        'user'		=> 'teste',
                        'password' 	=> '12345'
                       );
