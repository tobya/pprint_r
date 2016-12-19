<h1>Show output with prePrint_r</h1>
<?php

//Demo preprint_R
include_once('../pprint_R.php');


$Array = array("A","Duck",array('another'=>'Array',456,3242,526324234),'Final' => 'Item', 23);

echo '<P> Output with \'print_R<P>\'';
print_r($Array);

echo '<P> With preprint_R';
preprint_R($Array);
