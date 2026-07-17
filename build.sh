#!/bin/bash

# Tema Cursor Tailwind CSS Build Script
# OpenSID Theme Build Tool

echo "🎨 Building Tema Cursor Tailwind CSS..."

# Check if Node.js is installed
if ! command -v node &> /dev/null; then
    echo "❌ Node.js is not installed. Please install Node.js first."
    exit 1
fi

# Check if npm is installed
if ! command -v npm &> /dev/null; then
    echo "❌ npm is not installed. Please install npm first."
    exit 1
fi

# Install dependencies if node_modules doesn't exist
if [ ! -d "node_modules" ]; then
    echo "📦 Installing dependencies..."
    npm install
fi

# Build CSS
echo "🔨 Building CSS..."
npm run build:prod

# Check if build was successful
if [ $? -eq 0 ]; then
    echo "✅ Build completed successfully!"
    echo "📁 Output files:"
    echo "   - assets/css/custom-tailwind.css"
    echo "   - assets/js/theme.js"
    echo ""
    echo "🚀 Theme is ready to use!"
else
    echo "❌ Build failed!"
    exit 1
fi

# Optional: Show file sizes
if command -v du &> /dev/null; then
    echo ""
    echo "📊 File sizes:"
    if [ -f "assets/css/custom-tailwind.css" ]; then
        echo "   CSS: $(du -h assets/css/custom-tailwind.css | cut -f1)"
    fi
    if [ -f "assets/js/theme.js" ]; then
        echo "   JS: $(du -h assets/js/theme.js | cut -f1)"
    fi
fi

echo ""
echo "🎉 Build process completed!"
