# DiiQUBE Development Setup

## Running the Project Locally

### Option 1: PHP Development Server (Recommended)

1. **Start the server:**
   ```bash
   bash start-server.sh
   ```
   
   Or manually:
   ```bash
   php -S localhost:8000 -t /workspaces/DiiQUBE
   ```

2. **Open in browser:**
   - Homepage: `http://localhost:8000`
   - Contact Form: `http://localhost:8000/contact.html`

3. **Stop the server:**
   - Press `Ctrl+C` in the terminal

### Features Now Working

✅ **Contact Form** - Submits via `submit_contact.php` and sends emails
✅ **Proper PHP Execution** - No more downloading `.php` files
✅ **Form Validation** - Client-side and server-side validation
✅ **Success/Error Messages** - Real-time feedback to users
✅ **Email Fallback** - Uses PHPMailer if available, falls back to PHP `mail()`

### Email Configuration

The contact form is currently configured to send emails to:
- `info@diiqube.com` (Primary recipient)
- `nworatochi755@gmail.com` (Secondary recipient)

**To update email settings:**
1. Edit `submit_contact.php`
2. Update the email addresses in the fallback mail section (around line 75)
3. If using SMTP (PHPMailer), update credentials (lines 35-37)

### Security Notes

⚠️ **IMPORTANT:** The credentials in `submit_contact.php` should NOT be committed to production:
- Remove or replace Gmail credentials before deploying
- Use environment variables for sensitive data
- Consider using a proper email service (SendGrid, Mailgun, etc.)

### Troubleshooting

**Problem:** "Contact form still downloads the PHP file"
- **Solution:** Make sure the PHP development server is running with `bash start-server.sh`

**Problem:** "Emails not sending"
- **Check:**
  - Is the PHP dev server running?
  - Are recipient emails configured correctly in `submit_contact.php`?
  - Check browser console for network errors
  - Verify email credentials if using SMTP

**Problem:** "Form shows network error"
- **Solution:** Click F12 to open DevTools and check the Network tab for the actual error response

## Project Structure

```
/workspaces/DiiQUBE/
├── index.html              # Homepage
├── about.html              # About page
├── our-subsidiaries.html   # Subsidiaries page
├── contact.html             # Contact form page
├── submit_contact.php      # Form submission handler
├── script.js               # JavaScript (navbar, hero, blog)
├── start-server.sh         # PHP dev server launcher
├── assets/
│   ├── css/
│   │   ├── styles.css      # Homepage styles
│   │   └── con-style.css   # Contact page styles
│   └── img/                # Images
└── README-SETUP.md         # This file
```

## Recent Improvements

### index.html
- ✅ Added `lang="en"` for accessibility
- ✅ Added meta description for SEO
- ✅ Added favicon
- ✅ Proper contact links (mailto:, tel:)
- ✅ Wrapped content in `<main>` semantic tag
- ✅ Added descriptive alt text to images
- ✅ Lazy loading for images

### contact.html
- ✅ Added `lang="en"` and meta tags
- ✅ Real-time form feedback with success/error messages
- ✅ Loading spinner during submission
- ✅ Updated email address to company domain

### submit_contact.php
- ✅ Proper error handling with HTTP status codes
- ✅ PHPMailer support with fallback to PHP mail()
- ✅ Input sanitization and validation
- ✅ HTML email formatting
- ✅ Graceful error messages

## Next Steps

1. Start the PHP dev server: `bash start-server.sh`
2. Test the contact form at `http://localhost:8000/contact.html`
3. Update credentials as needed before production deployment
4. Consider adding reCAPTCHA for form protection
