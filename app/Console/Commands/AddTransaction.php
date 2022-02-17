<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Whoops\Exception\ErrorException;

class AddTransaction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:add {user : The email of the user} {--value= : Value of transaction} {description : Transaction description}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new transaction';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (!$this->hasOption('value')) {
            throw new \ErrorException('нужна опция value');
        }

        try {
            $userEmail = $this->argument('user');
            $description = $this->argument('description');
            $value = (float) $this->option('value');

            if ((round($value, 2) - $value) != 0) {
                throw new ErrorException('Копейки на части не делим');
            }

            \App\Jobs\AddTransaction::dispatch($userEmail, $description, $value);
        } catch (\Exception $e) {
            throw new \ErrorException($e->getMessage());
        }
    }
}
