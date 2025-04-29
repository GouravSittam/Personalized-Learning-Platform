// Dashboard Component
class Dashboard {
    constructor() {
        this.container = document.getElementById('dashboard');
        this.currentView = 'overview';
        this.initializeDashboard();
    }

    // Initialize dashboard
    async initializeDashboard() {
        if (!this.container) return;

        try {
            uiUtils.showLoading(this.container);
            
            // Check authentication
            if (!auth.isAuthenticated()) {
                window.location.href = '/login';
                return;
            }

            // Get user data and overall progress
            const [user, progress] = await Promise.all([
                auth.getCurrentUser(),
                apiService.getOverallProgress()
            ]);

            this.renderDashboard(user, progress);
        } catch (error) {
            uiUtils.showNotification('Failed to load dashboard', 'error');
            console.error('Dashboard initialization error:', error);
        } finally {
            uiUtils.hideLoading(this.container);
        }
    }

    // Render dashboard
    renderDashboard(user, progress) {
        this.container.innerHTML = '';
        
        // Create dashboard layout
        const layout = document.createElement('div');
        layout.className = 'dashboard-layout';
        layout.style.cssText = `
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 20px;
            height: 100%;
        `;

        // Add sidebar
        layout.appendChild(this.createSidebar());
        
        // Add main content
        const mainContent = document.createElement('div');
        mainContent.className = 'dashboard-main';
        mainContent.style.cssText = `
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
        `;

        // Add welcome section
        mainContent.appendChild(this.createWelcomeSection(user));
        
        // Add progress overview
        mainContent.appendChild(this.createProgressOverview(progress));
        
        // Add learning paths section
        this.loadLearningPaths(mainContent);
        
        // Add recent courses section
        this.loadRecentCourses(mainContent);
        
        // Add skill assessments section
        this.loadSkillAssessments(mainContent);

        layout.appendChild(mainContent);
        this.container.appendChild(layout);
    }

    // Create sidebar
    createSidebar() {
        const sidebar = document.createElement('div');
        sidebar.className = 'dashboard-sidebar';
        sidebar.style.cssText = `
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        `;

        // Add user profile section
        const userProfile = document.createElement('div');
        userProfile.className = 'user-profile';
        userProfile.style.cssText = `
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        `;

        const userAvatar = document.createElement('div');
        userAvatar.className = 'user-avatar';
        userAvatar.style.cssText = `
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #e9ecef;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #6c757d;
        `;
        userAvatar.textContent = auth.getUser()?.name?.charAt(0) || 'U';

        const userName = document.createElement('div');
        userName.className = 'user-name';
        userName.style.cssText = `
            font-weight: bold;
            margin-bottom: 5px;
        `;
        userName.textContent = auth.getUser()?.name || 'User';

        userProfile.appendChild(userAvatar);
        userProfile.appendChild(userName);
        sidebar.appendChild(userProfile);

        // Add navigation menu
        const navMenu = document.createElement('nav');
        navMenu.className = 'dashboard-nav';
        
        const menuItems = [
            { icon: '📊', text: 'Overview', view: 'overview' },
            { icon: '📚', text: 'Learning Paths', view: 'learning-paths' },
            { icon: '🎯', text: 'Courses', view: 'courses' },
            { icon: '📈', text: 'Progress', view: 'progress' },
            { icon: '🎓', text: 'Skills', view: 'skills' }
        ];

        menuItems.forEach(item => {
            const menuItem = document.createElement('button');
            menuItem.className = `nav-item ${this.currentView === item.view ? 'active' : ''}`;
            menuItem.style.cssText = `
                display: flex;
                align-items: center;
                width: 100%;
                padding: 10px;
                border: none;
                background: none;
                text-align: left;
                cursor: pointer;
                border-radius: 4px;
                margin-bottom: 5px;
                transition: background-color 0.2s;
            `;
            
            if (this.currentView === item.view) {
                menuItem.style.backgroundColor = '#e9ecef';
            }

            menuItem.innerHTML = `
                <span style="margin-right: 10px;">${item.icon}</span>
                ${item.text}
            `;

            menuItem.addEventListener('click', () => this.switchView(item.view));
            navMenu.appendChild(menuItem);
        });

        sidebar.appendChild(navMenu);
        return sidebar;
    }

