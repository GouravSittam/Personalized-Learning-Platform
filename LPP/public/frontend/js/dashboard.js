// Dashboard Component
class Dashboard {
    constructor() {
        this.container = document.getElementById('dashboard');
        this.currentView = 'overview';
        this.charts = {};
        this.initializeDashboard();
        this.setupRealTimeUpdates();
        this.setupSearchFunctionality();
        this.addAnimations();
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
                this.getSampleProgressData() // Using sample data for now
            ]);

            this.renderDashboard(user, progress);
        } catch (error) {
            uiUtils.showNotification('Failed to load dashboard', 'error');
            console.error('Dashboard initialization error:', error);
        } finally {
            uiUtils.hideLoading(this.container);
        }
    }

    // Get sample progress data
    getSampleProgressData() {
        return {
            learning_paths_completed: 3,
            total_learning_paths: 5,
            courses_completed: 8,
            total_courses: 12,
            skills_mastered: 15,
            total_skills: 20,
            timeline: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                values: [10, 25, 40, 55, 65, 75, 80, 85, 90, 92, 95, 98]
            },
            upcoming_deadlines: [
                {
                    title: 'Complete Web Development Basics',
                    date: new Date(Date.now() + 2 * 24 * 60 * 60 * 1000),
                    type: 'course',
                    priority: 'high'
                },
                {
                    title: 'Submit Python Project',
                    date: new Date(Date.now() + 5 * 24 * 60 * 60 * 1000),
                    type: 'project',
                    priority: 'medium'
                },
                {
                    title: 'Complete Data Structures Assessment',
                    date: new Date(Date.now() + 7 * 24 * 60 * 60 * 1000),
                    type: 'assessment',
                    priority: 'high'
                }
            ],
            recent_activities: [
                {
                    type: 'course',
                    title: 'Advanced JavaScript',
                    progress: 75,
                    last_accessed: '2 hours ago',
                    category: 'Programming',
                    duration: '8 hours',
                    instructor: 'John Smith'
                },
                {
                    type: 'assessment',
                    title: 'Python Fundamentals',
                    score: 85,
                    date: 'Yesterday',
                    category: 'Programming',
                    total_questions: 50,
                    time_taken: '45 minutes'
                },
                {
                    type: 'learning_path',
                    title: 'Full Stack Development',
                    progress: 60,
                    last_accessed: '1 day ago',
                    total_courses: 6,
                    completed_courses: 4,
                    estimated_completion: '2 weeks'
                },
                {
                    type: 'course',
                    title: 'React Advanced Concepts',
                    progress: 45,
                    last_accessed: '3 days ago',
                    category: 'Web Development',
                    duration: '10 hours',
                    instructor: 'Sarah Johnson'
                },
                {
                    type: 'project',
                    title: 'E-commerce Website',
                    progress: 30,
                    last_accessed: '4 days ago',
                    category: 'Web Development',
                    due_date: '2 weeks',
                    team_size: 3
                }
            ],
            skill_levels: {
                labels: ['JavaScript', 'Python', 'HTML/CSS', 'React', 'Node.js', 'SQL', 'Git', 'Docker', 'AWS', 'TypeScript'],
                currentLevels: [4, 3, 5, 3, 2, 4, 4, 2, 1, 3],
                targetLevels: [5, 4, 5, 4, 3, 5, 5, 3, 2, 4]
            },
            achievements: [
                {
                    title: 'Fast Learner',
                    description: 'Completed 5 courses in one month',
                    date: 'Last month',
                    icon: '🏆'
                },
                {
                    title: 'Perfect Score',
                    description: 'Scored 100% in JavaScript Basics',
                    date: '2 weeks ago',
                    icon: '⭐'
                },
                {
                    title: 'Team Player',
                    description: 'Completed 3 group projects',
                    date: 'Last week',
                    icon: '🤝'
                }
            ],
            recommendations: [
                {
                    title: 'Advanced React Patterns',
                    type: 'course',
                    difficulty: 'Intermediate',
                    duration: '6 hours',
                    rating: 4.8,
                    students: 1200
                },
                {
                    title: 'System Design Fundamentals',
                    type: 'learning_path',
                    difficulty: 'Advanced',
                    duration: '20 hours',
                    rating: 4.9,
                    students: 800
                },
                {
                    title: 'DevOps Essentials',
                    type: 'course',
                    difficulty: 'Intermediate',
                    duration: '8 hours',
                    rating: 4.7,
                    students: 1500
                }
            ]
        };
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
        
        // Add recent activities section
        mainContent.appendChild(this.createRecentActivitiesSection(progress.recent_activities));
        
        // Add skill levels section
        mainContent.appendChild(this.createSkillLevelsSection(progress.skill_levels));

        // Add achievements section
        mainContent.appendChild(this.createAchievementsSection(progress.achievements));

        // Add recommendations section
        mainContent.appendChild(this.createRecommendationsSection(progress.recommendations));

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

    // Create progress overview with charts
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
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        `;

        // Add progress cards with charts
        const progressCards = [
            {
                title: 'Learning Paths',
                data: {
                    completed: progress.learning_paths_completed || 0,
                    total: progress.total_learning_paths || 0
                },
                color: '#007bff'
            },
            {
                title: 'Courses',
                data: {
                    completed: progress.courses_completed || 0,
                    total: progress.total_courses || 0
                },
                color: '#28a745'
            },
            {
                title: 'Skills',
                data: {
                    completed: progress.skills_mastered || 0,
                    total: progress.total_skills || 0
                },
                color: '#ffc107'
            }
        ];

        progressCards.forEach(card => {
            const progressCard = document.createElement('div');
            progressCard.className = 'progress-card';
            progressCard.dataset.type = card.title.toLowerCase().replace(' ', '_');
            progressCard.style.cssText = `
                background: white;
                border-radius: 8px;
                padding: 20px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            `;

            const cardTitle = document.createElement('h3');
            cardTitle.style.cssText = `
                margin-bottom: 15px;
                color: #2c3e50;
            `;
            cardTitle.textContent = card.title;

            const chartContainer = document.createElement('div');
            chartContainer.style.cssText = `
                height: 150px;
                margin-bottom: 10px;
            `;

            progressCard.appendChild(cardTitle);
            progressCard.appendChild(chartContainer);
            progressCard.appendChild(this.createProgressCard(card.data, card.color));
            progressGrid.appendChild(progressCard);

            // Create chart
            this.charts[card.title] = ChartUtils.createProgressChart(chartContainer, card.data, {
                color: card.color
            });
        });

        // Add timeline chart
        if (progress.timeline) {
            const timelineCard = document.createElement('div');
            timelineCard.style.cssText = `
                grid-column: 1 / -1;
                background: white;
                border-radius: 8px;
                padding: 20px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            `;

            const timelineTitle = document.createElement('h3');
            timelineTitle.style.cssText = `
                margin-bottom: 15px;
                color: #2c3e50;
            `;
            timelineTitle.textContent = 'Progress Timeline';

            const timelineContainer = document.createElement('div');
            timelineContainer.style.cssText = `
                height: 200px;
            `;

            timelineCard.appendChild(timelineTitle);
            timelineCard.appendChild(timelineContainer);
            progressGrid.appendChild(timelineCard);

            this.charts.timeline = ChartUtils.createTimelineChart(timelineContainer, progress.timeline);
        }

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
            transition: transform 0.2s ease;
        `;

        cardContent.addEventListener('mouseenter', () => {
            cardContent.style.transform = 'scale(1.05)';
        });

        cardContent.addEventListener('mouseleave', () => {
            cardContent.style.transform = 'scale(1)';
        });

        const progressValue = document.createElement('div');
        progressValue.className = 'progress-value';
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
            showLabel: false,
            className: 'progress-bar'
        });

        const progressLabel = document.createElement('div');
        progressLabel.className = 'progress-label';
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

    // Create recent activities section
    createRecentActivitiesSection(activities) {
        const section = document.createElement('div');
        section.className = 'recent-activities-section';
        section.style.cssText = `
            margin-bottom: 30px;
        `;

        const sectionTitle = document.createElement('h2');
        sectionTitle.style.cssText = `
            font-size: 20px;
            margin-bottom: 15px;
            color: #2c3e50;
        `;
        sectionTitle.textContent = 'Recent Activities';

        const activitiesList = document.createElement('div');
        activitiesList.style.cssText = `
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        `;

        activities.forEach(activity => {
            const activityCard = document.createElement('div');
            activityCard.className = 'activity-card';
            activityCard.style.cssText = `
                background: white;
                border-radius: 8px;
                padding: 20px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            `;

            const icon = document.createElement('div');
            icon.style.cssText = `
                font-size: 24px;
                margin-bottom: 10px;
                color: ${activity.type === 'course' ? '#007bff' : 
                        activity.type === 'assessment' ? '#28a745' : '#ffc107'};
            `;
            icon.textContent = activity.type === 'course' ? '📚' : 
                             activity.type === 'assessment' ? '📝' : '🎯';

            const title = document.createElement('h3');
            title.style.cssText = `
                margin-bottom: 10px;
                color: #2c3e50;
            `;
            title.textContent = activity.title;

            const details = document.createElement('div');
            details.style.cssText = `
                color: #6c757d;
                font-size: 14px;
            `;

            if (activity.progress) {
                const progressBar = uiUtils.createProgressBar(activity.progress, {
                    progressColor: activity.type === 'course' ? '#007bff' : '#ffc107',
                    height: '6px',
                    showLabel: false
                });
                details.appendChild(progressBar);
                details.innerHTML += `<div style="margin-top: 5px;">Progress: ${activity.progress}%</div>`;
            } else if (activity.score) {
                details.innerHTML += `<div>Score: ${activity.score}%</div>`;
            }

            details.innerHTML += `<div>Last accessed: ${activity.last_accessed || activity.date}</div>`;

            activityCard.appendChild(icon);
            activityCard.appendChild(title);
            activityCard.appendChild(details);
            activitiesList.appendChild(activityCard);
        });

        section.appendChild(sectionTitle);
        section.appendChild(activitiesList);
        return section;
    }

    // Create skill levels section
    createSkillLevelsSection(skillData) {
        const section = document.createElement('div');
        section.className = 'skill-levels-section';
        section.style.cssText = `
            margin-bottom: 30px;
        `;

        const sectionTitle = document.createElement('h2');
        sectionTitle.style.cssText = `
            font-size: 20px;
            margin-bottom: 15px;
            color: #2c3e50;
        `;
        sectionTitle.textContent = 'Skill Levels';

        const chartContainer = document.createElement('div');
        chartContainer.style.cssText = `
            height: 300px;
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        `;

        section.appendChild(sectionTitle);
        section.appendChild(chartContainer);

        // Create skill chart
        this.charts.skills = ChartUtils.createSkillChart(chartContainer, skillData);

        return section;
    }

    // Create achievements section
    createAchievementsSection(achievements) {
        const section = document.createElement('div');
        section.className = 'achievements-section';
        section.style.cssText = `
            margin-bottom: 30px;
        `;

        const sectionTitle = document.createElement('h2');
        sectionTitle.style.cssText = `
            font-size: 20px;
            margin-bottom: 15px;
            color: #2c3e50;
        `;
        sectionTitle.textContent = 'Recent Achievements';

        const achievementsGrid = document.createElement('div');
        achievementsGrid.style.cssText = `
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        `;

        achievements.forEach(achievement => {
            const achievementCard = document.createElement('div');
            achievementCard.className = 'achievement-card';
            achievementCard.style.cssText = `
                background: white;
                border-radius: 8px;
                padding: 20px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                display: flex;
                align-items: center;
                gap: 15px;
            `;

            const icon = document.createElement('div');
            icon.style.cssText = `
                font-size: 32px;
                background: #f8f9fa;
                width: 60px;
                height: 60px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            `;
            icon.textContent = achievement.icon;

            const content = document.createElement('div');
            content.style.cssText = `
                flex: 1;
            `;

            const title = document.createElement('h3');
            title.style.cssText = `
                margin: 0 0 5px 0;
                color: #2c3e50;
            `;
            title.textContent = achievement.title;

            const description = document.createElement('p');
            description.style.cssText = `
                margin: 0 0 5px 0;
                color: #6c757d;
                font-size: 14px;
            `;
            description.textContent = achievement.description;

            const date = document.createElement('div');
            date.style.cssText = `
                color: #adb5bd;
                font-size: 12px;
            `;
            date.textContent = achievement.date;

            content.appendChild(title);
            content.appendChild(description);
            content.appendChild(date);

            achievementCard.appendChild(icon);
            achievementCard.appendChild(content);
            achievementsGrid.appendChild(achievementCard);
        });

        section.appendChild(sectionTitle);
        section.appendChild(achievementsGrid);
        return section;
    }

    // Create recommendations section
    createRecommendationsSection(recommendations) {
        const section = document.createElement('div');
        section.className = 'recommendations-section';
        section.style.cssText = `
            margin-bottom: 30px;
        `;

        const sectionTitle = document.createElement('h2');
        sectionTitle.style.cssText = `
            font-size: 20px;
            margin-bottom: 15px;
            color: #2c3e50;
        `;
        sectionTitle.textContent = 'Recommended for You';

        const recommendationsGrid = document.createElement('div');
        recommendationsGrid.style.cssText = `
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        `;

        recommendations.forEach(recommendation => {
            const recommendationCard = document.createElement('div');
            recommendationCard.className = 'recommendation-card';
            recommendationCard.style.cssText = `
                background: white;
                border-radius: 8px;
                padding: 20px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            `;

            const typeBadge = document.createElement('span');
            typeBadge.style.cssText = `
                display: inline-block;
                padding: 4px 8px;
                background: #e9ecef;
                border-radius: 4px;
                font-size: 12px;
                color: #6c757d;
                margin-bottom: 10px;
            `;
            typeBadge.textContent = recommendation.type;

            const title = document.createElement('h3');
            title.style.cssText = `
                margin: 0 0 10px 0;
                color: #2c3e50;
            `;
            title.textContent = recommendation.title;

            const details = document.createElement('div');
            details.style.cssText = `
                color: #6c757d;
                font-size: 14px;
                margin-bottom: 15px;
            `;
            details.innerHTML = `
                <div>Difficulty: ${recommendation.difficulty}</div>
                <div>Duration: ${recommendation.duration}</div>
                <div>Rating: ${recommendation.rating} ⭐ (${recommendation.students} students)</div>
            `;

            const startButton = document.createElement('button');
            startButton.style.cssText = `
                background: #007bff;
                color: white;
                border: none;
                padding: 8px 16px;
                border-radius: 4px;
                cursor: pointer;
                font-size: 14px;
                transition: background-color 0.2s;
            `;
            startButton.textContent = 'Start Learning';
            startButton.addEventListener('mouseenter', () => {
                startButton.style.backgroundColor = '#0056b3';
            });
            startButton.addEventListener('mouseleave', () => {
                startButton.style.backgroundColor = '#007bff';
            });

            recommendationCard.appendChild(typeBadge);
            recommendationCard.appendChild(title);
            recommendationCard.appendChild(details);
            recommendationCard.appendChild(startButton);
            recommendationsGrid.appendChild(recommendationCard);
        });

        section.appendChild(sectionTitle);
        section.appendChild(recommendationsGrid);
        return section;
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

    // Setup real-time updates
    setupRealTimeUpdates() {
        // Update progress every 30 seconds
        setInterval(() => {
            if (this.currentView === 'overview') {
                this.updateProgress();
            }
        }, 30000);
    }

    // Setup search functionality
    setupSearchFunctionality() {
        const searchInput = document.createElement('input');
        searchInput.type = 'text';
        searchInput.placeholder = 'Search courses, learning paths...';
        searchInput.className = 'search-input';
        searchInput.style.cssText = `
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            font-size: 14px;
        `;

        searchInput.addEventListener('input', (e) => {
            this.filterContent(e.target.value);
        });

        // Add search input to the main content
        const mainContent = this.container.querySelector('.dashboard-main');
        if (mainContent) {
            mainContent.insertBefore(searchInput, mainContent.firstChild);
        }
    }

    // Filter content based on search
    filterContent(searchTerm) {
        const cards = this.container.querySelectorAll('.card');
        searchTerm = searchTerm.toLowerCase();

        cards.forEach(card => {
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            const description = card.querySelector('.card-content').textContent.toLowerCase();
            
            if (title.includes(searchTerm) || description.includes(searchTerm)) {
                card.style.display = 'block';
                card.classList.add('fade-in');
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Update progress
    async updateProgress() {
        try {
            const progress = await apiService.getOverallProgress();
            this.updateProgressCards(progress);
            this.checkUpcomingDeadlines(progress);
        } catch (error) {
            console.error('Progress update error:', error);
        }
    }

    // Update progress cards with charts
    updateProgressCards(progress) {
        const progressCards = this.container.querySelectorAll('.progress-card');
        progressCards.forEach(card => {
            const type = card.dataset.type;
            const chart = this.charts[type];
            if (chart) {
                const newValue = progress[`${type}_completed`] || 0;
                const total = progress[`total_${type}`] || 0;
                chart.data.datasets[0].data = [newValue, total - newValue];
                chart.update();
            }
        });

        // Update timeline chart if exists
        if (this.charts.timeline && progress.timeline) {
            this.charts.timeline.data.labels = progress.timeline.labels;
            this.charts.timeline.data.datasets[0].data = progress.timeline.values;
            this.charts.timeline.update();
        }
    }

    // Check upcoming deadlines
    checkUpcomingDeadlines(progress) {
        const upcomingDeadlines = progress.upcoming_deadlines || [];
        upcomingDeadlines.forEach(deadline => {
            const daysUntil = Math.ceil((new Date(deadline.date) - new Date()) / (1000 * 60 * 60 * 24));
            if (daysUntil <= 3) {
                this.showNotification(`Upcoming deadline: ${deadline.title} in ${daysUntil} days`, 'warning');
            }
        });
    }

    // Show notification
    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            background: ${type === 'warning' ? '#fff3cd' : '#d4edda'};
            color: ${type === 'warning' ? '#856404' : '#155724'};
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            z-index: 1000;
            animation: slideIn 0.3s ease-out;
        `;

        notification.textContent = message;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease-out';
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    }

    // Add CSS animations
    addAnimations() {
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            .fade-in {
                animation: fadeIn 0.3s ease-out;
            }
            .card {
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }
            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            }
        `;
        document.head.appendChild(style);
    }
}

// Initialize dashboard when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    const dashboard = new Dashboard();
}); 