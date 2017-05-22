# droide-formsrecaptcha - 1.0
Plugin para utilizar o [droide-recaptcha](https://github.com/androidealp/droide-recaptcha) no [DroideForms](https://github.com/androidealp/droide-forms) no CMS Joomla 3.x

## Requerimentos

| Sistema     | Versão       |
|-------------|--------------|
|Joomla       | 3.5.x        |
|Droide Forms |   2.x >      |
|PHP          | 5 >          |

## Como usar

O droide-recaptcha Utiliza a versão 2 do recaptcha, este plugin é para quem quer utilizar esta versão.


* Instale o Plugin pelo Joomla instalador.
* abra o formulário e defina no campo criar validações o filtro Customizado.
* neste mesmo campo defina o nome do campo g-recaptcha-response, que é o campo padrão do google recaptcha
* Abra o seu layout e e informe a variavel customizada

```php

<?php
// o plugin trata esta variavel
echo $custom_vars['capcha']?>
````
