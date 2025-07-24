#!/bin/bash

echo ""
echo "🩺 Docker Container Health Check"
echo "--------------------------------"

# Ambil daftar semua container yang aktif
containers=$(docker ps --format '{{.Names}} {{.ID}}')

# Loop setiap container
while read -r name id; do
    running_status=$(docker inspect -f '{{.State.Status}}' "$id")
    health_status=$(docker inspect -f '{{if .State.Health}}{{.State.Health.Status}}{{else}}N/A{{end}}' "$id")

    # Tampilkan
    echo "🔹 $name ($id)"
    echo -n "   ➤ Running Status : "

    # Tampilkan warna status "running"
    if [ "$running_status" = "running" ]; then
        echo -e "\033[1;32m$running_status\033[0m"  # green
    else
        echo -e "\033[1;31m$running_status\033[0m"  # red
    fi

    echo -n "   ➤ Health Status  : "
    case "$health_status" in
        healthy)
            echo -e "\033[1;32m$health_status ✅\033[0m" ;;
        unhealthy)
            echo -e "\033[1;31m$health_status ❌\033[0m" ;;
        starting)
            echo -e "\033[1;33m$health_status ⏳\033[0m" ;;
        N/A)
            echo -e "\033[1;34mNot configured\033[0m" ;;
        *)
            echo "$health_status" ;;
    esac

    echo ""
done <<< "$containers"
