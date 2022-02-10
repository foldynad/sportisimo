# Sportisimo
Demo aplikace pro SPORTISIMO.

## Setup

1. 
```
$ composer install
```
1. Configure env variables - use local.example.neon

## Migration

```
$ php bin/console migrations:diff
$ php bin/console migrations:migrate
```

## Init data

```
$ php bin/console doctrine:fixtures:load
```

