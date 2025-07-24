#!/bin/bash

echo "🩺 Docker Container Health Check"
echo "--------------------------------"

# List semua container aktif
containers=$(docker ps --format "{{.ID}} {{.Names}}")

if [ -z "$containers" ]; then
    echo "❌ Tidak ada container yang sedang berjalan."
    exit 1
fi

# Loop dan cek status setiap container
while read -r container_id container_name; do
    health_status=$(docker inspect --format='{{if .State.Health}}{{.State.Health.Status}}{{else}}N/A{{end}}' "$container_id")
    running_status=$(docker inspect --format='{{.State.Status}}' "$container_id")

    echo "🔹 $container_name ($container_id)"
    echo "   ➤ Running Status : $running_status"
    echo "   ➤ Health Status  : $health_status"
    echo ""
done <<< "$containers"
