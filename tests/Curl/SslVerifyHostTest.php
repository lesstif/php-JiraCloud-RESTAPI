<?php

namespace JiraCloud\Test\Curl;

use JiraCloud\Configuration\{
    AbstractConfiguration,
    ConfigurationInterface,
};
use PHPUnit\Framework\TestCase;

class SslVerifyHostTest extends TestCase
{
    /**
     * @dataProvider sslVerifyHostGetterDataSource
     */
    public function testSslVerifyHostGetter(bool $curlOptSslVerifyHost, int $expectedResult): void
    {
        $this->assertEquals(
            $expectedResult,
            $this->getTestedInstance($curlOptSslVerifyHost)->getCurlOptSslVerifyHostValue()
        );
    }

    public function sslVerifyHostGetterDataSource(): array
    {
        return [
            'turned off' => [
                'curlOptSslVerifyHost' => false,
                'expectedResult' => 0,
            ],
            'turned on' => [
                'curlOptSslVerifyHost' => true,
                'expectedResult' => 2,
            ],
        ];
    }

    /**
     * @dataProvider setterSanityDataSource
     */
    public function testSetterSanity(int $curlOptSslVerifyHostValue, bool $expectError): void
    {
        $errorTriggered = false;

        $noticeHandler = function (
            int $number,
            string $message,
            string $file,
            int $line
        ) use (&$errorTriggered): bool {
            $errorTriggered = true;

            return true;
        };

        set_error_handler($noticeHandler, E_NOTICE);

        // Note that the host isn't really important here.
        $curlResource = curl_init("https://localhost/");
        curl_setopt($curlResource, CURLOPT_SSL_VERIFYHOST, $curlOptSslVerifyHostValue);
        curl_close($curlResource);

        $this->assertEquals($expectError, $errorTriggered);

        restore_error_handler();
    }

    public function setterSanityDataSource(): array
    {
        return [
            'turned off' => [
                'curlOptSslVerifyHostValue' => 0,
                'expectError' => false,
            ],
            'turned on' => [
                'curlOptSslVerifyHostValue' => 2,
                'expectError' => false,
            ],
            'using old "on" value' => [
                'curlOptSslVerifyHostValue' => 1,
                'expectError' => true,
            ],
        ];
    }

    protected function getTestedInstance(bool $curlOptSslVerifyHost): ConfigurationInterface
    {
        return new class ($curlOptSslVerifyHost) extends AbstractConfiguration
        {
            public function __construct(bool $curlOptSslVerifyHost)
            {
                $this->curlOptSslVerifyHost = $curlOptSslVerifyHost;
            }
        };
    }
}