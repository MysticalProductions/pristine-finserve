-- Pristine Finserve Database Schema
-- Prefix: pf_

CREATE DATABASE IF NOT EXISTS `pristine_finserve` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `pristine_finserve`;

-- ============================================================
-- 1. ROLES
-- ============================================================
CREATE TABLE `pf_roles` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50) NOT NULL UNIQUE,
  `slug` VARCHAR(50) NOT NULL UNIQUE,
  `description` TEXT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 2. ADMIN USERS
-- ============================================================
CREATE TABLE `pf_users` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role_id` INT UNSIGNED NOT NULL,
  `avatar` VARCHAR(255) NULL,
  `phone` VARCHAR(20) NULL,
  `status` ENUM('active','inactive','suspended') DEFAULT 'active',
  `last_login` DATETIME NULL,
  `remember_token` VARCHAR(100) NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`role_id`) REFERENCES `pf_roles`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================================
-- 3. PAGES
-- ============================================================
CREATE TABLE `pf_pages` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(200) NOT NULL,
  `slug` VARCHAR(200) NOT NULL UNIQUE,
  `content` LONGTEXT NULL,
  `meta_title` VARCHAR(200) NULL,
  `meta_description` TEXT NULL,
  `meta_keywords` TEXT NULL,
  `template` VARCHAR(100) DEFAULT 'default',
  `status` ENUM('draft','published') DEFAULT 'published',
  `show_in_menu` TINYINT(1) DEFAULT 1,
  `menu_order` INT DEFAULT 0,
  `featured_image` VARCHAR(255) NULL,
  `author_id` INT UNSIGNED NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`author_id`) REFERENCES `pf_users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ============================================================
-- 4. SERVICES
-- ============================================================
CREATE TABLE `pf_services` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(200) NOT NULL,
  `slug` VARCHAR(200) NOT NULL UNIQUE,
  `icon` VARCHAR(100) NULL,
  `short_desc` VARCHAR(300) NULL,
  `content` LONGTEXT NULL,
  `features` JSON NULL,
  `process` JSON NULL,
  `benefits` JSON NULL,
  `faq` JSON NULL,
  `meta_title` VARCHAR(200) NULL,
  `meta_description` TEXT NULL,
  `status` ENUM('draft','published') DEFAULT 'published',
  `featured_image` VARCHAR(255) NULL,
  `order` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 5. LOAN PRODUCTS
-- ============================================================
CREATE TABLE `pf_loan_products` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(200) NOT NULL,
  `slug` VARCHAR(200) NOT NULL UNIQUE,
  `icon` VARCHAR(100) NULL,
  `short_desc` VARCHAR(300) NULL,
  `description` LONGTEXT NULL,
  `min_amount` DECIMAL(15,2) DEFAULT 0,
  `max_amount` DECIMAL(15,2) DEFAULT 0,
  `min_rate` DECIMAL(5,2) NULL,
  `max_rate` DECIMAL(5,2) NULL,
  `min_tenure_months` INT DEFAULT 12,
  `max_tenure_months` INT DEFAULT 360,
  `processing_fee` VARCHAR(100) NULL,
  `eligibility` JSON NULL,
  `documents` JSON NULL,
  `features` JSON NULL,
  `interest_type` ENUM('fixed','reducing','floating') DEFAULT 'reducing',
  `benefits` JSON NULL,
  `faq` JSON NULL,
  `status` ENUM('draft','published') DEFAULT 'published',
  `featured_image` VARCHAR(255) NULL,
  `brochure` VARCHAR(255) NULL,
  `order` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 6. CALCULATORS
-- ============================================================
CREATE TABLE `pf_calculators` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(200) NOT NULL,
  `slug` VARCHAR(200) NOT NULL UNIQUE,
  `type` VARCHAR(50) NOT NULL COMMENT 'emi, eligibility, comparison, sip, lump-sum',
  `description` TEXT NULL,
  `default_rate` DECIMAL(5,2) NULL,
  `default_tenure` INT NULL,
  `default_amount` DECIMAL(15,2) NULL,
  `status` ENUM('active','inactive') DEFAULT 'active',
  `order` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 7. BLOG CATEGORIES
