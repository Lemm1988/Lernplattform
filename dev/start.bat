@echo off
rem Doppelklick-Start der Lernplattform (gleiche Funktion wie dev\start.ps1)
powershell -NoProfile -ExecutionPolicy Bypass -File "%~dp0start.ps1" %*
pause
