# TAR.AI - Multi-LLM Chat Interface

A modern, responsive AI chat application built with PHP and Tailwind CSS, featuring support for multiple Large Language Models (LLMs) including **Google Gemini** and **OpenAI**.

## 🚀 Features

- **Multi-Model Support**: Seamlessly switch between **Google Gemini** (Gemini 2.0 Flash) and **OpenAI** (GPT-3.5 Turbo) directly from the UI.
- **Modern UI/UX**:
  - Sleek dark mode design.
  - Fully responsive layout with a collapsible sidebar (on mobile).
  - Real-time typing indicators.
  - Auto-formatted code blocks with syntax highlighting support.
  - Built with **Tailwind CSS** for rapid and consistent styling.
- **Backend Architecture**:
  - Lightweight PHP implementation.
  - Service-based architecture for easy extension of new AI providers.
  - Secure environment variable management for API keys.

## 🛠️ Prerequisites

- **PHP 8.2** or higher.
- **Composer** (Dependency Manager for PHP).
- A valid **Google Gemini API Key**.
- A valid **OpenAI API Key**.

## 📦 Installation

1.  **Clone the repository** (or download the source code).

    ```bash
    git clone <repository-url>
    cd TAR.AI
    ```

2.  **Install Dependencies**:
    Run composer to install the required PHP libraries (OpenAI client, Gemini client, Dotenv).

    ```bash
    composer install
    ```

3.  **Environment Setup**:
    Create a `.env` file in the root directory (you can copy `.env.example` if available) and add your API keys:
    ```ini
    GEMINI_API_KEY=your_google_gemini_api_key_here
    OPENAI_API_KEY=your_openai_api_key_here
    ```
    > **Note**: Get your keys from [Google AI Studio](https://aistudio.google.com/) and [OpenAI Platform](https://platform.openai.com/).

## 🚦 How to Run

1.  Start the built-in PHP development server from the project root:

    ```bash
    php -S localhost:8000 index.php
    ```

2.  Open your browser and navigate to:
    [http://localhost:8000](http://localhost:8000)

## 📂 Project Structure

- **`index.php`**: The entry point and router for the application.
- **`views/`**: Contains the frontend HTML/PHP templates (`chat.php`).
- **`api/`**: Contains backend API endpoints (`chat.php`) handling AJAX requests.
- **`App/Services/`**:
  - `GeminiService.php`: Logic for interacting with Google's Gemini API.
  - `OpenAIService.php`: Logic for interacting with OpenAI's API.
- **`vendor/`**: Composer dependencies.

## 🤝 Contributing

Feel free to submit issues or pull requests to add more models (e.g., Anthropic Claude, Mistral) or improve the interface!
