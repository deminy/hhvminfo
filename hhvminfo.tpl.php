<?php

/**
 * An HHVM implementation of PHP function phpinfo().
 *
 * This code snippet was originally based on following code.
 *
 * @see https://gist.github.com/ck-on/67ca91f0310a695ceb65
 * @version e1bd3be4d561eb383d7bf377ede458913e555b6a
 */

$params = drupal_get_query_parameters();
?>
<!DOCTYPE html>
<html>
<head>
  <title>HHVMinfo</title>
  <meta name="ROBOTS" content="NOINDEX,NOFOLLOW,NOARCHIVE"/>
  <style type="text/css">
    body {
      background-color: #fff;
      color: #000;
    }

    body, td, th, h1, h2 {
      font-family: sans-serif;
    }

    pre {
      margin: 0px;
      font-family: monospace;
    }

    a:link, a:visited {
      color: #000099;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    table {
      border-collapse: collapse;
      border: 0;
      width: 934px;
      box-shadow: 1px 2px 3px #ccc;
    }

    .center {
      text-align: center;
    }

    .center table {
      margin: 1em auto;
      text-align: left;
    }

    .center th {
      text-align: center !important;
    }

    .middle {
      vertical-align: middle;
    }

    td, th {
      border: 1px solid #666;
      font-size: 75%;
      vertical-align: baseline;
      padding: 4px 5px;
    }

    h1 {
      font-size: 150%;
    }

    h2 {
      font-size: 125%;
    }

    .p {
      text-align: left;
    }

    .e {
      background-color: #ccccff;
      font-weight: bold;
      color: #000;
      width: 300px;
    }

    .h {
      background-color: #9999cc;
      font-weight: bold;
      color: #000;
    }

    .v {
      background-color: #ddd;
      max-width: 300px;
      overflow-x: auto;
    }

    .v i {
      color: #777;
    }

    .vr {
      background-color: #cccccc;
      text-align: right;
      color: #000;
      white-space: nowrap;
    }

    .b {
      font-weight: bold;
    }

    .white, .white a {
      color: #fff;
    }

    hr {
      width: 934px;
      background-color: #cccccc;
      border: 0px;
      height: 1px;
      color: #000;
    }

    .meta, .small {
      font-size: 75%;
    }

    .meta {
      margin: 2em 0;
    }

    .meta a, th a {
      padding: 10px;
      white-space: nowrap;
    }

    .buttons {
      margin: 0 0 1em;
    }

    .buttons a {
      margin: 0 15px;
      background-color: #9999cc;
      color: #fff;
      text-decoration: none;
      padding: 1px;
      border: 1px solid #000;
      display: inline-block;
      width: 6em;
      text-align: center;
      box-shadow: 1px 2px 3px #ccc;
    }

    .buttons a.active {
      background-color: #8888bb;
      box-shadow: none;
    }
  </style>
</head>

<body>
<div class="center">

  <h1><a href="?">HHVMinfo</a></h1>

  <div class="buttons">
    <a href="?INI&EXTENSIONS&FUNCTIONS&CONSTANTS&GLOBALS">ALL</a>
    <a <?php echo isset($params['INI']) ? 'class="active"' : '' ?>"
    href="?INI">ini</a>
    <a <?php echo isset($params['EXTENSIONS']) ? 'class="active"' : '' ?>
      href="?EXTENSIONS">Extensions</a>
    <a <?php echo isset($params['FUNCTIONS']) ? 'class="active"' : '' ?>
      href="?FUNCTIONS">Functions</a>
    <a <?php echo isset($params['CONSTANTS']) ? 'class="active"' : '' ?>
      href="?CONSTANTS">Constants</a>
    <a <?php echo isset($params['GLOBALS']) ? 'class="active"' : '' ?>
      href="?GLOBALS">Globals</a>
  </div>

<?php

$globals = array_keys($GLOBALS);

