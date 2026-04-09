@echo off
echo Iniciando ngrok...
start "" C:\xampp\htdocs\caddo\ngrok.exe http 80

echo Esperando a que ngrok arranque...
timeout /t 5 > nul

echo Configurando webhook...
C:\xampp\php\php.exe C:\xampp\htdocs\caddo\configurar_webhook.php

echo Todo listo 🚀
pause