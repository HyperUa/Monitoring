<?php

namespace Monitoring\State;

/**
 * Check CPU working
 *
 * Class CPU
 * @package Monitoring\State
 */
class CPU extends StateAbstract
{
    const STATE_TYPE         = 'CPU';
    const CPU_PROCESS_NUMBER = 'max_cpu_process_number';
    protected $_default = array(
        self::CPU_PROCESS_NUMBER => 80
    );

    public function verifyError()
    {
        $load = sys_getloadavg();
        $CPUProcessNumber = $this->getMaxCPUProcessNumbers();

        if ($load[0] > $CPUProcessNumber ) {
            $this->getHandler()->addErrorHandle(
                "Current CPU process number is {$load[0]}, when allowed is {$CPUProcessNumber}",
                time(),
                $this->getStateType()
            );
        }
    }

    private function getMaxCPUProcessNumbers()
    {
        return $this->getParam( self::CPU_PROCESS_NUMBER );
    }
}