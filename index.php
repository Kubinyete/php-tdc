<?php declare(strict_types=1);
/**
 * Arquivo de entrada da aplicação
 * responsável por chamar todos os outros scripts
 * e servir a requisição
 */

// Define o tempo inicial de execução
define('APP_INICIO', microtime(true));

// Define uma constante global contendo o caminho base da aplicação
define('APP_BASE', __DIR__.DIRECTORY_SEPARATOR);

// Carregue nosso importador de classes
require APP_BASE.'bootstrap'.DIRECTORY_SEPARATOR.'autoload.php';

// Carregue nosso arquivo de configurações na memória
App\Config\AppConfig::carregar(APP_BASE.'bootstrap'.DIRECTORY_SEPARATOR.'config.json');

// Define de modo global se estamos com o modo debug ativado
define('APP_DEBUG', App\Config\AppConfig::obter('App.ModoDebug') ?? true);

$conexao = new App\Database\Conexao();
$dalUsuarios = new App\Database\DalUsuario($conexao);

$testeAlianca = App\Fabricas\FabricaAlianca::criar();
$testeGrupo = App\Fabricas\FabricaGrupo::criar();
$testeGuerra = App\Fabricas\FabricaGuerra::criar();
$testeJogador = App\Fabricas\FabricaJogador::criar();
$testeMissao = App\Fabricas\FabricaMissao::criar();
$testeUsuario = App\Fabricas\FabricaUsuario::criar('helloworld', 'senha');

if ($dalUsuarios->criar($testeUsuario)) {
	echo 'O Usuário foi criado, Usuario::getId() = '.$testeUsuario->getId().'<br>';
}

$usuarioDoBanco = $dalUsuarios->obter($testeUsuario->getId());

if ($usuarioDoBanco !== null) {
	echo 'O Usuário #'.$usuarioDoBanco->getId().' foi retornado do banco de dados<br>';
}

$usuarioDoBanco->setLogin('modificado');
$dalUsuarios->atualizar($usuarioDoBanco);

$usuarioDoBanco = $dalUsuarios->obter($testeUsuario->getId());

if ($usuarioDoBanco->getLogin() === 'modificado') {
	echo 'O Usuário teve o nome modificado para "modificado"<br>';
}

$dalUsuarios->deletar($usuarioDoBanco);

$usuarioDoBanco = $dalUsuarios->obter($testeUsuario->getId());

if ($usuarioDoBanco === null) {
	echo 'O Usuário foi deletado do banco de dados<br>';
}

?>

<h1>Olá mundo!</h1>
<hr>
<p>Se esta página não estiver com erros, parabéns, sua versão do <strong>PHP</strong> (<em>Maior ou igual a <strong>7.1</strong></em>) é compatível com essa aplicação!</p>
<hr>

<?php

echo '<pre>';
echo $testeAlianca;
echo '<br>';
echo $testeGrupo;
echo '<br>';
echo $testeGuerra;
echo '<br>';
echo $testeJogador;
echo '<br>';
echo $testeMissao;
echo '<br>';
echo $testeUsuario;
echo '<br>';
echo $usuarioDoBanco;
echo 'APP_DEBUG = '.((APP_DEBUG) ? 'true' : 'false');



echo '</pre>';

?>
