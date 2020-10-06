<?php

namespace app\services;

use app\dto\ResponseObject;
use app\libs\Hash;
use app\libs\Validate;
use app\models\Admin;
use tiny\interfaces\IRequest;
use tiny\interfaces\IResponse;
use tiny\libs\Cookie;
use tiny\libs\JWT;
use tiny\libs\Session;

class AdminService {

  private static function adminEmailExist(string $email): bool {
    $users = Admin::findBy(['email', '=', trim($email)]);
    return !!count($users);
  }

  private static function isValidUser($requestBody): array {
    $rules = [
      'full_name' => ['required' => true],
      'email'  => [
        'required' => true,
        'email' => true,
        'customFunction' => function () use ($requestBody): bool {
          return !self::adminEmailExist($requestBody->email);
        }
      ],
      'password'  => [
        'required' => true,
        'min' => 6
      ],
    ];

    $message = [
      'email' => [
        'customFunction' => 'Email is already taken'
      ]
    ];

    $validator = new Validate((array) $requestBody, $rules, $message);
    return $validator->errors();
  }


  public static function signup(IRequest $req, IResponse $res) {
    $incomingUser = $req->body;

    $errors = self::isValidUser($incomingUser);

    if (!empty($errors)) {
      $res->json(ResponseObject::error($errors, 'Validation failed'), 400);
    }

    $newAdmin = new Admin();

    // $newAdmin->full_name = $incomingUser->full_name;
    // $newAdmin->email = $incomingUser->email;
    // $newAdmin->password = $incomingUser->password;

    foreach ($incomingUser as $key => $value) {
      if ($key === 'password') {
        $newAdmin->$key = Hash::create($value);
        continue;
      }

      $newAdmin->$key = $value;
    }

    $saveResult = $newAdmin->save();

    $res->json(ResponseObject::success($saveResult, 'User saved successfully'));
  }


  private static function isValidLogin($requestBody): array {
    $rules = [
      'email'  => [
        'required' => true,
        'email' => true,
        'customFunction' => function () use ($requestBody): bool {
          return self::adminEmailExist($requestBody->email);
        }
      ],
      'password'  => [
        'required' => true,
        'min' => 6,
        'customFunction' => function () use ($requestBody): bool {
          if (self::adminEmailExist($requestBody->email)) {
            $admin = Admin::findOneBy(['email', '=', $requestBody->email]);
            $hashedPassword = $admin->password;
            return Hash::compare($requestBody->password, $hashedPassword);
          }
          return true;
        }
      ],
    ];

    $message = [
      'email' => [
        'customFunction' => 'User does not exists'
      ],
      'password' => [
        'customFunction' => 'Invalid email or password'
      ],
    ];

    $validator = new Validate((array) $requestBody, $rules, $message);
    return $validator->errors();
  }


  public static function login(IRequest $req, IResponse $res) {
    $incomingLogin = $req->body;
    $errors = self::isValidLogin($incomingLogin);

    if (!empty($errors)) {
      $res->json(ResponseObject::error($errors, 'Unable to log you in'), 400);
    }

    //So we are sure there is no error now
    $admin = Admin::findOneBy(['email', '=', trim($incomingLogin->email)]);

    unset($admin->password);

    $token = JWT::sign($admin, JWT_SECRET);
    Cookie::set('token', $token);
    Session::set('token', $token);

    $returnData = [
      'token' => $token,
      'adminInfo' => $admin
    ];

    $res->json(ResponseObject::success($returnData, 'Login Successful'));
  }
}
