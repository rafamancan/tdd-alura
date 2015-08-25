<?php
require 'Bissexto.php';
class TestBissexto extends PHPUnit_Framework_TestCase {
	public function testDataDe4em4() {
		$ano = new AnoBissexto ();
		$ano->setAno ( 8 );
		$anoEscolhido = $ano->getAno ();
		// testa se está setando ano
		$this->assertEquals ( 8, $anoEscolhido );
		$retorno = $ano->verificaBissexto ();
		$this->assertEquals ( true, $retorno );
	}
	public function testDataNaoBissexto() {
		$ano = new AnoBissexto ();
		$ano->setAno ( 2013 );
		$anoEscolhido = $ano->getAno ();
		// testa se está setando ano
		$this->assertEquals ( 2013, $anoEscolhido );
		$retorno = $ano->verificaBissexto ();
		$this->assertEquals ( false, $retorno );
	}
	public function testData100em100NaoEBissexto() {
		$ano = new AnoBissexto ();
		$ano->setAno ( 2100 );
		$anoEscolhido = $ano->getAno ();
		// testa se está setando ano
		$this->assertEquals ( 2100, $anoEscolhido );
		$retorno = $ano->verificaBissexto ();
		$this->assertEquals ( false, $retorno );
	}
	public function testDataDe400em400EBissexto() {
		$ano = new AnoBissexto ();
		$ano->setAno ( 400 );
		$anoEscolhido = $ano->getAno ();
		// testa se está setando ano
		$this->assertEquals ( 400, $anoEscolhido );
		$retorno = $ano->verificaBissexto ();
		$this->assertEquals ( true, $retorno );
	}
}