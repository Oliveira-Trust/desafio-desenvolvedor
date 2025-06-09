#!/bin/bash

echo "Criando bucket S3: 'meu-bucket-local'..."
aws s3 mb s3://${AWS_BUCKET}
