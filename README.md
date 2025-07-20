# Setting up

You need to download a model after docker compose up
run for examle ollama pull llama3 inside the container

Frontend test: docker compose run --rm node npm run test

DB Migration related commands:

- docker compose run --rm dbmate status
- docker compose run --rm dbmate new <name>
- docker compose run --rm dbmate migrate
- docker compose run --rm dbmate rollback

## Background history
