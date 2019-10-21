docker stop sarapp
docker rm sarapp
docker run -itd --name sarapp -p 8081:80 -e CI_ENV=production sarapp:v1
