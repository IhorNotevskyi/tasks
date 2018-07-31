<?php

Config::set('site_name', 'Задачник');

// Routes. Route name => method prefix
Config::set('routes', [
   'default' => '',
   'admin' => 'admin_'
]);

Config::set('default_route', 'default');
Config::set('default_controller', 'tasks');
Config::set('default_action', 'index');

Config::set('db.host', 'localhost');
Config::set('db.user', 'root');
Config::set('db.password', '');
Config::set('db.db_name', 'beejee');

Config::set('salt', 'fs5fds5f675dsf67sfd');
