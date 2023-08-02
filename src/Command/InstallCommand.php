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
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

#[AsCommand(
    name: 'app:install',
    description: "Netoyage et installation des dependences, migration et fixtures.",
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


        $io->text("
        ███████╗██╗  ██╗ ██████╗ ██████╗ ██████╗ ███████╗██████╗       ███████╗ ██████╗ ██╗   ██╗ █████╗ ██████╗ ███████╗
        ██╔════╝██║  ██║██╔═══██╗██╔══██╗██╔══██╗██╔════╝██╔══██╗      ██╔════╝██╔═══██╗██║   ██║██╔══██╗██╔══██╗██╔════╝
        ███████╗███████║██║   ██║██████╔╝██████╔╝█████╗  ██████╔╝█████╗███████╗██║   ██║██║   ██║███████║██████╔╝█████╗  
        ╚════██║██╔══██║██║   ██║██╔═══╝ ██╔═══╝ ██╔══╝  ██╔══██╗╚════╝╚════██║██║▄▄ ██║██║   ██║██╔══██║██╔══██╗██╔══╝  
        ███████║██║  ██║╚██████╔╝██║     ██║     ███████╗██║  ██║      ███████║╚██████╔╝╚██████╔╝██║  ██║██║  ██║███████╗
        ╚══════╝╚═╝  ╚═╝ ╚═════╝ ╚═╝     ╚═╝     ╚══════╝╚═╝  ╚═╝      ╚══════╝ ╚══▀▀═╝  ╚═════╝ ╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝
                                                                                                                         
        ");
        // $arg1 = $input->getArgument('arg1');

        // if ($arg1) {
        //     $io->note(sprintf('You passed an argument: %s', $arg1));
        // }

        // if ($input->getOption('option1')) {
        //     // ...
        // }

        $filesystem = new Filesystem();

        // // Remove node_modules if it exists
        // if ($filesystem->exists('node_modules')) {
        //     $filesystem->remove(['node_modules'], true);
        //     $io->success('Supression du dossier node_modules.');
        // }


        // $io->success('Netoyage accompli.');

        // Install npm and composer dependencies

        $io->info('Installation des dépendances npm...');
        $io->text('>> npm install');
        $process = new Process(['npm', 'install']);
        $process->run();


        $io->info('Installation des dépendances composer...');
        $io->text('>> composer install');
        $process = new Process(['composer', 'install']);
        $process->run();


        $io->success('Dependences installer.');


        $io->info('Creation de la base de donnée...');
        $doctrineCommand = $this->getApplication()->find('doctrine:database:create');
        $doctrineCommand->run($input, $output);


        $io->info('insallation des migrations...');
        $doctrineCommand = $this->getApplication()->find('doctrine:migrations:migrate');
        $migrationsInput = new ArrayInput([
            'command' => 'doctrine:migrations:migrate',
        ]);
        $migrationsInput->setInteractive(false);
        $doctrineCommand->run($migrationsInput, $output);



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
