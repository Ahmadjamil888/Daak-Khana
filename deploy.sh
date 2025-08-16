#!/bin/bash

echo "🚀 Starting Heroku deployment..."

# Ensure we're in the right directory
cd "$(dirname "$0")"

# Clear any existing buildpack cache
echo "🧹 Clearing buildpack cache..."
heroku plugins:install heroku-repo
heroku repo:purge_cache

# Set buildpacks correctly
echo "🔧 Setting buildpacks..."
heroku buildpacks:clear
heroku buildpacks:add heroku/nodejs
heroku buildpacks:add heroku/php

# Install/update composer dependencies
echo "📦 Installing composer dependencies..."
composer install --no-dev --optimize-autoloader

# Clear Laravel caches
echo "🧹 Clearing Laravel caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Add and commit changes
echo "📝 Committing changes..."
git add .
git commit -m "Deploy: Fix Heroku PHP buildpack configuration"

# Push to Heroku
echo "🔄 Pushing to Heroku..."
git push heroku main

# Run database migrations on Heroku
echo "🗄️ Running database migrations..."
heroku run php artisan migrate --force

echo "✅ Deployment complete!"
echo "🌐 Your app should be available at your Heroku URL"