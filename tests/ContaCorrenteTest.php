<?php

use Andre\CaixaEletronico\ContaCorrente;
use Andre\CaixaEletronico\SaldoInsuficienteException;
use Andre\CaixaEletronico\SenhaInvalidaException;

test('Valida senha', function () {

    $conta = new ContaCorrente(0, '', 'senhacorreta');

    expect($conta)->validaSenha('senhaerrada');

})->throws(SenhaInvalidaException::class);


test('Imprimi saldo', function () {
    $conta = new ContaCorrente(50, '', 'senhacorreta');

    expect($conta->imprimiSaldo('senhacorreta'))
    ->toBe('R$ 50,00');

});

test('depositar saldo', function () {

    $conta = new ContaCorrente(0, '', 'senhacorreta');
    expect(
        $conta->depositarSaldo(1.99))->toBe('R$ 1,99')
        ->and(
            $conta->depositarSaldo(0.01))->toBe('R$ 2,00');
});

test('Sacar', function () {
    $conta = new ContaCorrente(200, '', 'senhacorreta');
    expect(
        $conta->sacar('senhacorreta', 150)
    )->toBe('R$ 50,00');
});


test('Verifica Saldo', function () {

    $conta = new ContaCorrente(100, '', 'senhacorreta');

    expect($conta)->verificaSaldo(200);

})->throws(SaldoInsuficienteException::class);


test('Transferir valor', function () {
    $conta1 = new ContaCorrente(1500, '', 'senhacorreta');
    $conta2 = new ContaCorrente(500, '', 'senhacorrreta2');

    expect($conta1)->transferirValor('senhacorreta', 500, $conta2)
    ->toBe('R$ 1.000,00');
});

