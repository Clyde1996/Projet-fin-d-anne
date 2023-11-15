<?php
$types = $result["data"]["types"];

foreach ($types as $type) {
    echo "<p>Type ID: " . $type->getId() . "</p>";
    echo "<p>Type Name: " . $type->getName() . "</p>";
    echo "<p>Type Pictogram: " . $type->getPictogram() . "</p>";
    echo "<hr>";
}
?>