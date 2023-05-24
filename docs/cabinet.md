Все запросы требуют токен авторизации в Headers

## Кабинет
Адрес **v1/cabinet/get-info**

GET запрос

Ответ:
```
{
  "success": true,
  "data": {
    "email": "xjyx20210@mail.ru",
    "role": 0,
    "scores": 0
  }
}
```
## Профиль
Адрес **/v1/cabinet/profile**

GET запрос

Ответ:
```
{
  "success": true,
  "data": {
    "firstname": "Никита",
    "middlename": null,
    "lastname": "Ярков",
    "gender": null,
    "phone": null,
    "age": null,
    "city": null,
    "is_russian_citizenship": 0,
    "scores": 0
  }
}
```
## Редактирование профиля
Адрес **v1/cabinet/update-profile**

POST запрос

Пример json запрос:
```
{
  "phone": "+7999999999"
}
```
В теле запроса можно посылать любое количество полей, но только из того списка, который можно получить из get запроса **/api/cabinet/profile**:

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
  "error": "Error message"
}
```
## Обновление пароля
Адрес **v1/cabinet/change-password**

POST запрос

Пример json запроса:
```
{
  "password": 123456,
  "password_confirm": 123456
}
```

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
  "error": "Undefined index: password"
}
```