// Authentication Module
class Auth {
    constructor() {
        this.baseUrl = '/api';
        this.token = localStorage.getItem('auth_token');
        this.user = JSON.parse(localStorage.getItem('user'));
    }

    // Register a new user
    async register(userData) {
        try {
            const response = await fetchAPI(`${this.baseUrl}/register`, {
                method: 'POST',
                body: JSON.stringify(userData)
            });

            if (response.token) {
                this.setSession(response.token, response.user);
                return response;
            }
            throw new Error('Registration failed');
        } catch (error) {
            console.error('Registration error:', error);
            throw error;
        }
    }

    // Login user
    async login(credentials) {
        try {
            const response = await fetchAPI(`${this.baseUrl}/login`, {
                method: 'POST',
                body: JSON.stringify(credentials)
            });

            if (response.token) {
                this.setSession(response.token, response.user);
                return response;
            }
            throw new Error('Login failed');
        } catch (error) {
            console.error('Login error:', error);
            throw error;
        }
    }

    // Logout user
    async logout() {
        try {
            if (this.token) {
                await fetchAPI(`${this.baseUrl}/logout`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${this.token}`
                    }
                });
            }
        } catch (error) {
            console.error('Logout error:', error);
        } finally {
            this.clearSession();
        }
    }

    // Get current user profile
    async getCurrentUser() {
        try {
            if (!this.token) {
                throw new Error('No authentication token');
            }

            const response = await fetchAPI(`${this.baseUrl}/user`, {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            });

            if (response.user) {
                this.user = response.user;
                localStorage.setItem('user', JSON.stringify(response.user));
                return response.user;
            }
            throw new Error('Failed to get user profile');
        } catch (error) {
            console.error('Get user error:', error);
            throw error;
        }
    }

    // Set session data
    setSession(token, user) {
        this.token = token;
        this.user = user;
        localStorage.setItem('auth_token', token);
        localStorage.setItem('user', JSON.stringify(user));
    }

    // Clear session data
    clearSession() {
        this.token = null;
        this.user = null;
        localStorage.removeItem('auth_token');
        localStorage.removeItem('user');
    }

    // Check if user is authenticated
    isAuthenticated() {
        return !!this.token;
    }

    // Get authentication token
    getToken() {
        return this.token;
    }

    // Get current user
    getUser() {
        return this.user;
    }
}

// Initialize auth instance
const auth = new Auth();

// Event listeners for authentication forms
document.addEventListener('DOMContentLoaded', () => {
    // Registration form handler
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            try {
                const formData = {
                    name: registerForm.querySelector('[name="name"]').value,
                    email: registerForm.querySelector('[name="email"]').value,
                    password: registerForm.querySelector('[name="password"]').value,
                    password_confirmation: registerForm.querySelector('[name="password_confirmation"]').value
                };

                await auth.register(formData);
                window.location.href = '/dashboard'; // Redirect to dashboard after successful registration
            } catch (error) {
                showError(registerForm, error.message);
            }
        });
    }

    // Login form handler
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            try {
                const formData = {
                    email: loginForm.querySelector('[name="email"]').value,
                    password: loginForm.querySelector('[name="password"]').value
                };

                await auth.login(formData);
                window.location.href = '/dashboard'; // Redirect to dashboard after successful login
            } catch (error) {
                showError(loginForm, error.message);
            }
        });
    }

    // Logout button handler
    const logoutBtn = document.getElementById('logoutBtn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', async (e) => {
            e.preventDefault();
            try {
                await auth.logout();
                window.location.href = '/login'; // Redirect to login page after logout
            } catch (error) {
                console.error('Logout error:', error);
            }
        });
    }
}); 