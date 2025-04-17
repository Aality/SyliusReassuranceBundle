If you want to use our recipes, you can configure your composer.json by running:

```bash
 composer config --no-plugins --json extra.symfony.endpoint '["https://api.github.com/repos/Sylius/SyliusRecipes/contents/index.json?ref=flex/main", "https://api.github.com/repos/Aality/recipes/contents/index.json?ref=flex/main","flex://defaults"]'
```

```bash
 composer require aality/sylius-reassurance-bundle
```

<details><summary>For the installation without flex, follow these additional steps</summary>
<p>

Change your `config/bundles.php` file to add this line for the plugin declaration:
```php
<?php

return [
    //..
    Aality\ReassuranceBundle\ReassuranceBundle::class => ['all' => true],
];  
```

Then copy the config files from `vendor/aality/sylius-reassurance-bundle/config` into your app config directory.

Copy the scss file from `vendor/aality/sylius-reassurance-bundle/assets/shop/scss/vendor/aality-sylius-reassurance-bundle.scss` to `assets/shop/scss/vendor/aality-sylius-reassurance-bundle.scss`

Add this line into `assets/shop/entrypoint.js`

```javascript
import './scss/vendor/aality-sylius-reassurance-bundle.scss';
```

</p>
</details>  

Generate migrations (be sure to have migration bundle installed) :

```bash
# Optional if you do not have doctrine-migration-bundle 
# composer require doctrine/doctrine-migrations-bundle "^3.0"

bin/console make:migration
```

Update your database:

```bash 
bin/console doctrine:migration:migrate
```

Clear Cache !
```bash 
bin/console c:c
```
