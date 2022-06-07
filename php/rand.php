<?php

$pattern = "09gdf'jj!k@h#%jhkfgdg^DDfgas%xcffghfg^%dfsfdgg3#dasd%^^&&USFGGHHSDD";
$length =  strlen($pattern)-1;

$store = [];
for($i=0;$i<6;$i++)
{
$number = 	rand(0,$length);
  $store[] =   $pattern[$number];
}


echo implode($store);



?>