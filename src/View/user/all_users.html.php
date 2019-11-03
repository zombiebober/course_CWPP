<?php

/** @var \Model\Entity\User[] $userList */
$body = function () use ($userList, $path) {
    foreach ($userList as $key => $user) {
        ?>
                <ol>
                    <li>Login: <?= $user->getLogin()?></li>
                    <li>Name: <?= $user->getName()?></li>
                    <li>Title role: <?= $user->getRole()->getTitle()?></li>
                    <li>Type role: <?= $user->getRole()->getType()?></li>
                </ol>
                <?php
    }
};








$renderLayout(
    'main_template.html.php',
    [
        'title' => 'Все пользователи',
        'body' => $body,
    ]
);
