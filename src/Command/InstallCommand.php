<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Process;

#[AsCommand(
    name: 'app:install',
    description: "Installations des dependences, migration et fixtures.",
)]
class InstallCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);


        // show logo project
        $io->text("
        ███████╗██╗  ██╗ ██████╗ ██████╗ ██████╗ ███████╗██████╗       ███████╗ ██████╗ ██╗   ██╗ █████╗ ██████╗ ███████╗
        ██╔════╝██║  ██║██╔═══██╗██╔══██╗██╔══██╗██╔════╝██╔══██╗      ██╔════╝██╔═══██╗██║   ██║██╔══██╗██╔══██╗██╔════╝
        ███████╗███████║██║   ██║██████╔╝██████╔╝█████╗  ██████╔╝█████╗███████╗██║   ██║██║   ██║███████║██████╔╝█████╗  
        ╚════██║██╔══██║██║   ██║██╔═══╝ ██╔═══╝ ██╔══╝  ██╔══██╗╚════╝╚════██║██║▄▄ ██║██║   ██║██╔══██║██╔══██╗██╔══╝  
        ███████║██║  ██║╚██████╔╝██║     ██║     ███████╗██║  ██║      ███████║╚██████╔╝╚██████╔╝██║  ██║██║  ██║███████╗
        ╚══════╝╚═╝  ╚═╝ ╚═════╝ ╚═╝     ╚═╝     ╚══════╝╚═╝  ╚═╝      ╚══════╝ ╚══▀▀═╝  ╚═════╝ ╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝                                                                                                               
        ");


        // install npm dependencies
        $io->info('Installation des dépendances npm...');
        $io->text('>> npm install');
        $process = new Process(['npm', 'install']);
        $process->run();


        // install composer dependencies
        $io->info('Installation des dépendances composer...');
        $io->text('>> composer install');
        $process = new Process(['composer', 'install']);
        $process->run();


        $io->success('Dependences installer.');


        // Create database
        $io->info('Creation de la base de donnée...');
        $doctrineCommand = $this->getApplication()->find('doctrine:database:create');
        $doctrineCommand->run($input, $output);


        // apply migrations
        $io->info('insallation des migrations...');
        $doctrineCommand = $this->getApplication()->find('doctrine:migrations:migrate');
        $migrationsInput = new ArrayInput([
            'command' => 'doctrine:migrations:migrate',
        ]);
        $migrationsInput->setInteractive(false);
        $doctrineCommand->run($migrationsInput, $output);


        // apply fixtures
        $io->info('insallation des fixtures...');
        $doctrineCommand = $this->getApplication()->find('doctrine:fixtures:load');
        $migrationsInput = new ArrayInput([
            'command' => 'doctrine:fixtures:load',
        ]);
        $migrationsInput->setInteractive(false);
        $doctrineCommand->run($migrationsInput, $output);




        $io->success("Installation terminée.");
        return Command::SUCCESS;
    }
}