    // Create welcome section
    createWelcomeSection(user) {
        const welcomeSection = document.createElement('div');
        welcomeSection.className = 'welcome-section';
        welcomeSection.style.cssText = `
            margin-bottom: 30px;
        `;

        const welcomeTitle = document.createElement('h1');
        welcomeTitle.style.cssText = `
            font-size: 24px;
            margin-bottom: 10px;
            color: #2c3e50;
        `;
        welcomeTitle.textContent = `Welcome back, ${user.name}!`;

        const welcomeSubtitle = document.createElement('p');
        welcomeSubtitle.style.cssText = `
            color: #6c757d;
            margin-bottom: 20px;
        `;
        welcomeSubtitle.textContent = 'Track your progress and continue your learning journey.';

        welcomeSection.appendChild(welcomeTitle);
        welcomeSection.appendChild(welcomeSubtitle);
        return welcomeSection;
    }

    // Create progress overview
    createProgressOverview(progress) {
        const progressSection = document.createElement('div');
        progressSection.className = 'progress-overview';
        progressSection.style.cssText = `
            margin-bottom: 30px;
        `;

        const progressTitle = document.createElement('h2');
        progressTitle.style.cssText = `
            font-size: 20px;
            margin-bottom: 15px;
            color: #2c3e50;
        `;
        progressTitle.textContent = 'Overall Progress';

        const progressGrid = document.createElement('div');
        progressGrid.style.cssText = `
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        `;

        // Add progress cards
        const progressCards = [
            {
                title: 'Learning Paths',
                value: progress.learning_paths_completed || 0,
                total: progress.total_learning_paths || 0,
                color: '#007bff'
            },
            {
                title: 'Courses',
                value: progress.courses_completed || 0,
                total: progress.total_courses || 0,
                color: '#28a745'
            },
            {
                title: 'Skills',
                value: progress.skills_mastered || 0,
                total: progress.total_skills || 0,
                color: '#ffc107'
            }
        ];

        progressCards.forEach(card => {
            const progressCard = uiUtils.createCard({
                title: card.title,
                content: this.createProgressCard(card),
                className: 'progress-card'
            });
            progressGrid.appendChild(progressCard);
        });

        progressSection.appendChild(progressTitle);
        progressSection.appendChild(progressGrid);
        return progressSection;
    }

    // Create progress card
    createProgressCard({ value, total, color }) {
        const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
        
        const cardContent = document.createElement('div');
        cardContent.style.cssText = `
            text-align: center;
        `;

        const progressValue = document.createElement('div');
        progressValue.style.cssText = `
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: ${color};
        `;
        progressValue.textContent = `${value}/${total}`;

        const progressBar = uiUtils.createProgressBar(percentage, {
            progressColor: color,
            height: '10px',
            showLabel: false
        });

        const progressLabel = document.createElement('div');
        progressLabel.style.cssText = `
            margin-top: 5px;
            color: #6c757d;
            font-size: 14px;
        `;
        progressLabel.textContent = `${percentage}% Complete`;

        cardContent.appendChild(progressValue);
        cardContent.appendChild(progressBar);
        cardContent.appendChild(progressLabel);
        return cardContent;
    }

    // Load learning paths
    async loadLearningPaths(container) {
        try {
            const learningPaths = await apiService.getLearningPaths();
            
            const section = document.createElement('div');
            section.className = 'learning-paths-section';
            section.style.cssText = `
                margin-bottom: 30px;
            `;

            const sectionTitle = document.createElement('h2');
            sectionTitle.style.cssText = `
                font-size: 20px;
                margin-bottom: 15px;
                color: #2c3e50;
            `;
            sectionTitle.textContent = 'Your Learning Paths';

            const pathsGrid = document.createElement('div');
            pathsGrid.style.cssText = `
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 20px;
            `;

            learningPaths.forEach(path => {
                const pathCard = this.createLearningPathCard(path);
                pathsGrid.appendChild(pathCard);
            });

            section.appendChild(sectionTitle);
            section.appendChild(pathsGrid);
            container.appendChild(section);
        } catch (error) {
            uiUtils.showNotification('Failed to load learning paths', 'error');
            console.error('Load learning paths error:', error);
        }
    }

    // Create learning path card
    createLearningPathCard(path) {
        const card = uiUtils.createCard({
            title: path.title,
            content: `
                <p style="margin-bottom: 15px;">${path.description}</p>
                <div style="margin-bottom: 15px;">
                    <span style="color: #6c757d;">Difficulty:</span> ${path.difficulty_level}
                </div>
                <div style="margin-bottom: 15px;">
                    <span style="color: #6c757d;">Duration:</span> ${path.estimated_duration} hours
                </div>
            `,
            footer: uiUtils.createButton('Continue Learning', {
                onClick: () => this.viewLearningPath(path.id)
            })
        });

        return card;
    }

