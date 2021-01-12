Forum
==================================

[![CircleCI](https://circleci.com/gh/gustavfors/ramverk1-project.svg?style=svg)](https://circleci.com/gh/gustavfors/ramverk1-project)
[![Build Status](https://scrutinizer-ci.com/g/gustavfors/ramverk1-project/badges/build.png?b=master)](https://scrutinizer-ci.com/g/gustavfors/ramverk1-project/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gustavfors/ramverk1-project/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gustavfors/ramverk1-project/?branch=master)

This forum application was developed by Gufo19 as part of the course DV1610 aka web based frameworks and design patterns.

### How to install

prerequisites PHP, composer terminal, sqlite /sqlite cli

1. clone the project
```
git clone https://github.com/gustavfors/ramverk1-project
```

2. cd into project
```
cd ramverk1-project
```

3. create database
```
touch data/db.sqlite
chmod 666 data/db.sqlite
```

4. create db tables and fill with dummy data (if you dont want dummy data, remove it from the file)
```
sqlite3 data/db.sqlite < sql/seed.sql
```

5. install dependencies
```
make install
```

6. Serve on a server example built in php dev
```
server php -S localhost:8080
```
