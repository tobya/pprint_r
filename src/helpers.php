<?php

if (!function_exists('preprint_r')){


   function preprint_r($Variable, $return = false){
    if ($return ){
      return '<PRE>' . print_r($Variable, $return);
    } else {
      echo '<PRE>';
      print_r($Variable,$return);
    }
   }

  if (!function_exists('preprintr')){
     function preprintr($Variable, $return = false){
        return preprint_r($Variable, $return);
     }
  }


}

if (!function_exists('pprint_r')) {
  function pprint_r($Array, $Options = false)
  {

    $prehtml = '
	<!-- Makes the file tree(s) expand/collapsae dynamically -->
		<style type="text/css">

      .php-array-tree {
        font-family: Georgia;
        font-size: 12px;
        letter-spacing: 1px;	line-height: 1.5;
		background-color: #ABC1DF;
      }

        .php-array-tree span {
          color: #000000;
          text-decoration: none;
        }

        .php-array-tree span:hover {
          color: #666666;
        }

        .php-array-tree .open {
          font-style: italic;
        }

        .php-array-tree .closed {
          font-style: normal;
        }
        
        .php-array-tree .pft-array {
          color: #4F15A7; 
          font-weight: bold;
          text-decoration: none; 
			    cursor: pointer; cursor: hand; //Turn into hand.
        }
        
        .php-array-tree .pft-array  .pft-value{
          color: #000000;
          font-weight: normal;
          text-decoration: none;  
	   	    cursor: auto;      //default cursor.
        }
		</style>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script  type="text/javascript">
		$(document).ready( function() {

        // Hide all subfolders at startup
        $(".php-array-tree").find("UL").hide();

        // Expand/collapse on click
        $(".pft-array span").click( function() {
          $(this).parent().find("UL:first").slideToggle("medium");
          if( $(this).parent().attr("className") == "pft-array" ) return false;
        });

      });

		</script>
  ';

    echo $prehtml;
    echo php_tree_array($Array, '');


    switch (getType($Options)) {
      case 'array':
        //Some code to deal with options.
        break;
      case  'string' : //display text and exit

        die($Options);

        break;
      case  'boolean' : //ShouldExit
        if ($Options == true) {
          exit;
        }
        break;
    }


  }


// Does the work to produce a Tree structure form a multidimensional array.
  function php_tree_array($MArray, $return_link, $extensions = array(), $first_call = true)
  {
    // Recursive function called by html_array_tree() to list all subarray values
    $html_array_tree = '';


    $html_array_tree = "\n<ul";
    if ($first_call) {
      $html_array_tree .= " class=\"php-array-tree\"";
      $first_call = false;
    }
    $html_array_tree .= ">";
    foreach ($MArray as $KeyValue => $this_value) {
      if (trim($KeyValue) == '') {
        $KeyValue = '{EmptyKey}';
      }
      if (is_array($this_value)) {
        // Array
        $html_array_tree .= "\n<li class=\"pft-array\"><span href=\"#\">" . htmlspecialchars($KeyValue) . "</span>";
        $html_array_tree .= php_tree_array($this_value, $return_link, $extensions, false);
        $html_array_tree .= "\n</li>";
      } else {
        // Key / Value
        $html_array_tree .= "\n<li ><span  class=\"pft-value\">$KeyValue=" . htmlspecialchars($this_value) . "</span></li>";
      }

    }
    $html_array_tree .= "\n</ul>";

    return $html_array_tree;
  }
}