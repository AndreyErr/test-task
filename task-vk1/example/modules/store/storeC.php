<?php
use core\controller;

class storeC extends controller{

    // Выбираем действие исходя из запроса (путь запроса и действия/ограничения из запроса (например, ?action=delete&id=5))
    private function actionSelect(string $path, array $actions){
        // ...
    }

    // Выборка информации о разделах (id раздела и сколько выбирать)
    private function getUnitsData(int $count = 10){
        $this->model->selectUnits(10); // Пример использования
        // ...
        $this->sendData(/* data */); // Пример использования
    }

    // Выборка информации о категориях (id юнита и сколько выбирать)
    private function getСatalogData(int $id, int $count = 10){
        // ...
    }

    // Выборка информации о подкатегориях (id категории и сколько выбирать)
    private function getSubdirectoryData(int $id, int $count = 10){
        // ...
    }

    // Выборка информации о товаре
    private function getProductData(int $id){
        // ...
    }

    // Выборка информации о товаре
    private function searchProduct(string $searchText){
        // ...
    }

    // Выборка информации о товарах в корзине (ничего не передаём т.к. корзина создаётся по id пользователя, которое мы возьмём из куки)
    private function getCartData(){
        // ...
    }

    // Действие с продуктом (добавить в корзину/в избранное и т.п.) (удаление/изменение и т.п. производится через административный модуль)
    private function actionWithProduct(int $id, string $action): string{ // Возвращаем сообщение об успехе или ошибке с её описанием
        // ...
    }

    // Действие с заказом (оформить, отменить и т.п.) (данные из форм получаем POST запросом через суперглобальную переменную $_POST)
    private function actionWithOrder(int $id, string $action): string{
        // ...
    }

    // Действие с корзиной (отчистить, начать оформление и т.п.)
    private function actionWithCart(string $action): string{
        // ...
    }

}