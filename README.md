# Razecode TrackOrder for Magento 2

[![Latest Stable Version](https://poser.pugx.org/razecode/module-base/v/stable)](https://packagist.org/packages/razecode/module-base)
[![Total Downloads](https://poser.pugx.org/razecode/module-base/downloads)](https://packagist.org/packages/razecode/module-base)

## How to install & upgrade Razecode_TrackOrder

### 1. Install via composer (recommend)

We recommend you to install Razecode_TrackOrder module via composer. It is easy to install, update and maintaince.

Run the following command in Magento 2 root folder.

#### 1.1 Install

```
composer require razecode/module-base
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

#### 1.2 Upgrade

```
composer update razecode/module-base
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

Run compile if your store in Production mode:

```
php bin/magento setup:di:compile
```

### 2. Copy and paste

If you don't want to install via composer, you can use this way. 

- Download [the latest version here](https://github.com/razecodetech/module-base/archive/master.zip) 
- Extract `master.zip` file to `app/code/Razecode/TrackOrder` ; You should create a folder path `app/code/Razecode/TrackOrder` if not exist.
- Go to Magento root folder and run upgrade command line to install `Razecode_TrackOrder`:

```
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```
