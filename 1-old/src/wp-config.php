<?php

$table_prefix  = 'wp_';

define('DB_NAME', 'wordpress_project');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

define('AUTH_KEY',         'v[Os6(6te^z$*Bn0eB+MX|tj|~nZ-uUQiE>rQI},V>$+.DG,.i/C#3P?iNjG*w9.');
define('SECURE_AUTH_KEY',  'R;-u+!d,6s4KB~=_bUsm6!m>E[)J34_A]#&LS:&>&+^L/<l}$T!EUUw;@lg?*79]');
define('LOGGED_IN_KEY',    '<&CR!BwKUxgi5a~x1-nZx[PT~ZLQaxj9SsC(nK4kRA|`[ZR5M.{ht[vGhZ6EFmm%');
define('NONCE_KEY',        '#N={WX1d.f}jj<+iPl,c+^z~7MSnT3mxV||:|.euK)+?}M;)Pzvf|RnM)`-2?u~7');
define('AUTH_SALT',        '[J,4fj90@?d:YAn,K9s9A`AXXb#Q61u{!oYKG5LGr<^Q(U(|>t]=!P9:Oa^PvG/0');
define('SECURE_AUTH_SALT', 'I6YUK~@#%WWs-7(@K}f;`u^;t+i]GPOCQy[F>: olL=sPQ|m)-lX{9-|)(MY+taS');
define('LOGGED_IN_SALT',   'kKDf*Cz-_,cSZG[-z|qO0:xv?<a;m,{w(xN*-;u=C 8gO8BSLr|At+dIHUnX9d)_');
define('NONCE_SALT',       'f6 fsyyG2$nYhXjF|/@fTZ_6$.QTh@8kB`IcgnsnSgtCN.U,ZV?qw_=6w59H])et');

define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors', 0);

if(!defined('ABSPATH'))
    define('ABSPATH', dirname(__FILE__) . '/');

require_once(ABSPATH . 'wp-settings.php');