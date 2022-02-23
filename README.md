# Homework

Composer version 2.2.6 

Docker version 20.10.12, build e91ed57

Docker-compose version 1.27.4

Backend: Symfony 5.4, PHP 7.4.27, mariadb:10.2.41

Frontend: React 17, node 16, typescript 4.5

### 1. LOCAL ENVIRONMENT

#### 1.2 START

Setup /etc/hosts:
```bash
cat >>/etc/hosts <<EOF
127.0.0.1 local1.homework.lh
EOF
```

Start the app:

```bash
$ ./docker-ci/local1-up.sh
```

Access the app in your browser: [http://local1.homework.lh](http://local1.homework.lh)


Access the docker backend app
```bash
$ ./docker-ci/ssh-backend.sh
```

Access the docker frontend app
```bash
$ ./docker-ci/ssh-frontend.sh
```

Run full-set tests on backend
```bash
$ ./docker-ci/ssh-full-set-test.sh
```

Run migrations on backend
```bash
$ ./docker-ci/ssh-migration.sh
```

#### 1.3 STOP

Stop the app (keeping the persistence):

```bash
$ ./docker-ci/local1-down.sh
```

