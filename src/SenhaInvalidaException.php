<?php

namespace Andre\CaixaEletronico;

use Exception;
class SenhaInvalidaException extends Exception
{
    protected $message = "Senha Incorreta";
}