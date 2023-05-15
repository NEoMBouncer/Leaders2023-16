## Локальное развертывание через Docker

1. В корне проекта создать файл .env и скопировать в него содержимое из файла .env.example
2. Запустить сборку проекта
```
docker-compose up --build
```
Дальнейшие действия производить в контейнере с проектом
```
docker exec -it <имя контейнера> bash
```
2. Установить зависимости
```
composer install --prefer-dist --ignore-platform-reqs -o
```
3. Все миграции выполняются из папки app/console
```
php yii migrate
php yii rbac-migrate
```
4. Создать 3 симлинка в папке app/frontend/web
```
ln -s /app/api/web/ api
ln -s /app/backend/web/ backend
ln -s /app/storage/web/ storage
```

## Настройка локальной базы данных
1. При необходимости развертывания дампа базы данных, необходимо положить сам дамп в папку storage/temp
   После этого распаковать дамп в контейнере с базой данных
```
docker exec -it <имя контейнера базы данных> bash
mysql -u "platform" -p "platform" <"temp/dump/dump.sql"
```
2. При возникновении ошибки развертывания поменяйте в дампе utf8mb4_0900_ai_ci на utf8mb4_general_ci
3. Если не работают отчеты в админке, то установите в контейнере с базой другой sql_mode под правами root
```
# Включаем синтаксис MYSQL под правами root
mysql -u "root" -p "platform"
# В консоли MYSQL вводим команду
SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));
```

