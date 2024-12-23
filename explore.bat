@echo off 

echo Current Directory
cd

echo Directory Contents:
dir

set /p dir="Enter directory to nevigate to:"
cd%dir%

echo New Directory:
cd

