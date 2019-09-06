docker run -it --rm --name sarapp -p 8081:80 -e CI_ENV=development -v $(pwd):/var/www/html sarapp:v1
