<?php
// подключим файлы, необходимые для подключения к базе данных и файлы с объектами
include_once "config/database.php";
include_once "objects/product.php";
include_once "objects/category.php";

// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// создадим экземпляры классов Product и Category
$product = new Product($db);
$category = new Category($db);
// установка заголовка страницы
$page_title = "Создание товара";

require_once "layout_header.php";
?>

    <div class="right-button-margin">
        <a href="index.php" class="btn btn-default pull-right">Просмотр всех товаров</a>
    </div>

    <!-- здесь будет html-форма "create product" -->

<?php // подвал
require_once "layout_footer.php";
?>