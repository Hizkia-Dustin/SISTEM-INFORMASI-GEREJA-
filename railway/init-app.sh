#!/bin/bash
set -e

echo "==> Running migrations..."
php artisan migrate --force

echo "==> Seeding initial admin users..."
php artisan db:seed --class=UserSeeder --force

echo "==> Optimizing caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Ready!"
