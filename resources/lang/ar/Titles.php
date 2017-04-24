<?php
use App\Defaults;
$getAllDefautls = Defaults::where('type','Titles')->get();
foreach ($getAllDefautls as $Default) {
	$titlesOfSite[$Default->properaty] = $Default->data;
}	

$titlesOfTypes = [1];
foreach (app('Types') as $Type) {
	$titlesOfTypes[$Type->id] = $Type->type;
	$titlesOfTypes[$Type->id] .= ' | '.$titlesOfSite['nameOfSite'];
}

$titlesOfSortsBy = [1];
foreach (app('sortsBy') as $sortBy) {
	$titlesOfSortsBy[$sortBy->sortByRoutes] = $sortBy->sortByArabic;
	$titlesOfSortsBy[$sortBy->sortByRoutes] .= ' | '.$titlesOfSite['nameOfSite'];
}

return array_merge($titlesOfTypes,$titlesOfSortsBy,$titlesOfSite);