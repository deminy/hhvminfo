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
    <a href="?INI&EXTENSIONS&FUNCTIONS&CONSTANTS">ALL</a>
    <a <?php echo isset($params['INI']) ? 'class="active"' : '' ?>"
    href="?INI">ini</a>
    <a <?php echo isset($params['EXTENSIONS']) ? 'class="active"' : '' ?>
      href="?EXTENSIONS">Extensions</a>
    <a <?php echo isset($params['FUNCTIONS']) ? 'class="active"' : '' ?>
      href="?FUNCTIONS">Functions</a>
    <a <?php echo isset($params['CONSTANTS']) ? 'class="active"' : '' ?>
      href="?CONSTANTS">Constants</a>
  </div>

  <?php _hhvminfo_phpinfo_details($params) ?>

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
