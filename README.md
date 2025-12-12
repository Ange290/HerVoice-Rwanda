# HerVoice Rwanda - Anonymous Violence Reporting Platform

A secure, anonymous platform for women and girls in Rwanda to report cases of violence and harassment.

## 🌟 Features

- ✅ **Anonymous Reporting** - Submit reports without revealing identity
- ✅ **Organization Selection** - Choose from trusted NGOs and organizations
- ✅ **Evidence Upload** - Support for images, audio, video, and documents
- ✅ **Case Tracking** - Track case status using unique tracking ID
- ✅ **Admin Dashboard** - Manage and update case statuses
- ✅ **Secure & Private** - All data stored securely

## 📁 Project Structure

```
HerVoice/
├── index.php              # Home page
├── report.php             # Report submission form
├── submit_report.php      # Handles report submission
├── track.php              # Track case status
├── admin_login.php        # Admin authentication
├── admin_dashboard.php    # Admin panel to manage reports
├── db_connect.php         # Database connection
├── database.sql           # Database schema and sample data
├── .htaccess             # Apache configuration (for hosting)
├── uploads/              # Uploaded evidence files
├── HOSTING_GUIDE.md      # InfinityFree hosting instructions
└── README.md             # This file
```

## 🚀 Local Installation (XAMPP)

### Prerequisites

- XAMPP installed with PHP 7.4+ and MySQL

### Steps

1. **Place the HerVoice folder** in the `htdocs` directory

   ```
   C:\xampp\htdocs\HerVoice
   ```

2. **Create Database**

   - Open phpMyAdmin: `http://localhost/phpmyadmin`
   - Create database named `hervoice`
   - Click "Import" tab
   - Select and import `database.sql` file

3. **Configure Database Connection**

   - Open `db_connect.php`
   - Verify these settings (should work by default):
     ```php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "hervoice";
     ```

4. **Create Uploads Folder**

   - The `uploads/` folder should exist
   - If not, create it manually
   - Set permissions to 755 or 777

5. **Start XAMPP**

   - Start Apache
   - Start MySQL

6. **Access Application**
   - Open browser: `http://localhost/HerVoice/`

## 🌐 InfinityFree Hosting

See [HOSTING_GUIDE.md](HOSTING_GUIDE.md) for complete step-by-step instructions.

### Quick Steps:

1. Create InfinityFree account
2. Create MySQL database in cPanel
3. Update `db_connect.php` with your hosting database credentials:
   ```php
   $servername = "sql123.infinityfree.com";  // From cPanel
   $username = "epiz_12345678";              // Your DB username
   $password = "your_password";               // Your DB password
   $dbname = "epiz_12345678_hervoice";       // Your DB name
   ```
4. Upload ALL files to `htdocs` folder via FTP/File Manager
5. Import `database.sql` in phpMyAdmin
6. Visit your live website!

## 🔑 Admin Access

**Default Credentials:**

- Username: `admin`
- Password: `password123`

**⚠️ Important:** Change password after first login!

## 📊 Database Tables

### `organizations`

Stores NGO and organization information

- `id` - Primary key
- `name` - Organization name
- `contact_email` - Contact email

### `reports`

Stores victim reports

- `id` - Primary key
- `tracking_id` - Unique 8-character ID for tracking
- `organization_id` - Foreign key to organizations
- `description` - Incident description
- `evidence_path` - Path to uploaded file
- `status` - Pending/In Review/Resolved
- `created_at` - Timestamp

### `admins`

Stores admin credentials

- `id` - Primary key
- `username` - Admin username
- `password` - Hashed password

## 🛠️ Technology Stack

- **Backend:** Pure PHP (no frameworks, no Composer)
- **Database:** MySQL
- **Frontend:** HTML5, Tailwind CSS (via CDN)
- **Server:** Apache (XAMPP/InfinityFree)

## 🔒 Security Features

- SQL injection prevention using `mysqli_real_escape_string`
- XSS protection with `htmlspecialchars`
- File upload validation (type and size checks)
- Session-based admin authentication
- Secure file storage

## 📝 Usage

### For Victims:

1. Visit home page
2. Click "Submit a Report"
3. Select organization from dropdown
4. Describe the incident
5. Upload evidence (optional)
6. Submit and receive tracking ID
7. Save tracking ID to check status later

### For Admins:

1. Navigate to admin login page
2. Enter credentials (admin/password123)
3. View all reports in dashboard
4. Update case statuses
5. View uploaded evidence

## 🐛 Common Issues & Solutions

### "Connection failed" Error

- Check `db_connect.php` credentials
- Ensure MySQL is running
- Verify database exists

### Upload Errors

- Check `uploads/` folder exists
- Set folder permissions to 755 or 777
- Check PHP settings: `upload_max_filesize` and `post_max_size`

### "Only index.php shows" on InfinityFree

- Verify ALL .php files are uploaded
- Check `db_connect.php` has correct hosting credentials
- Ensure files are in `htdocs`, not subfolder
- Check `.htaccess` file is uploaded

### Session Errors

- Ensure `session_start()` is at top of PHP files
- Check server session configuration

## 📞 Included Organizations (Rwanda)

- Isange One Stop Center
- Rwanda Investigation Bureau (RIB)
- Haguruka
- Profemmes Twese Hamwe
- Rwanda National Police
- SEVOTA
- Imbuto Foundation
- Rwanda Women's Network
- AVEGA
- Gender Monitoring Office

## 📄 Files Explained

- **index.php** - Landing page with features and navigation
- **report.php** - Form to submit new report
- **submit_report.php** - Processes form submission, handles file upload
- **track.php** - Check case status with tracking ID
- **admin_login.php** - Admin authentication page
- **admin_dashboard.php** - Admin panel to manage all reports
- **db_connect.php** - Database connection configuration
- **database.sql** - Complete database schema with sample data
- **.htaccess** - Apache configuration for hosting

## 🎯 Future Enhancements

- [ ] Email notifications to victims
- [ ] SMS alerts via Twilio
- [ ] Multi-language support (Kinyarwanda, French, English)
- [ ] Mobile app version
- [ ] Live chat with organizations
- [ ] PDF export of reports
- [ ] Two-factor authentication for admins

## 📸 Design Features

- Modern purple/violet gradient theme
- Fully responsive mobile design
- Clean, professional interface
- Smooth animations and transitions
- Accessible and user-friendly

---

**HerVoice Rwanda** - Empowering voices, ending violence. 💜

For detailed hosting instructions, see [HOSTING_GUIDE.md](HOSTING_GUIDE.md)
This project is open-source and available for modification and distribution under the terms of the MIT License.
