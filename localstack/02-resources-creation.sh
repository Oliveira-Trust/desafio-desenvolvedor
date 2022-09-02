#!bin/bash

aws --endpoint="http://localhost:4566" sns create-topic --name=user --profile=localstack
aws --endpoint="http://localhost:4566" sns create-topic --name=quotation --profile=localstack
aws --endpoint="http://localhost:4566" sns create-topic --name=notification --profile=localstack
aws --endpoint="http://localhost:4566" sns create-topic --name=test_topic --profile=localstack

aws --endpoint-url="http://localhost:4566" sns subscribe --topic-arn arn:aws:sns:sa-east-1:000000000000:notification --protocol https --notification-endpoint https://requestinspector.com/inspect/01gbympz8q7rw52zz0116cc0r0 --profile=localstack

aws --endpoint-url="http://localhost:4566" sns subscribe --topic-arn arn:aws:sns:sa-east-1:000000000000:notification --protocol http --notification-endpoint http://notification:2121/ --profile=localstack

aws --endpoint-url="http://localhost:4566" sns subscribe --topic-arn arn:aws:sns:sa-east-1:000000000000:notification --protocol http --notification-endpoint http://nginx-exchange:81/api --profile=localstack
