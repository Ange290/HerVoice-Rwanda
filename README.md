# HerVoice Rwanda - Anonymous Violence Reporting Platform

A secure, anonymous platform for women and girls in Rwanda to report cases of violence and harassment.

##  Features

-  **Anonymous Reporting** - Submit reports without revealing identity
-  **Organization Selection** - Choose from trusted NGOs and organizations
-  **Evidence Upload** - Support for images, audio, video, and documents
-  **Case Tracking** - Track case status using unique tracking ID
-  **Admin Dashboard** - Manage and update case statuses
-  **Secure & Private** - All data stored securely

##  Project Structure

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

##  Local Installation (XAMPP)

### Prerequisites

- XAMPP installed with PHP 7.4+ and MySQL


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

##  Technology Stack

- **Backend:** Pure PHP (no frameworks, no Composer)
- **Database:** MySQL
- **Frontend:** HTML5, Tailwind CSS (via CDN)
- **Server:** Apache (XAMPP/InfinityFree)

##  Security Features

- SQL injection prevention using `mysqli_real_escape_string`
- XSS protection with `htmlspecialchars`
- File upload validation (type and size checks)
- Session-based admin authentication
- Secure file storage

##  Usage

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
2. Enter credentials 
3. View all reports in dashboard
4. Update case statuses
5. View uploaded evidence


##  Future Enhancements

- [ ] Email notifications to victims
- [ ] SMS alerts via Twilio
- [ ] Multi-language support (Kinyarwanda, French, English)
- [ ] Mobile app version
- [ ] Live chat with organizations
- [ ] PDF export of reports
- [ ] Two-factor authentication for admins

##  Design Features

- Modern purple/violet gradient theme
- Fully responsive mobile design
- Clean, professional interface
- Smooth animations and transitions
- Accessible and user-friendly

---

**HerVoice Rwanda** - Empowering voices, ending violence. 💜

For detailed hosting instructions, see [HOSTING_GUIDE.md](HOSTING_GUIDE.md)
This project is open-source and available for modification and distribution under the terms of the MIT License.
