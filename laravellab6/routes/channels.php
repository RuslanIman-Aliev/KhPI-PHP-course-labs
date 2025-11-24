<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Налаштування доступу до приватного каналу проєкту
Broadcast::channel('project.{id}', function ($user, $id) {
    // У реальному додатку тут перевірка: чи має юзер доступ до проєкту $id
    // Для лабораторної повертаємо true (але юзер має бути залогінений)
    return true;
});