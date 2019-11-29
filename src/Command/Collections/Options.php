<?php

namespace AdamBrett\ShellWrapper\Command\Collections;

use AdamBrett\ShellWrapper\Command\Option;

class Options
{
    protected $options = array();

    public function __toString()
    {
        return join(' ', $this->options);
    }

    public function addOption(Option $option)
    {
        $this->options[(string) $option] = $option;
    }

    public function __clone()
    {
        $clonedOptionsList = array();
        foreach ($this->options as $option) {
            $clonedOptionsList[] = clone $option;
        }

        $this->options = $clonedOptionsList;
    }
}
