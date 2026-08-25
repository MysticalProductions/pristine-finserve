# Pristine Finserve - Admin Panel Documentation

## Overview
The admin panel is a comprehensive content management system for Pristine Finserve, built with a custom PHP MVC framework. It provides role-based access control, CRUD operations for all content types, and lead/inquiry management.

## Access
- **URL**: `http://your-domain.com/admin/login`
- **Default Credentials**:
  - Email: `admin@pristinefinserve.com`
  - Password: `admin@123`

## Navigation Structure

### Dashboard (`/admin` or `/admin/dashboard`)
- **Purpose**: Overview of key metrics
- **Features**:
  - Total leads (with status breakdown: new, contacted, qualified, converted, lost)
  - Contact inquiries count
  - Blog posts count
  - Services count
  - Loan products count
  - Partners count
  - Subscribers count
  - New leads today
  - Recent 5 leads table
  - Recent 5 inquiries table

### Lead Management (`/admin/leads`)
- **Purpose**: Manage customer leads from website forms
- **Features**:
  - Paginated list with status filter
  - Statuses: new, contacted, qualified, converted, lost
  - View lead details
  - Update lead status
  - Add internal notes
  - Export to CSV (filtered by status)
- **Routes**:
  - `GET /admin/leads` - List with pagination
  - `GET /admin/leads/view/{id}` - View single lead
  - `POST /admin/leads/status/{id}` - Update status
  - `POST /admin/leads/note/{id}` - Add note
  - `GET /admin/leads/export` - Export CSV

### Contact Inquiries (`/admin/inquiries`)
- **Purpose**: Manage contact form submissions
- **Features**:
  - Paginated list
  - View inquiry details (auto-marks as read)
  - Reply to inquiry (sends email via MailerService)
  - Delete inquiry
- **Routes**:
  - `GET /admin/inquiries` - List
  - `GET /admin/inquiries/view/{id}` - View & mark read
  - `POST /admin/inquiries/reply/{id}` - Send email reply
  - `GET /admin/inquiries/delete/{id}` - Delete

### Services (`/admin/services`)
- **Purpose**: Manage financial services offered
- **Fields**:
  - Title, Slug, Icon, Short Description, Full Content
  - Features, Benefits, Process (line-separated, stored as JSON)
  - FAQ (stored as JSON with question/answer pairs)
  - Status: published/draft
  - Featured Image (file upload)
  - Display Order
- **Routes**: Full CRUD (`index`, `create`, `store`, `edit`, `update`, `delete`)

### Loan Products (`/admin/loans`)
- **Purpose**: Manage loan offerings
- **Fields**:
  - Name, Slug, Icon, Short Description, Full Description
  - Min/Max Amount, Min/Max Interest Rate
  - Min/Max Tenure (months), Processing Fee
  - Interest Type (fixed/floating/reducing)
  - Eligibility, Documents, Features, Benefits (line-separated → JSON)
  - FAQ (JSON)
  - Status, Display Order
  - Featured Image, Brochure (PDF upload)
- **Routes**: Full CRUD

### Blog (`/admin/blogs` or `/admin/blog`)
- **Purpose**: Manage blog posts
- **Fields**:
  - Title, Slug, Excerpt, Full Content
  - Category (from blog_categories table)
  - Tags (comma-separated, stored as JSON array)
  - SEO: Meta Title, Description, Keywords
  - Status: draft/published
  - Featured Post toggle
  - Published Date (auto-set on publish)
  - Featured Image (upload)
- **Routes**: Full CRUD

### Partners (`/admin/partners`)
- **Purpose**: Manage partner organizations (banks, NBFCs, etc.)
- **Fields**:
  - Name, Slug, Type (bank/nbcc/insurance/etc.)
  - Description, Website URL
  - Logo (required, file upload)
  - Status: active/inactive
  - Display Order
- **Routes**: Full CRUD

### Gallery (`/admin/gallery`)
- **Purpose**: Manage image gallery
- **Features**: Full CRUD with image uploads

### Team (`/admin/team`)
- **Purpose**: Manage team member profiles
- **Features**: Full CRUD with image uploads

### Testimonials (`/admin/testimonials`)
- **Purpose**: Manage client testimonials
- **Features**: Full CRUD

