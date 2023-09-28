# Test task with Redmine

This is the README file for my project. It provides instructions and information about how to set up and run the project.

## Getting Started

These instructions will help you get the project up and running on your local machine for development and testing purposes.

### Prerequisites

Before you begin, make sure you have the following software installed:

- [PHP](https://www.php.net/)
- [Node.js](https://nodejs.org/)
- [Docker](https://www.docker.com/)

### Installation

1. **Clone this repository** to your local machine:

   ```bash
   git clone https://github.com/your-username/your-project.git
   cd your-project

### Install PHP dependencies:

    composer install

### Install JavaScript dependencies:

    npm install


###Running the Application
1. Start the PHP Development Server

To run the PHP development server, use the following command:

    php artisan serve

This will start the server, and you can access the application in your web browser at http://localhost:8000.

2. Compile JavaScript and CSS Assets

To compile JavaScript and CSS assets, use the following command:

    npm run dev


This will compile your assets for development.

3. Start Docker Containers

To start Docker containers for your project, use the following command:

    docker-compose up -d

This will launch the required services defined in your docker-compose.yml file.

###ENV configuration

1. For Redmine:
    ```bash
    READMINE_BASE_URL=
    READMINE_API_KEY=
2. For change source
    ```bash
    #DATA_SOURCE=redmine
    DATA_SOURCE=database
