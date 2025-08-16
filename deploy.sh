#!/bin/bash

echo "🚀 Starting Heroku deployment..."

# Ensure we're in the right directory
cd "$(dirname "$0")"

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
git commit -m "Deploy: Fix Heroku PHP buildpack and database configuration"

# Push to Heroku
echo "🔄 Pushing to Heroku..."
git push heroku main

# Run database migrations on Heroku
echo "🗄️ Running database migrations..."
heroku run php artisan migrate --force --app your-app-name

echo "✅ Deployment complete!"
echo "🌐 Your app should be available at your Heroku URL"