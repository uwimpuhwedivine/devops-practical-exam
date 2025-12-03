pipeline {
    agent any
    
    stages {
        stage('Build') {
            steps {
                echo "Build stage is running"
                sh 'docker-compose build'
            }
        }
        
        stage('Test') {
            steps {
                echo "Test stage is running"
                sh 'docker-compose up -d'
                sh 'sleep 30'
                sh 'docker-compose down'
            }
        }
        
        stage('Deploy') {
            steps {
                echo "Deploy stage is running"
                sh 'docker-compose up -d'
            }
        }
    }
    
    post {
        always {
            echo "Pipeline execution completed"
        }
    }
}
