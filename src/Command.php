<?php

namespace AdamBrett\ShellWrapper;

use AdamBrett\ShellWrapper\Command\Argument;
use AdamBrett\ShellWrapper\Command\Collections\Arguments;
use AdamBrett\ShellWrapper\Command\CommandInterface;
use AdamBrett\ShellWrapper\Command\Flag;
use AdamBrett\ShellWrapper\Command\Param;
use AdamBrett\ShellWrapper\Command\Option;
use AdamBrett\ShellWrapper\Command\SubCommand;

use AdamBrett\ShellWrapper\Command\Collections\Arguments as ArgumentList;
use AdamBrett\ShellWrapper\Command\Collections\Flags as FlagList;
use AdamBrett\ShellWrapper\Command\Collections\Params as ParamList;
use AdamBrett\ShellWrapper\Command\Collections\Options as OptionsList;
use AdamBrett\ShellWrapper\Command\Collections\SubCommands as SubCommandList;

class Command extends Command\AbstractCommand
{
    protected $arguments;
    protected $flags;
    protected $params;
    protected $options;
    protected $subCommands;

    public function __construct($command)
    {
        parent::__construct($command);

        $this->arguments = new ArgumentList();
        $this->flags = new FlagList();
        $this->params = new ParamList();
        $this->options = new OptionsList();
        $this->subCommands = new SubCommandList();
    }

    public function __toString()
    {
        return sprintf(
            '%s%s%s%s%s%s',
            $this->command,
            $this->pad($this->subCommands),
            $this->pad($this->flags),
            $this->pad($this->arguments),
            $this->pad($this->params),
            $this->pad($this->options)
        );
    }

    public function addSubCommand(SubCommand $command)
    {
        $this->subCommands->addSubCommand($command);
    }

    public function addParam(Param $param)
    {
        $this->params->addParam($param);
    }

    public function addArgument(Argument $argument)
    {
        $this->arguments->addArgument($argument);
    }

    public function addFlag($name)
    {
        $this->flags->addFlag($name);
    }

    public function addOption($name)
    {
        $this->options->addOption($name);
    }

    private function pad($string)
    {
        $string = (string) $string;

        if (!empty($string)) {
            return " $string";
        }

        return $string;
    }

    public function __clone()
    {
        if ($this->command instanceof CommandInterface) {
            $this->command = clone $this->command;
        }

        $this->arguments = clone $this->arguments;
        $this->flags = clone $this->flags;
        $this->params = clone $this->params;
        $this->options = clone $this->options;
        $this->subCommands = clone $this->subCommands;
    }
}
