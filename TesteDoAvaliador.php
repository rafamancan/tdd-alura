<?php
require_once 'Avaliador.php';
require_once 'CriadorDeLeilao.php';
class AvaliadorTest extends PHPUnit_Framework_TestCase {
	private $leiloeiro;
	private $joao;
	private $renan;
	private $felipe;
	private $rafael;
	private $giovani;
	private $fabricio;
	private $criador;
	public function setUp() {
		$this->leiloeiro = new Avaliador ();
		$this->joao = new Usuario ( "Joao" );
		$this->renan = new Usuario ( "Renan" );
		$this->felipe = new Usuario ( "Felipe" );
		$this->rafael = new Usuario ( "Rafael" );
		$this->giovani = new Usuario ( "Giovani" );
		$this->fabricio = new Usuario ( "Fabricio" );
		$this->criador = new CriadorDeLeilao ();
	}
	public function testAceitaLeilaoEmOrdemCrescente() {
		$leilao = $this->criador->para ( "Carro 0km" )->lance ( $this->joao, 250 )->lance ( $this->renan, 300 )->lance ( $this->felipe, 400 )->constroi ();
		$this->leiloeiro->avalia ( $leilao );
		$maiorEsperado = 400;
		$menorEsperado = 250;
		$this->assertEquals ( $this->leiloeiro->getMaiorLance (), $maiorEsperado );
		$this->assertEquals ( $this->leiloeiro->getMenorLance (), $menorEsperado );
	}
	public function testAceitaLeilaoEmOrdemDecrescente() {
		$leilao = $this->criador->para ( "Carro 0km" )->lance ( $this->joao, 400 )->lance ( $this->renan, 300 )->lance ( $this->felipe, 200 )->lance ( $this->rafael, 100 )->constroi ();
		$this->leiloeiro->avalia ( $leilao );
		$maiorEsperado = 400;
		$menorEsperado = 100;
		$this->assertEquals ( $this->leiloeiro->getMaiorLance (), $maiorEsperado );
		$this->assertEquals ( $this->leiloeiro->getMenorLance (), $menorEsperado );
	}
	public function testAceitaLeilaoEmOrdemCrescenteComOutrosValores() {
		$leilao = $this->criador->para ( "Carro 0km" )->lance ( $this->joao, 1000 )->lance ( $this->renan, 2000 )->lance ( $this->felipe, 3000 )->constroi ();
		$this->leiloeiro->avalia ( $leilao );
		$maioEsperado = 3000;
		$menorEsperado = 1000;
		$this->assertEquals ( $this->leiloeiro->getMaiorLance (), $maioEsperado );
		$this->assertEquals ( $this->leiloeiro->getMenorLance (), $menorEsperado );
	}
	public function testAceitaLeilaoComUmLance() {
		$leilao = $this->criador->para ( "Carro 0km" )->lance ( $this->joao, 250 )->constroi ();
		$this->leiloeiro->avalia ( $leilao );
		$maiorEsperado = 250;
		$menorEsperado = 250;
		$this->assertEquals ( $this->leiloeiro->getMaiorLance (), $maiorEsperado );
		$this->assertEquals ( $this->leiloeiro->getMenorLance (), $menorEsperado );
	}
	public function testAceitaLeilaoComValoresRandomicos() {
		$leilao = $this->criador->para ( "Carro 0km" )->lance ( $this->joao, 200 )->lance ( $this->renan, 450 )->lance ( $this->felipe, 120 )->lance ( $this->rafael, 700 )->lance ( $this->giovani, 630 )->lance ( $this->fabricio, 230 )->constroi ();
		$this->leiloeiro->avalia ( $leilao );
		$maiorEsperado = 700;
		$menorEsperado = 120;
		$this->assertEquals ( $this->leiloeiro->getMaiorLance (), $maiorEsperado );
		$this->assertEquals ( $this->leiloeiro->getMenorLance (), $menorEsperado );
	}
	public function testPegaOsTresMaiores() {
		$leilao = $this->criador->para ( "Carro 0km" )->lance ( $this->joao, 250 )->lance ( $this->renan, 300 )->lance ( $this->felipe, 400 )->constroi ();
		$this->leiloeiro->avalia ( $leilao );
		$maiores = $this->leiloeiro->getTresMaiores ();
		$this->assertEquals ( count ( $maiores ), 3 );
		$this->assertEquals ( $maiores [0]->getValor (), 400 );
		$this->assertEquals ( $maiores [1]->getValor (), 300 );
		$this->assertEquals ( $maiores [2]->getValor (), 250 );
	}
	public function testRealizaLeilaoComCincoLancesEncontraOsTresMaiores() {
		$leilao = $this->criador->para ( "Carro 0km" )->lance ( $this->joao, 250 )->lance ( $this->renan, 300 )->lance ( $this->felipe, 400 )->lance ( $this->giovani, 630 )->lance ( $this->fabricio, 230 )->constroi ();
		$this->leiloeiro->avalia ( $leilao );
		$maiores = $this->leiloeiro->getTresMaiores ();
		$this->assertEquals ( count ( $maiores ), 3 );
		$this->assertEquals ( $maiores [0]->getValor (), 630 );
		$this->assertEquals ( $maiores [1]->getValor (), 400 );
		$this->assertEquals ( $maiores [2]->getValor (), 300 );
	}
	public function testRealizaLeilaoComDoisLancesRetornaDoisLances() {
		$leilao = $this->criador->para ( "Carro 0km" )->lance ( $this->joao, 250 )->lance ( $this->renan, 300 )->constroi ();
		$this->leiloeiro->avalia ( $leilao );
		$quantidadeLances = 2;
		$this->assertEquals ( $quantidadeLances, count ( $leilao->getLances () ) );
	}
	/**
	 * @expectedException Exception
	 */
	public function testNaoDeveAvaliarLeiloesSemNenhumLanceDado() {
		$leilao = $this->criador->para ( "Carro 0km" )->constroi ();
		$this->leiloeiro->avalia ( $leilao );
	}
}

