# Development Guide - Tema AR Modern Monoline

Panduan pengembangan untuk tema OpenSID berbasis Tailwind CSS.

## 🚀 Quick Start

### Prerequisites
- Node.js 16+ 
- npm 8+ atau yarn
- Git

### Installation
```bash
# Clone repository
git clone https://github.com/kevlar453/tema-monoline-opensid.git
cd desa/themes/ar-modern-1

# Install dependencies
npm install

# Start development mode
npm run dev
```

## 🏗️ Project Structure

```
desa/themes/ar-modern-1/
├── src/
│   └── input.css              # Main Tailwind CSS input file
├── assets/
│   ├── css/
│   │   └── custom-tailwind.css # Generated CSS output
│   └── js/
│       └── theme.js           # Theme JavaScript
├── resources/
│   └── views/                 # Blade templates
├── tailwind.config.js         # Tailwind configuration
├── postcss.config.js          # PostCSS configuration
├── package.json               # Dependencies and scripts
└── README.md                  # Documentation
```

## 🎨 Development Workflow

### 1. CSS Development
```bash
# Watch mode for development
npm run dev

# Build for production
npm run build:prod
```

### 2. JavaScript Development
```bash
# Lint JavaScript files
npm run lint

# Fix linting issues
npm run lint:fix
```

### 3. Template Development
- Edit Blade templates in `resources/views/`
- Use Tailwind utility classes
- Follow responsive design principles

## 🎯 Tailwind CSS Usage

### Custom Components
```css
/* Define in src/input.css */
@layer components {
  .btn-primary {
    @apply bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700;
  }
}
```

### Custom Utilities
```css
/* Define in src/input.css */
@layer utilities {
  .text-gradient {
    @apply bg-gradient-to-r from-primary-600 to-primary-700 bg-clip-text text-transparent;
  }
}
```

### Responsive Design
```html
<!-- Mobile first approach -->
<div class="w-full md:w-1/2 lg:w-1/3">
  <!-- Content -->
</div>
```

## 🔧 Configuration

### Tailwind Config
```javascript
// tailwind.config.js
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./assets/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          600: '#dc2626',
          // ... more colors
        }
      }
    }
  }
}
```

### Theme Configuration
```json
// config.json
{
  "judul": "Warna Dasar Tema",
  "key": "warna_dasar",
  "value": "#dc2626",
  "type": "color-picker"
}
```

## 📱 Responsive Design

### Breakpoints
- **Mobile**: < 640px
- **Tablet**: 640px - 1024px  
- **Desktop**: > 1024px

### Mobile-First Approach
```html
<!-- Start with mobile styles -->
<div class="p-4 md:p-6 lg:p-8">
  <h1 class="text-xl md:text-2xl lg:text-3xl">Title</h1>
</div>
```

## 🎭 Component Development

### Card Component
```html
<div class="card">
  <div class="card-header">
    <h3 class="text-lg font-semibold">Card Title</h3>
  </div>
  <div class="card-body">
    <p>Card content goes here</p>
  </div>
  <div class="card-footer">
    <button class="btn-primary">Action</button>
  </div>
</div>
```

### Button Components
```html
<button class="btn-primary">Primary Button</button>
<button class="btn-secondary">Secondary Button</button>
<button class="btn-outline">Outline Button</button>
<button class="btn-ghost">Ghost Button</button>
```

### Form Components
```html
<label class="form-label">Email</label>
<input type="email" class="form-input" placeholder="Enter email">
<div class="form-error">Error message</div>
```

## 🚀 Performance Optimization

### CSS Optimization
- Use Tailwind's purge to remove unused CSS
- Minimize custom CSS
- Use utility classes when possible

### JavaScript Optimization
- Lazy load components
- Use event delegation
- Minimize DOM queries

### Image Optimization
- Use appropriate image formats
- Implement lazy loading
- Optimize image sizes

## 🧪 Testing

### Browser Testing
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

### Device Testing
- Mobile devices
- Tablets
- Desktop screens
- Different resolutions

## 📝 Code Standards

### CSS/SCSS
- Use Tailwind utility classes
- Follow BEM methodology for custom CSS
- Use semantic class names
- Maintain consistent spacing

### JavaScript
- Use ES6+ features
- Follow ESLint rules
- Use meaningful variable names
- Add JSDoc comments

### HTML/Blade
- Use semantic HTML
- Maintain accessibility
- Follow responsive design principles
- Use consistent indentation

## 🔍 Debugging

### CSS Debugging
```css
/* Add debug outline */
.debug * {
  outline: 1px solid red;
}
```

### JavaScript Debugging
```javascript
// Use console logging
console.log('Debug info:', data);

// Use browser dev tools
debugger;
```

### Responsive Debugging
```css
/* Show current breakpoint */
body::before {
  content: 'Mobile';
  position: fixed;
  top: 0;
  left: 0;
  background: red;
  color: white;
  padding: 4px;
  z-index: 9999;
}

@media (min-width: 640px) {
  body::before { content: 'Tablet'; }
}

@media (min-width: 1024px) {
  body::before { content: 'Desktop'; }
}
```

## 📚 Resources

### Documentation
- [Tailwind CSS Docs](https://tailwindcss.com/docs)
- [OpenSID Documentation](https://docs.opendesadesa.id)
- [Blade Templates](https://laravel.com/docs/blade)

### Tools
- [Tailwind CSS IntelliSense](https://marketplace.visualstudio.com/items?itemName=bradlc.vscode-tailwindcss)
- [PostCSS](https://postcss.org/)
- [Autoprefixer](https://autoprefixer.github.io/)

## 🤝 Contributing

### Code Review Process
1. Create feature branch
2. Make changes following standards
3. Test thoroughly
4. Submit pull request
5. Code review and approval

### Commit Messages
```
feat: add new button component
fix: resolve mobile menu issue
docs: update development guide
style: improve button hover effects
refactor: simplify card component
```

## 🚨 Common Issues

### CSS Not Loading
- Check Tailwind build process
- Verify file paths
- Clear browser cache

### JavaScript Errors
- Check browser console
- Verify script loading order
- Check for jQuery conflicts

### Responsive Issues
- Test on actual devices
- Check breakpoint values
- Verify viewport meta tag

## 📞 Support

- Create issue on GitHub
- Contact development team
- Check documentation
- Review existing issues

---

**Happy Coding! 🎉**
