<?php
$fname = dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.phar.php';
$pname = 'phar://' . $fname;
$file = b"<?php __HALT_COMPILER(); ?>";

$files = array();
$files['a.php'] = '<?php echo "This is a\n"; ?>';
$files['b.php'] = '<?php echo "This is b\n"; ?>';
$files['b/c.php'] = '<?php echo "This is b/c\n"; ?>';
include 'files/phar_test.inc';

$fp = fopen($pname . '/b/c.php', 'wb');
fwrite($fp, b"extra");
fclose($fp);
echo "===CLOSE===\n";
$p = new Phar($fname);
$b = fopen($pname . '/b/c.php', 'rb');
$a = $p['b/c.php'];
var_dump($a);
var_dump(fread($b, 20));
rewind($b);
echo "===UNLINK===\n";
unlink($pname . '/b/c.php');
var_dump($a);
var_dump(fread($b, 20));
include $pname . '/b/c.php';
?>

===DONE===
<?php error_reporting(0); ?>
<?php unlink(dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.phar.php'); ?>