-- ============================================================
CREATE TABLE `pf_blog_categories` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(100) NOT NULL UNIQUE,
  `description` TEXT NULL,
  `color` VARCHAR(7) DEFAULT '#1B5AAE',
  `status` ENUM('active','inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 8. BLOG POSTS
-- ============================================================
CREATE TABLE `pf_blog_posts` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(200) NOT NULL,
  `slug` VARCHAR(200) NOT NULL UNIQUE,
  `excerpt` TEXT NULL,
  `content` LONGTEXT NULL,
  `featured_image` VARCHAR(255) NULL,
  `category_id` INT UNSIGNED NULL,
  `author_id` INT UNSIGNED NULL,
  `tags` JSON NULL,
  `meta_title` VARCHAR(200) NULL,
  `meta_description` TEXT NULL,
  `meta_keywords` TEXT NULL,
  `status` ENUM('draft','published') DEFAULT 'published',
  `is_featured` TINYINT(1) DEFAULT 0,
  `published_at` DATETIME NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `pf_blog_categories`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`author_id`) REFERENCES `pf_users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ============================================================
-- 9. TESTIMONIALS
-- ============================================================
CREATE TABLE `pf_testimonials` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `client_name` VARCHAR(100) NOT NULL,
  `client_company` VARCHAR(200) NULL,
  `client_designation` VARCHAR(100) NULL,
  `client_photo` VARCHAR(255) NULL,
  `rating` TINYINT UNSIGNED DEFAULT 5,
  `content` TEXT NOT NULL,
  `loan_type` VARCHAR(100) NULL,
  `amount_sanctioned` DECIMAL(15,2) NULL,
  `status` ENUM('draft','published') DEFAULT 'published',
  `is_featured` TINYINT(1) DEFAULT 0,
  `order` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 10. PARTNERS
-- ============================================================
CREATE TABLE `pf_partners` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(200) NOT NULL,
  `slug` VARCHAR(200) NOT NULL UNIQUE,
  `logo` VARCHAR(255) NOT NULL,
  `type` ENUM('bank','nbfc','insurance','other') DEFAULT 'bank',
  `description` TEXT NULL,
  `website` VARCHAR(255) NULL,
  `status` ENUM('active','inactive') DEFAULT 'active',
  `order` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 11. GALLERY
-- ============================================================
CREATE TABLE `pf_gallery` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(200) NOT NULL,
  `description` TEXT NULL,
  `image` VARCHAR(255) NULL,
  `video_url` VARCHAR(255) NULL,
  `type` ENUM('photo','video','event') DEFAULT 'photo',
  `category` VARCHAR(100) NULL,
  `status` ENUM('active','inactive') DEFAULT 'active',
  `is_featured` TINYINT(1) DEFAULT 0,
  `order` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 12. TEAM / LEADERSHIP
-- ============================================================
CREATE TABLE `pf_team` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `designation` VARCHAR(200) NOT NULL,
  `bio` TEXT NULL,
  `photo` VARCHAR(255) NULL,
  `email` VARCHAR(100) NULL,
  `phone` VARCHAR(20) NULL,
  `linkedin` VARCHAR(255) NULL,
  `twitter` VARCHAR(255) NULL,
  `order` INT DEFAULT 0,
  `status` ENUM('active','inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 13. LEADS / INQUIRIES
-- ============================================================
CREATE TABLE `pf_leads` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `loan_type` VARCHAR(100) NULL,
  `loan_amount` DECIMAL(15,2) NULL,
  `city` VARCHAR(100) NULL,
  `message` TEXT NULL,
  `source` VARCHAR(50) DEFAULT 'website',
  `status` ENUM('new','contacted','qualified','proposal','negotiation','converted','lost') DEFAULT 'new',
  `notes` JSON NULL,
  `assigned_to` INT UNSIGNED NULL,
  `callback_time` DATETIME NULL,
  `converted_at` DATETIME NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`assigned_to`) REFERENCES `pf_users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ============================================================
