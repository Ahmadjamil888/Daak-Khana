# Heroku Deployment Guide for Daak Khana

## Prerequisites
1. Heroku CLI installed
2. Git repository initialized
3. Heroku app created

## Deployment Steps

### 1. Set Buildpacks
```bash
heroku buildpacks:clear
heroku buildpacks:add heroku/nodejs
heroku buildpacks:add heroku/php
```

### 2. Set Environment Variables
```bash
heroku config:set APP_NAME="Daak Khana"
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false
heroku config:set APP_KEY=$(php artisan --no-ansi key:generate --show)
heroku config:set LOG_CHANNEL=errorlog

# Database (JawsDB MySQL)
heroku addons:create jawsdb:kitefin
# This will automatically set JAWSDB_URL

# Stripe Configuration
heroku config:set STRIPE_PUBLISHABLE_KEY=your_stripe_publishable_key
heroku config:set STRIPE_SECRET_KEY=your_stripe_secret_key
heroku config:set STRIPE_RESTRICTED_KEY=your_stripe_restricted_key

# Gemini AI Configuration
heroku config:set GEMINI_API_KEY=your_gemini_api_key
heroku config:set GEMINI_API_URL=https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent

# Mail Configuration (optional - use Heroku SendGrid addon)
heroku addons:create sendgrid:starter
```

### 3. Configure Database
After JawsDB is added, get the database URL:
```bash
heroku config:get JAWSDB_URL
```

Then set individual database variables:
```bash
# Extract from JAWSDB_URL: mysql://username:password@hostname:port/database_name
heroku config:set DB_CONNECTION=mysql
heroku config:set DB_HOST=your_host
heroku config:set DB_PORT=3306
heroku config:set DB_DATABASE=your_database
heroku config:set DB_USERNAME=your_username
heroku config:set DB_PASSWORD=your_password
```

### 4. Deploy
```bash
git add .
git commit -m "Deploy to Heroku with all pro features"
git push heroku main
```

### 5. Run Migrations and Seed
```bash
heroku run php artisan migrate --force
heroku run php artisan db:seed --class=CourierCompanySeeder --force
```

### 6. Set up Queue Worker (Optional)
```bash
heroku ps:scale worker=1
```

## Troubleshooting

### If vendor/bin/heroku-php-apache2 not found:
1. Clear buildpack cache:
```bash
heroku plugins:install heroku-repo
heroku repo:purge_cache -a your-app-name
```

2. Ensure composer.json is valid:
```bash
composer validate
```

3. Force rebuild:
```bash
git commit --allow-empty -m "Force rebuild"
git push heroku main
```

### If database connection fails:
1. Check JAWSDB_URL format
2. Ensure all DB_* variables are set correctly
3. Test connection locally with same credentials

### If assets not loading:
1. Run build process:
```bash
heroku run npm run build
```

2. Check if public/build directory exists after deployment

## Post-Deployment Checklist
- [ ] App loads successfully
- [ ] Database migrations completed
- [ ] Sample companies seeded
- [ ] Stripe payments working
- [ ] AI features functional
- [ ] Email notifications working
- [ ] Real-time features active

## Environment Variables Summary
```
APP_NAME=Daak Khana
APP_ENV=production
APP_DEBUG=false
APP_KEY=(generated)
LOG_CHANNEL=errorlog
DB_CONNECTION=mysql
DB_HOST=(from JAWSDB_URL)
DB_PORT=3306
DB_DATABASE=(from JAWSDB_URL)
DB_USERNAME=(from JAWSDB_URL)
DB_PASSWORD=(from JAWSDB_URL)
STRIPE_PUBLISHABLE_KEY=your_stripe_publishable_key
STRIPE_SECRET_KEY=your_stripe_secret_key
STRIPE_RESTRICTED_KEY=your_stripe_restricted_key
GEMINI_API_KEY=your_gemini_api_key
GEMINI_API_URL=https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent
```