if (empty($_GET) || count($_GET) > 4 || isset($_GET['SUMMARY'])) {
  if (($pidfile = ini_get('pid')) || ($pidfile = ini_get('hhvm.pid_file'))) {
    if (($pidfile) && ($mtime = @filemtime($pidfile))) {
      $uptime = new DateTime('@' . $mtime);
      $uptime = $uptime
        ->diff(new DateTime('NOW'))
        ->format('%a days, %h hours, %i minutes');
    }
    else {
      $uptime = '<i>unknown<i>';
    }

    if (function_exists('php_ini_loaded_file')) {
      $inifile = php_ini_loaded_file();
    }
    else {
      $inifile = '';
    }
    if (empty($inifile)
      && ($pid = @file_get_contents($pidfile))
      && ($cmdline = @file_get_contents("/proc/$pid/cmdline"))
    ) {
      $pattern = '@-?-c(onfig)?\s*([^ ]+?)($|\s|--)@';
      if (preg_match($pattern, $cmdline, $match)) {
        $inifile = $match[2];
      }
      else {
        $inifile = '';
      }
    }
  }
  else {
    $uptime = $inifile = '<i>unknown</i>';
  }

  $host = function_exists('gethostname') ? @gethostname() : @php_uname('n');
  $sapi = php_sapi_name() . ' ' . ini_get('hhvm.server.type');
  _hhvminfo_print_table(
    array(
      'Host'                      => $host,
      'System'                    => php_uname(),
      'PHP Version'               => phpversion(),
      'HHVM Version'              => ini_get('hphp.compiler_version'),
      'HHVM compiler id'          => ini_get('hphp.compiler_id'),
      'SAPI'                      => $sapi,
      'Loaded Configuration File' => $inifile,
      'Uptime'                    => $uptime,
    )
  );
}

if (isset($_GET['INI']) && $ini = ini_get_all()) {
  ksort($ini);
  echo '<h2 id="ini">ini</h2>';
  _hhvminfo_print_table(
    $ini,
    array('Directive', 'Local Value', 'Master Value', 'Access'),
    FALSE
  );
  echo '<h2>access level legend</h2>';
  _hhvminfo_print_table(
    array(
      'Entry can be set in user scripts, ini_set()' => INI_USER,
      'Entry can be set in php.ini, .htaccess, httpd.conf' => INI_PERDIR,
      'Entry can be set in php.ini or httpd.conf' => INI_SYSTEM,
      '<div style="width:865px">Entry can be set anywhere</div>' => INI_ALL,
    )
  );
}

if (isset($_GET['EXTENSIONS']) && $extensions = get_loaded_extensions(TRUE)) {
  echo '<h2 id="extensions">extensions</h2>';
  natcasesort($extensions);
  _hhvminfo_print_table($extensions, array(), TRUE);
}

if (isset($_GET['FUNCTIONS']) && $functions = get_defined_functions()) {
  echo '<h2 id="functions">functions</h2>';
  natcasesort($functions['internal']);
  _hhvminfo_print_table($functions['internal'], array(), TRUE);
}

if (isset($_GET['CONSTANTS']) && $constants = get_defined_constants(TRUE)) {
  ksort($constants);
  foreach ($constants as $key => $value) {
    if (!empty($value)) {
      ksort($value);
      echo '<h2 id="constants-', $key, '">Constants (', $key, ')</h2>';
      _hhvminfo_print_table($value);
    }
  }
}

if (isset($_GET['GLOBALS'])) {
  if (0) {
    $_SERVER;
    $_ENV;
    $_SESSION;
    $_COOKIE;
    $_GET;
    $_POST;
    $_REQUEST;
    $_FILES;
  } // PHP 5.4+ JIT
  $order = array_flip(
    array('_SERVER', '_ENV', '_COOKIE', '_GET', '_POST', '_REQUEST', '_FILES')
  );
  foreach ($order as $key => $ignore) {
    if (isset($GLOBALS[$key])) {
      echo '<h2 id="', $key, '">$', $key, '</h2>';
      if (empty($GLOBALS[$key])) {
        echo '<hr>';
      }
      else {
        _hhvminfo_print_table($GLOBALS[$key]);
      }
    }
  }
  natcasesort($globals);
  $globals = array_flip($globals);
  unset($globals['GLOBALS']);
  foreach ($globals as $key => $ignore) {
    if (!isset($order[$key])) {
      echo '<h2 id="', $key, '">$', $key, '</h2>';

      if (empty($GLOBALS[$key])) {
        echo '<hr>';
      }
      else {
        _hhvminfo_print_table($GLOBALS[$key]);
      }
    }
  }
}
?>
  <div class="meta">
    <a href="http://hhvm.com/blog">HHVM blog</a> |
    <a href="https://github.com/facebook/hhvm/wiki">HHVM wiki</a> |
    <a href="https://github.com/facebook/hhvm/blob/master/hphp/NEWS">HHVM
      changelog</a> |
    <a href="https://github.com/facebook/hhvm/commits/master">HHVM commits</a> |
    <a href="http://webchat.freenode.net/?channels=hhvm">#HHVM irc chat</a> |
    <a href="https://gist.github.com/ck-on/67ca91f0310a695ceb65">HHVMinfo
      latest</a>
  </div>

</div>
</body>
</html>
