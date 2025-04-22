If you want to use our recipes, you can configure your composer.json by running:

```bash
 composer config --no-plugins --json extra.symfony.endpoint '["https://api.github.com/repos/Sylius/SyliusRecipes/contents/index.json?ref=flex/main", "https://api.github.com/repos/Aality/recipes/contents/index.json?ref=flex/main","flex://defaults"]'
```
Edit your `composer.json`file to add our VCS repository. 
If you do not have "repositories" entry, you can add it in top of "require" for exemple.

```json
"authors" : ...,
"repositories": [
        {
            "type": "vcs",
            "url": "whateverURL/whateverRepository"
        },
        ...,
        {
            "type": "vcs",
            "url": "https://github.com/Aality/SyliusReassuranceBundle.git"
        }
    ],
 "require": {
        "php": "^8.2",
       ....
 },
 ...
```

Then, require our bundle.

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
    Aality\SyliusReassuranceBundle\SyliusReassuranceBundle::class => ['all' => true],
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

Update your database:

```bash 
bin/console doctrine:migration:migrate
```

Clear Cache !
```bash 
bin/console c:c
```

After configuring your reassurances in admin, use this to display reassurance in your templates : 

```twig
{{ render(controller('Aality\\SyliusReassuranceBundle\\Controller\\ReassuranceController::index')) }}

```
