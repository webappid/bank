# Banks
Laravel lib for indonesian banks references.

## Install Package
### Install package via composer
```
composer require webappid/bank
```

### Migration
```
php artisan migrate
```

### Seed the data
```
php artisan webappid:bank:seed
```

Note: just put the seed method into your autodeploy, it will add the new data if any and update the current data if needed.