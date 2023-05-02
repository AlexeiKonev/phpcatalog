<?php

// получаем ID редактируемого товара
$id = isset($_GET["id"]) ? $_GET["id"] : die("ERROR: отсутствует ID.");

// подключаем файлы для работы с базой данных и файлы с объектами
include_once "config/database.php";
include_once "objects/product.php";
include_once "objects/category.php";

// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// подготавливаем объекты
$product = new Product($db);
$category = new Category($db);

// устанавливаем свойство ID товара для редактирования
$product->id = $id;

// получаем информацию о редактируемом товаре
$product->readOne();

// установка заголовка страницы
$page_title = "Обновление товара";

include_once "layout_header.php";
?>

    <div class="right-button-margin">
        <a href="index.php" class="btn btn-default pull-right">Просмотр всех товаров</a>
    </div>

    <!-- здесь будет контент -->

    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
        <table class="table table-hover table-responsive table-bordered">

            <tr>
                <td>Название</td>
                <td><input type="text" name="name" value="<?= $product->name; ?>" class="form-control" /></td>
            </tr>

            <tr>
                <td>Цена</td>
                <td><input type="text" name="price" value="<?= $product->price; ?>" class="form-control" /></td>
            </tr>

            <tr>
                <td>Описание</td>
                <td><textarea name="description" class="form-control"><?= $product->description; ?></textarea></td>
            </tr>

            <tr>
                <td>Категория</td>
                <td>
                    <!-- здесь будет раскрывающийся список для выбора категории -->
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary">Обновить</button>
                </td>
            </tr>

        </table>
    </form>

<?php // подвал
require_once "layout_footer.php";