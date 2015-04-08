<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug']=true;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//register the database stuff

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
	'db.options' => array(
		'driver' => 'pdo_sqlite',
		'path'   => __DIR__.'/mydatabase.db',
	),
));

//register the template stuff

$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path'=> __DIR__.'/views',
));

$app->get('/', function() use ($app){
	return $app['twig']->render('hello.twig', array(
		'name' => 'mr name',
	));
});

$app->get('/hello/{name}', function ($name) use ($app) {
	$sql  = "SELECT * FROM testdata";
	$data = $app['db']->fetchAll($sql);
	$awidget =  $data[1]['widget'];
    return 'Hello '.$app->escape($name) . ' ' . $awidget;
});

$app->post('/feedback', function(Request $request) use($app){

	$response = array(
		'success'=>TRUE,
		'message'=>$request->get('message'),
	);
		
	return $app->json($response, 201);
});

$app->run();

?>
