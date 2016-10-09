<?php
// Routes
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
    
    /*
    $indexController = new IndexController();
    $info = $indexController->obtener();
    $this->logger->info($info);
    */

    $data = array('nombre' => $name, 'age' => 29,'info' =>$dato);
    foreach ($data as $key => $value) {
        $this->logger->info($key." ".$value);
    }

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