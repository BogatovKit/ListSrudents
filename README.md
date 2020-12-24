# Задача про список студентов.

Нужно сделать сайт для регистрации абитуриентов. Он состоит из 2 страниц: список зарегистрированных абитуриентов и форма ввода/редактирования информации о себе. Любой абитуриент может зайти на сайт и добавить себя в список или отредактировать информацию о себе.

Форма содержит поля: имя, фамилия, дата рождения, пол, номер группы (от 2 до 5 цифр или букв), e-mail (должен быть уникален), суммарное число баллов на ЕГЭ (проверять на адекватность), город проживания. Данные надо сохранять в БД, все поля обязательны, все поля надо проверять (например нельзя ввести фамилию длиной 200 символов), при ошибке ввода отображать форму с сообщением об ошибке и выделенным красным цветом ошибочным полем, при успешном заполнении — вывести уведомление.

После регистрации сайт должен запомнить пользователя и вместо формы регистрации показывать форму редактирования своих данных. Запомнить пользователя можно с помощью кук, ставить на 10 лет. Надо использовать какой-то код, чтобы нельзя было отредактировать чужие данные.

Список студентов — выводит имя, фамилию, номер группы, дату рождения, число баллов. Выводятся по 25 человек на страницу, сортировка по любому полю делается кликом на заголовок колонки таблицы. Есть поле поиска, которое ищет сразу по всем строкам таблицы (на данный момент регистрозависимый поиск).

# Используемые технологии.

1. Для верстки используеся Twitter Bootstrap v.4
2. Язык программирования - PHP
3. Для базы данных используется Sqlite
4. Для запуска на локальной машине в начале использовался встроенный сервер PHP, после запускался на Apache 2.4

 
