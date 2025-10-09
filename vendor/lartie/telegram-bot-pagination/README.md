# Telegram Bot Pagination

- [Installation](#installation)
    - [Composer](#composer)
    - [Configuration](#configuration)
    - [Service Provider](#service-provider)
- [Usage](#usage)
    - [Test Data](#test-data)
    - [How To Use](#how-to-use)
    - [Result](#result)
- [License](#license)

## Installation

### Composer
```bash
composer require "lartie/telegram-bot-pagination:^1.0.0"
```

### Service Provider

You must install this service provider.
```php
// config/app.php
'providers' => [
    ...
    LArtie\TelegramBotPagination\TelegramBotPaginationServiceProvider::class,
    ...
];
```

## Usage

### Test Data
```php
$items = range(1, 100); 
$command = 'testCommand'; // optional. Default: pagination
$selectedPage = 10; // optional. Default: 1
```

### How To Use
```php

$cqPagination = new CallbackQueryPagination($items, $command);
$cqPagination->setMaxButtons(6);
$cqPagination->setWrapSelectedButton('< #VALUE# >');
    
$pagination = $cqPagination->pagination($selectedPage); //$cqPagination->setSelectedPage($selectedPage);

```

### Result
```php
if (!empty($paginate['keyboard'])) {
    $paginate['keyboard'][0]['callback_data']; // testCommand?currentPage10=&nextPage=1
    $paginate['keyboard'][1]['callback_data']; // testCommand?currentPage10=&nextPage=9
    ...
    
    $response = [
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                $paginate['keyboard'],
            ],
        ]),
    ];
}
```

## Code Quality

Run the PHPUnit tests with PHPUnit. 

    phpunit tests/


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.