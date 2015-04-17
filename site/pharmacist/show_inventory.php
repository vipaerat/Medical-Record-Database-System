

<?php




include('../config.php');

$query = $_POST['query'];

//Some rough php code to connect to db and returns the Stock table

$stockInventoryQuery =<<<EOF
SELECT name,dose,expiry_date,quantity
FROM stock
WHERE lower(name) like lower('%$query%')
EOF;

$ret = pg_query($db,$stockInventoryQuery);


$i=0;
//echo $field;
echo ' <div class="">
<table class="table table-responsive table-hover table-striped">
<thead>
<tr>';



while($i<pg_num_fields($ret))
{
$field=pg_field_name($ret,$i);


echo '<th class="col-md-2">',strtoupper($field) ,'</th>';

$i=$i+1;
}


echo '</tr> </thead> <tbody>';
$k=0;
while($row = pg_fetch_row($ret)){
$j=0;
echo '<tr>';

//fetching salts for all medicines

	$name = $row[0];
	$dose = $row[1];

	$saltQuery = "SELECT salt FROM med_salts WHERE name='$name' and dose=$dose;";

	$saltRes = pg_query($db,$saltQuery);

	$salts = '<ul class="list-unstyled">';

	while($fetchSalts = pg_fetch_row($saltRes))
	{
		$salts = $salts . "<li>" . $fetchSalts[0] . "</li>";
	}


	$salts = $salts . "</ul>";

while($j<pg_num_fields($ret))
{


if($j==0)
{
$a=$row[$j];
echo '<td class="col-md-2"> <a href="javascript:void(0);" data-html="true"  data-toggle="popover" data-trigger="focus" title="Salts" data-content=\''. $salts .'\'>',$a,'</a> </td>';
}
else{
echo '<td class="col-md-2">',$row[$j],'</td>';
}
$j=$j+1;
}
echo '</tr>';
$k=$k+1;
}



echo '</tbody></table> </div>';


?>
