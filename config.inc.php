<?php
    $i = 0;
    $i++;    // для первого сервера MySQL
    $cfg['Servers'][$i]['host'] = 'localhost';
    $cfg['Servers'][$i]['extension'] = 'mysqli';
    $cfg['Servers'][$i]['connect_type'] = 'tcp';
    $cfg['Servers'][$i]['compress'] = false;
    $cfg['Servers'][$i]['auth_type'] = 'config';
    $cfg['Servers'][$i]['user'] = 'root';
    $cfg['Servers'][$i]['password'] = '1111'; // Пароль пользователя root