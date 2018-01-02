## Architecture overview

### Check Documentation at [VendaMais](https://github.com/socialbase/issues/wiki/VendaMais)

Basic characteristics:
- RESTFull API
- MongoDB as main data repository

## Endpoints

- /users
- /materials
- /products
- /pitches

## Docker

- Exposed PORT 80
- Run command:
  ```
  # docker run -d --rm --name "vm-backend" -p "8000:80" 832266673134.dkr.ecr.us-east-1.amazonaws.com/socialbase/vm-backend:latest
  ```
## Cheat sheet

- Build command

php bin/console server:run

- Lint command
- Unit tests

# References

- Main documentation:
https://github.com/socialbase/vm-issues/wiki
