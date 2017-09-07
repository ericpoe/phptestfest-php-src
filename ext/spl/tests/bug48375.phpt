--TEST--
Bug #48375 (AppendIterator::append() never ends, which has SplFileObject as inner iterator)
--CREDITS--
 KCPHPUG Testfest 2017 - Eric Poe
--FILE--
<?php
$it = new AppendIterator();
$fileIt = new SplFileObject('data://text/plain;base64,QSBsaW5l', 'r'); // "A line"
$it->append($fileIt);
$it->append(new ArrayIterator(["A line"])); // endless

foreach ($it as $value) {
  var_dump($value);
};
?>
--XFAIL--
This test will timeout until Bug #48375 is fixed
--EXPECT--
string(6) "A line"
int(1)