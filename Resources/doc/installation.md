# Installation

## Step 1) Get the library

First you need to get a hold of this library. There are two ways of doing this:


### Method a) Using composer

Add the following to your ``composer.json`` (see http://getcomposer.org/)

    "require" :  {
        // ...
        "cleentfaar/docdata-orderapi": "1.0.*@dev"
    }


### Method b) Using submodules

Run the following commands to bring in the needed libraries as submodules.

```bash
git submodule add https://github.com/cleentfaar/docdata-orderapi.git vendor/bundles/CL/DocData/Component/OrderApi
```

## Step 2) Register the namespaces

If you installed the bundle by composer, use the created autoload.php  (jump to step 3).
Add the following two namespace entries to the `registerNamespaces` call in your autoloader:

``` php
<?php
// app/autoload.php
$loader->registerNamespaces(array(
    // ...
    'CL\DocData\Component\OrderApi' => __DIR__.'/../vendor/cleentfaar/docdata-orderapi',
    // ...
));
```

# Ready?

Check out the [usage documentation](usage.md)!
