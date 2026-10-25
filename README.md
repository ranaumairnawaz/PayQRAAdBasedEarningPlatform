# 💰 PayQRA — Ad-Based Earning & PTC Revenue Platform

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel 11">
  <img src="https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php" alt="PHP 8.3">
  <img src="https://img.shields.io/badge/Gateways-20%2B%20Integrated-success?style=for-the-badge" alt="Payment Gateways">
  <img src="https://img.shields.io/badge/Security-KYC%20%2B%202FA-blue?style=for-the-badge" alt="Security">
</p>

---

## 📖 What is PayQRA?

**PayQRA** is an enterprise-scale **Paid-To-Click (PTC) advertising and user reward monetization platform** engineered on **Laravel 11, PHP 8.3, and MySQL**. 

It provides a two-sided marketplace:
1. **Advertisers** gain high-intent, targeted web traffic, brand views, and campaign engagement.
2. **Users / Earners** earn digital currency rewards by watching advertisements, completing micro-tasks, and inviting downstream referrals.

---

## 🎯 Why PayQRA? Problem & Solution

| The Challenge | How PayQRA Solves It |
| :--- | :--- |
| **Ad Click Bot Fraud:** Advertisers often pay for fake bot clicks on traditional ad networks, resulting in zero real conversions. | Incorporates **Anti-Cheat Timing Engines & Captcha Verification**, ensuring ads are viewed for the complete required duration by real users before rewards unlock. |
| **Complex Global Payments:** Managing global member payouts and advertiser deposits across borders requires multiple payment processor contracts. | Pre-integrates **over 20 automated payment gateways** (Stripe, BTCPayServer, CoinGate, Razorpay, Mollie, Authorize.Net, Flutterwave, Paystack) alongside custom manual bank transfer verification. |
| **Low User Retention in Earning Sites:** Users drop off without incentives to return daily. | Features **Tiered Membership Plans & Multi-Level Referral Trees**, unlocking higher daily click limits, higher per-ad rewards, and recurring affiliate commissions. |

---

## 🌟 Key Features

### 👥 Member / Earner Experience
- **Interactive Ad Viewing Engine:** Responsive viewing player with animated countdown timers, focus-loss detection, and mathematical captcha verification.
- **Tiered Membership Subscriptions:** Flexible plans with daily click quotas, bonus reward multipliers, and priority withdrawal processing.
- **Multi-Level Affiliate Matrix:** Generative multi-tier referral commissions earned on friend registrations, daily ad views, and membership upgrades.
- **Deposit & Payout Portal:** Automated balance deposits and instant withdrawal requests with real-time status tracking.

### 📢 Advertiser Command Center
- **Campaign Creation & Budgeting:** Launch banner ads, text ads, and timed PTC visits with custom CPC (Cost-Per-Click) budgeting.
- **Geo & Demographic Targeting:** Configure total views, daily view caps, and click durations to maximize campaign ROI.

### 🛡️ Administrative Oversight Suite
- **Financial Analytics & Risk Management:** Monitor total deposits, pending withdrawals, active member balances, and platform profit margins.
- **Campaign & Ad Moderation:** Review and approve advertiser submissions with automated refunding if rejected.
- **KYC & Two-Factor Authentication:** Built-in customer identity verification (KYC form submission) and Google Authenticator 2FA.
- **Support Ticket Desk:** Built-in bi-directional customer support ticketing system with file attachments.

---

## 🛠️ Technical Stack

- **Backend:** Laravel 11.x, PHP 8.3
- **Database:** MySQL 8.0+ / MariaDB (High transactional integrity with double-entry accounting)
- **Payment Gateways:** Stripe, BTCPayServer, CoinGate, Mollie, Razorpay, Authorize.Net, Twilio, SendGrid
- **Security:** Anti-bot timing algorithms, CSRF validation, XSS filtering (HTMLPurifier), Rate limiting

---

## 📦 Local Installation & Setup

### 1. Requirements
- PHP 8.2 or 8.3 with `pdo_mysql`, `curl`, `fileinfo`, `gd`, `openssl`, `mbstring` extensions
- Composer 2.x
- MySQL 8.0+

### 2. Setup Application
```bash
git clone https://github.com/ranaumairnawaz/PayQRAAdBasedEarningPlatform.git
cd PayQRAAdBasedEarningPlatform

cd core
composer install
cp .env.example .env
php artisan key:generate
```

### 3. Database Migration & Launch
```bash
# In core/
php artisan migrate --seed
php artisan serve
```

---

## 👨‍💻 Author
**Rana Umair Nawaz**  
- [GitHub Profile](https://github.com/ranaumairnawaz)  
- [LinkedIn Profile](https://linkedin.com/in/ranaumairnawaz)
