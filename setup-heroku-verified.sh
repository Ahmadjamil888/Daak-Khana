#!/bin/bash

echo "🚀 Setting up Heroku deployment after account verification..."

# Create a new Heroku app
echo "📦 Creating new Heroku app..."
heroku create daak-khana-$(date +%s)

# Set buildpacks
echo "🔧 Setting buildpacks..."
heroku buildpacks:clear
heroku buildpacks:add heroku/nodejs
heroku buildpacks:add heroku/php

# Set environment variables
echo "⚙️ Setting environment variables..."
heroku config:set APP_NAME="Daak Khana"
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false
heroku config:set APP_KEY=$(php artisan --no-ansi key:generate --show)
heroku config:set LOG_CHANNEL=errorlog

# Add JawsDB MySQL
echo "🗄️ Setting up database..."
heroku addons:create jawsdb:kitefin

# Wait for addon to be provisioned
sleep 10

# Get database URL and set individual variables
JAWSDB_URL=$(heroku config:get JAWSDB_URL)
echo "Database URL: $JAWSDB_URL"

# Extract database components
DB_HOST=$(echo $JAWSDB_URL | sed 's/.*@\([^:]*\).*/\1/')
DB_PORT=$(echo $JAWSDB_URL | sed 's/.*:\([0-9]*\)\/.*/\1/')
DB_DATABASE=$(echo $JAWSDB_URL | sed 's/.*\///')
DB_USERNAME=$(echo $JAWSDB_URL | sed 's/.*:\/\/\([^:]*\):.*/\1/')
DB_PASSWORD=$(echo $JAWSDB_URL | sed 's/.*:\/\/[^:]*:\([^@]*\)@.*/\1/')

# Set database variables
heroku config:set DB_CONNECTION=mysql
heroku config:set DB_HOST=$DB_HOST
heroku config:set DB_PORT=$DB_PORT
heroku config:set DB_DATABASE=$DB_DATABASE
heroku config:set DB_USERNAME=$DB_USERNAME
heroku config:set DB_PASSWORD=$DB_PASSWORD

# Deploy
echo "🚀 Deploying to Heroku..."
git push heroku main

# Run migrations
echo "🗄️ Running migrations..."
heroku run php artisan migrate --force

echo "✅ Deployment complete!"
echo "🌐 Your app URL: $(heroku info -s | grep web_url | cut -d= -f2)"
