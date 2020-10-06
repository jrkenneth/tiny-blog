<?php

namespace app\models;

use tiny\libs\db\Entity;

class Admin extends Entity {

  public $tableName = "admin";

  public $id;
  public $email;
  public $full_name;
  public $password;
  public $created_at;
}
