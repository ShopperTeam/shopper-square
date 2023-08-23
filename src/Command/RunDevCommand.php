<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Process;

#[AsCommand(
    name: 'app:run-dev',
    description: 'Start development tools: Symfony, npm dev-server, npm watch',
)]
class RunDevCommand extends Command
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
        $arg1 = $input->getArgument('arg1');


        $io->text("
        ███████╗██╗  ██╗ ██████╗ ██████╗ ██████╗ ███████╗██████╗       ███████╗ ██████╗ ██╗   ██╗ █████╗ ██████╗ ███████╗
        ██╔════╝██║  ██║██╔═══██╗██╔══██╗██╔══██╗██╔════╝██╔══██╗      ██╔════╝██╔═══██╗██║   ██║██╔══██╗██╔══██╗██╔════╝
        ███████╗███████║██║   ██║██████╔╝██████╔╝█████╗  ██████╔╝█████╗███████╗██║   ██║██║   ██║███████║██████╔╝█████╗  
        ╚════██║██╔══██║██║   ██║██╔═══╝ ██╔═══╝ ██╔══╝  ██╔══██╗╚════╝╚════██║██║▄▄ ██║██║   ██║██╔══██║██╔══██╗██╔══╝  
        ███████║██║  ██║╚██████╔╝██║     ██║     ███████╗██║  ██║      ███████║╚██████╔╝╚██████╔╝██║  ██║██║  ██║███████╗
        ╚══════╝╚═╝  ╚═╝ ╚═════╝ ╚═╝     ╚═╝     ╚══════╝╚═╝  ╚═╝      ╚══════╝ ╚══▀▀═╝  ╚═════╝ ╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝                                                                                                               
        ");


        $this->launchInNewTerminal('symfony server:start', 'Symfony Server');

        $this->launchInNewTerminal('npm run dev-server', 'npm dev-server');

        $this->launchInNewTerminal('npm run watch', 'npm watch');

        $io->success("Mode <DEV/> activé");

        return Command::SUCCESS;
    }

    private function launchInNewTerminal($command, $title)
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $process = new Process([
                'cmd.exe',
                '/C',
                'start',
                'cmd.exe',
                '/K',
                'title ' . $title . ' && ' . $command
            ]);
        } else {
            $process = new Process(['gnome-terminal', '--', 'bash', '-c', $command]);
        }

        $process->setTimeout(null);
        $process->start();
        return $process;
    }
}