-- 14. CONTACT INQUIRIES
-- ============================================================
CREATE TABLE `pf_contact_inquiries` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(20) NULL,
  `subject` VARCHAR(200) NULL,
  `message` TEXT NOT NULL,
  `is_read` TINYINT(1) DEFAULT 0,
  `replied_at` DATETIME NULL,
  `replied_by` INT UNSIGNED NULL,
  `reply_message` TEXT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`replied_by`) REFERENCES `pf_users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ============================================================
-- 15. SETTINGS
-- ============================================================
CREATE TABLE `pf_settings` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `key` VARCHAR(100) NOT NULL UNIQUE,
  `value` LONGTEXT NULL,
  `type` ENUM('text','textarea','image','select','json') DEFAULT 'text',
  `group` VARCHAR(50) DEFAULT 'general',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 16. SEO META
-- ============================================================
CREATE TABLE `pf_seo_meta` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `page_url` VARCHAR(200) NOT NULL UNIQUE,
  `title` VARCHAR(200) NULL,
  `description` TEXT NULL,
  `keywords` TEXT NULL,
  `og_title` VARCHAR(200) NULL,
  `og_description` TEXT NULL,
  `og_image` VARCHAR(255) NULL,
  `schema_markup` JSON NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 17. SLIDERS
-- ============================================================
CREATE TABLE `pf_sliders` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(200) NOT NULL,
  `subtitle` VARCHAR(300) NULL,
  `description` TEXT NULL,
  `image` VARCHAR(255) NOT NULL,
  `btn_text` VARCHAR(50) NULL,
  `btn_url` VARCHAR(255) NULL,
  `btn_text_2` VARCHAR(50) NULL,
  `btn_url_2` VARCHAR(255) NULL,
  `order` INT DEFAULT 0,
  `status` ENUM('active','inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 18. MEDIA
-- ============================================================
CREATE TABLE `pf_media` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `filename` VARCHAR(255) NOT NULL,
  `original_name` VARCHAR(255) NOT NULL,
  `path` VARCHAR(500) NOT NULL,
  `type` VARCHAR(50) NOT NULL,
  `size` INT UNSIGNED NOT NULL,
  `mime_type` VARCHAR(100) NULL,
  `alt_text` VARCHAR(255) NULL,
  `caption` TEXT NULL,
  `uploaded_by` INT UNSIGNED NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`uploaded_by`) REFERENCES `pf_users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ============================================================
-- 19. MENUS
-- ============================================================
CREATE TABLE `pf_menus` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `location` VARCHAR(50) NOT NULL UNIQUE COMMENT 'header, footer, sidebar',
  `items` JSON NULL,
  `status` ENUM('active','inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 20. NEWSLETTER / SUBSCRIBERS
-- ============================================================
CREATE TABLE `pf_subscribers` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `name` VARCHAR(100) NULL,
  `status` ENUM('active','unsubscribed') DEFAULT 'active',
  `subscribed_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `unsubscribed_at` TIMESTAMP NULL
) ENGINE=InnoDB;

-- ============================================================
-- 21. NOTIFICATIONS
-- ============================================================
CREATE TABLE `pf_notifications` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL,
  `type` VARCHAR(50) NOT NULL COMMENT 'lead, inquiry, system',
  `title` VARCHAR(200) NOT NULL,
  `message` TEXT NULL,
  `link` VARCHAR(255) NULL,
  `is_read` TINYINT(1) DEFAULT 0,
  `read_at` DATETIME NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `pf_users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================================
-- 22. ACTIVITY LOGS
-- ============================================================
CREATE TABLE `pf_activity_logs` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NULL,
  `action` VARCHAR(100) NOT NULL,
  `description` TEXT NULL,
  `model` VARCHAR(100) NULL,
  `model_id` INT UNSIGNED NULL,
  `ip_address` VARCHAR(45) NULL,
  `user_agent` TEXT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `pf_users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ============================================================
-- 23. FAQS
-- ============================================================
CREATE TABLE `pf_faqs` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `question` VARCHAR(500) NOT NULL,
  `answer` TEXT NOT NULL,
  `category` VARCHAR(100) NULL,
  `order` INT DEFAULT 0,
  `status` ENUM('active','inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 24. BRANCHES / OFFICES
-- ============================================================
CREATE TABLE `pf_branches` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(200) NOT NULL,
  `address` TEXT NOT NULL,
  `city` VARCHAR(100) NOT NULL,
  `state` VARCHAR(100) NULL,
  `pincode` VARCHAR(10) NULL,
  `phone` VARCHAR(20) NULL,
  `email` VARCHAR(100) NULL,
  `map_url` VARCHAR(500) NULL,
  `latitude` DECIMAL(10,8) NULL,
  `longitude` DECIMAL(11,8) NULL,
  `is_head_office` TINYINT(1) DEFAULT 0,
  `order` INT DEFAULT 0,
  `status` ENUM('active','inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 25. Milestones / Achievements
-- ============================================================
CREATE TABLE `pf_milestones` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(200) NOT NULL,
  `description` TEXT NULL,
  `icon` VARCHAR(100) NULL,
  `year` YEAR NULL,
  `order` INT DEFAULT 0,
  `status` ENUM('active','inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 26. STATISTICS / COUNTERS (Dashboard stats)
-- ============================================================
CREATE TABLE `pf_statistics` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `label` VARCHAR(100) NOT NULL,
  `value` VARCHAR(50) NOT NULL,
  `suffix` VARCHAR(20) NULL,
  `icon` VARCHAR(100) NULL,
  `order` INT DEFAULT 0,
  `status` ENUM('active','inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 27. ACHIEVEMENTS (Awards & recognition)
-- ============================================================
CREATE TABLE `pf_achievements` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(200) NOT NULL,
  `description` TEXT NULL,
  `image` VARCHAR(255) NULL,
  `year` YEAR NULL,
  `order` INT DEFAULT 0,
  `status` ENUM('active','inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 28. PARTNER BENEFITS
-- ============================================================
CREATE TABLE `pf_partner_benefits` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `partner_id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(200) NOT NULL,
  `description` TEXT NULL,
  `order` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`partner_id`) REFERENCES `pf_partners`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================================
