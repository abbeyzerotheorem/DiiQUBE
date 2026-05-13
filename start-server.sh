#!/bin/bash

# Start PHP development server
echo "🚀 Starting DiiQUBE development server..."
echo "📍 Server running at: http://localhost:8000"
echo "📧 Contact form will work at: http://localhost:8000/contact.html"
echo ""
echo "Press Ctrl+C to stop the server"
echo ""

php -S localhost:8000 -t /workspaces/DiiQUBE
