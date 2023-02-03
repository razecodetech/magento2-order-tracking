# Razecode Order Tracking for Magento 2

Magento 2 Order Tracking extension by Razecode allows customers or guest users to check the status of their orders using order ID, Email address or Mobile number.

[![Latest Stable Version](https://poser.pugx.org/razecode/trackorder/v/stable)](https://packagist.org/packages/razecode/trackorder)
[![Total Downloads](https://poser.pugx.org/razecode/trackorder/downloads)](https://packagist.org/packages/razecode/trackorder)

## How to install & upgrade Razecode_TrackOrder

### 1. Install via composer (recommend)

We recommend you to install Razecode_TrackOrder module via composer. It is easy to install, update and maintaince.

Please use composer 2 to avoid any error while installing.

Run the following command in Magento 2 root folder.

#### 1.1 Install

```
composer require razecode/trackorder
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

#### 1.2 Upgrade

```
composer update razecode/trackorder
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

Run compile if your store in Production mode:

```
php bin/magento setup:di:compile
```

### 2. Copy and paste

If you don't want to install via composer, you can use this way. 

- Download [the latest version here](https://github.com/razecodetech/magento2-order-tracking/archive/master.zip) 
- Extract `master.zip` file to `app/code/Razecode/TrackOrder` ; You should create a folder path `app/code/Razecode/TrackOrder` if not exist.
- Go to Magento root folder and run upgrade command line to install `Razecode_TrackOrder`:

```
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

## Screenshot 1
[![Track-your-order.png](https://i.postimg.cc/G9wMFGcw/Track-your-order.png)](https://postimg.cc/tnkty1Z2)

## Screenshot 2
[![Track-your-order-2.png](https://i.postimg.cc/7LVpqsqC/Track-your-order-2.png)](https://postimg.cc/wt1WVkyH)