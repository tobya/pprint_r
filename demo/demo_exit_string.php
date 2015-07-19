<h1>Show Array, Print String and Exit</h1>

<?php




  include('../pprint_r.php');

 $ShowArray =  array( 'Value1','Item2'=> 'Value2',
                      'Item3 (Click to Open)'=> array('Item4', 
                      'Item5' => array('Some Text value'),
                      'Item6' => "<a href='http://example.com'>A Link</a> inside some HTML but it gets show just as is.",
                      'Item7 (Click to Open)' => array('A Further Item', 'Another Item', 'Must Keep Going')));


  echo '<P>Without pprint_r</P><PRE>';
  print_R($ShowArray);
  echo '</PRE>';

  
  pprint_R($ShowArray,'pprint_r has shut down this page.');

  echo 'This statement wont be shown';