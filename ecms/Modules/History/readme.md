# History module

Quickly send (real-time) histories to your EncoreCms application.


  ``` php
  $this->history->push('New subscription', 'Someone has subscribed!', 'fa fa-hand-peace-o text-green', route('admin.user.user.index'));
  ```

  ``` php
 /**
  * Push a history on the dashboard
  * @param string $title
  * @param string $message
  * @param string $icon
  * @param string|null $link
 */
public function push($title, $message, $icon, $link = null);
 ```

![Histories demo screenshot](https://cldup.com/Dvb8rrcJLv.thumb.png)
[Quick demo](http://quick.as/7rasgvgv)
***

## Installation

### Module Download

Using EncoreCMS's module download command:

``` bash
php artisan asgard:download:module asgardcms/history --migrations
```

This will download the module and run its migrations .

This is the recommended way if you wish to customise the fields, views, etc.

### Composer

Execute the following command in your terminal:

``` bash
composer require tecnodesignc/history-module
```

**Note: After installation you'll have to give you the required permissions to get to the blog module pages in the backend.**

#### Run migrations

``` bash
php artisan module:migrate history
```

### Publish the configuration

``` bash
php artisan module:publish-config history
```

## Real time?

If you want real time histories over websockets, you need to configure the `broadcasting.php` config file. After that is done, set the `asgard.history.config.real-time` option to `true`.

Currently, [Laravel broadcasting](https://laravel.com/docs/5.5/broadcasting) supports Pusher and Redis, but EncoreCms only has the front-end integration for Pusher. More integrations are welcome via pull-request. Look at the [Pusher integration](https://github.com/EncoreCms/History/blob/master/Assets/js/pusherHistories.js) for inspiration.

For configuring Pusher, you can add the following lines to your `.env` file:

```
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_ID=
PUSHER_APP_CLUSTER=us2
PUSHER_APP_ENCRYPTED=true
```

Your app's "Getting Started" tab on Pusher's website has a section for `.env`. You can just copy and paste those directly.

## Usage

Usage is simple and straightforward:

Inject the `Modules\History\Services\History` interface where you need it and assign it to a class variable.

### Send history to logged in user

``` php
$this->history->push('New subscription', 'Someone has subscribed!', 'fa fa-hand-peace-o text-green', route('admin.user.user.index'));
```

### Send history to a specific user

``` php
$this->history->to($userId)->push('New subscription', 'Someone has subscribed!', 'fa fa-hand-peace-o text-green', route('admin.user.user.index'));
```
