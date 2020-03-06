<?php

namespace Anagrams\Application\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Anagrams\Domain\Service\VerifyAnagramsService;
use Anagrams\Domain\Entity\Haystack;
use Anagrams\Domain\Entity\Needle;

/**
 * @codeCoverageIgnore
 */
class VerifyAnagramsCommand extends Command
{
    protected static $name = 'verify:anagrams';

    protected function configure()
    {
        $this
            ->setName(self::$name)
            ->setDescription('Verifies that a needle (or any of its anagrams) is contained in an haystack.')
            ->setDefinition(array(
                new InputArgument('haystack', InputArgument::REQUIRED, 'Haystack'),
                new InputArgument('needle', InputArgument::REQUIRED, 'Needle'),
            ))
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $haystack = new Haystack($input->getArgument('haystack'));
        $needle   = new Needle($input->getArgument('needle'));

        $service = new VerifyAnagramsService;

        try {
            $result = $service->containsAnagram($haystack, $needle);
        } catch (\InvalidArgumentException $e) {
            $result = 0;
        }

        $output->writeln($result > 0 ? 'true' : 'false');
        return 0;
    }
}
