# Blog Platform

An application that aims to have a social connection between users who have a visionary approach in life. Users can upload images, titles, and creative descriptions and engage with each other through comments to share their thoughts and ideas.

## Getting Started

### Prerequisites
Before running the application locally, ensure you have the following installed and configured:
* [Node.js](https://nodejs.org/en) - to download and be able to run React.js framework
* [PHP](https://www.php.net/downloads.php) - to download and be able to run Laravel framework

### Installation
* Clone the repository
```
git clone <repository_url>
cd <project_folder>
```
* Install dependencies
```
composer install
npm install
```
* Configure environment variables
```
DATABASE_URL=your_supabase_database_url
SUPABASE_URL=your_supabase_url
SUPABASE_ANON_KEY=your_anon_key
SUPABASE_PUBLIC_URL=your_storage_public_url
```
* Run the application
```
php artisan serve
npm run dev
```

### Reminders
This project heavily relies on a Supabase database, authentication, and storage as backend. Before running the application, you must have an active Supabase project with the appropriate database schema configured.

