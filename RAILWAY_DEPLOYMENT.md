# Railway Deployment Guide for Daak Khana

## Prerequisites
1. Railway account (free at https://railway.app)
2. GitHub account
3. Your Laravel application code

## Step-by-Step Deployment

### 1. Prepare Your Repository
Make sure your code is pushed to GitHub:
```bash
git add .
git commit -m "Prepare for Railway deployment"
git push origin main
```

### 2. Deploy to Railway

#### Option A: Deploy via Railway Dashboard
1. **Go to**: https://railway.app
2. **Sign up/Login** with your GitHub account
3. **Click "New Project"**
4. **Select "Deploy from GitHub repo"**
5. **Choose your repository**: `Ahmadjamil888/Daak-Khana`
6. **Railway will automatically detect** it's a PHP/Laravel app

#### Option B: Deploy via Railway CLI
```bash
# Install Railway CLI
npm install -g @railway/cli

# Login to Railway
railway login

# Initialize Railway project
railway init

# Deploy
railway up
```

### 3. Configure Environment Variables

In Railway Dashboard, go to your project → Variables tab and add:

#### Basic Laravel Configuration
```
APP_NAME=Daak Khana
APP_ENV=production
APP_DEBUG=false
APP_KEY=(will be auto-generated)
LOG_CHANNEL=errorlog
```

#### Database Configuration (MySQL)
```
DB_CONNECTION=mysql
DB_HOST=(from Railway MySQL addon)
DB_PORT=3306
DB_DATABASE=(from Railway MySQL addon)
DB_USERNAME=(from Railway MySQL addon)
DB_PASSWORD=(from Railway MySQL addon)
```

#### External Services
```
STRIPE_PUBLISHABLE_KEY=your_stripe_publishable_key
STRIPE_SECRET_KEY=your_stripe_secret_key
STRIPE_RESTRICTED_KEY=your_stripe_restricted_key
GEMINI_API_KEY=your_gemini_api_key
GEMINI_API_URL=https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent
```

### 4. Add MySQL Database

1. **In Railway Dashboard**, go to your project
2. **Click "New"** → **"Database"** → **"MySQL"**
3. **Railway will automatically** set the database environment variables
4. **Copy the database credentials** to your environment variables

### 5. Deploy and Run Migrations

1. **Railway will automatically deploy** when you push to GitHub
2. **Or manually deploy** from Railway Dashboard
3. **Run migrations** via Railway Dashboard → Deployments → View Logs → Terminal:
   ```bash
   php artisan migrate --force
   php artisan db:seed --class=CourierCompanySeeder --force
   ```

### 6. Set Custom Domain (Optional)

1. **In Railway Dashboard**, go to your project
2. **Click "Settings"** → **"Domains"**
3. **Add your custom domain**

## Troubleshooting

### If deployment fails:
1. **Check Railway logs** in the Dashboard
2. **Verify environment variables** are set correctly
3. **Ensure database is connected** and accessible
4. **Check if all required PHP extensions** are available

### If database connection fails:
1. **Verify database credentials** in environment variables
2. **Check if MySQL addon** is properly provisioned
3. **Test connection** via Railway terminal

### If assets don't load:
1. **Run build process**:
   ```bash
   npm install
   npm run build
   ```
2. **Check if public/build directory** exists

## Railway Advantages

✅ **No payment verification required**
✅ **Automatic HTTPS**
✅ **Global CDN**
✅ **Easy environment variable management**
✅ **Built-in database support**
✅ **GitHub integration**
✅ **Automatic deployments**

## Post-Deployment Checklist

- [ ] App loads successfully
- [ ] Database migrations completed
- [ ] Sample companies seeded
- [ ] Stripe payments working
- [ ] AI features functional
- [ ] Email notifications working
- [ ] Real-time features active

## Support

- **Railway Documentation**: https://docs.railway.app
- **Laravel on Railway**: https://docs.railway.app/deploy/deployments/laravel
