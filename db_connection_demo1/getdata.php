<?php

$a = "pgsql:host=localhost;dbname=osm";
$opt = [
	PDO::ATTR_ERRMODE			=> PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES => false
];


$pdo = new PDO($a, "postgres", "passwordhere", $opt);

$result = $pdo->query("SELECT  round((st_x(ST_Transform(geompt, 4326))::numeric),6) as lng, round((st_y(st_transform(geompt,4326))::numeric),6) as lat  FROM playgrounds where geompt is not null");

$out = fopen('php://output', 'w');

fputcsv($out,['lng','lat']);

//echo ('lat,lng \r\n');

foreach($result AS $row)
{
  fputcsv($out,$row);
}

fclose($out);
?>
