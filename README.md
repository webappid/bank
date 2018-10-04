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

The original source bank list data get from http://www.atmbersama.com/id/profil/kode-bank.html and http://www.jaringanprima.com/kode/all if there is any issue about the code and the bank name. Feel free to contact me or join me to maintenance this source. 

Thank You