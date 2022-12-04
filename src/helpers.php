<?php

if (!function_exists('pprint_r')){


   function pprint_r($Variable, $return){
    if ($return ){
      return '<PRE>' . print_r($Variable, $return);
    } else {
      echo '<PRE>';
      print_r($Variable,$return);
    }
   }

  if (!function_exists('pprintr')){
     function pprintr($Variable, $return){
        return print_r($Variable, $return);
     }
  }


}
