pipeline {
    agent any

    environment {
        APP_IMAGE = 'haseeb0440/hr-app:latest'
        WEB_IMAGE = 'haseeb0440/hr-web:latest'
    }

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Build Images') {
            steps {
                sh '''
docker build --target app -t $APP_IMAGE .
docker build --target web -t $WEB_IMAGE .
'''
            }
        }

        stage('Push to Docker Hub') {
            steps {
                withCredentials([usernamePassword(credentialsId: 'dockerhub-creds', usernameVariable: 'DH_USER', passwordVariable: 'DH_PASS')]) {
                    sh '''
echo "$DH_PASS" | docker login -u "$DH_USER" --password-stdin
docker push $APP_IMAGE
docker push $WEB_IMAGE
docker logout
'''
                }
            }
        }

        stage('Deploy to Kubernetes') {
            steps {
                sh '''
kubectl apply -f k8s/
kubectl rollout restart deployment/app deployment/web
kubectl rollout status deployment/db --timeout=300s
kubectl rollout status deployment/app --timeout=300s
kubectl rollout status deployment/web --timeout=300s
kubectl exec deploy/app -- php artisan migrate --force
'''
            }
        }

        stage('Verify') {
            steps {
                sh '''
for i in 1 2 3 4 5 6; do
  curl -fsS -o /dev/null -I http://localhost:30080 && exit 0
  sleep 5
done
exit 1
'''
            }
        }
    }
}
