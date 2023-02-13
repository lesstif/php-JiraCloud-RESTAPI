<?php

namespace JiraCloud\Configuration;

/**
 * Interface ConfigurationInterface.
 */
interface ConfigurationInterface
{
    /**
     * Jira host.
     */
    public function getJiraHost(): string;

    /**
     * Jira login.
     */
    public function getJiraUser(): string;

    /**
     * Jira password.
     */
    public function getJiraPassword(): string;

    /**
     * Enabled write to log.
     */
    public function getJiraLogEnabled(): bool;

    /**
     * Path to log file.
     */
    public function getJiraLogFile(): string;

    /**
     * Log level (DEBUG, INFO, ERROR, WARNING).
     */
    public function getJiraLogLevel(): string;

    /**
     * Curl options CURLOPT_SSL_VERIFYHOST.
     */
    public function isCurlOptSslVerifyHost(): bool;

    /**
     * Curl options CURLOPT_SSL_VERIFYPEER.
     */
    public function isCurlOptSslVerifyPeer(): bool;

    public function isCurlOptSslCert(): ?string;

    public function isCurlOptSslCertPassword(): ?string;

    public function isCurlOptSslKey(): ?string;

    public function isCurlOptSslKeyPassword(): ?string;

    /**
     * Curl options CURLOPT_VERBOSE.
     */
    public function isCurlOptVerbose(): bool;

    /**
     * Get curl option CURLOPT_USERAGENT.
     */
    public function getCurlOptUserAgent(): ?string;

    /**
     * Get the actual value for Curl's CURLOPT_SSL_VERIFYHOST.
     */
    public function getCurlOptSslVerifyHostValue(): int;

    /**
     * HTTP header 'Authorization: Bearer {token}' for OAuth.
     */
    public function getOAuthAccessToken(): ?string;

    /**
     * Use cookie authorization. Login with username and password only once, then use session cookie.
     */
    public function isCookieAuthorizationEnabled(): bool;

    /**
     * get HTTP cookie file name.
     */
    public function getCookieFile(): mixed;

    /**
     * Proxy server.
     */
    public function getProxyServer(): ?string;

    /**
     * Proxy port.
     */
    public function getProxyPort(): ?string;

    /**
     * Proxy user.
     */
    public function getProxyUser(): ?string;

    /**
     * Proxy password.
     */
    public function getProxyPassword(): ?string;

    /**
     * The number of seconds to wait while trying to connect.
     */
    public function getTimeout(): int;

    /**
     * Personal Access Token.
     */
    public function getPersonalAccessToken(): string;
}
