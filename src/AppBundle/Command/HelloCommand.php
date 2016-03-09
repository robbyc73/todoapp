<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 10/02/16
 * Time: 10:01 AM
 */
// File src/AppBundle/Command/HelloCommand.php
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelloCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('todo:hello')
            ->setDescription('this is simple, hello command')
            ->addArgument('name', null, 'What is your name?', 'World')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $output->writeln(sprintf('<info>Hello %s!</info>', $name));
    }
}