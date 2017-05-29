<?php declare(strict_types=1);
/**
 * Registra a função de auto-carregar classes
 */

spl_autoload_register(function (string $caminhoClasse)
	{
		$caminhoClasse = explode('\\', $caminhoClasse);

		// Transforma o nome do primeiro diretório para lowercase
		// Pois todas as pastas no diretório principal estão em lowercase
		// App\Database\Class => app\Database\Class
		if (isset($caminhoClasse[0])) {
			$caminhoClasse[0] = strtolower($caminhoClasse[0]);
		}

		$caminhoClasse = implode(DIRECTORY_SEPARATOR, $caminhoClasse);

		$caminhoClasse = APP_BASE.$caminhoClasse.'.php';

		if (file_exists($caminhoClasse))
			require $caminhoClasse;
		else
			exit('Não foi possível importar a classe <strong>"'.$caminhoClasse.'"</strong>.');
	}
);

?>
