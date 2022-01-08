<?php 

$name = $_POST['name'];
$email = $_POST['email'];

echo "Name: " . $name;
echo "<br>";
echo "Email: " . $email;

$file = 'form.txt';
$content = "Name: " . $name ."\n" . "Email: " . $email . "\n\n";

file_put_contents($file, $content, FILE_APPEND);
