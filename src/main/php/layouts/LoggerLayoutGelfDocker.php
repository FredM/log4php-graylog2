<?php

class LoggerLayoutGelfDocker extends LoggerLayoutGelf
{
    private $containerPod;
    private $containerEnv;
    private $applicationName;

    /**
     * @return mixed
     */
    public function getApplicationName()
    {
        return $this->applicationName;
    }

    /**
     * @param mixed $applicationName
     */
    public function setApplicationName($applicationName)
    {
        $this->applicationName = $applicationName;
    }

    /**
     * @return mixed
     */
    public function getContainerEnv()
    {
        return $this->containerEnv;
    }

    /**
     * @param mixed $containerEnv
     */
    public function setContainerEnv($containerEnv)
    {
        $this->containerEnv = $containerEnv;
    }

    /**
     * @return mixed
     */
    public function getContainerPod()
    {
        return $this->containerPod;
    }

    /**
     * @param mixed $containerPod
     */
    public function setContainerPod($containerPod)
    {
        $this->containerPod = $containerPod;
    }

    protected function getMessageAsArray(LoggerLoggingEvent $event)
    {
        $data = parent::getMessageAsArray($event);

        $data["_containerPod"] = $this->containerPod;
        $data["_containerEnv"] = $this->containerEnv;
        $data["_applicationName"] = $this->applicationName;

        return $data;
    }

    public function getHost()
    {
        return $this->containerEnv.".".$this->applicationName;
    }
}
