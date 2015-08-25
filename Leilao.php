<?php
class Leilao {
	private $descricao;
	private $lances;
	function __construct($descricao) {
		$this->descricao = $descricao;
		$this->lances = array ();
	}
	public function propoe(Lance $lance) {
		if (count ( $this->lances ) == 0 || ($this->podeDarLance ( $lance->getUsuario () ))) {
			$this->lances [] = $lance;
		}
	}
	private function podeDarLance(Usuario $usuario) {
		$total = $this->qtdDeLancesDo ( $usuario );
		return $this->ultimoLanceDado ()->getUsuario () != $usuario && $total < 5;
	}
	private function qtdDeLancesDo(Usuario $usuario) {
		$total = 0;
		foreach ( $this->lances as $lanceAtual ) {
			if ($lanceAtual->getUsuario () == $usuario) {
				$total ++;
			}
		}
		return $total;
	}
	private function ultimoLanceDado() {
		return $this->lances [count ( $this->lances ) - 1];
	}
	public function getDescricao() {
		return $this->descricao;
	}
	public function getLances() {
		return $this->lances;
	}
	public function dobraLance(Usuario $usuario) {
		$ultimoLanceDoUsuario = $this->ultimoLanceDadoUsuarioValor ( $usuario ) * 2;
		if ($ultimoLanceDoUsuario != "") {
			$this->propoe ( new Lance ( $usuario, $ultimoLanceDoUsuario ) );
		}
	}
	private function ultimoLanceDadoUsuarioValor(Usuario $usuario) {
		$ultimoLanceDoUsuario = "";
		foreach ( $this->lances as $lance ) {
			if ($lance->getUsuario () == $usuario)
				$ultimoLanceDoUsuario = $lance->getValor ();
		}
		
		return $ultimoLanceDoUsuario;
	}
}
?>