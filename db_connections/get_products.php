<?PHP

require_once __DIR__ . '/../config.php';

$host = $_ENV['DB_HOST'];
$db = $_ENV['DB_DATABASE'];
$user = $_ENV['DB_USERNAME'];
$pass = $_ENV['DB_PASSWORD'];

if(!function_exists('fetch_products')) {

    function fetch_products($dotenv, $category = null, $limit = 4) {
        if ($category){
            $get = $dotenv->prepare("SELECT * FROM `products` WHERE `product_category`=? AND `featured`=1 LIMIT ? ");
            $get->bind_param("i", $limit);
        }else {
            $get = $dotenv->prepare("SELECT * FROM `products` AND `featured`=1 LIMIT ?");
            $get->bind_param("i", $limit);
        }

        $get->execute();
        return $get->get_result();
    }

}


$featured_product = fetch_products($dotenv);
$mouse = fetch_products($dotenv, 'Mouse');
$keyboard = fetch_products($dotenv, 'Keyboard');
$headphone = fetch_products($dotenv, 'Headphone');
$graphic_card = fetch_products($dotenv, 'Graphic Card');
$ssd = fetch_products($dotenv, 'SSD');
$mother_board = fetch_products($dotenv, 'Mother Board');

?>
