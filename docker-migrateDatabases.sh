#!/usr/bin/env bash
  cd backend
 php bin/console doctrine:migrations:migrate -n
 php bin/console doctrine:migrations:migrate -n --env=test