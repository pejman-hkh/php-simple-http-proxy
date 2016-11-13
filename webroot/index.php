<?
ini_set('display_errors', 'Off');

$url = $_SERVER['REQUEST_URI'];

$headers = getallheaders();

$headers1 = array();

if( isset($headers['Cookie'] )) {
  $headers1['Cookie'] = $headers['Cookie'];
}

if( isset( $headers['Content-Type'] ) ) {
  $headers1['Content-Type'] = $headers['Content-Type'];
  $headers1['Content-Length'] = $headers['Content-Length'];
}

$h = array();
foreach( $headers1 as $k => $v ) {
    $h[] = $k.": ".$v;
}


$postdata = http_build_query(
    $_POST
);


$opts = array(
  'http'=>array(
    'method'=> $_SERVER['REQUEST_METHOD'],
    'header'=> implode("\r\n", $h)
  )
);

if( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
  $opts['http']['content'] = $postdata;
}


$context = stream_context_create($opts);


if( @$c = file_get_contents( $url , false, $context ) ) {

}

foreach( $http_response_header as $k => $v ) {
  header( $v );
}


echo $c;

?>
