<?php
/**
 *  Client attributes for application processing
 *
 */


// urlPathMap is the URL structure that needs to match. The first elements is currently always the object, everything
// after the object will be object parameters. We'll need to come up with a more flexible method later

$config['clock']['urlPathMap'] = '/clock/dataSource/dateFormat';

// since you have them in your path map above, you must also declare the variable defaults!

$config['clock']['parameters'] = ['dataSource' => 'default',
    'dateFormat' => 'default'];

// blog

$config['blog']['urlPathMap'] = 'blog/slug';

$config['blog']['parameters'] = ['slug' => ''];

// blog-admin

$config['blog-admin']['urlPathMap'] = '/blog-admin/slug';

$config['blog-admin']['parameters'] = ['slug' => ''];