-- 29. LOAN APPLICATIONS (Detailed from leads)
-- ============================================================
CREATE TABLE `pf_loan_applications` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `lead_id` INT UNSIGNED NOT NULL,
  `loan_product_id` INT UNSIGNED NULL,
  `applicant_name` VARCHAR(100) NOT NULL,
  `applicant_email` VARCHAR(100) NOT NULL,
  `applicant_phone` VARCHAR(20) NOT NULL,
  `pan` VARCHAR(20) NULL,
  `aadhaar` VARCHAR(20) NULL,
  `dob` DATE NULL,
  `employment_type` ENUM('salaried','self-employed','business','professional','other') NULL,
  `monthly_income` DECIMAL(15,2) NULL,
  `loan_amount` DECIMAL(15,2) NULL,
  `loan_tenure_months` INT NULL,
  `status` ENUM('draft','submitted','under-review','approved','rejected','disbursed') DEFAULT 'submitted',
  `documents` JSON NULL,
  `notes` TEXT NULL,
  `assigned_to` INT UNSIGNED NULL,
  `submitted_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`lead_id`) REFERENCES `pf_leads`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`loan_product_id`) REFERENCES `pf_loan_products`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`assigned_to`) REFERENCES `pf_users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ============================================================
-- 30. DOCUMENTS (Uploaded)
-- ============================================================
CREATE TABLE `pf_documents` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `loan_application_id` INT UNSIGNED NULL,
  `lead_id` INT UNSIGNED NULL,
  `name` VARCHAR(200) NOT NULL,
  `file_path` VARCHAR(500) NOT NULL,
  `file_type` VARCHAR(50) NULL,
  `file_size` INT UNSIGNED NULL,
  `category` VARCHAR(50) NULL COMMENT 'identity, address, income, property, bank',
  `uploaded_by` INT UNSIGNED NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`loan_application_id`) REFERENCES `pf_loan_applications`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`lead_id`) REFERENCES `pf_leads`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`uploaded_by`) REFERENCES `pf_users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ============================================================
-- 31. CALCULATION HISTORY
-- ============================================================
CREATE TABLE `pf_calculation_history` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `calculator_type` VARCHAR(50) NOT NULL,
  `input_data` JSON NOT NULL,
  `result_data` JSON NOT NULL,
  `session_id` VARCHAR(100) NULL,
  `user_id` INT UNSIGNED NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `pf_users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ============================================================
