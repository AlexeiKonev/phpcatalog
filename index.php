<?php
// страница, указанная в параметре URL, страница по умолчанию - 1
$page = isset($_GET["page"]) ? $_GET["page"] : 1;

// устанавливаем ограничение количества записей на странице
$records_per_page = 5;

// подсчитываем лимит запроса
$from_record_num = ($records_per_page * $page) - $records_per_page;

// здесь будет получение товаров из БД

// включаем соединение с БД и файлы с объектами
include_once "config/database.php";
include_once "objects/product.php";
include_once "objects/category.php";

// создаём экземпляры классов БД и объектов
$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$category = new Category($db);

// запрос товаров
$stmt = $product->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();
// установка заголовка страницы
$page_title = "Вывод товаров";

require_once "layout_header.php";
?>

    <div class="right-button-margin">
        <a href="create_product.php" class="btn btn-default pull-right">Добавить товар</a>
    </div>
<?php
// отображаем товары, если они есть
if ($num > 0) {

    echo "<table class='table table-hover table-responsive table-bordered'>";
    echo "<tr>";
    echo "<th>Товар</th>";
    echo "<th>Цена</th>";
    echo "<th>Описание</th>";
    echo "<th>Категория</th>";
    echo "<th>Действия</th>";
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        echo "<tr>";
        echo "<td>{$name}</td>";
        echo "<td>{$price}</td>";
        echo "<td>{$description}</td>";
        echo "<td>";
        $category->id = $category_id;
        $category->readName();
        echo $category->name;
        echo "</td>";

        echo "<td>";
        // ссылки/кнопки для просмотра, редактирования и удаления товара
        echo "<a href='read_product.php?id={$id}' class='btn btn-primary left-margin'>
    <span class='glyphicon glyphicon-list'></span> Просмотр
</a>

<a href='update_product.php?id={$id}' class='btn btn-info left-margin'>
    <span class='glyphicon glyphicon-edit'></span> Редактировать
</a>

<a delete-id='{$id}' class='btn btn-danger delete-object'>
    <span class='glyphicon glyphicon-remove'></span> Удалить
</a>";
        echo "</td>";

        echo "</tr>";

    }

    echo "</table>";

    // страница, на которой используется пагинация
    $page_url = "index.php?";

// подсчёт всех товаров в базе данных, чтобы подсчитать общее количество страниц
    $total_rows = $product->countAll();

// пагинация
    include_once "paging.php";
} // сообщим пользователю, что товаров нет
else {
    echo "<div class='alert alert-info'>Товары не найдены.</div>";
}
?>
<?php // подвал
require_once "layout_footer.php";