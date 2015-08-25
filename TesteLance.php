<?php
require_once 'Avaliador.php';
require_once 'CriadorDeLeilao.php';
class AvaliadorTest extends PHPUnit_Framework_TestCase {
	private $leiloeiro;
	private $joao;
	private $criador;
	public function setUp() {
		$this->leiloeiro = new Avaliador ();
		$this->joao = new Usuario ( "Joao" );
		$this->criador = new CriadorDeLeilao ();
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testNaoAceitaLanceMenorQueZero() {
		$leilao = $this->criador->para ( "Carro 0km" )->lance ( $this->joao, - 520 )->constroi ();
		$this->leiloeiro->avalia ( $leilao );
	}
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testNaoAceitaLanceIgualAZero() {
		$leilao = $this->criador->para ( "Carro 0km" )->lance ( $this->joao, 0 )->constroi ();
		$this->leiloeiro->avalia ( $leilao );
	}
}