<?php
/*************************************************************
Copyright © 2012 Toby Allen (http://github.com/tobya)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the “Software”), to deal in the Software without restriction, 
including without limitation the rights to use, copy, modify, merge, publish, distribute, sub-license, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, 
subject to the following conditions:

The above copyright notice, and every other copyright notice found in this software, and all the attributions in every file, and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT. 
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, 
ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
****************************************************************/


/****************************
 * pprint_r code based on php_file_tree origionally provided by Cory LaViska (http://abeautifulsite.net/) - http://www.abeautifulsite.net/blog/2007/06/php-file-tree/
 * Modified to take any array and render with a little css and jquery to have a tree that can collapse and expand.  Very useful for viewing debugging a very large array.
 */


/********************
 * @param $Array
 * @param bool $ShouldExit
 *
 */
function pprint_r($Array, $Options = false){

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



switch (getType($Options))
{
  case 'array':
  //Some code to deal with options.
  break;
  case  'string' : //display text and exit
  
  die($Options);
  
  break;
  case  'boolean' : //ShouldExit
  if ($Options == true){
	  exit;
	}
	break;
}


}

function php_tree_array($MArray, $return_link, $extensions = array(), $first_call = true) {
	// Recursive function called by html_array_tree() to list all subarray values
	$html_array_tree = '';


		$html_array_tree = "\n<ul";
		if( $first_call ) { $html_array_tree .= " class=\"php-array-tree\""; $first_call = false; }
		$html_array_tree .= ">";
		foreach( $MArray as $KeyValue => $this_value) {

        if (trim($KeyValue) == ''){$KeyValue = '{EmptyKey}';}
				if( is_array($this_value) ) {
					// Array
          $html_array_tree .= "\n<li class=\"pft-array\"><span href=\"#\">" . htmlspecialchars($KeyValue) . "</span>";
					$html_array_tree .= php_tree_array($this_value, $return_link ,$extensions, false);
					$html_array_tree .= "\n</li>";
				} else {
					// Key / Value
					$html_array_tree .= "\n<li ><span  class=\"pft-value\">$KeyValue=" . htmlspecialchars($this_value) . "</span></li>";
				}
			
		}
		$html_array_tree .= "\n</ul>";

	return $html_array_tree;
}
?>