### Statistics (`/admin/statistics`)
- **Purpose**: Manage key statistics/numbers for homepage
- **Features**: Full CRUD

### Pages (`/admin/pages`)
- **Purpose**: Manage static content pages
- **Features**: Full CRUD for legal/info pages (Privacy Policy, Terms, etc.)

### Users & Roles (`/admin/users`)
- **Purpose**: Manage admin users
- **Features**:
  - Role-based access (Super Admin, Admin, Editor)
  - Create/edit users with role assignment
  - Password hashing via AuthService
  - Prevent self-deletion
  - Only Super Admin/Admin can delete users
- **Routes**: Full CRUD

### Activity Logs (`/admin/activity` or `/admin/activity-logs`)
- **Purpose**: View system activity logs

### Notifications (`/admin/notifications`)
- **Purpose**: View and mark notifications as read

### Settings (`/admin/settings`)
- **Purpose**: Manage site-wide settings
- **Features**:
  - Grouped by category
  - Dynamic key-value storage
  - Auto-creates missing keys

### SEO Management (`/admin/seo` or `/admin/settings/seo`)
- **Purpose**: Manage SEO meta entries
- **Features**:
  - Create/edit/delete SEO meta records
  - Bulk update via settings page

## Authentication & Authorization

### Login Flow
1. Access `/admin/login`
2. Enter email/password
3. Validated via `AuthService::login()`
4. On success: redirect to `/admin`
5. On failure: flash error, return to login

### Session Management
- Session stored via `Core\Session`
- User data available via `$session->getUser()`
- Flash messages for success/error/old input

### Role Hierarchy
1. **Super Admin** (role_id: 1) - Full access, can delete users
2. **Admin** (role_id: 2) - Full access, can delete users
3. **Editor** (role_id: 3+) - Content management only

### Middleware Protection
- All admin routes (except login/logout) protected by `AuthMiddleware`
- CSRF protection via `CsrfMiddleware` on all POST routes

## File Uploads
- **Location**: `storage/uploads/{category}/`
- **Categories**: services, loans, blog, partners, gallery, team, loans/brochures
- **Helper**: `uploadFile($file, $category)` in `app/Helpers/functions.php`
- **MIME types**: Images (png, jpg, jpeg, gif, webp), PDFs for brochures

## Data Helpers (app/Helpers/functions.php)
- `linesToJson($string, $type='list')` - Convert line-separated input to JSON
- `jsonToLines($json, $type='list')` - Convert JSON back to lines for editing
- `adminRoute($path='')` - Generate admin URLs
- `uploadFile($file, $category)` - Handle file uploads

## Database
- **Prefix**: Configurable via `config/database.php` (default: `pf_`)
- **Key Tables**:
  - `users` - Admin users
  - `roles` - User roles
  - `leads` - Customer leads
  - `contact_inquiries` - Contact form submissions
  - `services` - Financial services
  - `loan_products` - Loan offerings
  - `blog_posts` - Blog articles
  - `blog_categories` - Blog categories
  - `partners` - Partner organizations
  - `gallery` - Gallery images
  - `team` - Team members
  - `testimonials` - Client testimonials
  - `statistics` - Key metrics
  - `pages` - Static pages
  - `settings` - Site settings (key-value)
  - `seo_meta` - SEO metadata
  - `activity_logs` - Audit trail
  - `notifications` - User notifications
  - `subscribers` - Newsletter subscribers
  - `calculators` - EMI calculators

## Email Configuration
- **Service**: `App\Services\MailerService`
- **Config**: Set via `.env` or Settings panel
- **Used for**: Inquiry replies, lead notifications

## Common Workflows

### Creating a Service
1. Navigate to `/admin/services/create`
2. Fill title, slug, icon, descriptions
3. Add features/benefits/process (one per line)
4. Add FAQ (question|answer per line)
5. Upload featured image
6. Set status & order
7. Submit

### Managing Leads
1. View `/admin/leads` - filter by status
2. Click "View" for details
3. Update status via dropdown
4. Add notes for team collaboration
5. Export filtered leads to CSV

### Replying to Inquiries
1. Go to `/admin/inquiries`
2. Click "View" on unread inquiry
3. Click "Reply" button
4. Write response - sent via email automatically
5. Inquiry marked as replied

