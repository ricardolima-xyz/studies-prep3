# Dockerfile Security Best Practices
Here we’ll cover small but powerful habits to reduce attack surface, avoid secrets leaks, and harden containers.

## ✅ 1. Use Minimal Base Images
Use alpine, debian:slim, busybox, or language-specific minimal images.

```Dockerfile
FROM php:8.3-cli-alpine
```
Why? Smaller images = less stuff to attack.

## ✅ 2. Avoid Storing Secrets in Images
❌ Bad:

```Dockerfile
ENV DB_PASSWORD=supersecret
```
✅ Better:

Use Docker secrets (Swarm/K8s)

Use environment variables injected at runtime (e.g., in docker run or .env with Compose)

## ✅ 3. Drop Root Privileges
Switch to a non-root user:

```Dockerfile
RUN addgroup -S appgroup && adduser -S appuser -G appgroup
USER appuser
```
💡 Always do this after installing packages or modifying the system.

## ✅ 4. Reduce Layers and Clean Up
Minimize unnecessary tools and remove caches:

```Dockerfile
RUN apk add --no-cache git \
 && do-something \
 && apk del git
```
Or with apt:

```Dockerfile
RUN apt-get update \
 && apt-get install -y some-package \
 && rm -rf /var/lib/apt/lists/*
```
## ✅ 5. Avoid latest Tag in Production
Use specific tags to ensure deterministic builds:

```Dockerfile
FROM php:8.3.7-cli
```

## ✅ 6. Scan Images Frequently
Use tools like:

docker scan

Trivy

Grype

## ✅ 7. Multistage Builds
We already covered this, but it’s worth repeating: keep build tools out of production!