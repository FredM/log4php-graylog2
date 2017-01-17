<?php

require_once "LoggerLayoutGelfTest.php";

class LoggerLayoutGelfDockerTest extends LoggerLayoutGelfTest
{
    CONST POD_NAME = "my-pod";
    CONST ENV_NAME = "my-env";
    CONST APP_NAME = "test-app";

    public function testDockerErrorLayout() {
        parent::testErrorLayout();
        $message = "some-error-message";

        $event = LoggerTestHelper::getErrorEvent($message);

        $layout = new LoggerLayoutGelfDocker();
        $layout->setContainerPod(self::POD_NAME);
        $layout->setContainerEnv(self::ENV_NAME);
        $layout->setApplicationName(self::APP_NAME);

        $actual = $layout->format($event);
        $encodedMessage = json_decode($actual, 1);

        // Check specific fields fields
        $this->assertEquals(self::POD_NAME, $encodedMessage["_containerPod"]);
        $this->assertEquals(self::ENV_NAME, $encodedMessage["_containerEnv"]);
        $this->assertEquals(self::APP_NAME, $encodedMessage["_applicationName"]);
    }
}
