<?php

namespace Andre\CaixaEletronico;




class ContaCorrente
{


    public function __construct(
        public float $saldo,
        public string $conta,
        public string $senha )
    {
    }

    public function validaSenha($senhaRecebida): void
    {
        if ($senhaRecebida != $this->senha) {
            throw new SenhaInvalidaException;
        }
    }

    public function imprimiSaldo($senha): string
    {
        $this->validaSenha($senha);
        return 'R$ '. number_format($this->saldo, 2, ',', '.');

    }

    public function depositarSaldo($valor): string
    {
        $this->saldo = $this->saldo + $valor;
        return 'R$ ' . number_format($this->saldo, 2, ',', '.');
    }

    public function sacar($senha, $valor): string
    {

        $this->validaSenha($senha);
        $this->verificaSaldo($valor);

        $this->saldo = $this->saldo - $valor;

        return $this->imprimiSaldo($senha);
    }

    public function verificaSaldo($valor): void
    {
        if ($valor > $this->saldo) {
            throw new SaldoInsuficienteException();
        }
    }

    public function transferirValor($senha, $valor, ContaCorrente $contaDestino): string
    {
        $this->validaSenha($senha);
        $this->verificaSaldo($valor);

        $this->sacar($senha, $valor);
        $contaDestino->depositarSaldo($valor);

        return 'Saldo transferido com sucesso R$ ' . number_format($valor, 2, ',', '.'); ;
        
    }

}