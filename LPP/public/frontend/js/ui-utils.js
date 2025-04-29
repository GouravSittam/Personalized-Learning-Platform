// UI Utilities Module
class UIUtils {
    constructor() {
        this.notificationTimeout = 5000; // Default notification display time
        this.initializeNotificationContainer();
    }

    // Initialize notification container
    initializeNotificationContainer() {
        if (!document.getElementById('notification-container')) {
            const container = document.createElement('div');
            container.id = 'notification-container';
            container.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 1000;
            `;
            document.body.appendChild(container);
        }
    }

    // Show notification
    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.style.cssText = `
            margin-bottom: 10px;
            padding: 15px 20px;
            border-radius: 4px;
            color: white;
            font-size: 14px;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        `;

        // Set background color based on type
        const colors = {
            success: '#28a745',
            error: '#dc3545',
            info: '#17a2b8',
            warning: '#ffc107'
        };
        notification.style.backgroundColor = colors[type] || colors.info;

        notification.textContent = message;
        document.getElementById('notification-container').appendChild(notification);

        // Fade in
        setTimeout(() => notification.style.opacity = '1', 10);

        // Remove notification after timeout
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 300);
        }, this.notificationTimeout);
    }

    // Create loading spinner
    createLoadingSpinner() {
        const spinner = document.createElement('div');
        spinner.className = 'loading-spinner';
        spinner.style.cssText = `
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        `;

        // Add keyframe animation
        if (!document.querySelector('#spinner-animation')) {
            const style = document.createElement('style');
            style.id = 'spinner-animation';
            style.textContent = `
                @keyframes spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }
            `;
            document.head.appendChild(style);
        }

        return spinner;
    }

    // Show loading state
    showLoading(container) {
        const spinner = this.createLoadingSpinner();
        const loadingContainer = document.createElement('div');
        loadingContainer.className = 'loading-container';
        loadingContainer.style.cssText = `
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999;
        `;
        loadingContainer.appendChild(spinner);
        container.style.position = 'relative';
        container.appendChild(loadingContainer);
    }

    // Hide loading state
    hideLoading(container) {
        const loadingContainer = container.querySelector('.loading-container');
        if (loadingContainer) {
            loadingContainer.remove();
        }
    }

    // Create card element
    createCard({ title, content, footer, className = '' }) {
        const card = document.createElement('div');
        card.className = `card ${className}`;
        card.style.cssText = `
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        `;

        if (title) {
            const cardHeader = document.createElement('div');
            cardHeader.className = 'card-header';
            cardHeader.style.cssText = `
                padding: 15px 20px;
                border-bottom: 1px solid #eee;
                font-weight: bold;
            `;
            cardHeader.textContent = title;
            card.appendChild(cardHeader);
        }

        const cardBody = document.createElement('div');
        cardBody.className = 'card-body';
        cardBody.style.padding = '20px';
        if (typeof content === 'string') {
            cardBody.textContent = content;
        } else {
            cardBody.appendChild(content);
        }
        card.appendChild(cardBody);

        if (footer) {
            const cardFooter = document.createElement('div');
            cardFooter.className = 'card-footer';
            cardFooter.style.cssText = `
                padding: 15px 20px;
                border-top: 1px solid #eee;
                background: #f8f9fa;
            `;
            if (typeof footer === 'string') {
                cardFooter.textContent = footer;
            } else {
                cardFooter.appendChild(footer);
            }
            card.appendChild(cardFooter);
        }

        return card;
    }

    // Create progress bar
    createProgressBar(progress, options = {}) {
        const {
            height = '20px',
            backgroundColor = '#e9ecef',
            progressColor = '#007bff',
            showLabel = true,
            animated = true
        } = options;

        const progressBar = document.createElement('div');
        progressBar.className = 'progress';
        progressBar.style.cssText = `
            height: ${height};
            background-color: ${backgroundColor};
            border-radius: ${parseInt(height) / 2}px;
            overflow: hidden;
        `;

        const progressInner = document.createElement('div');
        progressInner.className = 'progress-bar';
        progressInner.style.cssText = `
            width: ${progress}%;
            height: 100%;
            background-color: ${progressColor};
            transition: width 0.6s ease;
            ${animated ? 'animation: progress-bar-stripes 1s linear infinite;' : ''}
        `;

        if (showLabel) {
            progressInner.textContent = `${progress}%`;
            progressInner.style.color = 'white';
            progressInner.style.textAlign = 'center';
            progressInner.style.lineHeight = height;
        }

        // Add stripes animation if animated
        if (animated && !document.querySelector('#progress-animation')) {
            const style = document.createElement('style');
            style.id = 'progress-animation';
            style.textContent = `
                @keyframes progress-bar-stripes {
                    0% { background-position: 1rem 0; }
                    100% { background-position: 0 0; }
                }
                .progress-bar {
                    background-image: linear-gradient(
                        45deg,
                        rgba(255, 255, 255, 0.15) 25%,
                        transparent 25%,
                        transparent 50%,
                        rgba(255, 255, 255, 0.15) 50%,
                        rgba(255, 255, 255, 0.15) 75%,
                        transparent 75%,
                        transparent
                    );
                    background-size: 1rem 1rem;
                }
            `;
            document.head.appendChild(style);
        }

        progressBar.appendChild(progressInner);
        return progressBar;
    }

    // Create button
    createButton(text, options = {}) {
        const {
            type = 'primary',
            size = 'medium',
            onClick,
            disabled = false
        } = options;

        const button = document.createElement('button');
        button.className = `btn btn-${type} btn-${size}`;
        button.textContent = text;
        button.disabled = disabled;

        const sizes = {
            small: '0.875rem',
            medium: '1rem',
            large: '1.25rem'
        };

        const paddings = {
            small: '0.25rem 0.5rem',
            medium: '0.5rem 1rem',
            large: '0.75rem 1.5rem'
        };

        button.style.cssText = `
            display: inline-block;
            font-size: ${sizes[size]};
            padding: ${paddings[size]};
            border-radius: 4px;
            border: none;
            cursor: ${disabled ? 'not-allowed' : 'pointer'};
            opacity: ${disabled ? '0.65' : '1'};
            transition: all 0.2s ease-in-out;
        `;

        if (onClick && !disabled) {
            button.addEventListener('click', onClick);
        }

        return button;
    }
}

// Initialize UI utilities instance
const uiUtils = new UIUtils(); 