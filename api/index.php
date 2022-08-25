<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include 'DbConnect.php';
$objDb = new DbConnect();
$conn = $objDb->connect();

$method = $_SERVER['REQUEST_METHOD'];
switch($method) {
    case 'GET':
        $sql = "SELECT * FROM products";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($products);
        break;

    case "POST":
     $user = json_decode(file_get_contents('php://product') );
     $sql = "INSERT INTO products (sku, name, price, productType, attributes) VALUES (:sku, :name, :price, $:productType, :attributes)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':sku', $product->sku);
    $stmt->bindParam(':name', $product->name);
    $stmt->bindParam(':price', $product->price);
    $stmt->bindParam(':productType', $product->productType);
    $stmt->bindParam(':attributes', $product->attributes);
    if($stmt->execute()){
        $response = [
            'status' => 1,
            'message' => 'Product created successfully'
        ];
    } else {
        $response = [
            'status' => 0,
            'message' => 'Product creation failed'];

    };
    echo json_encode($response);
break;

case "DELETE":
    $sql = "DELETE FROM products WHERE sku = :sku";
    $path = explode("/productlist", $_SERVER["REQUEST_URI"]);
    
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":sku", $path[3]);
    }
     if($stmt->execute()){
        $response = [
            'status' => 1,
            'message' => 'Product deleted successfully'
        ];
    } else {
        $response = [
            'status' => 0,
            'message' => 'Product failed delete '];

    };
    echo json_encode($response);


