pprint_r
--------

Pretty print_r
--------------

Have you every wished you had a better way of viewing a very large array?  
This very simple function can be called and will display inline an expandable tree of your array.

Simple Call

    pprint_r($MyArray);

If you wish execution to end on print then pass a second parameter

    pprint_r($MyArray,true);

If you wish execution to end on print with an message pass a string as the second parameter

    pprint_r($MyArray,'Execution ended by pprint_r');

[Demo.](http://tobya.github.io/pprint_r)
