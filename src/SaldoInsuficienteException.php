<?php

namespace Andre\CaixaEletronico;

use Exception;
class SaldoInsuficienteException extends Exception
{
    protected $message = "Saldo Incorreta";
}