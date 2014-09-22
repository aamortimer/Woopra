Woopra PHP SDK
==============

This library allows you to more easily comunicate with the [Woopra API](https://www.woopra.com/docs/developer/api-introduction/)


##Installing via Composer

The recommended way to install Woopra SDK is through Composer.

```
# Install Composer
curl -sS https://getcomposer.org/installer | php

# Add Woopra as a dependency

composer require aamortimer/woopra:dev-master
```

After installing, you need to require Composer's autoloader:
```
require 'vendor/autoload.php';
```

#Search API
All methods of the search API are supported to see further details and the options available visit (https://www.woopra.com/docs/developer/search-api/)

```php
// setup namespace
use aamortimer\Woopra\Search;

// set up the search class
$search = new Search(array(
  'app-id' => 'YOUR APP ID HERE',
  'secret-key' => 'YOUR SECRET KEY HERE'
));

// user data
$website = 'example.com';

// search all data for domain
$rsp = $search->search(array(
  'website'=>$website
));
print_r($rsp);

// search by name
$rsp = $search->search(array(
  'website'=>$website,
  'search'=>'Bob Marley'
));
print_r($rsp);

// look up a profile
$rsp = $search->profile(array(
  'website'=>$website,
  'email'=>'test@example.com'
));
print_r($rsp);

// profile visits
$rsp = $search->profileVisits(array(
  'website'=>$website,
  'email'=>'test@example.com',
  'start_day'=>date('Y-m-d', strtotime('- 10 days')),
  'end_day'=>date('Y-m-d')
));
print_r($rsp);

// edit profile data
$rsp = $search->profileEdit(array(
  'website'=>$website,
  'email'=>'test@example.com',
  'data'=>'{"name":"john smith", "age": 33}'
));
print_r($rsp);

// online count
$rsp = $search->onlineCount(array(
  'website'=>$website
));
print_r($rsp);
```

#Labels API
Only the list methods of the labels API is supported to see further details and the options available visit (https://www.woopra.com/docs/developer/labels-api/)
```php
// setup namespace
use aamortimer\Woopra\userData;

// set up the search class
$labels = new UserData(array(
  'app-id' => 'YOUR APP ID HERE',
  'secret-key' => 'YOUR SECRET KEY HERE'
));

$rsp = $labels->show(array(
  'website'=>'example.com'
));
```

#Analytics API
All methods of the analytics API are supported to see further details and the options available visit (https://www.woopra.com/docs/developer/analytics-api/)

```php
// setup namespace
use aamortimer\Woopra\Analytics;

// set up the search class
$analytics = new Analytics(array(
  'app-id' => 'YOUR APP ID HERE',
  'secret-key' => 'YOUR SECRET KEY HERE'
));


// get report
$report = [
  'group_by'=>array(
    array('key'=>'time', 'scope'=>'visits')
  ),
  'columns'=>array(
    array('name'=>'People', 'method'=>'count', 'scope'=>'visitors'),
    array('name'=>'Actions', 'method'=>'count', 'scope'=>'actions')
  )
];

$this->analytics->report(array(
  'website' => 'example.com',
  'report' => $report,
  'start_day'=>date('Y-m-d', strtotime('-1 Day')),
  'end_day'=>date('Y-m-d')
));
```
