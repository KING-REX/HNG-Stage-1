# Number Classification API

## Overview

The **Number Classification API** is a simple RESTful service that classifies a given number based on its mathematical properties and provides a fun fact about the number.

## Features

-   Determines whether a number is **prime**.
-   Checks if the number is a **perfect number**.
-   Identifies if the number is an **Armstrong number**.
-   Classifies the number as **odd** or **even**.
-   Computes the **sum of its digits**.
-   Fetches a **fun fact** about the number from the Numbers API.

## API Details

### Base URL

-   Production: `https://inforet.free.nf/`

### Endpoint

**GET /api/classify-number**

**Query Parameter:**

-   `number` (integer, required) - The number to classify.

### **Example Request:**

```sh
GET <your-domain.com>/api/classify-number?number=371
```

### **Response Format**

#### **Success Response (200 OK)**

```json
{
    "number": 371,
    "is_prime": false,
    "is_perfect": false,
    "properties": ["armstrong", "odd"],
    "digit_sum": 11,
    "fun_fact": "371 is an Armstrong number because 3^3 + 7^3 + 1^3 = 371"
}
```

#### **Error Response (400 Bad Request)**

```json
{
    "number": "alphabet",
    "error": true
}
```

## Deployment

The API is publicly accessible at:

```
<your-deployment-url>
```

## Installation & Running Locally

### **Requirements:**

-   Python 3.x / Node.js / Java / Go / C# (Choose your preferred tech stack)
-   Dependencies installed via `pip/npm/maven` (depending on your chosen language)

### **Setup Instructions:**

1. **Clone the repository:**

    ```sh
    git clone https://github.com/<your-username>/number-classification-api.git
    cd number-classification-api
    ```

2. **Install dependencies:**

    ```sh
    composer install
    ```

3. **Set Up the Environment File:**

    ```sh
    copy .env.example .env
    php artisan key:generate
    ```

4. **Configure Environment Variables in `.env`:**

    ```sh
    APP_NAME="Example app name"
    APP_ENV=local
    APP_DEBUG=true
    APP_URL=http://example-localhost
    ```

5. **Start the Development Server:**

    ```sh
    php artisan serve
    ```

The API should now be running at `http://example-localhost`

## License

This project is licensed under the MIT License.

## Technology Stack

-   Laravel PHP Framework
-   [Backlink: HNG Hire PHP Developers](https://hng.tech/hire/php-developers)
