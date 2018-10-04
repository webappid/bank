# Professions
Laravel package for indonesian profession list. 

## Install Package
### Install package via composer
```
composer require webappid/profession
```

### Migration
```
php artisan migrate
```

### Seed the data
```
php artisan webappid:profession:seed
```

Note: just put the seed method into your autodeploy, it will add the new data if any and update the current data if needed.