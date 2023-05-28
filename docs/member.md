Все запросы требуют токен авторизации в Headers

## Получение вакансии
Адрес **v1/cabinet/get-vacancy/"id"**

GET запрос

Параметры:
- id - идентификатор вакансии организации

Ответ:
```
{
  "success": true,
  "data": {
    "id": 2,
    "direction": {
      "direction_id": null,
      "list": {
        "1": "IT-город",
        "2": "Медийный город",
        "3": "Социальный город",
        "4": "Комфортная городская среда",
        "5": "Правовое пространство",
        "6": "Городская экономика",
        "7": "HR-город"
      }
    },
    "intern_id": null,
    "mentor_id": 5,
    "organization": "Департамент тестов",
    "income": 150000,
    "title": "test",
    "address": "Kirov",
    "geo_lat": 42.468465646,
    "geo_lon": 42.468465646,
    "description": null,
    "schedule": null,
    "status": 0,
    "is_publish": 0
  }
}
```
## Создание вакансии
Адрес **v1/cabinet/create-vacancy**

POST запрос

Параметры:
- direction_id - id направления
- mentor_id - id наставника
- income - стоимость
- title - название
- geo_lat - координата lat
- geo_lon - координата lon
- description - описание
- schedule - график работы

Ответ:
```
{
  "success": true
}
```
Ответ с ошибкой:
```
{
  "success": false,
  "error": "Вам не разрешено выполнять данное действие"
}
```
## Редактирование вакансии
Адрес **/v1/cabinet/update-vacancy/"id"**

POST запрос

QUERY Параметры:
- id - id вакансии

POST Параметры:
- direction_id - id направления
- mentor_id - id наставника
- income - стоимость
- title - название
- geo_lat - координата lat
- geo_lon - координата lon
- description - описание
- schedule - график работы

Ответ:
```
{
  "success": true
}
```
Ответ с ошибкой:
```
{
  "success": false,
  "error": "Вам не разрешено выполнять данное действие"
}
```
## Список вакансий организации
Адрес **/v1/cabinet/organization/list-vacancy**

GET запрос

Ответ:
```
{
  "success": true,
  "data": [
    {
      "id": 2,
      "direction": {
        "direction_id": null,
        "list": {
          "1": "IT-город",
          "2": "Медийный город",
          "3": "Социальный город",
          "4": "Комфортная городская среда",
          "5": "Правовое пространство",
          "6": "Городская экономика",
          "7": "HR-город"
        }
      },
      "intern_id": null,
      "mentor_id": 5,
      "organization": "Департамент тестов",
      "income": 150000,
      "title": "test",
      "address": "Kirov",
      "geo_lat": 42.468465646,
      "geo_lon": 42.468465646,
      "description": null,
      "schedule": null,
      "status": 0,
      "is_publish": 0
    }
  ]
}
```