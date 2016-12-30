<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ReupCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'reup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Redo db and seed.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {  
        $this->call('db:clear');

        $this->call('migrate');

        $this->call('db:seed');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array();
    }

}