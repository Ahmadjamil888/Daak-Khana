#!/bin/bash

echo "🔧 Setting up Heroku environment variables..."

# Basic Laravel configuration
heroku config:set APP_NAME="Daak Khana"
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false
heroku config:set APP_KEY=$(php artisan --no-ansi key:generate --show)
heroku config:set LOG_CHANNEL=errorlog

# Database configuration (will be set by JawsDB addon)
echo "🗄️ Setting up JawsDB MySQL addon..."
heroku addons:create jawsdb:kitefin

# Wait a moment for the addon to be provisioned
sleep 5

# Get the database URL and extract components
JAWSDB_URL=$(heroku config:get JAWSDB_URL)
echo "Database URL: $JAWSDB_URL"

# Extract database components from URL
# Format: mysql://username:password@hostname:port/database_name
DB_HOST=$(echo $JAWSDB_URL | sed 's/.*@\([^:]*\).*/\1/')
DB_PORT=$(echo $JAWSDB_URL | sed 's/.*:\([0-9]*\)\/.*/\1/')
DB_DATABASE=$(echo $JAWSDB_URL | sed 's/.*\///')
DB_USERNAME=$(echo $JAWSDB_URL | sed 's/.*:\/\/\([^:]*\):.*/\1/')
DB_PASSWORD=$(echo $JAWSDB_URL | sed 's/.*:\/\/[^:]*:\([^@]*\)@.*/\1/')

# Set individual database variables
heroku config:set DB_CONNECTION=mysql
heroku config:set DB_HOST=$DB_HOST
heroku config:set DB_PORT=$DB_PORT
heroku config:set DB_DATABASE=$DB_DATABASE
heroku config:set DB_USERNAME=$DB_USERNAME
heroku config:set DB_PASSWORD=$DB_PASSWORD

echo "✅ Environment variables set successfully!"
echo ""
echo "📋 Next steps:"
echo "1. Set your Stripe keys:"
echo "   heroku config:set STRIPE_PUBLISHABLE_KEY=your_key"
echo "   heroku config:set STRIPE_SECRET_KEY=your_key"
echo "   heroku config:set STRIPE_RESTRICTED_KEY=your_key"
echo ""
echo "2. Set your Gemini AI key:"
echo "   heroku config:set GEMINI_API_KEY=your_key"
echo ""
echo "3. Deploy your application:"
echo "   ./deploy.sh"
