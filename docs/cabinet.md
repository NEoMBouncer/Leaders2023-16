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
## Страны
Адрес **/v1/cabinet/countries**

GET запрос

Ответ:
```
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Андорра"
    },
    {
      "id": 2,
      "name": "Объединенные Арабские Эмираты"
    },
    {
      "id": 3,
      "name": "Афганистан"
    },
    ...
  ]
}
```
## Специализации
Адрес **/v1/cabinet/specializations**

GET запрос

Ответ:
```
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "HR, управление персоналом"
    },
    {
      "id": 2,
      "title": "PR, пресс-служба"
    },
    {
      "id": 3,
      "title": "Администрирование, координация деятельности"
    },
    ...
  ]
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
    "country_id": {
      "value": null,
      "list": [
        {
          "id": 1,
          "name": "Andorra"
        },
        {
          "id": 2,
          "name": "United Arab Emirates"
        },
        {
          "id": 3,
          "name": "Afghanistan"
        },
        ...
      ]
    },
    "education": [],
    "experience": [],
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
## Получить эссе
Адрес **/v1/cabinet/essay?id="id"**

GET запрос

Параметры:
- id - query параметр, передающийся в адресной строке. Пример **/v1/cabinet/essay?id=2**

Ответ:
```
{
  "success": true,
  "data": {
    "id": 2,
    "topic": "Test",
    "text": "test text"
  }
}
```
Ответ с ошибкой:
```
{
  "success": false,
  "error": "Нет эссе с таким идентификатором"
}
```
## Список эссе пользователя
Адрес **/v1/cabinet/essay**

GET запрос

Ответ:
```
{
  "success": true,
  "data": [
    {
      "id": 2,
      "topic": "Test",
      "text": "test text"
    },
    {
      "id": 3,
      "topic": "Test2",
      "text": "qwerty"
    }
  ]
}
```
## Создать эссе
Адрес **/v1/cabinet/essay**

POST запрос

Параметры:
- topic - тема эссе
- text - текст эссе

Пример запроса:
```
{
  "topic": "Test2",
  "text": "qwerty"
}
```

Ответ:
```
{
  "success": true
}
```
## Редактировать эссе
Адрес **/v1/cabinet/essay**

PUT запрос

Параметры:
- topic - тема эссе
- text - текст эссе

Пример запроса:
```
{
  "id": 2,
  "topic": "Test2",
  "text": "qwerty"
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
  "error": "Нет эссе с таким идентификатором"
}
```
## Удалить эссе
Адрес **/v1/cabinet/delete-essay/"id"**

DELETE запрос

Параметр "id" сообщает об id эссе

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
  "error": "Нет эссе с таким идентификатором"
}
```