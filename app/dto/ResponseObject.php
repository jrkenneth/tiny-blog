<?php


namespace app\dto;

class ResponseObject {

  public static function success($data, $message = 'success', $code = 200) {
    return ['message' => $message, 'data' => $data, 'code' => $code, 'success' => true];
  }

  public static function error($data = null, $message = 'error', $code = 500) {
    return ['message' => $message, 'data' => $data, 'code' => $code, 'success' => false];
  }
}
