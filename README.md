<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://fiverr-res.cloudinary.com/images/q_auto,f_auto/gigs/304739857/original/f59b6548f83bb11da90e811e659b4d354d57a71f/add-chatgpt-in-your-php-laravel-site.png" width="400" alt="Laravel Logo"></a></p>

## ChatGPT Clone

### Setup
- `composer install`
- `npm i`
- Set configuration in `.env` File:
    ```
    // OpenAI Key
    OPENAI_API_KEY="<OPENAI_SECRET_KEY>"
    ```
    
    ```
    // OPTIONAL CONFIGURATION For OAuth 2 Login(Login with Google) 
    GOOGLE_CLIENT_ID="<GOOGLE_CLIENT_ID>"
    GOOGLE_CLIENT_SECRET="<GOOGLE_CLIENT_SECRET>"
    GOOGLE_REDIRECT="${APP_URL}/google/callback"
    ```
    
- Run Migrations `php artisan migrate`
- Serve Project:
    - `php artisan serve`
    - `npm run dev`
- Hit `http://127.0.0.1:8000/`
- Enjoy :relieved:

## Support
<p><a href="https://www.buymeacoffee.com/monishkhatri"> <img align="left" src="https://cdn.buymeacoffee.com/buttons/v2/default-green.png" height="50" width="210" alt="monishkhatri" /></a></p><br><br>
