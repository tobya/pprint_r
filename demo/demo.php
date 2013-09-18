<?php

  include('../pprint.php');

 $ShowArray =  array( 'Value1','Item2'=> 'Value2',
                      'Item3'=> array('Item4', 
                      'Item5' => 'Some HTML value'));

  pprint_R($ShowArray);