### Publishing Blog Post
1. Create at `/admin/blogs/create`
2. Select category, add tags
3. Set status to "published"
4. Published date auto-filled
5. Featured image optional

## Troubleshooting

### Login Issues
- Verify credentials in `users` table
- Check `APP_DEBUG` in `.env` for error details
- Ensure session directory writable: `storage/logs/`

### File Upload Failures
- Check `storage/uploads/` permissions (775)
- Verify PHP `upload_max_filesize` & `post_max_size`
- Check disk space

### Email Not Sending
- Verify MailerService config in Settings
- Check SMTP credentials
- Review `storage/logs/app.log` for errors

### 500 Errors
- Enable `APP_DEBUG=true` in `.env`
- Check `storage/logs/app.log`
- Common: Missing columns, JSON decode errors, null property access

## Maintenance Commands

### Clear Cache/Logs
```bash
rm -rf storage/logs/*.log
```

### Database Backup
```bash
mysqldump -u root pristine_finserve > backup.sql
```

### Reset Admin Password
```sql
UPDATE pf_users SET password = '$2y$10$...' WHERE email = 'admin@pristinefinserve.com';
```
(Generate hash via `AuthService::hashPassword('newpassword')`)

## Extending the Admin Panel

### Adding New Module
1. Create Model in `app/Models/`
2. Create Controller in `app/Controllers/Admin/`
3. Add routes in `public/index.php`
4. Create views in `app/Views/Admin/{module}/`
5. Add navigation in `app/Views/Admin/layouts/admin.php`

### Custom Fields
- Use `linesToJson()` for repeatable fields
- Use `jsonToLines()` for editing
- Store as TEXT/JSON in database

## Security Notes
- All POST routes have CSRF protection
- Passwords hashed with bcrypt (cost 10)
- SQL queries use prepared statements
- File uploads validated by MIME type
- Role checks on sensitive actions (user deletion)
- Session-based authentication

## Support
For issues or feature requests, check the codebase or contact the development team.

---

# Step-by-Step User Guide (For Non-Technical Users)

This section provides detailed, click-by-click instructions for common daily tasks.

---

## 1. First-Time Login

1. Open your web browser (Chrome, Firefox, Safari, Edge)
2. In the address bar, type: `http://your-domain.com/admin/login` (replace `your-domain.com` with your actual website address)
3. Press **Enter** on your keyboard
4. You will see the login page with two fields:
   - **Email**: Type `admin@pristinefinserve.com`
   - **Password**: Type `admin@123`
5. Click the **Login** button (or press Enter)
6. You will be redirected to the **Dashboard** - your main control panel

> **Important**: Change your password after first login! Go to Settings → Users → Edit your account → Enter new password → Save.

---

## 2. Changing Your Password

1. After logging in, look at the top-right corner for your name/email
2. Click on it (or go to `/admin/users`)
3. Find your account in the list (usually the first one)
4. Click the **Edit** button (pencil icon) next to your name
5. In the **Password** field, type your new password
6. In **Confirm Password**, type it again
7. Click **Update User** button at the bottom
8. You will see a green success message: "User updated successfully"

---

## 3. Adding a New Service (e.g., "Home Loan", "Business Loan")

1. In the left sidebar menu, click **Services**
2. Click the **Add Service** button (usually top-right, green button)
3. Fill in the form:
   - **Title**: Type the service name (e.g., "Home Loan")
   - **Slug**: This auto-fills from title, or type a URL-friendly version (e.g., `home-loan`)
   - **Icon**: Optional - enter an icon class name (e.g., `fa-house`)
   - **Short Description**: Write 1-2 sentences for cards/previews
   - **Content**: Write the full description (use the editor toolbar for formatting)
4. **Features** section (optional):
   - Type one feature per line (e.g., "Low interest rates", "Quick approval")
   - Each line becomes a bullet point on the website
5. **Benefits** section (optional):
   - Type one benefit per line (e.g., "Save on taxes", "Flexible tenure")
6. **Process** section (optional):
   - Type steps one per line (e.g., "Apply online", "Get approved", "Receive funds")
7. **FAQ** section (optional):
   - Type questions and answers separated by `|` (pipe symbol)
   - Example: `What is the minimum amount?|Minimum loan amount is ₹1 Lakh`
