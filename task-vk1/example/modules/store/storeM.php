<?php
use core\model;

class storeM extends model{

    // Выборка информации о разделах
    public function selectUnits(int $count): array{
        // ...
    }

    // Выборка информации о категориях
    public function selectСatalogs(int $id, int $count): array{
        // ...
    }

    // Выборка информации о подкатегориях
    public function selectSubdirectorys(int $id, int $count): array{
        // ...
    }

    // Выборка информации о товарах по id подкатегории
    public function selectProductsFromSubdirectory(int $id): array{
        // ...
    }

    // Выборка информации о товаре по id
    public function searchProduct(string $searchText): array{
        // ...
    }

    // Выборка информации о товаре по id
    public function selectProductData(int $id): array{
        // ...
    }

    // Выборка информации из корзины по id из куки
    public function selectCartData(): array{
        // ...
    }

    // Добавление товара в корзину
    public function addProductToCart(int $id): string{
        // ...
    }

    // Удалене товара из корзины
    public function deleteProductFromCart(int $id): string{
        // ...
    }

    // Оформление из корзины
    public function decorationProductFromCart(int $id): string{
        // ...
    }

    // Проверка на наличие товара на складах города
    protected function chtckProductFromCartInCity(int $id): bool{
        // ...
    }

    // Проверка данных из формы заказа
    protected function chtckDataFromOrder(int $id, array $data): string{
        // ...
    }

    // Оплата заказа заказа
    protected function payForOrder(int $id, array $payData): bool{
        // ...
    }

    // Отправка данных логисту
    protected function sendToLogist(int $id): string{
        // ...
    }

    // Изменение статуса заказа
    protected function changeOrderStatus(int $id, int $newStatus): string{
        // ...
    }

}