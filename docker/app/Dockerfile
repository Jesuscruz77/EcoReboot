# Partimos de una imagen base de Ubuntu
FROM ubuntu:22.04

# Instalar dependencias básicas
RUN apt-get update && apt-get install -y \
    apache2 \
    php \
    libapache2-mod-php \
    php-mysqli \
    python3 \
    python3-pip \
    python3-venv \
    supervisor \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Configurar Apache (opcional, si requieres cambiar DocumentRoot, etc.)
# Por defecto se usará /var/www/html

# Configurar Python: crear entorno virtual para FastAPI
WORKDIR /app
RUN python3 -m venv env && \
    /app/env/bin/pip install --upgrade pip && \
    /app/env/bin/pip install fastapi uvicorn[standard] databases[asyncmy] sqlalchemy

# Copiamos el código de FastAPI (esto depende de tu estructura)
# También puedes montar la carpeta desde docker-compose en lugar de copiar
# COPY ../api_fastapi /app

# Configurar Supervisor
RUN mkdir -p /var/log/supervisor
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Exponer puertos: 80 para Apache, 8000 para FastAPI (aunque ambos se administran internamente)
EXPOSE 80 8000

# Iniciar Supervisor, que lanzará Apache y Uvicorn
CMD ["/usr/bin/supervisord", "-n"]
