<?php
class Product {
    public $name;
    protected $price;
    public $description;

    public function __construct($name, $price, $description) {
        if ($price < 0) $price = 0;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
    }

    public function getInfo() {
        echo "Назва: {$this->name}<br>";
        echo "Ціна: {$this->price}<br>";
        echo "Опис: {$this->description}<br><br>";
    }
}

class DiscountedProduct extends Product {
    public $discount;

    public function __construct($name, $price, $description, $discount) {
        parent::__construct($name, $price, $description);
        $this->discount = $discount;
    }

    public function getDiscountedPrice() {
        return $this->price - ($this->price * $this->discount / 100);
    }

    public function getInfo() {
        $newPrice = $this->getDiscountedPrice();
        echo "Назва: {$this->name}<br>";
        echo "Ціна без знижки: {$this->price}<br>";
        echo "Знижка: {$this->discount}%<br>";
        echo "Ціна зі знижкою: {$newPrice}<br>";
        echo "Опис: {$this->description}<br><br>";
    }
}

class Category {
    public $name;
    public $products = [];

    public function __construct($name) {
        $this->name = $name;
    }

    public function addProduct($product) {
        $this->products[] = $product;
    }

    public function showProducts() {
        echo "<h3>Категорія: {$this->name}</h3>";
        foreach ($this->products as $p) {
            $p->getInfo();
        }
    }
}

$product1 = new Product("Ноутбук", 20000, "Потужний ноутбук для роботи");
$product2 = new Product("Мишка", 500, "Бездротова мишка");
$product3 = new DiscountedProduct("Смартфон", 15000, "Сучасний телефон", 10);
$product4 = new DiscountedProduct("Навушники", 2000, "Bluetooth навушники", 20);

$category1 = new Category("Електроніка");
$category1->addProduct($product1);
$category1->addProduct($product2);
$category1->addProduct($product3);
$category1->addProduct($product4);

$category1->showProducts();
?>