@echo off
git fetch --prune origin 
git reset --hard origin/main 
git clean -f -d
