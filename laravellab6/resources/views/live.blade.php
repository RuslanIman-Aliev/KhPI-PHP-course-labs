<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow+ Live Reverb</title>
    <!-- Підключення Vite для компіляції JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: sans-serif; padding: 20px; background: #f0f2f5; }
        #log {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            min-height: 200px;
            max-width: 600px;
            margin-top: 20px;
        }
        .msg { padding: 5px 0; border-bottom: 1px solid #eee; }
        .btn { padding: 10px 20px; background: #3490dc; color: white; border: none; cursor: pointer; border-radius: 4px; text-decoration: none; display: inline-block; margin-right: 10px;}
        .btn:hover { background: #2779bd; }
    </style>
</head>
<body>
    <h2>🔴 TaskFlow+ Live Monitor</h2>
    <p>Ви увійшли як: <strong>{{ Auth::check() ? Auth::user()->name : 'Неавторизований (Помилка: потрібен логін)' }}</strong></p>

    <div style="margin-bottom: 20px;">
        <a href="/test-event-task" class="btn" target="_blank">1. Тест: Змінити статус задачі</a>
        <a href="/test-event-comment" class="btn" target="_blank">2. Тест: Створити коментар</a>
    </div>

    <h3>Лог подій (Real-time):</h3>
    <div id="log">Очікування подій...</div>

    <script type="module">
        const projectId = 1; // Тестовий ID проєкту

        const logDiv = document.getElementById('log');
        const log = (msg) => {
            if (logDiv.innerHTML === 'Очікування подій...') logDiv.innerHTML = '';
            const time = new Date().toLocaleTimeString();
            logDiv.innerHTML = `<div class="msg"><small>[${time}]</small> ${msg}</div>` + logDiv.innerHTML;
        };

        // Слухаємо приватний канал
        window.Echo.private(`project.${projectId}`)
            .listen('.task.updated', (e) => {
                console.log('Task Event:', e);
                log(`🟡 Задача "<strong>${e.title}</strong>" змінена: <span style="color:blue">${e.status}</span>`);
            })
            .listen('.comment.created', (e) => {
                console.log('Comment Event:', e);
                log(`💬 Новий коментар до задачі #${e.taskId}: "<em>${e.body}</em>" (від ${e.author})`);
            })
            .error((error) => {
                console.error('Echo Error:', error);
                log(`❌ Помилка підключення (перевірте консоль). Ви залогінені?`);
            });
    </script>
</body>
</html>