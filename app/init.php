<?php
fORMDatabase::attach(new fDatabase('mysql', DB_NAME, DB_USER, DB_PASS, DB_HOST));
fAuthorization::setLoginPage(SITE_BASE . '/login/');
