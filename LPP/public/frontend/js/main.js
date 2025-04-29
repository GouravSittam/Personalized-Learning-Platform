// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize mobile navigation toggle
    initMobileNav();
    
    // Initialize form validation
    initFormValidation();
});

// Mobile navigation toggle
function initMobileNav() {
    const navToggle = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');
    
    if (navToggle && navLinks) {
        navToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    }
}

// Form validation
function initFormValidation() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            if (!validateForm(this)) {
                event.preventDefault();
            }
        });
    });
}

// Validate form fields
function validateForm(form) {
    let isValid = true;
    const requiredFields = form.querySelectorAll('[required]');
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            showError(field, 'This field is required');
        } else {
            clearError(field);
        }
        
        // Email validation
        if (field.type === 'email' && field.value) {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(field.value)) {
                isValid = false;
                showError(field, 'Please enter a valid email address');
            }
        }
    });
    
    return isValid;
}

// Show error message
function showError(field, message) {
    const errorDiv = field.nextElementSibling?.classList.contains('error-message') 
        ? field.nextElementSibling 
        : createErrorElement();
    
    errorDiv.textContent = message;
    if (!field.nextElementSibling?.classList.contains('error-message')) {
        field.parentNode.insertBefore(errorDiv, field.nextElementSibling);
    }
    field.classList.add('error');
}

// Clear error message
function clearError(field) {
    const errorDiv = field.nextElementSibling;
    if (errorDiv?.classList.contains('error-message')) {
        errorDiv.remove();
    }
    field.classList.remove('error');
}

// Create error message element
function createErrorElement() {
    const div = document.createElement('div');
    div.className = 'error-message';
    div.style.color = 'red';
    div.style.fontSize = '0.8rem';
    div.style.marginTop = '0.25rem';
    return div;
}

// Utility function to debounce function calls
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Utility function to format date
function formatDate(date) {
    return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}

// Utility function for API calls
async function fetchAPI(url, options = {}) {
    try {
        const response = await fetch(url, {
            headers: {
                'Content-Type': 'application/json',
                ...options.headers
            },
            ...options
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        return await response.json();
    } catch (error) {
        console.error('API call failed:', error);
        throw error;
    }
} 