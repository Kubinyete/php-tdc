<?php declare(strict_types=1);
/**
 * Camada de acesso ao banco de dados para obtenção de dados necessários para o retorno
 * de uma página home completa
 */

namespace App\Models;

use App\Models\ModelBase;
use App\Database\DalAliancas;
use App\Database\DalGrupos;
use App\Fabricas\FabricaAlianca;
use App\Fabricas\FabricaGrupo;
use App\Views\HomeView;
use App\Config\AppConfig;
use App\Exceptions\FormException;

final class HomeModel extends ModelBase {
	private const ALIANCA_NOME_TAMANHO_INVALIDO = 'O nome da aliança que você está tentando adicionar deve ter no mínimo %m e no máximo %M carácteres.';
	private const ALIANCA_ATINGIDO_NUMERO_LIMITE = 'Não foi possível adicionar mais uma aliança pois você já atingiu o limite de %L alianças.';

	public function __invoke() : HomeView {
        $dal = new DalAliancas($this->getConexao());
        $aliancas = $dal->obterDeUmUsuario($this->getUsuarioLogado());

        return new HomeView(
            $this->getUsuarioLogado(),
            $aliancas
        );
    }

    /**
     * Retorna uma HomeView preenchida com o erro retornado de um processamento
     * @param  string $nomeAlianca
     * @param  string $nomeAliancaErro
     * @return HomeView
     */
    private function erro(?string $nomeAlianca, string $nomeAliancaErro) : HomeView {
    	$dal = new DalAliancas($this->getConexao());
        $aliancas = $dal->obterDeUmUsuario($this->getUsuarioLogado());

        return new HomeView(
            $this->getUsuarioLogado(),
            $aliancas,
            $nomeAlianca,
            $nomeAliancaErro
        );
    }

    /**
     * Registra uma Aliança para ser gerenciada por um Usuário
     * @param  string $nomeAlianca
     * @return HomeView
     */
    public function adicionarAlianca(string $nomeAlianca) : HomeView {
    	try {
            // Estágio 1
            
            $validador = new FormException();

    		$nomeAlianca = trim($nomeAlianca);

    		if (!self::tamanhoNomeAliancaValido($nomeAlianca)) {
    			$validador->adicionarErros(['nome-erro' => self::ALIANCA_NOME_TAMANHO_INVALIDO]);
                throw $validador;
            } else {
                // Estágio 2
                
                $dal = new DalAliancas($this->getConexao());
                $contagem = $dal->obterContagemAliancasDeUmUsuario($this->getUsuarioLogado());

                if ($contagem >= AppConfig::obter('Aliancas.LimitePorUsuario')) {
                    $validador->adicionarErros(['nome-erro' => self::ALIANCA_ATINGIDO_NUMERO_LIMITE]);
                    throw $validador;
                } else {
                    // Estágio 3
                    // Crie
                    
                    $novaAlianca = FabricaAlianca::criar($this->getUsuarioLogado()->getId(), $nomeAlianca);

                    $dal->criar($novaAlianca);

                    $dal = new DalGrupos($this->getConexao());

                    // Crie automaticamente na tabela Grupos do banco de dados 3 Grupos
                    // vazios para esta Aliança
                    for ($i = 0; $i < 3; $i++) {
                        $novoGrupo = FabricaGrupo::criar($novaAlianca->getId(), 'Grupo '.chr(65 + $i));
                        $dal->criar($novoGrupo);
                    }

                    unset($dal);

                    return $this->__invoke();
                }
            }
    	} catch (FormException $e) {
    		return $this->erro(
    			$nomeAlianca,
    			str_replace(
    				[
    				'%m',
    				'%M',
    				'%L'
    				],
    				[
    					AppConfig::obter('Aliancas.NomeTamanhoMinimo'),
    					AppConfig::obter('Aliancas.NomeTamanhoLimite'),
    					AppConfig::obter('Aliancas.LimitePorUsuario')
    				],
    				$e->obter('nome-erro')
    			)
    		);
    	}
    }

    /**
     * Retorna se o tamanho de determinada string é válida para o tamanho de um
     * nome de Aliança
     * @param  string $str
     * @return bool
     */
    private static function tamanhoNomeAliancaValido(string $str) : bool {
    	$strlen = strlen($str);

    	return ($strlen >= AppConfig::obter('Aliancas.NomeTamanhoMinimo')
    		&&
    			$strlen <= AppConfig::obter('Aliancas.NomeTamanhoLimite'));
    }
}

?>
