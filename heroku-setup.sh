#!/bin/bash

echo "🔧 Setting up Heroku deployment for Courier Marketplace..."

# Install composer dependencies (production)
echo "📦 Installing production dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Generate optimized autoloader
echo "⚡ Optimizing autoloader..."
composer dump-autoload --optimize

# Clear all Laravel caches
echo "🧹 Clearing Laravel caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear

# Set proper permissions
echo "🔐 Setting permissions..."
chmod -R 755 storage bootstrap/cache

# Build frontend assets if needed
if [ -f "package.json" ]; then
    echo "🎨 Building frontend assets..."
    npm ci --production
    npm run build
fi

echo "✅ Heroku setup complete!"
echo "📋 Next steps:"
echo "1. Commit your changes: git add . && git commit -m 'Heroku deployment setup'"
echo "2. Push to Heroku: git push heroku main"
echo "3. The release process will automatically run migrations"