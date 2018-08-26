<?php

Config::set('site_name', 'Тестовое задание');

// Routes. Route name => method prefix
Config::set('routes', ['default' => '']);

Config::set('default_route', 'default');
Config::set('default_controller', 'records');
Config::set('default_action', 'index');

Config::set('db.host', 'localhost');
Config::set('db.user', 'root');
Config::set('db.password', '');
Config::set('db.db_name', 'double');
