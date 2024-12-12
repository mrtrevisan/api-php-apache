### PHP Apache Web Server and Nginx Proxy

### How it Works
Static files (HTML, CSS, JS) served from Nginx:  
-> public folder is ```app/```

Api requests are forwarded and handled by Apache Server (PHP):  
-> entrypoint is ```api/index.php```

### Dependencies
- Docker

### How to use:
Run:  
```
docker compose up --build
```