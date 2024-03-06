<?php

use Illuminate\Database\Capsule\Manager as Capsule;

require_once("./DbHandler.php");
class MainProgram implements DbHandler
{
    private $_capsule;


    // Constructor
    public function __construct()
    {
        $this->_capsule = new Capsule;
    }
    // -------------------------------------------------------------------------------------------------------
    // Connect Function
    public function connect()
    {
        try {
            $this->_capsule->addConnection([
                'driver'    => __DRIVER_DB__,
                'host'      => __HOST_DB__,
                'database'  => __NAME_DB__,
                'username'  => __USERNAME_DB__,
                'password'  => __PASS_DB__,
            ]);
            $this->_capsule->setAsGlobal();
            $this->_capsule->bootEloquent();
            return true;
        } catch (\Exception $ex) {
            echo "Error : " . $ex->getMessage();
            return false;
        }
    }
    //----------------------------------------------------------------------------------------------------------
    // Get All Data
    public function get_data($fields = array(),  $start = 0)
    {
        $items = Items::skip($start)->take(5)->get();
        if (empty($fields)) {
            foreach ($items as $item) {
                echo $item->id . " <br>";
            }
        } else {
            return $items;
        }
    }
    // -------------------------------------------------------------------------------------------------------
    // Disconnect Function
    public function disconnect()
    {
        try {
            Capsule::disconnect();
            return true;
        } catch (\Exception $e) {
            echo "Error : " . $e->getMessage();
            return false;
        }
    }
    //--------------------------------------------------------------------------------------------------------
    // Get Specific Items
    public function get_record_by_id($id, $primary_key)
    {
        $item = Items::where($primary_key, "=", $id)->get();
        if (count($item) > 0)
            return $item[0];
    }
    //--------------------------------------------------------------------------------------------------------
    // Search Function
    public function search_by_column($name_column, $value)
    {
        $items = Items::where($name_column, "like", "%$value%")->get();
        if ($name_column == "" || $value == "") {
            echo "<div style='display:flex;
            justify-content:center;
            margin-top:20px;
            color:red;
            font-weight:bold;'>Please Enter A Value</div>";
            return $items;
        }
        $isExist = Items::where($name_column, "=", $value)->exists();
        if ($isExist) {
            if (count($items) > 0)
                return $items;
        } else {
            echo "This value deosn't exists";
            return $items;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Insert Function
    public function insert_item($data)
    {
        if (!empty($data)) {
            $this->_capsule->table("items")->insert($data);
            echo "<div style='display:flex;justify-content:center;'>Data Added successfully</div> ";
            return true;
        }
        return false;
    }
}
// -------------------------------------------------------------------------------------------------------