-- 32. EMAIL TEMPLATES
-- ============================================================
CREATE TABLE `pf_email_templates` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL UNIQUE,
  `subject` VARCHAR(500) NOT NULL,
  `body` LONGTEXT NOT NULL,
  `variables` JSON NULL,
  `status` ENUM('active','inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 33. EMAIL LOGS
-- ============================================================
CREATE TABLE `pf_email_logs` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `to_email` VARCHAR(100) NOT NULL,
  `to_name` VARCHAR(100) NULL,
  `subject` VARCHAR(500) NOT NULL,
  `body` LONGTEXT NULL,
  `template` VARCHAR(100) NULL,
  `status` ENUM('sent','failed','queued') DEFAULT 'sent',
  `error_message` TEXT NULL,
  `sent_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 34. COUNTRY / STATE / CITY (for dropdowns)
-- ============================================================
CREATE TABLE `pf_countries` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `code` CHAR(2) NOT NULL,
  `status` ENUM('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB;

CREATE TABLE `pf_states` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `code` VARCHAR(10) NULL,
  `country_id` INT UNSIGNED DEFAULT 1,
  `status` ENUM('active','inactive') DEFAULT 'active',
  FOREIGN KEY (`country_id`) REFERENCES `pf_countries`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `pf_cities` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `state_id` INT UNSIGNED NOT NULL,
  `status` ENUM('active','inactive') DEFAULT 'active',
  FOREIGN KEY (`state_id`) REFERENCES `pf_states`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================================
-- 35. VALUES (Company values / culture)
-- ============================================================
CREATE TABLE `pf_values` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(100) NOT NULL,
  `description` TEXT NULL,
  `icon` VARCHAR(100) NULL,
  `order` INT DEFAULT 0,
  `status` ENUM('active','inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 36. SERVICE PROCESS STEPS
-- ============================================================
CREATE TABLE `pf_service_process_steps` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `service_id` INT UNSIGNED NOT NULL,
  `step_number` INT UNSIGNED NOT NULL,
  `title` VARCHAR(200) NOT NULL,
  `description` TEXT NULL,
  `icon` VARCHAR(100) NULL,
  `order` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`service_id`) REFERENCES `pf_services`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================================
-- 37. TESTIMONIAL HIGHLIGHTS (Per loan type)
-- ============================================================
CREATE TABLE `pf_testimonial_highlights` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `testimonial_id` INT UNSIGNED NOT NULL,
  `highlight` VARCHAR(300) NOT NULL,
  `order` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`testimonial_id`) REFERENCES `pf_testimonials`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================================
-- 38. TESTIMONIAL STATS SUMMARY
-- ============================================================
CREATE TABLE `pf_testimonial_stats` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `total_reviews` INT UNSIGNED DEFAULT 0,
  `average_rating` DECIMAL(3,2) DEFAULT 0.00,
  `five_star_count` INT UNSIGNED DEFAULT 0,
  `four_star_count` INT UNSIGNED DEFAULT 0,
  `three_star_count` INT UNSIGNED DEFAULT 0,
  `two_star_count` INT UNSIGNED DEFAULT 0,
  `one_star_count` INT UNSIGNED DEFAULT 0,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- INDEXES
-- ============================================================
CREATE INDEX `idx_leads_status` ON `pf_leads`(`status`);
CREATE INDEX `idx_leads_created` ON `pf_leads`(`created_at`);
CREATE INDEX `idx_pages_status` ON `pf_pages`(`status`);
CREATE INDEX `idx_blog_posts_status` ON `pf_blog_posts`(`status`);
CREATE INDEX `idx_blog_posts_category` ON `pf_blog_posts`(`category_id`);
CREATE INDEX `idx_blog_posts_featured` ON `pf_blog_posts`(`is_featured`);
CREATE INDEX `idx_notifications_user` ON `pf_notifications`(`user_id`, `is_read`);
CREATE INDEX `idx_activity_user` ON `pf_activity_logs`(`user_id`);
CREATE INDEX `idx_activity_action` ON `pf_activity_logs`(`action`);
CREATE INDEX `idx_media_type` ON `pf_media`(`type`);

-- ============================================================
-- SEED DATA
-- ============================================================

-- Default roles
INSERT INTO `pf_roles` (`name`, `slug`, `description`) VALUES
('Super Admin', 'super-admin', 'Full system access'),
('Admin', 'admin', 'Administrative access'),
('Manager', 'manager', 'Team management access'),
('Staff', 'staff', 'Limited staff access');

-- Default admin user (password: admin@123)
INSERT INTO `pf_users` (`name`, `email`, `password`, `role_id`, `status`) VALUES
('Super Admin', 'admin@pristinefinserve.com', '$2y$10$42E2VZvTzfCrLYp1pDD.O.0kzoRMX/8HSQ0IB8z1I3vVf.TvduMjS', 1, 'active');

-- Default settings
INSERT INTO `pf_settings` (`key`, `value`, `type`, `group`) VALUES
('site_name', 'Pristine Finserve', 'text', 'general'),
('site_tagline', 'Your Trusted Financial Partner', 'text', 'general'),
('site_logo', '', 'image', 'general'),
('site_favicon', '', 'image', 'general'),
('contact_email', 'info@pristinefinserve.com', 'text', 'contact'),
('contact_phone', '+91 98765 43210', 'text', 'contact'),
('contact_address', '123, Business Hub, MG Road, Mumbai - 400001', 'textarea', 'contact'),
('social_facebook', '#', 'text', 'social'),
('social_twitter', '#', 'text', 'social'),
('social_linkedin', '#', 'text', 'social'),
('social_instagram', '#', 'text', 'social'),
('social_youtube', '#', 'text', 'social'),
('footer_text', '© 2025 Pristine Finserve. All rights reserved.', 'text', 'footer'),
('about_short', 'Pristine Finserve is a leading financial services and loan consultancy company...', 'textarea', 'about'),
('stats_loans_disbursed', '5000+', 'text', 'stats'),
('stats_satisfied_clients', '10000+', 'text', 'stats'),
('stats_years_experience', '10+', 'text', 'stats'),
('stats_branches', '25+', 'text', 'stats'),
('google_maps_api_key', '', 'text', 'integration'),
('recaptcha_site_key', '', 'text', 'integration'),
('recaptcha_secret_key', '', 'text', 'integration'),
('admin_email', 'admin@pristinefinserve.com', 'text', 'general');

-- Default menu
INSERT INTO `pf_menus` (`name`, `location`, `items`) VALUES
('Main Menu', 'header', '[{"label":"Home","url":"\/","children":[]},{"label":"About","url":"\/about","children":[]},{"label":"Services","url":"\/services","children":[]},{"label":"Loans","url":"\/loans","children":[]},{"label":"Calculators","url":"\/calculators","children":[]},{"label":"Blog","url":"\/blog","children":[]},{"label":"Contact","url":"\/contact","children":[]}]');

-- Default pages
INSERT INTO `pf_pages` (`title`, `slug`, `content`, `status`, `show_in_menu`) VALUES
('Home', 'home', '<p>Welcome to Pristine Finserve</p>', 'published', 0),
('About Us', 'about', '<p>About Pristine Finserve</p>', 'published', 0),
('Contact Us', 'contact', '<p>Contact us page</p>', 'published', 0);

-- Email templates
INSERT INTO `pf_email_templates` (`name`, `subject`, `body`, `variables`) VALUES
('lead_confirmation', 'Thank You {{name}} - We Received Your Inquiry', '<h2>Hi {{name}},</h2><p>Thank you for reaching out to Pristine Finserve. We have received your loan inquiry and one of our relationship managers will contact you within 24 hours.</p><p><strong>Your Inquiry Details:</strong><br>Loan Type: {{loan_type}}<br>Amount: {{loan_amount}}<br>Reference ID: {{lead_id}}</p><p>Team Pristine Finserve</p>', '["name","email","phone","loan_type","loan_amount","lead_id"]'),
('contact_autoreply', 'Thank You {{name}} - We Received Your Message', '<h2>Hi {{name}},</h2><p>Thank you for contacting Pristine Finserve. We have received your message and will get back to you shortly.</p><p>Team Pristine Finserve</p>', '["name","email","subject"]'),
('lead_notification_admin', 'New Loan Inquiry - {{name}}', '<h2>New Loan Inquiry</h2><p><strong>Name:</strong> {{name}}<br><strong>Email:</strong> {{email}}<br><strong>Phone:</strong> {{phone}}<br><strong>Loan Type:</strong> {{loan_type}}<br><strong>Amount:</strong> {{loan_amount}}<br><strong>Source:</strong> {{source}}</p>', '["name","email","phone","loan_type","loan_amount","source"]');

-- Testimonials
INSERT INTO `pf_testimonials` (`client_name`, `client_company`, `client_designation`, `content`, `rating`, `loan_type`, `amount_sanctioned`, `status`, `is_featured`) VALUES
('Rajesh Sharma', 'Sharma Enterprises', 'Business Owner', 'Pristine Finserve made the entire loan process seamless. From application to disbursement, everything was handled professionally. Highly recommend their services.', 5, 'Business Loan', 5000000.00, 'published', 1),
('Priya Patel', 'Tech Solutions Pvt Ltd', 'HR Manager', 'I was initially nervous about applying for a home loan, but the team at Pristine Finserve guided me through every step. Got approval in just 5 days!', 5, 'Home Loan', 3500000.00, 'published', 1),
('Amit Verma', NULL, 'Freelancer', 'Best personal loan experience. Minimal documentation, quick approval, and the interest rate was surprisingly low. Thank you Pristine Finserve!', 5, 'Personal Loan', 500000.00, 'published', 1);
