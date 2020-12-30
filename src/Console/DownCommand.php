<?php namespace Haruncpi\LaravelMaintenance\Console;

class DownCommand extends \Illuminate\Foundation\Console\DownCommand
{
    protected $signature = 'down {--message= : The message for the maintenance mode}
                                 {--retry= : The number of seconds after which the request may be retried}
                                 {--secret= : Set a secret to access site by secret route}
                                 {--allow=* : IP or networks allowed to access the application while in maintenance mode}';

    public function handle()
    {
        $secret = $this->option('secret');

        try {
            if (file_exists(storage_path('framework/down'))) {
                $this->comment('Application is already down.');
                return true;
            }

            $data = $this->getDownFilePayload();
            $cookieName = 'secret_cookie';
            $cookieValue = $secret;
            if ($secret) {
                $data[$cookieName] = $cookieValue;
            }

            file_put_contents(storage_path('framework/down'),
                json_encode($data, JSON_PRETTY_PRINT));

            $this->comment('Application is now in maintenance mode.');
        } catch (\Exception $e) {
            $this->error('Failed to enter maintenance mode.');
            $this->error($e->getMessage());
            return 1;
        }

    }


}
