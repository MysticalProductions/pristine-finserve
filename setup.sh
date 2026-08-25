#!/bin/bash
# Pristine Finserve - Setup Script
# Usage: bash setup.sh

PHP="/Applications/XAMPP/xamppfiles/bin/php"
MYSQL="/Applications/XAMPP/xamppfiles/bin/mysql"
MYSQL_ADMIN="/Applications/XAMPP/xamppfiles/bin/mysqladmin"

echo "=== Pristine Finserve Setup ==="

# 1. Create .env if not exists
if [ ! -f .env ]; then
    cp .env.example .env
    echo "✓ Created .env from .env.example"
else
    echo "• .env already exists"
fi

# 2. Create storage directories
mkdir -p storage/logs storage/uploads
chmod 775 storage/logs storage/uploads
echo "✓ Storage directories ready"

# 3. Import database
echo ""
echo "Starting MySQL..."
"$MYSQL_ADMIN" -u root ping 2>/dev/null
if [ $? -ne 0 ]; then
    echo "⏳ MySQL not running. Start it via XAMPP Manager or run:"
    echo "   sudo /Applications/XAMPP/xamppfiles/bin/mysql.server start"
    echo "Then re-run this script."
    exit 1
fi

echo "Importing database schema..."
"$MYSQL" -u root < database/schema.sql 2>/dev/null
if [ $? -eq 0 ]; then
    echo "✓ Database 'pristine_finserve' created and seeded"
else
    echo "⚠ Database import failed (may already exist)"
fi

# 4. Test PHP
echo ""
echo "PHP version: $($PHP -v | head -1)"

# 5. Start dev server
echo ""
echo "============================================"
echo "  Setup complete! Start the server with:"
echo ""
echo "  $PHP -S localhost:8000 server.php"
echo ""
echo "  Then open: http://localhost:8000"
echo "  Admin:     http://localhost:8000/admin/login"
echo "  Email:     admin@pristinefinserve.com"
echo "  Password:  admin@123"
echo "============================================"
