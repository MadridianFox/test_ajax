<?php
$users = [
    ["email" => "madridianfox@yandex.ru"],
    ["email" => "dimka@yandex.ru"],
    ["email" => "ej-pan@yandex.ru"],
    ["email" => "nikola@yandex.ru"],
    ["email" => "slavaslava@yandex.ru"],
    ["email" => "satana@yandex.ru"]
];

function valueOrDie($arr, $name, $message)
{
    if (isset($arr[$name])) {
        return $arr[$name];
    }
    throw new \Exception($message);
}

function isUserInList($users, $email)
{
    foreach ($users as $user) {
        if ($user["email"] == $email) {
            return true;
        }
    }

    return false;
}

$result = [
    "error" => false
];

try {
    $only_check = isset($_GET["only_check"]);
    $email = valueOrDie($_POST, "email", "Необходимо заполнить email");
    if (isUserInList($users, $email)) {
        throw new \Exception("Пользователь с такой почтой уже зарегистрирован");
    }

    if (!$only_check) {
        $first_name = valueOrDie($_POST, "first_name", "Необходимо заполнить имя");
        $last_name = valueOrDie($_POST, "last_name", "Необходимо заполнить фамилию");
        $pass_1 = valueOrDie($_POST, "pass_1", "Необходимо заполнить пароль");
        $pass_2 = valueOrDie($_POST, "pass_2", "Необходимо заполнить повтор пароля");



        if ($pass_1 != $pass_2) {
            throw new \Exception("Введённые пароли не совпадают");
        }

        $result["message"] = "Вы успешно зарегистрировались";
    }
} catch (\Exception $e) {
    $result["error"] = $e->getMessage();
}

echo json_encode($result);
