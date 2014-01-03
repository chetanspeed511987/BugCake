BugCake
=======

BugCake is an open source minimalistic bug tracker, developed in the CakePHP framework.

### Pictures

![Picture 1](http://i.imgur.com/euy3DjW.png)
![Picture 2](http://i.imgur.com/wVW8ViP.png)


### Installation
It is highly extendable, like any CakePHP web app. By default it makes use of the MySQL database, which you have to correctly set when installing the web app:
Rename app/Config/database.php.default to app/Config/database.php and change the following sniper, according to your database server credentials:

```php
public $default = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'user',
        'password' => 'password',
        'database' => 'database_name',
        'prefix' => '',
        //'encoding' => 'utf8',
);
```

After that, you should create the MySQL tables into your database. The recommended  structure is the following:

```sql
CREATE TABLE IF NOT EXISTS `issues` (
`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`title` VARCHAR(50) DEFAULT NULL,
`body` text,
`created` datetime DEFAULT NULL,
`modified` datetime DEFAULT NULL,
`commentid` INT(11) NOT NULL,
`author` VARCHAR(255) NOT NULL,
`answers` INT(11) NOT NULL,
`state` INT(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `users` (
`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`username` VARCHAR(50) DEFAULT NULL,
`password` VARCHAR(50) DEFAULT NULL,
`role` VARCHAR(20) DEFAULT NULL,
`created` datetime DEFAULT NULL,
`modified` datetime DEFAULT NULL,
`email` VARCHAR(255) NOT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `email` (`email`),
UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
```

In the app/Controller/UsersController.php file, we have a company-inside limitation for users' registration (we require LubbleUp corporate e-mail accounts), which is be default commented out. Though, we recommend to use it so that is suits your needs if you use it in an enterprise-level environment.

Contact: talk2us@lubbleup.com
