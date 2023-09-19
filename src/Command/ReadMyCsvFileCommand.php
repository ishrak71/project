<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use App\Service\CsvReader;
use App\Service\CalculatePercentage;

#[AsCommand(
    name: 'app:readMyCsvFile',
    description: 'Read my CSV file',
    hidden:false,
    aliases: ['app:read-file']
)]
class ReadMyCsvFileCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('filename', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        //Name of the file which will be read
        $filename = $input->getArgument('filename');
        
        //New Instance of the 
        $csvReader = new CsvReader($filename);
        
        //Saving the return value of the CsvReader method
        $data = $csvReader->readCSV();


        //Locating the infomation inside the array $data
        $totalAmount = $data[1][3];
        $cuurencyOutput = $data[1][2];
        $amountToConvert = $data[1][0];

        //Determine the Value which will be used to calculate the profit
        $percentageToCalculate = $cuurencyOutput == 'AUD' ?  $totalAmount : $amountToConvert;

        //Final value which will be used to calculate the percentage
        $finalProfit =  calculatePercentage::calculate15Percent($percentageToCalculate);

        echo "15% profit in the transaction is: $finalProfit AUD";

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
