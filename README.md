# InvestigacionAplicada1DSS
Api notas

Descripción del Proyecto

Este proyecto consiste en el desarrollo, empaquetado y despliegue de una API REST para la gestión de notas. La API está diseñada para ser escalable y altamente disponible, utilizando contenedores Docker y Kubernetes para su despliegue y administración.

Características Principales

API REST que expone endpoints para la gestión de notas en formato JSON.
Autenticación basada en JWT para proteger ciertos endpoints.
Manejo de errores con respuestas claras y estandarizadas.
Empaquetado en Docker con una imagen lista para desplegarse.
Despliegue en Kubernetes con al menos 2 réplicas.
Balanceo de carga mediante un Service de tipo LoadBalancer en Kubernetes.
Escalado horizontal con HorizontalPodAutoscaler basado en el uso de CPU.

Tecnologías Utilizadas:
PHP + Apache para la API.
MySQL como base de datos.
Docker para la contenedorización.
Docker Hub para el almacenamiento de la imagen.
Kubernetes para la orquestación y despliegue.

Archivos Clave
Dockerfile: Define la imagen Docker de la API.
docker-compose.yml: Configura los servicios en Docker.
docker-compose.override.yml: Configuración adicional para desarrollo.
deployment.yaml: Configura el Deployment en Kubernetes.
service.yaml: Define el Service con LoadBalancer en Kubernetes.
hpa.yaml: Configura el HorizontalPodAutoscaler.

Estado Final del Proyecto
El proyecto ha sido desplegado exitosamente en Kubernetes, cumpliendo con los requisitos de:

API REST funcional con autenticación.

Contenerización con Docker y publicación en Docker Hub.
Despliegue en Kubernetes con múltiples réplicas.
Balanceo de carga mediante un Service tipo LoadBalancer.
Escalado horizontal con HorizontalPodAutoscaler.

## contribución
Abner Leví Funes Navarro - FN242644
Jasmín Azucena García Flores - GF24264
Jeferson Edenilson Campos Rosales - CR241530
Francisco José Herrera Martínez -  HM221408
Heysel Guadalupe Argueta Hernandez - AH230907
José Manuel Reyes Echeverría - RE242138

## Videos

*Exposición*

https://www.youtube.com/watch?v=QGVU6Qo3Feg


*Explicación de la api*

https://drive.google.com/file/d/1E-1meapvXqLLU35UK6aGQVfyt6QID7Kz/view?usp=sharing
