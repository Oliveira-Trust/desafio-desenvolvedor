FROM python:3.10-slim

# Install dependencies
RUN pip install --no-cache-dir pymongo pandas watchdog

WORKDIR /app

# Copy worker files into the container
COPY ./python/worker /app

# Run the worker
CMD ["python", "main.py"]

