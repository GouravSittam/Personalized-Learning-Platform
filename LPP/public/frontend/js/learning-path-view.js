// Learning Path View Component
class LearningPathView {
    constructor(container) {
        this.container = container;
        this.currentPathId = null;
    }

    // Initialize learning path view
    async initialize(pathId) {
        this.currentPathId = pathId;
        try {
            uiUtils.showLoading(this.container);
            
            // Get learning path details and progress
            const [pathDetails, progress] = await Promise.all([
                apiService.getLearningPath(pathId),
                apiService.getLearningPathProgress(pathId)
            ]);

            this.renderLearningPath(pathDetails, progress);
        } catch (error) {
            uiUtils.showNotification('Failed to load learning path', 'error');
            console.error('Learning path initialization error:', error);
        } finally {
            uiUtils.hideLoading(this.container);
        }
    }

    // Render learning path
    renderLearningPath(path, progress) {
        this.container.innerHTML = '';
        
        // Create header section
        const header = document.createElement('div');
        header.className = 'learning-path-header';
        header.style.cssText = `
            margin-bottom: 30px;
        `;

        const title = document.createElement('h1');
        title.style.cssText = `
            font-size: 28px;
            margin-bottom: 10px;
            color: #2c3e50;
        `;
        title.textContent = path.title;

        const description = document.createElement('p');
        description.style.cssText = `
            color: #6c757d;
            margin-bottom: 20px;
            line-height: 1.6;
        `;
        description.textContent = path.description;

        const metaInfo = document.createElement('div');
        metaInfo.style.cssText = `
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        `;

        const difficulty = document.createElement('div');
        difficulty.innerHTML = `
            <span style="color: #6c757d;">Difficulty:</span>
            <span style="font-weight: bold;">${path.difficulty_level}</span>
        `;

        const duration = document.createElement('div');
        duration.innerHTML = `
            <span style="color: #6c757d;">Duration:</span>
            <span style="font-weight: bold;">${path.estimated_duration} hours</span>
        `;

        metaInfo.appendChild(difficulty);
        metaInfo.appendChild(duration);
        header.appendChild(title);
        header.appendChild(description);
        header.appendChild(metaInfo);

        // Add progress section
        const progressSection = document.createElement('div');
        progressSection.className = 'learning-path-progress';
        progressSection.style.cssText = `
            margin-bottom: 30px;
        `;

        const progressTitle = document.createElement('h2');
        progressTitle.style.cssText = `
            font-size: 20px;
            margin-bottom: 15px;
            color: #2c3e50;
        `;
        progressTitle.textContent = 'Your Progress';

        const progressBar = uiUtils.createProgressBar(progress.percentage || 0, {
            height: '20px',
            showLabel: true
        });

        progressSection.appendChild(progressTitle);
        progressSection.appendChild(progressBar);

        // Add courses section
        const coursesSection = document.createElement('div');
        coursesSection.className = 'learning-path-courses';
        coursesSection.style.cssText = `
            margin-bottom: 30px;
        `;

        const coursesTitle = document.createElement('h2');
        coursesTitle.style.cssText = `
            font-size: 20px;
            margin-bottom: 15px;
            color: #2c3e50;
        `;
        coursesTitle.textContent = 'Courses in this Path';

        const coursesList = document.createElement('div');
        coursesList.style.cssText = `
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        `;

        // Add courses
        path.courses.forEach(course => {
            const courseCard = this.createCourseCard(course, progress);
            coursesList.appendChild(courseCard);
        });

        coursesSection.appendChild(coursesTitle);
        coursesSection.appendChild(coursesList);

        // Add learning goals section
        const goalsSection = document.createElement('div');
        goalsSection.className = 'learning-path-goals';
        goalsSection.style.cssText = `
            margin-bottom: 30px;
        `;

        const goalsTitle = document.createElement('h2');
        goalsTitle.style.cssText = `
            font-size: 20px;
            margin-bottom: 15px;
            color: #2c3e50;
        `;
        goalsTitle.textContent = 'Learning Goals';

        const goalsList = document.createElement('ul');
        goalsList.style.cssText = `
            list-style: none;
            padding: 0;
        `;

        path.learning_goals.forEach(goal => {
            const goalItem = document.createElement('li');
            goalItem.style.cssText = `
                padding: 10px;
                background: white;
                border-radius: 4px;
                margin-bottom: 10px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            `;
            goalItem.textContent = goal;
            goalsList.appendChild(goalItem);
        });

        goalsSection.appendChild(goalsTitle);
        goalsSection.appendChild(goalsList);

        // Add all sections to container
        this.container.appendChild(header);
        this.container.appendChild(progressSection);
        this.container.appendChild(coursesSection);
        this.container.appendChild(goalsSection);
    }

    // Create course card
    createCourseCard(course, progress) {
        const courseProgress = progress.courses.find(c => c.id === course.id) || { percentage: 0 };
        
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
                <div style="margin-bottom: 15px;">
                    <span style="color: #6c757d;">Progress:</span>
                    ${uiUtils.createProgressBar(courseProgress.percentage, {
                        height: '10px',
                        showLabel: true
                    }).outerHTML}
                </div>
            `,
            footer: uiUtils.createButton(
                courseProgress.percentage === 100 ? 'Review Course' : 'Continue Course',
                {
                    onClick: () => this.startCourse(course.id)
                }
            )
        });

        return card;
    }

    // Start course
    startCourse(courseId) {
        // Implement course start
        console.log('Start course:', courseId);
        // You can implement course viewer here or navigate to course page
    }
}

// Initialize learning path view when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('learning-path-view');
    if (container) {
        const pathId = new URLSearchParams(window.location.search).get('id');
        if (pathId) {
            const learningPathView = new LearningPathView(container);
            learningPathView.initialize(pathId);
        }
    }
}); 