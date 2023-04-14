<?php
require __DIR__ . '/../../vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Routing\RouteCollectorProxy;
use Slim\Factory\AppFactory;
use Slim\Psr7\Response as Response;

require 'account.php';

$app = AppFactory::create();
$app->setBasePath('/api');

// Middleware to ensure that pages that require authentication are validated
$app->add(function (Request $request, RequestHandler $handler) {
    // Get the original response so we can get the status code and existing content to be used later
    $response = $handler->handle($request);
    $request_method = $request->getMethod();
    $status_code = $response->getStatusCode();
    $existingContent = (string)$response->getBody();

    // Then start a new reponse
    $response = new Response();
    $response->getBody()->write($existingContent);

    // Now get the HTTP verb and path and compare them with the list of paths that don't require auth
    $path = $request->getUri()->getPath();
    $paths_not_requiring_auth = [
        '/api/1.0/account' => 'POST',
        '/api/1.0/verify' => 'POST',
        '/api/1.0/reset_password' => 'POST',
        '/api/1.0/auth' => 'POST',
    ];

    foreach ($paths_not_requiring_auth as $path_match => $verb) {
        if (strstr($path, $path_match)) {
            $match = $paths_not_requiring_auth[$path_match];
        }
    }

    $validate_auth = isset($match) && $request_method == $match ? false : true;
    $headers = $request->getHeaders();

    // If this request is to an endpoint that requires auth and no 'Authorization' header is present then return an error
    if ($validate_auth && !isset($headers['Authorization'])) {
        $response = new Response();
        $response->getBody()->write(json_encode(['error' => 'Unauthorized', 'code' => '0001']));
        return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
    }

    return $response
                ->withStatus($status_code)
                ->withHeader('Content-Type', 'application/json');
});

/**
 * Successful response
 * 
 * Build the JSON for a successful response and return with the proper HTTP response code
 * 
 * @param Object The Response object
 * @param Array The payload
 * @return Object
 */
function successResponse($response, $results) {
    $response->getBody()->write(json_encode(['response' => $results]));
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
}

/**
 * Error response
 * 
 * Build the JSON for an error response and return with the proper HTTP response code
 * 
 * @param Object The Response object
 * @param Object The exception object
 * @return Object
 */
function errorResponse(Response $response, \Throwable $th) {
    $response->getBody()->write(json_encode(['response' => ['error' => $th->getMessage(), 'code' => $th->getCode()]]));
    return $response->withStatus(500, $th->getMessage());
}

$app->group('/1.0', function (RouteCollectorProxy $group) {
    $group->post('/auth',
        function (Request $request, Response $response, $args) {
            try {
                return successResponse($response, (new Account())->authenticate(json_decode($request->getBody())));
            } catch (\Throwable $th) {
                return errorResponse($response, $th);
            }
        });

    $group->post('/reset_password',
        function (Request $request, Response $response, $args) {
            try {
                return successResponse($response, (new Account())->resetPassword(json_decode($request->getBody())));
            } catch (\Throwable $th) {
                return errorResponse($response, $th);
            }
        });

    $group->get('/account',
        function (Request $request, Response $response, $args) {
            try {
                return successResponse($response, (new Account())->getAccount(json_decode($request->getBody())));
            } catch (\Throwable $th) {
                return errorResponse($response, $th);
            }
        });

    $group->get('/', 
        function (Request $request, Response $response, $args) {
            $response->getBody()->write("Hello world!");
            return $response;
        });
});

$app->run();