    // Load recent courses
    async loadRecentCourses(container) {
        try {
            const courses = await apiService.getCourses();
            const recentCourses = courses.slice(0, 3); // Get only 3 most recent courses
            
            const section = document.createElement('div');
            section.className = 'recent-courses-section';
            section.style.cssText = `
                margin-bottom: 30px;
            `;

            const sectionTitle = document.createElement('h2');
            sectionTitle.style.cssText = `
                font-size: 20px;
                margin-bottom: 15px;
                color: #2c3e50;
            `;
            sectionTitle.textContent = 'Recent Courses';

            const coursesList = document.createElement('div');
            coursesList.style.cssText = `
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 20px;
            `;

            recentCourses.forEach(course => {
                const courseCard = this.createCourseCard(course);
                coursesList.appendChild(courseCard);
            });

            section.appendChild(sectionTitle);
            section.appendChild(coursesList);
            container.appendChild(section);
        } catch (error) {
            uiUtils.showNotification('Failed to load recent courses', 'error');
            console.error('Load recent courses error:', error);
        }
    }

    // Create course card
    createCourseCard(course) {
        const card = uiUtils.createCard({
            title: course.title,
            content: `
                <p style="margin-bottom: 15px;">${course.description}</p>
                <div style="margin-bottom: 15px;">
                    <span style="color: #6c757d;">Category:</span> ${course.category}
                </div>
                <div style="margin-bottom: 15px;">
                    <span style="color: #6c757d;">Duration:</span> ${course.duration} hours
                </div>
            `,
            footer: uiUtils.createButton('Start Course', {
                onClick: () => this.startCourse(course.id)
            })
        });

        return card;
    }

    // Load skill assessments
    async loadSkillAssessments(container) {
        try {
            const assessments = await apiService.getLatestAssessments();
            
            const section = document.createElement('div');
            section.className = 'skill-assessments-section';
            section.style.cssText = `
                margin-bottom: 30px;
            `;

            const sectionTitle = document.createElement('h2');
            sectionTitle.style.cssText = `
                font-size: 20px;
                margin-bottom: 15px;
                color: #2c3e50;
            `;
            sectionTitle.textContent = 'Skill Assessments';

            const assessmentsList = document.createElement('div');
            assessmentsList.style.cssText = `
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 20px;
            `;

            assessments.forEach(assessment => {
                const assessmentCard = this.createSkillAssessmentCard(assessment);
                assessmentsList.appendChild(assessmentCard);
            });

            section.appendChild(sectionTitle);
            section.appendChild(assessmentsList);
            container.appendChild(section);
        } catch (error) {
            uiUtils.showNotification('Failed to load skill assessments', 'error');
            console.error('Load skill assessments error:', error);
        }
    }

    // Create skill assessment card
    createSkillAssessmentCard(assessment) {
        const card = uiUtils.createCard({
            title: assessment.skill_name,
            content: `
                <div style="margin-bottom: 15px;">
                    <span style="color: #6c757d;">Current Level:</span> ${assessment.current_level}
                </div>
                <div style="margin-bottom: 15px;">
                    <span style="color: #6c757d;">Target Level:</span> ${assessment.target_level}
                </div>
                <div style="margin-bottom: 15px;">
                    <span style="color: #6c757d;">Last Assessment:</span> ${new Date(assessment.assessment_date).toLocaleDateString()}
                </div>
            `,
            footer: uiUtils.createButton('Take Assessment', {
                onClick: () => this.takeSkillAssessment(assessment.skill_name)
            })
        });

        return card;
    }

    // Switch view
    switchView(view) {
        this.currentView = view;
        this.initializeDashboard();
    }

    // View learning path
    viewLearningPath(id) {
        // Implement learning path view
        console.log('View learning path:', id);
    }

    // Start course
    startCourse(id) {
        // Implement course start
        console.log('Start course:', id);
    }

    // Take skill assessment
    takeSkillAssessment(skillName) {
        // Implement skill assessment
        console.log('Take skill assessment:', skillName);
    }
}

// Initialize dashboard when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    const dashboard = new Dashboard();
}); 