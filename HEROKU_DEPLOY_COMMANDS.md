# 🚀 Heroku Deployment Commands for Daak Khana

## Step 1: Create Heroku App (if not done)
```bash
heroku create your-app-name
# or
heroku create daak-khana-marketplace
```

## Step 2: Set Buildpacks
```bash
heroku buildpacks:clear
heroku buildpacks:add heroku/nodejs
heroku buildpacks:add heroku/php
```

## Step 3: Add Database
```bash
heroku addons:create jawsdb:kitefin
```

## Step 4: Set Environment Variables
```bash
# App Configuration
heroku config:set APP_NAME="Daak Khana"
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false
heroku config:set LOG_CHANNEL=errorlog

# Generate and set app key
heroku config:set APP_KEY=$(php artisan --no-ansi key:generate --show)

# Get database URL and extract components
heroku config:get JAWSDB_URL
# Format: mysql://username:password@hostname:port/database_name

# Set database variables (replace with your actual values)
heroku config:set DB_CONNECTION=mysql
heroku config:set DB_HOST=your_db_host
heroku config:set DB_PORT=3306
heroku config:set DB_DATABASE=your_db_name
heroku config:set DB_USERNAME=your_db_username
heroku config:set DB_PASSWORD=your_db_password

# Set your API keys (replace with actual values)
heroku config:set STRIPE_PUBLISHABLE_KEY=pk_test_your_publishable_key_here
heroku config:set STRIPE_SECRET_KEY=sk_test_your_secret_key_here
heroku config:set STRIPE_RESTRICTED_KEY=rk_test_your_restricted_key_here
heroku config:set GEMINI_API_KEY=your_gemini_api_key_here
heroku config:set GEMINI_API_URL=https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent
```

## Step 5: Deploy
```bash
git push heroku main
```

## Step 6: Run Migrations
```bash
heroku run php artisan migrate --force
heroku run php artisan db:seed --class=CourierCompanySeeder --force
```

## Step 7: Open Your App
```bash
heroku open
```

## Troubleshooting Commands
```bash
# View logs
heroku logs --tail

# Clear cache if needed
heroku repo:purge_cache

# Restart app
heroku restart

# Check config
heroku config
```

## 🎯 Your App Features:
✅ Pro Users (PKR 200/month): Real-time tracking, email alerts, messaging
✅ Pro Couriers (PKR 80/order): AI tools, advanced dashboard  
✅ Free Features: Basic tracking, messaging, AI chat
✅ Real-time GPS location sharing
✅ AI-powered profile generation and search
✅ Stripe payment integration
✅ Email notification system
✅ Mobile-responsive design with custom logo

## 📱 Test Your Deployment:
1. Visit your Heroku app URL
2. Register as a customer or courier
3. Test booking creation
4. Try the AI chat feature
5. Test pro subscription upgrade
6. Verify real-time messaging works

Your Daak Khana courier marketplace is now ready for production! 🚀