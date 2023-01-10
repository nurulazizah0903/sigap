<?php

namespace PHPMaker2022\project1;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // absen
    $app->map(["GET","POST","OPTIONS"], '/AbsenList[/{id}]', AbsenController::class . ':list')->add(PermissionMiddleware::class)->setName('AbsenList-absen-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/AbsenAdd[/{id}]', AbsenController::class . ':add')->add(PermissionMiddleware::class)->setName('AbsenAdd-absen-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/AbsenView[/{id}]', AbsenController::class . ':view')->add(PermissionMiddleware::class)->setName('AbsenView-absen-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/AbsenEdit[/{id}]', AbsenController::class . ':edit')->add(PermissionMiddleware::class)->setName('AbsenEdit-absen-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/AbsenDelete[/{id}]', AbsenController::class . ':delete')->add(PermissionMiddleware::class)->setName('AbsenDelete-absen-delete'); // delete
    $app->group(
        '/absen',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', AbsenController::class . ':list')->add(PermissionMiddleware::class)->setName('absen/list-absen-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', AbsenController::class . ':add')->add(PermissionMiddleware::class)->setName('absen/add-absen-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', AbsenController::class . ':view')->add(PermissionMiddleware::class)->setName('absen/view-absen-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', AbsenController::class . ':edit')->add(PermissionMiddleware::class)->setName('absen/edit-absen-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', AbsenController::class . ':delete')->add(PermissionMiddleware::class)->setName('absen/delete-absen-delete-2'); // delete
        }
    );

    // error
    $app->map(["GET","POST","OPTIONS"], '/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->get('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        Route_Action($app);
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
