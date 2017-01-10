<?php
// Connect to MySQL
$link = mysql_connect( 'localhost', 'root', 'deepak' );
if ( !$link ) {
  die( 'Could not connect: ' . mysql_error() );
}

// Select the data base
$db = mysql_select_db( 'amcharts', $link );
if ( !$db ) {
  die ( 'Error selecting database \'amcharts\' : ' . mysql_error() );
}

// Fetch the data
$query = "
  SELECT *
  FROM my_chart_data1
  ORDER BY category ASC";
$result = mysql_query( $query );

// All good?
if ( !$result ) {
  // Nope
  $message  = 'Invalid query: ' . mysql_error() . "\n";
  $message .= 'Whole query: ' . $query;
  die( $message );
}

// Print out rows
$prefix = '';
echo "[\n";
while ( $row = mysql_fetch_assoc( $result ) ) {
  echo $prefix . " {\n";
  echo '  "category": "' . $row['category'] . '",' . "\n";
  echo '  "value1": ' . $row['value'] . ',' . "\n";
  echo " }";
  $prefix = ",\n";
}
echo "\n]";

// Close the connection
mysql_close($link);
?>