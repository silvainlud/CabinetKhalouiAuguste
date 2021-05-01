#!/bin/bash
NOW=$(date +"%Y-%m-%d_%H%M%S")
FILE="cabinetkhalouiauguste.fr.$NOW.tar"
BACKUP_DIR="/home/ludwig/NaseraWodpress/Backups"
WWW_DIR="/home/ludwig/NaseraWodpress/data/"

DB_FILE="cabinetkhalouiauguste.fr.$NOW.sql"

docker-compose exec db bash -c 'export MYSQL_PWD=$MYSQL_PASSWORD && mysqldump -u$MYSQL_USER $MYSQL_DATABASE --no-tablespaces' > $DB_FILE
tar -cvf $BACKUP_DIR/$FILE --directory=$WWW_DIR wp
tar --append --file=$BACKUP_DIR/$FILE $DB_FILE

gzip -9 $BACKUP_DIR/$FILE
rm $DB_FILE