8. **Status**: Select **Published** (to show on website) or **Draft** (to hide)
9. **Featured Image**: Click **Choose File** → select an image from your computer → click **Open**
10. **Order**: Enter a number (0 = first, higher numbers = later in list)
11. Click **Create Service** button at bottom
12. You'll see a green success message and be taken back to the services list

---

## 4. Editing an Existing Service

1. Go to **Services** in the left menu
2. Find the service you want to change in the list
3. Click the **Edit** button (pencil icon) on that row
4. Make your changes (same fields as adding new)
5. Click **Update Service** button
6. Green success message confirms the update

---

## 5. Adding a Loan Product (e.g., "Personal Loan", "Car Loan")

1. In the left sidebar, click **Loans** (or **Loan Products**)
2. Click **Add Loan** button (top-right)
3. Fill in the required fields (marked with *):
   - **Name**: Loan product name (e.g., "Personal Loan")
   - **Slug**: Auto-fills or type URL version (e.g., `personal-loan`)
   - **Short Description**: Brief summary for listings
   - **Description**: Full details
   - **Min Amount**: Minimum loan amount in numbers only (e.g., `100000`)
   - **Max Amount**: Maximum loan amount (e.g., `5000000`)
4. Fill in optional financial details:
   - **Min Rate**: Lowest interest rate % (e.g., `10.5`)
   - **Max Rate**: Highest interest rate % (e.g., `18.0`)
   - **Min Tenure (months)**: Shortest repayment period (e.g., `12`)
   - **Max Tenure (months)**: Longest repayment period (e.g., `84`)
   - **Processing Fee**: Fee percentage or flat amount (e.g., `2`)
   - **Interest Type**: Select Fixed, Floating, or Reducing
5. Add details (one per line each):
   - **Eligibility**: Who can apply (e.g., "Salaried employees", "Age 21-60")
   - **Documents**: Required documents (e.g., "PAN Card", "Aadhaar", "Salary slips")
   - **Features**: Key features (e.g., "No collateral", "Quick disbursal")
   - **Benefits**: Customer benefits
6. **FAQ**: Same format as services (Question|Answer per line)
7. **Status**: Published or Draft
8. **Featured Image**: Upload main image
9. **Brochure**: Upload PDF brochure (optional)
10. **Order**: Display order number
11. Click **Create Loan Product**

---

## 6. Writing a Blog Post

1. Click **Blog** in left menu
2. Click **Add Blog Post** button
3. Fill in:
   - **Title**: Blog headline (e.g., "5 Tips for Getting Home Loan Approval")
   - **Slug**: Auto-fills or customize (e.g., `5-tips-home-loan-approval`)
   - **Excerpt**: 2-3 sentence summary for blog listing page
   - **Content**: Full article (use editor for headings, bold, images, links)
4. **Category**: Select from dropdown (create categories first if needed)
5. **Tags**: Type comma-separated keywords (e.g., `home loan, tips, approval, finance`)
6. **SEO Fields** (optional but recommended):
   - **Meta Title**: What shows in Google search (max 60 chars)
   - **Meta Description**: Search result description (max 160 chars)
   - **Meta Keywords**: Comma-separated SEO keywords
7. **Status**: 
   - **Draft** - Save but don't publish yet
   - **Published** - Goes live immediately
8. **Featured Post**: Check to highlight on homepage
9. **Published Date**: Leave blank for now, or set future date for scheduling
10. **Featured Image**: Upload blog header image
11. Click **Create Blog Post**

---

## 7. Managing Leads (Customer Inquiries)

### Viewing All Leads
1. Click **Leads** in left menu
2. You see a table with columns: Name, Email, Phone, Service, Status, Date
3. Use **Status Filter** dropdown to show only "New", "Contacted", etc.
4. Click **View** (eye icon) to see full details

### Updating Lead Status
1. In the leads list, find the lead
2. Click **View** to open details
3. Find the **Status** dropdown (shows current status)
4. Select new status: **New → Contacted → Qualified → Converted** or **Lost**
5. Click **Update Status** button
6. Page refreshes with success message

### Adding Internal Notes
1. Open lead details (click View)
2. Scroll to **Notes** section
3. Type your note in the text area (e.g., "Called customer, interested in personal loan")
4. Click **Add Note**
5. Note appears with your name and timestamp

