# PHP Exercises

A collection of PHP exercises.

## Requirements

- PHP >= 8.1
- exads/ab-test-data ^1.0
- vlucas/phpdotenv ^5.5

## Installation

### Option 1: Clone the GitHub repository

1. Clone the GitHub repository:

```bash
git clone https://github.com/edgardnogueira/php-exercises.git
```

2. Change to the project directory:

```bash
cd php-exercises
```

3. Install the dependencies using Composer:

```bash
composer install
```

### Option 2: Install using Composer

1. Install the project using Composer:

```bash
composer create-project edgardnogueira/php-exercises
```

2. Change to the project directory:

```bash
cd php-exercises
```

## Configuration

1. Copy the `.env_example` file to a new file called `.env`:

```bash
cp .env_example .env
```

2. Update the `.env` file with the appropriate configuration values for your environment.

3. Import the `database/database.sql` file into your database.

## Usage

To run the exercises, use a web server like Apache or Nginx to serve the `public` directory of the project.

For example, if you have PHP's built-in web server installed, you can use the following command to serve the `public` directory on port 8000:

```bash
php -S localhost:8000 -t public
```

Then, open a web browser and navigate to `http://localhost:8000` to access the exercises.

## License

This project is licensed under the MIT License.
</pre>
Simply copy and paste the content inside the <pre> tags into your README.md file.