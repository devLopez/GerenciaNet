Igrejanet/GerenciaNet
===

[![Build Status](https://travis-ci.org/devLopez/GerenciaNet.svg?branch=master)](https://travis-ci.org/devLopez/GerenciaNet)

O Pacote GerênciaNet é um *wrapper* desenvolvido para facilitar a integração com o
*Gateway* de pagamentos GerênciaNet

Instalação
---

Realize a Instalação do Pacote Via composer:

```sh
$ composer require igrejanet/gerencianet
```

PS.: O pacote já vem com *package auto-discovery* para utilização com Laravel.
A Classe `Gerencianet` é instanciada automaticamente em *Singleton*

Utilização
---

Para utilizar o pacote, vamos separar o processo em 2: Criação da cobrança e Checkout da cobrança

### Criação da Cobrança
Esta etapa, em geral, é executada antes que o formulário de pagamento seja exibido.
```php

<?php

use Gerencianet\Gerencianet;
use Igrejanet\GerenciaNet\ChargeCreator;
use Igrejanet\GerenciaNet\Products;

$gerencianet = new Gerencianet([
    'client_id'     => 'meu_client_id',
    'client_secret' => 'meu_client_secret',
    'sandbox'       => true // Ou false, caso em produção
]);

$products = new Products();
$products->add('Carrinho Hot Wheels', 1500, 3);
$products->add('Bolacha Maizena', 185, 2);

$charge = new ChargeCreator($gerencianet);
$charge->setInvoiceId(1); // Gerado pelo seu sistema
$charge->setNotificationUrl('http://minhaloja.com');
$charge->setProducts($products);

// Guarde bem este valor, vamos precisar dele na segunda etapa
$charge_id = $charge->generateCharge();
```

### Processo de Checkout
```php
<?php

use Gerencianet\Gerencianet;
use Igrejanet\GerenciaNet\ChargeSender;
use Igrejanet\GerenciaNet\Customer\BillingAddress;
use Igrejanet\GerenciaNet\Customer\Customer;
use Igrejanet\GerenciaNet\Methods\BankingBillet;
use Igrejanet\GerenciaNet\Methods\CreditCard;
use Igrejanet\GerenciaNet\Methods\DiscountManager;

$gerencianet = new Gerencianet([
    'client_id'     => 'meu_client_id',
    'client_secret' => 'meu_client_secret',
    'sandbox'       => true // Ou false, caso em produção
]);

$customer = new Customer(
    'João Lopes',
    '32214653783',
    'joao@company.com',
    '3895281420',
    '1990-01-01'
);

$billingAddress = new BillingAddress(
    'Rua do Cachorro Toco',
    12,
    'São Pedo da Garça',
    '39400000',
    'Montes Claros',
    'MG'
);

// O desconto pode ser aplicado em centavos ou porcentagem.
//No caso de porcentagem, multiplicar o valor por 100
$discount = new DiscountManager(1000);

// Se o cliente pagar com boleto...
if($isBoleto) {
    $method = new BankingBillet();
    $method->setExpirationDate(7); // Em quantos dias o boleto deve vencer?
    $method->setCustomer($customer);
    
} else if($isCartao) {
    // Estas variáveis são repassadas pela tela de checkout
    $method = new CreditCard($paymentToken, $installments);
    
    $method->setCustomer($customer);
    
    // O End. de cobrança deve ser aplicado em pagamentos via CC
    $method->setBillingAddress($billingAddress);
    
    // O desconto pode ser aplicado em ambos os métodos
    $method->setDiscount($discount);
}

$chargeSender = new ChargeSender($gerencianet);

// A variável charge ID contém o valor definido na geração da cobrança
// Sem o charge_id, a cobrança não será enviada
// A variável response recebe um array contendo todos os dados da transação
$response = $chargeSender->sendPaymentRequest($method, $charge_id);

```

Testes
---
Existem dois testes que devem ser executados separadamente, pois, antes de executá-los
você deve setar o seu client_id e client_secret no arquivo *phpunit.xml*. Somente assim
é possível testar a criação e o envio de cobranças para seu sandbox no GerênciaNet

* ChargeCreatorTest.php
* ChargeSenderTest.php

Ao executar o PHPUnit, somente os testes que não utilizam acesso à API são executados.

Para testar os arquivos acima, é necessário testá-los separadamente.

Futuro
---

Atualmente o package aceita somente os pagamentos via boleto e cartão. Existem planos de expansão para as
demais formas ofereciadas pelo GerênciaNet. Contribuições são extremamente bem vindas