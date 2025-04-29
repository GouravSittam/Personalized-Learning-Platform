// API Service Module
class APIService {
    constructor() {
        this.baseUrl = '/api';
        this.auth = auth; // Reference to the Auth instance
    }

    // Helper method to get headers with authentication
    getHeaders() {
        const token = this.auth.getToken();
        return {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json'
        };
    }

    // Learning Paths API
    async getLearningPaths() {
        return await fetchAPI(`${this.baseUrl}/learning-paths`, {
            headers: this.getHeaders()
        });
    }

    async createLearningPath(data) {
        return await fetchAPI(`${this.baseUrl}/learning-paths`, {
            method: 'POST',
            headers: this.getHeaders(),
            body: JSON.stringify(data)
        });
    }

    async updateLearningPath(id, data) {
        return await fetchAPI(`${this.baseUrl}/learning-paths/${id}`, {
            method: 'PUT',
            headers: this.getHeaders(),
            body: JSON.stringify(data)
        });
    }

    async deleteLearningPath(id) {
        return await fetchAPI(`${this.baseUrl}/learning-paths/${id}`, {
            method: 'DELETE',
            headers: this.getHeaders()
        });
    }

    async markLearningPathComplete(id) {
        return await fetchAPI(`${this.baseUrl}/learning-paths/${id}/complete`, {
            method: 'POST',
            headers: this.getHeaders()
        });
    }

    async getLearningPathProgress(id) {
        return await fetchAPI(`${this.baseUrl}/learning-paths/${id}/progress`, {
            headers: this.getHeaders()
        });
    }

    // Courses API
    async getCourses() {
        return await fetchAPI(`${this.baseUrl}/courses`, {
            headers: this.getHeaders()
        });
    }

    async getCoursesByCategory(category) {
        return await fetchAPI(`${this.baseUrl}/courses/category/${category}`, {
            headers: this.getHeaders()
        });
    }

    async getCoursesByDifficulty(level) {
        return await fetchAPI(`${this.baseUrl}/courses/difficulty/${level}`, {
            headers: this.getHeaders()
        });
    }

    async createCourse(data) {
        return await fetchAPI(`${this.baseUrl}/courses`, {
            method: 'POST',
            headers: this.getHeaders(),
            body: JSON.stringify(data)
        });
    }

    async updateCourse(id, data) {
        return await fetchAPI(`${this.baseUrl}/courses/${id}`, {
            method: 'PUT',
            headers: this.getHeaders(),
            body: JSON.stringify(data)
        });
    }

    async deleteCourse(id) {
        return await fetchAPI(`${this.baseUrl}/courses/${id}`, {
            method: 'DELETE',
            headers: this.getHeaders()
        });
    }

    async toggleCourseActive(id) {
        return await fetchAPI(`${this.baseUrl}/courses/${id}/toggle-active`, {
            method: 'POST',
            headers: this.getHeaders()
        });
    }

    // Progress Tracking API
    async getProgressTracking() {
        return await fetchAPI(`${this.baseUrl}/progress-tracking`, {
            headers: this.getHeaders()
        });
    }

    async getProgressByLearningPath(learningPathId) {
        return await fetchAPI(`${this.baseUrl}/progress-tracking/learning-path/${learningPathId}`, {
            headers: this.getHeaders()
        });
    }

    async getOverallProgress() {
        return await fetchAPI(`${this.baseUrl}/progress-tracking/overall`, {
            headers: this.getHeaders()
        });
    }

    async updateProgress(id, data) {
        return await fetchAPI(`${this.baseUrl}/progress-tracking/${id}`, {
            method: 'PUT',
            headers: this.getHeaders(),
            body: JSON.stringify(data)
        });
    }

    // Skill Assessment API
    async getSkillAssessments() {
        return await fetchAPI(`${this.baseUrl}/skill-assessments`, {
            headers: this.getHeaders()
        });
    }

    async createSkillAssessment(data) {
        return await fetchAPI(`${this.baseUrl}/skill-assessments`, {
            method: 'POST',
            headers: this.getHeaders(),
            body: JSON.stringify(data)
        });
    }

    async getSkillHistory(skillName) {
        return await fetchAPI(`${this.baseUrl}/skill-assessments/skill/${skillName}/history`, {
            headers: this.getHeaders()
        });
    }

    async getLatestAssessments() {
        return await fetchAPI(`${this.baseUrl}/skill-assessments/latest`, {
            headers: this.getHeaders()
        });
    }

    async getSkillLevels() {
        return await fetchAPI(`${this.baseUrl}/skill-assessments/levels`, {
            headers: this.getHeaders()
        });
    }
}

// Initialize API service instance
const apiService = new APIService(); 