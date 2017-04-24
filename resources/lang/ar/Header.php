<?php
use App\Defaults;
$getAllDefaults = Defaults::where('type','Header')->get();
foreach ($getAllDefaults as $Default) {
	$Defaults[$Default->properaty] = $Default->data;
}

$sortsBy = [];
foreach (app('sortsBy') as $getAllSortsBy){
	$sortsBy[$getAllSortsBy->sortByEnglish] = $getAllSortsBy->sortByArabic;
}

return array_merge($sortsBy,$Defaults);