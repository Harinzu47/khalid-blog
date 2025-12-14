# IMM FT UMJ Web Platform

**Khalid Blog** is a web-based platform designed for **Ikatan Mahasiswa Muhammadiyah (IMM) Fakultas Teknik UMJ**. This application serves as a digital hub for students to organize, share ideas through articles, and showcase organizational activities.

![IMM Banner](public/img/logo-imm-ft-umj.png)

## 🚀 About The Project

This project aims to provide a digital space for IMM FT UMJ members to:
- **Share Knowledge:** Write and publish articles/posts.
- **Showcase Activities:** A dynamic gallery of organizational events.
- **Engage:** Comment and discuss on various topics.
- **Manage Organization:** Admin tools to oversee users and content.

## ✨ Key Features

### 🌍 Public Interface
- **Home & About Pages:** Information about IMM vision, mission, and values.
- **Activity Gallery:** Interactive carousel demonstrating recent events.
- **Article Reading:** Browse and read posts from members.
- **Comments:** Engage with content (requires login).

### 🔐 Authentication & Roles
- **Secure Login/Register:** Built with Laravel Breeze.
- **Role-Based Access:** Distinctions between regular Users and Admins.
- **Profile Management:** Update user details and avatars.

### 📝 Dashboard (User)
- **Content Creation:** Write, edit, and delete personal posts.
- **Rich Text Editing:** (If applicable, generalized description).
- **Post Management:** View status of submitted writings.

### 🛡️ Admin Panel
- **User Management:** Oversee registered members.
- **Post & Category Management:** Control content organization.
- **Comment Moderation:** Publish, hide, or delete comments to maintain community standards.

## 🛠️ Technology Stack

### Backend
- **Framework:** [Laravel 12](https://laravel.com)
- **Language:** PHP 8.2+
- **Database:** SQLite (Default) / MySQL

### Frontend
- **Styling:** [Tailwind CSS v4](https://tailwindcss.com)
- **Components:** [Flowbite](https://flowbite.com)
- **Interactivity:** [Alpine.js](https://alpinejs.dev)
- **Templating:** Laravel Blade

### Real-Time & Utilities
- **Real-Time:** Pusher & Laravel Echo
- **Bundler:** Vite

## ⚙️ Installation & Setup

Follow these steps to set up the project locally:

1.  **Clone the repository**
    ```bash
    git clone https://github.com/yourusername/khalid-blog.git
    cd khalid-blog
    ```

2.  **Install PHP Dependencies**
    ```bash
    composer install
    ```

3.  **Install Node.js Dependencies**
    ```bash
    npm install
    ```

4.  **Environment Configuration**
    Copy the example env file and configure your database settings:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5.  **Database Migration & Seeding**
    Create the database structure and insert default data:
    ```bash
    php artisan migrate --seed
    ```

6.  **Run the Application**
    You need two terminals running:
    
    *Terminal 1 (Vite for assets):*
    ```bash
    npm run dev
    ```
    
    *Terminal 2 (Laravel Server):*
    ```bash
    php artisan serve
    ```

7.  **Access the App**
    Open your browser and visit: `http://localhost:8000`

## 🤝 Contributing

Contributions are welcome! If you have suggestions or improvements, please fork the repository and submit a pull request.

1.  Fork the Project
2.  Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3.  Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4.  Push to the Branch (`git push origin feature/AmazingFeature`)
5.  Open a Pull Request

## 📄 License

Distributed under the MIT License. See `LICENSE` for more information.
