# Instructions

```git clone https://github.com/fhulufhelo/axxess.git```

```cd axxess```

``` composer install```

``` npm install```

``` npm run build```

``` cp .env.example .env```

```php artisan key:generate```

Please update your database details on ```.env``` file

``` php artisan migrate```

add a login user with the following commands

``` php artisan tinker```

``` App\Models\Operator::create(["name"=> "Fhulufhelo","username"=>"fhulu","password"=>bcrypt("123456")]);```

exist tinker  ``` exist```

run the application  ``` php artisan serve```


### update customer balance via triggers

``` CREATE TRIGGER `update_customer_balance_on_delete` AFTER DELETE ON `payments`
FOR EACH ROW UPDATE customers SET balance = (SELECT SUM(amount) as total FROM payments WHERE customer_id = old.customer_id) WHERE customers.id = old.customer_id```

```  CREATE TRIGGER `update_customer_balance_on_insert` AFTER INSERT ON `payments`
FOR EACH ROW UPDATE customers SET balance = (SELECT SUM(amount) as total FROM payments WHERE customer_id = new.customer_id) WHERE customers.id = new.customer_id```

```  CREATE TRIGGER `update_customer_balance_on_update` BEFORE UPDATE ON `payments`
FOR EACH ROW UPDATE customers SET balance = (SELECT SUM(amount) as total FROM payments WHERE customer_id = new.customer_id) WHERE customers.id = new.customer_id```
