# Sportisimo
Demo aplikace pro SPORTISIMO.

## Setup

1. Composer
```
$ composer install
```
2. Configure env variables - use local.example.neon

## Migration

```
$ php bin/console migrations:diff
$ php bin/console migrations:migrate
```

## Init data

```
$ php bin/console doctrine:fixtures:load
```

