# :rocket: Deployment

## Using Cloudpanel on a VPS

[Cloudpanel](https://www.cloudpanel.io/) is a free and open-source control panel for managing your VPS. It is easy to install and provides a user-friendly interface for managing your server.

The steps are simple. 

1. You need to own a domain.
1. Provision a VPS and install **Cloudpanel**. Steps can be found here: [Cloudpanel Installation](https://www.cloudpanel.io/docs/v2/getting-started/)
1. Create a new **PHP site** in Cloudpanel and note down the site name. For example, `feedback.mywebsite.com`.
   ![image](https://github.com/user-attachments/assets/889cc98e-ed8a-466c-af7a-2d4ae64a4306)
1. Create a new **database** in Cloudpanel and note down the database name, username, and password.
1. Install **NodeJs**. Refer [docs](https://www.cloudpanel.io/docs/v2/php/guides/nodejs/)
1. SSH into your VPS and clone the repository into the site directory. Example `~/htdocs/feedback.mywebsite.com/`.
1. Run few scripts to set up the environment. 
   ```bash
   cd ~/htdocs/feedback.mywebsite.com/
   composer install
   npm install
   npm run build
   cp .env.example .env
   php artisan key:generate
   ```
1. Update your `.env` file with the database configuration *(Depending on how to setup the Cloudpanel in the first place, you may have choose the MariaDB or MySQL database. So update the `DB_CONNECTION` accordingly)*:
   ```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```
1. Run migrations to set up the database:
   ```bash
   php artisan migrate
   ```
1. If you want to enable Email, get an API key from [Resend](https://resend.com/api-keys) and set it in the `.env` file. 
    ```bash
    RESEND_KEY=your_api_key
    ```
1. If you choose to enable email. See the [Setup Supervisor](#setup-supervisor) section below to set up the email worker.
1. Go to your DNS registrar site and add the Server IP address as an **A record** for the domain. For example, `feedback.mywebsite.com`. (If using Cloudflare, uncheck the proxy option to avoid SSL issues.)
1. Configure SSL using Let's Encrypt
   - Go to the site in Cloudpanel and click on the SSL tab.
   - Select the domain and click Action > New Let's Encrypt Certificate.
   - Wait for the SSL certificate to be issued. (If failed, try again.)
    ![image](https://github.com/user-attachments/assets/558472ee-94c0-41fb-9aec-ad4d8047d348)
1. Visit your site at `https://feedback.mywebsite.com` and you should see the app running.
1. Update who can access the `/admin` panel. See: https://filamentphp.com/docs/3.x/panels/users#authorizing-access-to-the-panel

## Setup Supervisor

The Mailables are employs a `ShouldQueue` trait, which means they are queued and sent in the background. To do this, you need to set up a queue worker.

1. SSH into your VPS and install Supervisor. (To do this, the site user must have sudo access. [Add the user in sudoers group](https://askubuntu.com/a/380387))
   ```bash
   sudo apt-get install supervisor
   ```
1. Create a new configuration file for the queue worker.
   ```bash
   cd /etc/supervisor/conf.d
   sudo nano laravel-worker.conf
   ```
1. Add the following configuration to the file.
    ```conf
    [program:laravel-worker]
    process_name=%(program_name)s_%(process_num)02d
    command=php /home/mywebsite-feedback/htdocs/feedback.waktusolat.app/artisan queue:work database --sleep=3 --tries=3 --max-time=3600 --delay=1 --backoff=5
    autostart=true
    autorestart=true
    stopasgroup=true
    killasgroup=true
    user=mywebsite-feedback
    numprocs=1
    redirect_stderr=true
    stdout_logfile=/home/mywebsite-feedback/htdocs/feedback.waktusolat.app/storage/logs/worker.log
    stopwaitsecs=3600
    ```
1. Save the file and exit.
1. Update the Supervisor configuration.
   ```bash
   sudo supervisorctl reread
   sudo supervisorctl update
   sudo supervisorctl start laravel-worker:*
   ```
1. The worker should now be running and ready to process emails. If anything, check the logs in `storage/logs/worker.log` file.
1. If anything goes wrong, you consult the Laravel [documentation](https://laravel.com/docs/12.x/queues#supervisor-configuration).
