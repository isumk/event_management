# Event Management Software

## Introduction
This Event Management Software is designed to streamline the organization, planning, and execution of events. It provides features for event scheduling, participant management, venue booking, and resource allocation. Built on the Laravel framework, it aims to make event management more efficient and user-friendly.

## Table of Contents
1. [Installation](#installation)
2. [Usage](#usage)
3. [Features](#features)
4. [Dependencies](#dependencies)
5. [Configuration](#configuration)
6. [Documentation](#documentation)
7. [Examples](#examples)
8. [Troubleshooting](#troubleshooting)
9. [Contributors](#contributors)
10. [License](#license)

## Installation

### Prerequisites
Before you begin, ensure you have the following installed on your local machine:

- PHP (>= 7.4)
- Composer (PHP package manager)
- Node.js and npm (for managing front-end dependencies)
- A MySQL database

### Steps
1. Clone the repository:
    ```bash
    git clone https://github.com/yourusername/event-management.git
    cd event-management
    ```

2. Install PHP dependencies:
    ```bash
    composer install
    ```

3. Set up your environment:
    Copy the `.env.example` file to `.env` and configure the necessary database and application settings.
    ```bash
    cp .env.example .env
    ```

4. Generate the application key:
    ```bash
    php artisan key:generate
    ```

5. Run the migrations to set up the database:
    ```bash
    php artisan migrate
    ```

6. Install front-end dependencies:
    ```bash
    npm install
    ```

7. Compile the front-end assets:
    ```bash
    npm run dev
    ```

8. Serve the application:
    ```bash
    php artisan serve
    ```

Now, you can access the application at `http://localhost:8000`.

## Usage

Once the application is up and running, you can start managing your events, participants, and venues. 

1. Log in as an admin or user (depending on your role).
2. Create a new event, specifying details such as date, time, venue, and description.
3. Add participants and assign roles to them.
4. Track event progress and make adjustments as necessary.

For more detailed usage, refer to the [Documentation](#documentation) section.

## Features

- **Event Creation**: Create and manage events with detailed information such as title, description, date, time, and location.
- **Participant Management**: Add participants to events, assign them roles, and track attendance.
- **Venue Booking**: Book and manage venues for events.
- **Notification System**: Notify participants about event changes or updates via email or app notifications.
- **Reporting**: Generate reports on event statistics, attendance, and more.
- **Authentication**: User authentication and role management (Admin, User).
  
## Dependencies

- **Laravel**: PHP framework used for back-end development.
- **MySQL**: Database for storing event and user data.
- **Node.js** and **npm**: For managing front-end dependencies and assets.
- **Tailwind CSS**: Utility-first CSS framework for styling.
- **PHPUnit**: For running tests.

## Configuration

In the `.env` file, you can configure various application settings such as:

- **Database**: Set your MySQL database connection settings.
- **Mail**: Configure mail settings for sending notifications.
- **App settings**: Set the app name, environment, and other settings.
  
Example configuration in `.env`:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=event_management
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

## Documentation

For more detailed documentation on setting up, using, and customizing the software, refer to the [full documentation](#).

## Examples

Below are a few examples of how to create events, manage participants, and use the notification system:

### Example: Creating an Event
1. Navigate to the "Events" section.
2. Click "Create New Event."
3. Fill in the details such as title, description, date, and venue.

### Example: Adding a Participant
1. After creating an event, go to the "Participants" section.
2. Click "Add Participant" and select from your user list.
3. Assign roles and confirm.

## Troubleshooting

- **Issue**: Application is not loading.
  - **Solution**: Ensure all dependencies are installed, and the database is properly configured.
  
- **Issue**: Cannot send email notifications.
  - **Solution**: Check the mail configuration in the `.env` file and ensure your SMTP settings are correct.

## Contributors

This project is maintained by:
- [Your Name](https://github.com/yourusername)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
