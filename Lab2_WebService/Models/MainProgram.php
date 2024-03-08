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
            echo "Error: " . $ex->getMessage();
            return false;
        }
    }

    // Get All Data
    public function get_data($fields = [], $start = 0)
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

    // Disconnect Function
    public function disconnect()
    {
        try {
            Capsule::disconnect();
            return true;
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Get Specific Items
    public function get_record_by_id($id, $primary_key)
    {
        $item = Items::where($primary_key, "=", $id)->first();
        if ($item) {
            return $item;
        }
        return null;
    }

    // Search Function
    public function search_by_column($name_column, $value)
    {
        if ($name_column === "" || $value === "") {
            echo "<div style='display:flex; justify-content:center; margin-top:20px; color:red; font-weight:bold;'>Please Enter A Value</div>";
            return [];
        }

        $items = Items::where($name_column, "like", "%$value%")->get();

        if ($items->count() > 0) {
            return $items;
        } else {
            echo "This value doesn't exist";
            return [];
        }
    }

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

    // Git URL Function
    public function get_url()
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = explode('/', $url);

        if (isset($url[4]) && $url[4] !== 'products') {
            header("HTTP/1.1 404 Not Found");
            exit();
        }

        $product_id = null;

        if (isset($url[5])) {
            $product_id = (int) $url[5];
        }

        return $product_id;
    }

    // Validate the method type
    public function handle_methods($items, $product_id)
    {
        $method = $_SERVER["REQUEST_METHOD"];

        switch ($method) {
            case 'POST':
                $post = json_decode(file_get_contents('php://input'), true);
                $response = $items->create($post);
                echo json_encode($response);
                break;

            case 'GET':
                if ($product_id) {
                    $response = $this->get_record_by_id($product_id, 'id');

                    if ($response) {
                        echo json_encode($response);
                    } else {
                        http_response_code(404);
                        echo json_encode(["Error" => "Not Found"]);
                    }
                } else {
                    $response = $this->get_data();
                    echo json_encode($response);
                }
                break;

            default:
                http_response_code(405);
                echo json_encode(["Error" => "Request Method Not Supported"]);
                break;
        }
    }
}
