<?php
// Routes
$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    $dato = $this->IndexController->obtener();

    // Render index view
    //return $this->renderer->render($response, 'index.phtml', $args);
    $data = array('saludo' =>$dato);
    return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($data));
});

/*
$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    $name = $request->getAttribute('name');
    $this->logger->info($name);
    $this->logger->info($ruta);

    $dato = $this->IndexController->obtener();
    //$this->logger->info($dato);

    // Render index view
    //return $this->renderer->render($response, 'index.phtml', $args);
    
    $data = array('nombre' => $name, 'age' => 29,'saludo' =>$dato);

    return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($data));
});
*/

//http://docs.slimframework.com/request/body/slim-3-how-to-get-all-get-put-post-variables
//http://stackoverflow.com/questions/32668186/

// Usuario
// Guardar
$app->post("/uuid/guardar/", function ($request, $response, $args) {
    $this->logger->info("uuid/guardar/");
    $allPostPutVars = $request->getParsedBody();
    $uuid = $allPostPutVars["uuid"];
    $data = $this->UsuarioController->guardar($uuid);
    return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($data));
});

// Favoritos
// Obtener Favoritos
$app->get('/obtener/[{uuid}]', function ($request, $response, $args) {
    $this->logger->info("'/obtener/'");

    /*
    $allGETVARS = $request->getQueryParams();
    $uuid = $allGETVARS["uuid"];
    $videoid = $allGETVARS["videoid"];
    foreach($allGetVars as $key => $param){
       //GET parameters list
        $this->logger->info($key."->".$param);
    } 
    */  

    $uuid = $request->getAttribute('uuid');
    $data = $favoritoController = $this->FavoritoController->obtener($uuid);        
    return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($data));
});
// Guardar
$app->post('/guardar/[{uuid}]', function ($request, $response, $args) {
    $this->logger->info("'/guardar/'");
    //POST or PUT
    //$this->logger->info($request->getBody());
    /*
    foreach($allPostPutVars as $key => $param){
        //POST or PUT parameters list
        $this->logger->info($key."->".$param);
    }
    */
    $allPostPutVars = $request->getParsedBody();
    /*
    foreach($allPostPutVars as $key => $param){
        //POST or PUT parameters list
        $this->logger->info($key."->".$param);
    }
    */
    
    $uuid = $allPostPutVars["uuid"];
    $videoid = $allPostPutVars["videoid"];
    $nombre = $allPostPutVars["nombre"];
    $descripcion = $allPostPutVars["descripcion"];
    $miniatura = $allPostPutVars["miniatura"];

    $data = $favoritoController = $this->FavoritoController->guardar($uuid,$videoid,$nombre,$descripcion,$miniatura);
        
    return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($data));
});



















/*
$app->get('/myroute/[{varname}]', function() use ($app) {
    // all the good stuff here (getting the data from the db and all that)
    $this->logger->info("Slim-Skeleton '/muyroute' route");

    $dataArray = array('id' => $id, 'somethingElse' => $somethingElse);

    $response = $app->response();
    $response['Content-Type'] = 'application/json';
    $response->body(json_encode($dataArray));
    exit();
});
*/