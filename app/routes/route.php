<?php

use tiny\interfaces\IHttpAllowedMethods;
use tiny\interfaces\IRequest;
use tiny\interfaces\IResponse;
use app\middleware\Auth;
use app\services\AdminService;

$authMiddleware = new Auth();

return function ($app) use ($authMiddleware) {

    $app->get('/', function (IRequest $req, IResponse $res) {
        $title = 'Home';
        $res->view('index.php', compact('title'));
    });

    $app->get('/admin/login', function (IRequest $req, IResponse $res) {

        if (isLoggedIn()) {
            $res->redirect('/admin/index');
        }

        $title = 'Login';
        $res->view('admin/login.php', compact('title'));
    });

    $app->get('/admin/signup', function (IRequest $req, IResponse $res) {
        if (isLoggedIn()) {
            $res->redirect('/admin/index');
        }

        $title = 'Signup';
        $res->view('admin/signup.php', compact('title'));
    });

    $app->get('/admin/index', function (IRequest $req, IResponse $res) {
        $title = 'Admin Index';
        $res->view('admin/index.php', compact('title'));
    }, [$authMiddleware]);

    $app->get('/logout', function (IRequest $req, IResponse $res) {
        $req->destroySession("token");
        $req->destroyCookies("token");
        $res->redirect('/admin/login');
    });

    $app->group('/api/', function (IHttpAllowedMethods $group) use ($authMiddleware) {
        $group->post('/signup', function (IRequest $req, IResponse $res) {
            AdminService::signup($req, $res);
        });

        $group->post('/login', function (IRequest $req, IResponse $res) {
            AdminService::login($req, $res);
        });
    });


    // $app->get('/', function (IRequest $req, IResponse $res) {
    //     $res->json(["GREETINGS" => "/"]);
    // });

    // $app->get('/home', function (IRequest $req, IResponse $res) {
    //     $message = "Hello World";
    //     $res->view('index.php', compact('message'));
    // });

    // $app->any('/api/{name}', function (IRequest $req, IResponse $res) {
    //     $res->json(["GREETINGS" => $req->getPathParam('name')]);
    // });

    // $app->get('/api/{name}/world', function (IRequest $req, IResponse $res) {
    //     $res->json(["user" => ['username' => $req->getPathParam('name')]]);
    // });

    // $app->put('/api/admin', function (IRequest $req, IResponse $res) {
    //     $res->json(["res" => trim("/api/", '/'), "body"=> $req->body]);
    // }, [$authMiddleware]);

    // $app->delete('/api/admin', function (IRequest $req, IResponse $res) {
    //     $res->json(["res" => trim("/api/", '/'), "body"=> $req->body]);
    // });

    // $app->post('/api/post', function (IRequest $req, IResponse $res) {
    //     $res->json($req->body);
    // });

    // $app->group('api/v1/', function (IHttpAllowedMethods $group) use ($authMiddleware) {

    //     $group->get('/admin', function (IRequest $req, IResponse $res) {
    //         $res->json(['admin' => 'Inner route']);
    //     }, [$authMiddleware]);

    //     $group->get('/admin/{john}', function (IRequest $req, IResponse $res) {
    //         $res->json(['admin' => 'unprotected Inner route for ' . $req->getPathParam('john')]);
    //     });

    //     $group->post('/admin', function (IRequest $req, IResponse $res) {
    //         $res->json(['admin' => 'unprotected Post Inner route']);
    //     });
    // });

    // $app->group('api/v2/{name}', function (IHttpAllowedMethods $group) use ($authMiddleware) {

    //     $group->get('/special', function (IRequest $req, IResponse $res) {
    //         $res->json([
    //             'special' => 'Inner route',
    //             'name' => $req->getPathParam('name'),
    //         ]);
    //     });//, [$authMiddleware]);

    //     $group->get('', function (IRequest $req, IResponse $res) {
    //         $res->json([
    //             'special' => 'Inner route',
    //         ]);
    //     });

    // });
};
