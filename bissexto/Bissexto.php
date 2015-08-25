<?php
class AnoBissexto {
	private $ano;
	public function setAno($ano) {
		$this->ano = $ano;
	}
	public function getAno() {
		return $this->ano;
	}
	public function verificaBissexto() {
		$anoTestado = $this->getAno ();
		if ((($anoTestado % 4) == 0 && ($anoTestado % 100) != 0) || ($anoTestado % 400) == 0) {
			return true;
		} else {
			return false;
		}
	}
}