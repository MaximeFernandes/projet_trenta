stack_name=projet_trenta

start:
	docker stack deploy -c docker-compose.yml $(stack_name)

stop:
	docker stack rm $(stack_name)

build:
	docker build -t $(stack_name)_php:7.2 -f .docker/Dockerfile --build-arg PHP_PORT=9000 --build-arg HOST_UID=1000 .docker