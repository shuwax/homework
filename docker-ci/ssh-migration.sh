#!/usr/bin/env bash
docker exec -it backend php bin/console doctrine:migrations:migrate -n
docker exec -it backend php bin/console doctrine:migrations:migrate -n --env=test