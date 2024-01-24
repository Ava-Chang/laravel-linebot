# Laravel Linebot 🤖

## Table of Contents

- [Laravel Linebot 🤖](#laravel-linebot-)
  - [Table of Contents](#table-of-contents)
  - [Description](#description)
  - [Setting on dev](#setting-on-dev)
  - [License](#license)

## Description

Simple reply Linebot with Laravel & OpenAI API

## Setting on dev

1. Clone the repository.

   ```sh
   git clone https://github.com/Ava-Chang/laravel-linebot.git
   ```

2. Configure the application settings.

   ```sh
   cp .env.example .env
   ```

   Update the `.env` file with your desired settings,
   especially for `OPEN_AI_API_KEY` `LINE_CHANNEL_ACCESSTOKEN` `LINE_CHANNEL_SECRET`.

   **This project doesn't use any database. The database setting is default to SQLite.**

   **If you are using WSL2, please follow step 3; otherwise, you can skip to step 4.**

3. build docker image, find your WSL2 UID and GID, replace the DOCKER_UID below.

    **Make sure that the values of DOCKER_UID and DOCKER_GID in your .env file match those in the command below.**

    ```sh
    docker build -f dockerfile-dev --build-arg DOCKER_UID=${YOUR_DOCKER_UID} -t laravel-linebot .
    ```

4. Start the application.

    ```sh
    docker-compose up
    ```

## License

This project is licensed under the [MIT License](LICENSE).
