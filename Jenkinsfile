pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Prepare Settings') {
            steps {
                sh '''
if [ ! -f .env ]; then
  KEY="base64:$(openssl rand -base64 32)"
  {
    echo "APP_NAME=HRManagementSystem"
    echo "APP_ENV=production"
    echo "APP_KEY=$KEY"
    echo "APP_DEBUG=false"
    echo "APP_URL=http://localhost"
    echo "DB_CONNECTION=mysql"
    echo "DB_HOST=db"
    echo "DB_PORT=3306"
    echo "DB_DATABASE=hrmanagementsystem"
    echo "DB_USERNAME=hruser"
    echo "DB_PASSWORD=hrpass123"
    echo "SESSION_DRIVER=database"
    echo "CACHE_STORE=database"
    echo "QUEUE_CONNECTION=database"
  } > .env
fi
'''
            }
        }

        stage('Build Images') {
            steps {
                sh 'docker compose build app web'
            }
        }

        stage('Push to Docker Hub') {
            steps {
                withCredentials([usernamePassword(credentialsId: 'dockerhub-creds', usernameVariable: 'DH_USER', passwordVariable: 'DH_PASS')]) {
                    sh '''
echo "$DH_PASS" | docker login -u "$DH_USER" --password-stdin
docker compose push app web
docker logout
'''
                }
            }
        }

        stage('Deploy') {
            steps {
                sh '''
docker compose pull app web
docker compose up -d
sleep 15
docker compose exec -T app php artisan migrate --force
'''
            }
        }

        stage('Verify') {
            steps {
                sh '''
for i in 1 2 3 4 5 6; do
  curl -fsS -o /dev/null -I http://localhost && exit 0
  sleep 5
done
exit 1
'''
            }
        }
    }
}