### Exporting Leads to Excel/CSV
1. Go to **Leads** list page
2. Optionally filter by status first
3. Click **Export CSV** button (top-right)
4. File downloads to your computer
5. Open in Excel/Google Sheets

---

## 8. Replying to Contact Form Inquiries

1. Click **Inquiries** in left menu
2. Unread inquiries show in bold
3. Click **View** on any inquiry
4. Read the message from the customer
5. Click **Reply** button (or scroll to reply form)
6. Type your response in the message box
7. Click **Send Reply**
8. System sends email to customer automatically
9. Inquiry shows "Replied" status with timestamp

---

## 9. Adding a Partner Logo (Bank/NBFC Logo)

1. Click **Partners** in left menu
2. Click **Add Partner** button
3. Fill in:
   - **Name**: Partner name (e.g., "HDFC Bank")
   - **Slug**: Auto-fills (e.g., `hdfc-bank`)
   - **Type**: Select from dropdown (Bank, NBFC, Insurance, etc.)
   - **Description**: Brief description (optional)
   - **Website**: Partner's website URL (e.g., `https://hdfcbank.com`)
4. **Logo**: **Required** - Click Choose File → select logo image → Open
   - Best format: PNG with transparent background
   - Recommended size: 200x100px or similar ratio
5. **Status**: Active (shows on website) or Inactive
6. **Order**: Display order number
7. Click **Create Partner**

---

## 10. Managing Team Members

1. Click **Team** in left menu
2. Click **Add Team Member**
3. Fill in:
   - **Name**: Full name
   - **Designation**: Job title (e.g., "Senior Loan Advisor")
   - **Email**: Contact email
   - **Phone**: Contact number
   - **Bio**: Short professional bio
   - **Social Links**: LinkedIn, Twitter, etc. (optional)
4. **Image**: Upload profile photo (square ratio works best)
5. **Status**: Active/Inactive
6. **Order**: Display order
7. Click **Create**

---

## 11. Adding a Testimonial

1. Click **Testimonials** in left menu
2. Click **Add Testimonial**
3. Fill in:
   - **Client Name**: Customer's name
   - **Designation**: Their title/role
   - **Company**: Company name (optional)
   - **Content**: Their testimonial text
   - **Rating**: 1-5 stars
4. **Image**: Upload client photo/logo (optional)
5. **Status**: Published/Draft
6. **Order**: Display order
7. Click **Create**

---

## 12. Updating Site Settings (Phone, Email, Address, etc.)

1. Click **Settings** in left menu
2. Settings are grouped by category (General, Contact, Social, etc.)
3. Find the setting you want to change:
   - **Site Name**: Your company name
   - **Site Email**: Contact email for forms
   - **Site Phone**: Phone number
   - **Address**: Full address
   - **Social Links**: Facebook, Twitter, LinkedIn, Instagram URLs
4. Edit the value in the text box
5. Click **Save Settings** at bottom of page
6. Green success message appears

---

## 13. Managing Admin Users (Adding Team Members to Admin)

1. Click **Users** in left menu
2. Click **Add User** button
3. Fill in:
   - **Name**: Full name of the person
   - **Email**: Their email (used for login)
   - **Password**: Set a temporary password (they can change it)
   - **Role**: Select **Admin** (full access) or **Editor** (content only)
   - **Phone**: Optional
   - **Status**: Active
4. Click **Create User**
5. Share the login URL and credentials with them
6. **Important**: Ask them to change password on first login

---

## 14. Uploading Images to Gallery

1. Click **Gallery** in left menu
2. Click **Add Image**
3. **Title**: Image caption/title
4. **Image**: Choose file from computer
5. **Category**: Select or create category
6. **Status**: Published/Draft
7. Click **Create**

---

## 15. Managing Statistics (Homepage Numbers)

1. Click **Statistics** in left menu
2. Click **Add Statistic**
3. Fill in:
   - **Label**: What the number represents (e.g., "Happy Customers")
   - **Value**: The number (e.g., `5000+`)
   - **Icon**: Icon class (e.g., `fa-users`)
   - **Order**: Display order
4. Click **Create**

---

## 16. Creating/Editing Static Pages (Privacy Policy, Terms, etc.)

1. Click **Pages** in left menu
2. Click **Add Page** or **Edit** existing
3. Fill in:
   - **Title**: Page title (e.g., "Privacy Policy")
   - **Slug**: URL path (e.g., `privacy-policy`)
   - **Content**: Full page content (use editor)
   - **Meta Title/Description**: For SEO
