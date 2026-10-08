# 💰 PayQRA — Ad-Based Earning & PTC Platform

A comprehensive, enterprise-grade **Paid-To-Click (PTC) and Ad-Based Revenue Platform** engineered with **Laravel 11, PHP 8.3, and MySQL**. PayQRA connects advertisers wanting targeted reach with users earning rewards by viewing advertisements, completing tasks, and participating in multi-tier affiliate referral programs.

---

## 🌟 Key Features

### 👥 Member / Earner Experience
- **🎯 Ad Viewing Engine:** Interactive countdown timers, anti-cheat captcha verification, and instant balance crediting.
- **📈 Tiered Membership Plans:** Multiple membership tiers with custom daily click limits, increased per-ad rewards, and faster payouts.
- **🤝 Multi-Level Referral System:** Generative commission tree rewarding users for direct and downstream signups, ad views, and plan upgrades.
- **💳 Multi-Gateway Deposits & Withdrawals:** Automated deposit & instant withdrawal processing supporting global fiat and crypto providers.
- **📊 Real-Time Analytics:** Account activity logs, click history, referral metrics, and earning breakdown.

### 📢 Advertiser Hub
- **Create & Manage Campaigns:** Launch PTC advertisements, banner ads, and impression campaigns with real-time budget tracking.
- **Audience Targeting:** Configure duration, total views, and target parameters for maximum campaign ROI.

### 🛡️ Administrative Command Center
- **Executive Dashboard:** Live metrics on deposit volume, withdrawal liabilities, platform revenue, and active PTC sessions.
- **Ad & Campaign Moderation:** Approve, pause, or reject advertiser campaigns and manage platform-wide rewards.
- **Gateway Manager:** 20+ automated payment gateways pre-integrated (Stripe, BTCPay, CoinGate, Razorpay, Mollie, Authorize.Net, etc.) plus custom manual banking channels.
- **Support Ticket System:** Integrated bidirectional customer support ticket management.
- **Security & KYC Verification:** Identity verification, two-factor authentication (2FA), and anti-fraud fraud protection.

---

## 🛠️ Tech Stack

- **Backend:** Laravel 11.x, PHP 8.3
- **Database:** MySQL 8.0+ / MariaDB 10.4+
- **Payment Integrations:** Stripe, BTCPayServer, CoinGate, Razorpay, Mollie, Authorize.Net, Twilio, SendGrid
- **Security:** CSRF protection, rate limiting, anti-bot timing checks, XSS filtering (HTMLPurifier)

---

## 📦 Setup & Deployment

### 1. Requirements
- PHP 8.2 or 8.3 with extensions: `pdo_mysql`, `curl`, `fileinfo`, `gd`, `openssl`, `mbstring`
- Composer 2.x
- MySQL / MariaDB

### 2. Installation
```bash
git clone https://github.com/ranaumairnawaz/PayQRAAdBasedEarningPlatform.git
cd PayQRAAdBasedEarningPlatform

cd core
composer install
cp .env.example .env
php artisan key:generate
```

### 3. Database Configuration
Edit `core/.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=payqra_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Run Migrations & Seeders
```bash
php artisan migrate --seed
```

---

## 👨‍💻 Author
**Rana Umair Nawaz**  
- Founder, [ZedX Solutions](https://github.com/ranaumairnawaz)  
- [LinkedIn Profile](https://linkedin.com/in/ranaumairnawaz)  
- [Personal Portfolio](https://umair.zedx-solutions.com)
