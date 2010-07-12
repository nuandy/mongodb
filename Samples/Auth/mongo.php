<?php
$connection = new Mongo("localhost:27017", array("persist" => "dude")); // connect
$db = $connection->test;
$collection = $connection->test->users;
$obj = $collection->find();
foreach ($obj as $id => $value) {
    echo "<p>$id: ";
    var_dump($value);
    echo "</p>";
}
//$collection->remove(array("email" => "nuandy@gmail.com"));
echo "<p>".$collection->count()."</p>";
?>