4. **Status**: Published/Draft
5. Click **Create/Update**

---

## 17. SEO Management

### Adding SEO Meta for a Page
1. Click **SEO** in left menu
2. Click **Add SEO Entry**
3. Fill in:
   - **Route**: The URL path (e.g., `/services`, `/loans/personal-loan`)
   - **Meta Title**: Browser tab title / Google title
   - **Meta Description**: Google search description
   - **Meta Keywords**: Comma-separated keywords
   - **OG Title/Description/Image**: For Facebook/LinkedIn sharing
   - **Twitter Card**: For Twitter sharing
4. Click **Create**

---

## 18. Daily Recommended Routine

### Morning (5 minutes)
1. Log in to admin panel
2. Check **Dashboard** for:
   - New leads count (red badge)
   - New inquiries count
3. Click **Leads** → Filter by "New" → Review each new lead
4. Click **Inquiries** → View unread → Reply or assign

### Throughout the Day
- Update lead statuses as you contact them
- Add notes after phone calls/meetings
- Reply to inquiries promptly

### Weekly (15 minutes)
1. Review **Blog** - publish any draft posts
2. Check **Settings** - update any changed contact info
3. Review **Statistics** - update key numbers if changed
4. Check **Gallery/Team/Testimonials** - add new content

### Monthly (30 minutes)
1. Export **Leads CSV** → Share with sales team
2. Review **Services/Loans** - update rates, features
3. Check **Partners** - add new partners, remove inactive
4. Review **Users** - remove access for departed staff

---

## 19. Common Problems & Quick Fixes

| Problem | Solution |
|---------|----------|
| "Invalid email or password" | Check caps lock, try copy-paste, or use "Forgot Password" (if enabled) |
| Image won't upload | Check file size (< 5MB), format (JPG/PNG/WebP), and try again |
| Changes not showing on website | Clear browser cache (Ctrl+Shift+R), or check if Status = "Published" |
| "Page not found" after save | Check the Slug field - no spaces, only lowercase letters, numbers, hyphens |
| Email not sending | Contact your developer/hosting - check SMTP settings in Settings panel |
| Can't delete a user | You can't delete yourself; only Super Admin/Admin can delete others |
| Form shows "Error" red message | Read the error - usually a required field is missing or format is wrong |

---

## 20. Keyboard Shortcuts (Power User Tips)

| Action | Shortcut |
|--------|----------|
| Save form | Ctrl + S (in most browsers) |
| New tab for link | Ctrl + Click on any link |
| Search in page | Ctrl + F |
| Refresh page | Ctrl + R |
| Go to dashboard | Click logo in top-left |
| Logout | Click your name (top-right) → Logout |

---

## 21. Glossary of Terms

| Term | Meaning |
|------|---------|
| **Slug** | URL-friendly version of title (e.g., "Home Loan" → `home-loan`) |
| **CRUD** | Create, Read, Update, Delete - the four basic operations |
| **Published** | Visible on the live website |
| **Draft** | Saved but hidden from website |
| **Status** | Current stage (e.g., New, Contacted, Converted for leads) |
| **Featured** | Highlighted/promoted on homepage or top of lists |
| **SEO** | Search Engine Optimization - helps Google find your pages |
| **Meta Tags** | Hidden code that tells search engines about your page |
| **CSV** | Comma-Separated Values - opens in Excel |
| **Backend/Admin Panel** | This management area (not visible to public) |
| **Frontend** | The public website visitors see |

---

## 22. Getting Help

### Before Contacting Support:
1. Check this documentation
2. Try the "Common Problems" table above
3. Note down: What you clicked, what happened, any error message
4. Take a screenshot if possible (Press **Print Screen** or **Cmd+Shift+4** on Mac)

### Contact Information:
- **Developer/Technical Support**: [Your developer contact]
- **Emergency Issues**: [Phone/Email for urgent problems]

### Useful Links:
- **Admin Panel**: `http://your-domain.com/admin/login`
- **Live Website**: `http://your-domain.com`
- **Hosting Control Panel**: [Your hosting panel URL]

---

*Document Version: 1.0 | Last Updated: August 2026 | For Pristine Finserve Admin Panel*