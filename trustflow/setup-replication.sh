#!/bin/bash

echo "Aguardando MySQL iniciar..."
sleep 10

# Obter informações do master usando performance_schema
MASTER_INFO=$(docker exec trustflow-mysql-1 mysql -u root -ppassword -sN -e "
SELECT FILE_NAME, POSITION 
FROM performance_schema.log_status 
WHERE CHANNEL_NAME = 'group_replication_applier' 
LIMIT 1;")

# Se não funcionar, usa método alternativo
if [ -z "$MASTER_INFO" ]; then
    MASTER_INFO=$(docker exec trustflow-mysql-1 mysql -u root -ppassword -sN -e "
    SELECT @@GLOBAL.log_bin_basename, @@GLOBAL.log_bin_index;")
    
    # Pega o último binlog
    LOG_FILE=$(docker exec trustflow-mysql-1 mysql -u root -ppassword -sN -e "SHOW BINARY LOGS;" | tail -1 | awk '{print $1}')
    LOG_POS=$(docker exec trustflow-mysql-1 mysql -u root -ppassword -sN -e "SHOW BINARY LOGS;" | tail -1 | awk '{print $2}')
else
    LOG_FILE=$(echo $MASTER_INFO | awk '{print $1}')
    LOG_POS=$(echo $MASTER_INFO | awk '{print $2}')
fi

echo "Master Log File: $LOG_FILE"
echo "Master Log Pos: $LOG_POS"

# Configurar replicação na réplica
docker exec trustflow-mysql_replica-1 mysql -u root -ppassword -e "
STOP SLAVE;
CHANGE MASTER TO
    MASTER_HOST='mysql',
    MASTER_USER='root',
    MASTER_PASSWORD='password',
    MASTER_LOG_FILE='$LOG_FILE',
    MASTER_LOG_POS=$LOG_POS;
START SLAVE;"

# Verificar status
echo "Verificando status da réplica..."
docker exec trustflow-mysql_replica-1 mysql -u root -ppassword -e "SHOW SLAVE STATUS\G" | grep -E "Slave_IO_Running|Slave_SQL_Running|Last_Error"

echo "Replicação configurada!"
