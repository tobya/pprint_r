pprint_r
--------

Provides 2 useful functions for debug printing out
- pprint_r which outputs a javascript tree of any array that can explored on page.
- preprint_r adds a `<PRE>` tag before output so array can be easily seen.
- Great for debugging just include from github using `https://rawgit.com/tobya/pprint_r/master/pprint_r.php` or copy [this](https://rawgit.com/tobya/pprint_r/master/pprint_r.php)

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

Pre Print_r
-------

    preprint_r($Array);

Outputs array with html `<PRE>` in front of it.

unprint_r
--------

If you have the text of an array provided by print_r you can use `unprint_r` to read it and turn it back into an array.


