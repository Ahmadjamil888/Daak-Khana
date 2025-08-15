# Daak Khana - Pakistan's First Professional Courier Service Platform

A comprehensive Laravel-based courier marketplace designed specifically for the Pakistani market, featuring dual authentication, professional design, and complete logistics solutions.

## 🇵🇰 About Daak Khana

**Daak Khana** (ڈاک خانہ) is Pakistan's premier courier service platform that connects customers with verified courier companies across the country. Built with Pakistani businesses and consumers in mind, offering services in both English and Urdu.

## 🚀 Key Features

### Core Platform Features
- **Dual Authentication System**: Separate portals for customers and courier companies
- **Pakistani Market Focus**: Designed for Pakistani cities, pricing in PKR, Urdu support
- **Professional Design**: Clean, formal light green and white theme
- **Multi-Service Support**: Same-day, express, standard, and international delivery
- **Real-time Tracking**: Live package tracking across Pakistan
- **Verified Companies**: Only authenticated courier companies
- **Mobile Responsive**: Works perfectly on all devices

### For Customers
- Browse verified courier companies
- Compare prices and services
- Book deliveries online
- Track packages in real-time
- Rate and review services
- Multiple payment options

### For Courier Companies
- Professional company profiles
- Service management dashboard
- Booking management system
- Performance analytics
- Customer communication tools
- Revenue tracking

## 🛠️ Technical Stack

- **Backend**: Laravel 11 with Breeze authentication
- **Frontend**: Blade templates with Tailwind CSS
- **Database**: MySQL
- **Styling**: Custom light green theme with professional design
- **Authentication**: Multi-guard system for dual user types
- **Deployment**: GitHub Actions, Heroku-ready

## 🎨 Design System

### Color Palette
- **Primary Green**: #22c55e (Pakistan-inspired green)
- **Light Green**: #f0fdf4 to #dcfce7
- **Neutrals**: Professional grays and whites
- **Accent**: Complementary colors for highlights

### Typography
- **Primary**: Inter font family
- **Headings**: Poppins for titles
- **Body**: Inter for readability

## 📁 Project Structure

```
daak-khana/
├── app/
│   ├── Http/Controllers/
│   │   ├── PageController.php (Static pages)
│   │   ├── Customer/DashboardController.php
│   │   ├── Courier/DashboardController.php
│   │   ├── CourierCompanyController.php
│   │   └── BookingController.php
│   └── Models/
│       ├── User.php (Multi-type users)
│       ├── CourierCompany.php
│       ├── CourierService.php
│       └── Booking.php
├── resources/views/
│   ├── welcome.blade.php (Landing page)
│   ├── pages/ (Static pages)
│   ├── customer/ (Customer dashboard)
│   └── courier/ (Courier dashboard)
├── .github/workflows/
│   └── deploy.yml (GitHub Actions)
├── public/
│   ├── favicon.ico
│   └── images/
└── database/migrations/
```

## 🚀 Installation & Setup

### Prerequisites
- PHP 8.2+
- Composer
- Node.js 18+
- MySQL 8.0+

### Local Development Setup

1. **Clone the repository**
```bash
git clone https://github.com/yourusername/daak-khana.git
cd daak-khana
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database setup**
```bash
# Create database 'daak_khana' in MySQL
php artisan migrate
php artisan db:seed --class=TestCompanySeeder
```

5. **Build assets**
```bash
npm run build
```

6. **Start development server**
```bash
php artisan serve
```

Visit `http://localhost:8000`

### Test Credentials
- **Customer**: `customer@example.com` / `password`
- **Courier**: `courier@example.com` / `password`

## 🌐 Deployment

### GitHub Deployment

1. **Push to GitHub**
```bash
git add .
git commit -m "Initial commit"
git branch -M main
git remote add origin https://github.com/yourusername/daak-khana.git
git push -u origin main
```

2. **Environment Variables**
Set these in your hosting platform:
```
APP_NAME="Daak Khana"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com
DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_DATABASE=your-db-name
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password
```

### Heroku Deployment

1. **Install Heroku CLI**
2. **Create Heroku app**
```bash
heroku create daak-khana
```

3. **Add MySQL addon**
```bash
heroku addons:create cleardb:ignite
```

4. **Deploy**
```bash
git push heroku main
heroku run php artisan migrate
heroku run php artisan db:seed --class=TestCompanySeeder
```

### VPS/Shared Hosting

1. Upload files to public_html
2. Point domain to `/public` folder
3. Set up database and update `.env`
4. Run migrations: `php artisan migrate`
5. Set permissions: `chmod -R 755 storage bootstrap/cache`

## 📱 Pages & Features

### Landing Page Sections
1. **Hero Section** - Main value proposition
2. **Services** - Available courier services
3. **How It Works** - Step-by-step process
4. **Features** - Platform capabilities
5. **Pricing** - Service pricing
6. **Companies** - Featured courier companies
7. **Testimonials** - Customer reviews
8. **Contact** - Contact information
9. **Footer** - Links and company info

### Static Pages
- `/services` - Detailed service information
- `/about` - About Daak Khana
- `/pricing` - Pricing plans
- `/contact` - Contact form
- `/how-it-works` - Process explanation
- `/features` - Feature details

## 🔐 Security Features

- CSRF protection on all forms
- SQL injection prevention
- XSS protection
- Secure password hashing
- Input validation and sanitization
- File upload security
- Rate limiting on API endpoints

## 📈 SEO Optimization

- Semantic HTML structure
- Meta tags for all pages
- Open Graph tags
- Twitter Card tags
- Structured data markup
- Sitemap generation
- Robot.txt optimization
- Fast loading times

## 🚀 Performance Features

- Optimized database queries
- Image optimization
- CSS/JS minification
- Caching strategies
- CDN ready
- Lazy loading
- Progressive Web App ready

## 🤝 Contributing

1. Fork the repository
2. Create feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Open Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📞 Support

For support, email support@daakkhana.com or join our Slack channel.

## 🙏 Acknowledgments

- Laravel community for the amazing framework
- Tailwind CSS for the utility-first CSS framework
- Pakistani courier companies for inspiration
- Open source community for various packages

---

**Made with ❤️ for Pakistan by Pakistani developers**

**ڈاک خانہ - پاکستان کا پہلا پروفیشنل کوریئر پلیٹ فارم**