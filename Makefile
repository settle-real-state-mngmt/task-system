install: composer-install cp-env run generate-key generate-jwt-secret add-data

composer-install:
	docker run --rm \
		-u "$(shell id -u):$(shell id -g)" \
		-v $(PWD):/var/www/html \
		-w /var/www/html \
		laravelsail/php83-composer:latest \
		composer install --ignore-platform-reqs

cp-env:
	cp .env.example .env

run:
	./vendor/bin/sail up -d

generate-key:
	./vendor/bin/sail artisan key:generate

generate-jwt-secret:
	./vendor/bin/sail artisan jwt:secret

add-data:
	./vendor/bin/sail artisan migrate && ./vendor/bin.sail artisan db:seed