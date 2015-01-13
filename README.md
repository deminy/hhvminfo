# Summary

When calling PHP function "_phpinfo()_" on HHVM, you probably see "_HipHop_" as
output without any other details. This module outputs information about your
PHP's configuration on HHVM, replacing the old phpinfo page under Drupal admin
panel.

# Credits

The HHVM implementation of function phpinfo() (i.e., file "_hhvminfo.php_") was
based on [this code snippet](https://gist.github.com/ck-on/67ca91f0310a695ceb65)
by [ck-on](https://github.com/ck-on).
