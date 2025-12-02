pipeline {
    agent any
    
    environment {
        DOCKER_REGISTRY = 'localhost:5000'
        IMAGE_NAME = '25RP20136-shareride'
        CONTAINER_NAME = '25RP20136-shareride-container'
    }
    
    stages {
        stage('Checkout') {
            steps {
                echo "Checkout stage is running"
                git branch: 'main',
                    url: 'https://github.com/uwimpuhwedivine/devops-practical-exam.git'
                sh 'ls -la'
            }
        }
        
        stage('Code Quality Check') {
            steps {
                echo "Code Quality Check stage is running"
                sh '''
                    echo "Checking PHP syntax..."
                    find src -name "*.php" -exec php -l {} \\;
                    echo "Checking for required files..."
                    [ -f src/index.php ] && echo "✓ index.php found"
                    [ -f src/registration.php ] && echo "✓ registration.php found"
                    [ -f src/login.php ] && echo "✓ login.php found"
                    [ -f Dockerfile ] && echo "✓ Dockerfile found"
                    [ -f docker-compose.yml ] && echo "✓ docker-compose.yml found"
                '''
            }
        }
        
        stage('Build Docker Image') {
            steps {
                echo "Build Docker Image stage is running"
                sh '''
                    echo "Building Docker image..."
                    docker build -t ${IMAGE_NAME}:${BUILD_NUMBER} .
                    docker tag ${IMAGE_NAME}:${BUILD_NUMBER} ${IMAGE_NAME}:latest
                '''
            }
        }
        
        stage('Test Application') {
            steps {
                echo "Test Application stage is running"
                sh '''
                    echo "Starting containers for testing..."
                    docker-compose up -d
                    sleep 15
                    
                    echo "Checking web service..."
                    curl -f http://localhost:3000 || echo "Web service check failed"
                    
                    echo "Checking database connection..."
                    docker-compose exec -T db mysql -uroot -ppassword -e "SHOW DATABASES;" || echo "Database check failed"
                    
                    echo "Stopping test containers..."
                    docker-compose down
                '''
            }
        }
        
        stage('Deploy to Test Environment') {
            steps {
                echo "Deploy to Test Environment stage is running"
                sh '''
                    echo "Deploying application..."
                    docker-compose -f docker-compose.yml up -d
                    
                    echo "Waiting for services to start..."
                    sleep 10
                    
                    echo "Checking deployment status..."
                    docker ps --format "table {{.Names}}\t{{.Status}}\t{{.Ports}}"
                    
                    echo "Application URL: http://localhost:3000"
                '''
            }
        }
    }
    
    post {
        always {
            echo "Pipeline execution completed"
            sh '''
                echo "Cleaning up..."
                docker-compose down || true
                docker system prune -f || true
            '''
        }
        success {
            echo "✅ Pipeline succeeded!"
            emailext (
                subject: "Pipeline Success: ${env.JOB_NAME} - Build ${env.BUILD_NUMBER}",
                body: "The ${env.JOB_NAME} pipeline succeeded.\\n\\nBuild URL: ${env.BUILD_URL}",
                to: 'admin@example.com'
            )
        }
        failure {
            echo "❌ Pipeline failed!"
            emailext (
                subject: "Pipeline Failed: ${env.JOB_NAME} - Build ${env.BUILD_NUMBER}",
                body: "The ${env.JOB_NAME} pipeline failed.\\n\\nCheck: ${env.BUILD_URL}console",
                to: 'admin@example.com'
            )
        }
    }
}
