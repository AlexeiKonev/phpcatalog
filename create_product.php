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

    <!-- Здесь будет PHP код -->

    <!-- HTML-формы для создания товара -->
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">

        <table class="table table-hover table-responsive table-bordered">

            <tr>
                <td>Название</td>
                <td><input type="text" name="name" class="form-control" /></td>
            </tr>

            <tr>
                <td>Цена</td>
                <td><input type="text" name="price" class="form-control" /></td>
            </tr>

            <tr>
                <td>Описание</td>
                <td><textarea name="description" class="form-control"></textarea></td>
            </tr>

            <tr>
                <td>Категория</td>
                <td>
                    <!-- здесь будут категории из базы данных -->
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </td>
            </tr>

        </table>
    </form>

<?php // подвал
require_once "layout_footer.php";
?>