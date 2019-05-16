<?php
// For instance, you can do something like this:
if(isset($_POST['width']) && isset($_POST['height'])) {
    $_SESSION['screen_width'] = $_POST['width'];
    $_SESSION['screen_height'] = $_POST['height'];
    $out = json_encode(array('outcome'=>'success'));
} else {
    $out = json_encode(array('outcome'=>'error','error'=>"Couldn't save dimension info"));
}


$file = 'people.txt';
// Open the file to get existing content
$current = file_get_contents($file);
// // Append a new person to the file
$current .= $out;
// // Write the contents back to the file
file_put_contents($file, $current);
//
?>
