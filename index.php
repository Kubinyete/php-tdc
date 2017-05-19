<?php declare(strict_types=1);
/**
 * Arquivo de entrada da aplicação
 * responsável por chamar todos os outros scripts
 * e servir a requisição
 */

require __DIR__.DIRECTORY_SEPARATOR.'bootstrap'.DIRECTORY_SEPARATOR.'autoload.php';

use App\Objetos\Objeto;
use App\Objetos\Alianca;
use App\Objetos\Grupo;
use App\Objetos\Guerra;
use App\Objetos\Jogador;
use App\Objetos\Mapa;
use App\Objetos\Missao;
use App\Objetos\Usuario;
use App\Database\iSqlSintaxe;
use App\Database\SqlComandoBase;
use App\Database\SqlComandoMySql;
use App\Database\SqlComando;

/**
 * TODO: Fazer uma classe como espécie de fábrica para criação de objetos genéricos
 * TODO: Fazer método que cria todos os objetos da aplicação e chama seus respectivos ::toString()
 * para que seja possível detectar algum erro no código
 */

echo '<h1>Olá mundo!</h1>';
echo '<hr>';
echo '<p>Se esta página não estiver com erros, parabéns, sua versão do <strong>PHP</strong> (<em>Maior ou igual a <strong>7.1</strong></em>) é compatível com essa aplicação!</p>';

?>