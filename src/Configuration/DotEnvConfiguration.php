<?php

namespace JiraCloud\Configuration;

use JiraCloud\JiraException;

/**
 * Class DotEnvConfiguration.
 */
class DotEnvConfiguration extends AbstractConfiguration
{
    /**
     * @param string $path
     *
     * @throws JiraException
     */
    public function __construct(string $path = '.')
    {
        $this->loadDotEnv($path);

        $this->jiraHost = $this->env('JIRAAPI_V3_HOST');
        $this->jiraUser = $this->env('JIRAAPI_V3_USER');

        $this->oauthAccessToken = $this->env('JIRAAPI_V3_OAUTH_ACCESS_TOKEN');
        $this->cookieAuthEnabled = $this->env('JIRAAPI_V3_COOKIE_AUTH_ENABLED', false);
        $this->cookieFile = $this->env('JIRAAPI_V3_COOKIE_FILE', 'jira-cookie.txt');
        $this->jiraLogEnabled = $this->env('JIRAAPI_V3_LOG_ENABLED', true);
        $this->jiraLogFile = $this->env('JIRAAPI_V3_LOG_FILE', 'jira-rest-client.log');
        $this->jiraLogLevel = $this->env('JIRAAPI_V3_LOG_LEVEL', 'WARNING');
        $this->curlOptSslVerifyHost = $this->env('JIRAAPI_V3_CURLOPT_SSL_VERIFYHOST', false);
        $this->curlOptSslVerifyPeer = $this->env('JIRAAPI_V3_CURLOPT_SSL_VERIFYPEER', false);
        $this->curlOptSslCert = $this->env('JIRAAPI_V3_CURLOPT_SSL_CERT');
        $this->curlOptSslCertPassword = $this->env('JIRAAPI_V3_CURLOPT_SSL_CERT_PASSWORD');
        $this->curlOptSslKey = $this->env('JIRAAPI_V3_CURLOPT_SSL_KEY');
        $this->curlOptSslKeyPassword = $this->env('JIRAAPI_V3_CURLOPT_SSL_KEY_PASSWORD');
        $this->curlOptUserAgent = $this->env('JIRAAPI_V3_CURLOPT_USERAGENT', $this->getDefaultUserAgentString());
        $this->curlOptVerbose = $this->env('JIRAAPI_V3_CURLOPT_VERBOSE', false);
        $this->proxyServer = $this->env('JIRAAPI_V3_PROXY_SERVER');
        $this->proxyPort = $this->env('JIRAAPI_V3_PROXY_PORT');
        $this->proxyUser = $this->env('JIRAAPI_V3_PROXY_USER');
        $this->proxyPassword = $this->env('JIRAAPI_V3_PROXY_PASSWORD');

        $this->timeout = $this->env('JIRAAPI_V3_TIMEOUT', 30);

        $this->personalAccessToken = $this->env('JIRAAPI_V3_PERSONAL_ACCESS_TOKEN', false);
        $this->serviceDeskId = $this->env('JIRAAPI_V3_SERVICE_DESK_ID', null);
    }

    /**
     * Gets the value of an environment variable. Supports boolean, empty and null.
     */
    private function env(string $key, mixed $default = null): mixed
    {
        $value = $_ENV[$key] ?? null;

        if ($value === null) {
            return $default;
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;

            case 'false':
            case '(false)':
                return false;

            case 'empty':
            case '(empty)':
                return '';

            case 'null':
            case '(null)':
                return null;
        }

        if ($this->startsWith($value, '"') && $this->endsWith($value, '"')) {
            return substr($value, 1, -1);
        }

        return $value;
    }

    /**
     * Determine if a given string starts with a given substring.
     */
    public function startsWith(string $haystack, array|string $needles): bool
    {
        foreach ((array) $needles as $needle) {
            if ($needle != '' && strpos($haystack, $needle) === 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given string ends with a given substring.
     */
    public function endsWith(string $haystack, array|string $needles): bool
    {
        foreach ((array) $needles as $needle) {
            if ((string) $needle === substr($haystack, -strlen($needle))) {
                return true;
            }
        }

        return false;
    }

    /**
     * load dotenv.
     */
    private function loadDotEnv(string $path)
    {
        $requireParam = [
            'JIRAAPI_V3_HOST', 'JIRAAPI_V3_USER', 'JIRAAPI_V3_PERSONAL_ACCESS_TOKEN',
        ];

        // support for dotenv 1.x and 2.x. see also https://github.com/lesstif/php-jira-rest-client/issues/102
        //if (method_exists('\Dotenv\Dotenv', 'createImmutable')) {    // v4 or above
        $dotenv = \Dotenv\Dotenv::createImmutable($path);

        $dotenv->safeLoad();
        $dotenv->required($requireParam);
        //}
    }
}
