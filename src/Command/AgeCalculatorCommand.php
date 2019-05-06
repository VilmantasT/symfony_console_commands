<?php


namespace App\Command;


use App\UserAge\AgeManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Style\SymfonyStyle;


class AgeCalculatorCommand extends Command
{
    protected static $defaultName = 'app:age:calculator';

    private $ageManager;

    public function __construct(AgeManager $ageManager)
    {
        $this->ageManager = $ageManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Calculates age by given birthday')
            ->setHelp('This command calculates user age by given birthday. If option --adult setted writes if user
            adult');

        $this
            // configure an argument
            ->addArgument('birthday', InputArgument::REQUIRED, 'The birthday of the user.')
            // ...
        ;

        $this
            // ...
            ->addOption(
                'adult',
                null,
                InputOption::VALUE_NONE,
                'Is user adult or not?'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $birthday = $input->getArgument('birthday');
        $optionValue = $input->getOption('adult');
        $age = $this->ageManager->getUserAge($birthday);

        $io = new SymfonyStyle($input, $output);
        $io->newLine();

        $io->note('I am '. $age .' years old');

        $io->newLine();

        if ($optionValue !== false)
        {
            if ($this->ageManager->isUserAdult($age))
            {
                $io->success('Am I an adult ?  ----  YES !!');

            }else{

                $io->warning('Am I an adult ?  ----  NO !!!');


            }

            $io->newLine();
        }

    }
}
