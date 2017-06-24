<?php 

if ( in_category('28') || post_is_in_descendant_category(28) && !in_category('50'))
{include(TEMPLATEPATH .'/single-works.php');}

elseif( in_category('29') || post_is_in_descendant_category(29) && !in_category('49'))
{include(TEMPLATEPATH . '/single-works.php');}

else{include(TEMPLATEPATH . '/single-default.php');}
?>