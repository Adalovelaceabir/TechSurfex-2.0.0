/**
 * TechSurfex Theme JavaScript
 * Mobile menu toggle, newsletter forms
 */

(function() {
    // Mobile menu toggle
    const mobileBtn = document.getElementById('mobileMenuToggle');
    const navMenu = document.getElementById('navMenuList');
    
    function toggleMenu() {
        if (!navMenu) return;
        navMenu.classList.toggle('show');
        const icon = mobileBtn.querySelector('i');
        if (navMenu.classList.contains('show')) {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
            mobileBtn.setAttribute('aria-expanded', 'true');
        } else {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
            mobileBtn.setAttribute('aria-expanded', 'false');
        }
    }
    
    function closeMenu() {
        if (window.innerWidth <= 768 && navMenu && navMenu.classList.contains('show')) {
            navMenu.classList.remove('show');
            const icon = mobileBtn.querySelector('i');
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
            mobileBtn.setAttribute('aria-expanded', 'false');
        }
    }
    
    if (mobileBtn && navMenu) {
        mobileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleMenu();
        });
        
        // Close when clicking a nav link
        const navLinks = navMenu.querySelectorAll('a');
        navLinks.forEach(function(link) {
            link.addEventListener('click', closeMenu);
        });
    }
    
    // Close menu on resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768 && navMenu && navMenu.classList.contains('show')) {
            closeMenu();
        }
    });
    
    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        if (navMenu && navMenu.classList.contains('show') && window.innerWidth <= 768) {
            const isClickInsideNav = navMenu.contains(event.target);
            const isClickOnBtn = mobileBtn && mobileBtn.contains(event.target);
            if (!isClickInsideNav && !isClickOnBtn) {
                closeMenu();
            }
        }
    });
    
    // Newsletter form handlers
    const newsletterForms = document.querySelectorAll('.newsletter-form, .sidebar-widget form, .footer-widget form');
    newsletterForms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('✅ Thank you for subscribing! (Demo)');
            form.reset();
        });
    });
})();
