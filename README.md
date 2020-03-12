# Gmail API

> Adaptação da API do gmail em PHP como alternativas de envio de e-mail ao PHP Mailer

## Setup

-   Mova o diretório `GmailAPI` para alguma área do seu projeto;
-   Ajuste o `namespace` dos arquivos `.php`;
-   Instale a biblioteca da API do gmail com o composer (Ex: `composer require google/apiclient:^2.0`);
-   Criar um projeto no console do Google (caso ainda não tenha criado);
-   Colocque o arquivo `credentials.json` que o projeto do console do Google oferece ao lado do `scriptToCreateToken.php` sendo que ambos devem estar no mesmo nível de diretório que o `vendor/`;
-   Execute no terminal `php scriptToCreateToken.php` para gerar o `token.json`;
-   Mova os arquivos `credentials.json` e `token.json` para dentro do diretório `GmailApi/storage/`;
-   Agora é só chamar o `EmailMessage`, criar um objeto e usar;
-   Caso queira trabalhar com alguma abstração existe a interface da classe que se chama `IEmailMessage`.

> Exemplo com instanciação de forma direta

```php
<?php

use GmailAPI/messages/send/EmailMessage;

$emailMessage = new EmailMessage();
$emailMessage->send(
    ['from@gmail.com'],
    ['to1@email.com', 'to2@gmail.com'],
    'Assunto',
    "<p>Mensagem com HTML</p>"
)
```

> Exemplo com injeção de dependência e inversão de dependência

```php
<?php

use GmailAPI/messages/send/{
    EmailMessage,
    IEmailMessage
};

class Test
{
    /**
     * @var IEmailMessage $emailMessage
     */
    private $emailMessage;

    public function __construct(IEmailMessage $emailMessage)
    {
        $this->emailMessage = $emailMessage;
    }

    public function testGmailAPI(): void
    {
        $this->emailMessage->send(
            ['from@gmail.com'],
            ['to1@email.com', 'to2@gmail.com'],
            'Assunto',
            "<p>Mensagem com HTML</p>"
        );
    }
}

$test = new Test(new EmailMessage());
$test->testGmailAPI();
```
