<?php

namespace JiraCloud\User;

use JiraCloud\Issue\Reporter;

/**
 * Class to perform all user related queries.
 *
 * @author Anik
 */
class UserService extends \JiraCloud\JiraClient
{
    private $uri = '/user';

    /**
     * Function to create a new user.
     *
     * @param array|User $user
     *
     *@throws \JsonMapper_Exception
     * @throws \JiraCloud\JiraException
     *
     * @return User User class
     */
    public function create(User|array $user): User
    {
        $data = json_encode($user);

        $this->log->info("Create User=\n".$data);

        $ret = $this->exec($this->uri, $data, 'POST');

        return $this->json_mapper->map(
            json_decode($ret),
            new User()
        );
    }

    /**
     * Function to get user.
     *
     * @param array $paramArray Possible values for $paramArray 'accountId', 'key'.
     *                          "Either the 'username' or the 'key' query parameters need to be provided".
     *
     *@throws \JsonMapper_Exception
     * @throws \JiraCloud\JiraException
     *
     * @return User User class
     */
    public function get(array $paramArray): User
    {
        $queryParam = '?'.http_build_query($paramArray);

        $ret = $this->exec($this->uri.$queryParam, null);

        $this->log->info("Result=\n".$ret);

        return $this->json_mapper->map(
            json_decode($ret),
            new User()
        );
    }

    /**
     * Returns a list of users that match the search string and/or property.
     *
     * @param array $paramArray
     *
     *@throws \JsonMapper_Exception
     * @throws \JiraCloud\JiraException
     *
     * @return User[]
     */
    public function findUsers(array $paramArray): array
    {
        $queryParam = '?'.http_build_query($paramArray);

        $ret = $this->exec($this->uri.'/search'.$queryParam, null);

        $this->log->info("Result=\n".$ret);

        $userData = json_decode($ret);
        $users = [];

        foreach ($userData as $user) {
            $users[] = $this->json_mapper->map(
                $user,
                new User()
            );
        }

        return $users;
    }

    /**
     * Returns a list of users that match the search string.
     * Please note that this resource should be called with an issue key when a list of assignable users is retrieved for editing.
     *
     * @param array $paramArray
     *
     * @throws \JsonMapper_Exception
     * @throws \JiraCloud\JiraException
     *
     * @return User[]
     *
     * @see https://docs.atlassian.com/jira/REST/cloud/#api/2/user-findAssignableUsers
     */
    public function findAssignableUsers(array $paramArray): array
    {
        $queryParam = '?'.http_build_query($paramArray);

        $ret = $this->exec($this->uri.'/assignable/search'.$queryParam, null);

        $this->log->info("Result=\n".$ret);

        $userData = json_decode($ret);
        $users = [];

        foreach ($userData as $user) {
            $users[] = $this->json_mapper->map(
                $user,
                new User()
            );
        }

        return $users;
    }

    /**
     * Returns a list of users that match with a specific query.
     *
     * @param array $paramArray
     *
     * @throws \JsonMapper_Exception
     * @throws \JiraCloud\JiraException
     *
     * @return User[]
     *
     * @see https://developer.atlassian.com/cloud/jira/platform/rest/v2/#api-rest-api-2-user-search-query-get
     */
    public function findUsersByQuery(array $paramArray): array
    {
        $queryParam = '?'.http_build_query($paramArray);

        $ret = $this->exec($this->uri.'/search/query'.$queryParam, null);

        $this->log->info("Result=\n".$ret);

        $userData = json_decode($ret);
        $users = [];

        foreach ($userData->values as $user) {
            $users[] = $this->json_mapper->map(
                $user,
                new User()
            );
        }

        return $users;
    }

    /**
     * Delete a User.
     *
     * @param array $paramArray username or keys
     *
     * @throws \JiraCloud\JiraException
     *
     * @return string
     */
    public function deleteUser(array $paramArray): string
    {
        $queryParam = '?'.http_build_query($paramArray);

        $ret = $this->exec($this->uri.$queryParam, null, 'DELETE');

        return $ret;
    }

    /**
     * get a user info details.
     *
     * @throws \JiraCloud\JiraException
     *
     * @return Reporter user Object
     */
    public function getMyself()
    {
        $ret = $this->exec('myself', null);

        $user = $this->json_mapper->map(
            json_decode($ret),
            new Reporter()
        );

        return $user;
    }

    /**
     * @param array $paramArray
     *
     *@throws \JsonMapper_Exception
     * @throws \JiraCloud\JiraException
     *
     * @return User[]
     */
    public function getUsers(array $paramArray): array
    {
        $queryParam = '?'.http_build_query($paramArray);

        $ret = $this->exec('/users'.$queryParam, null);

        $this->log->info("Result=\n".$ret);

        $userData = json_decode($ret);
        $users = [];

        foreach ($userData as $user) {
            $users[] = $this->json_mapper->map($user, new User());
        }

        return $users;
    }

    /**
     * Function to update an existing user.
     *
     * @param array      $paramArray
     * @param array|User $user
     *
     *@throws \JsonMapper_Exception
     * @throws \JiraCloud\JiraException
     *
     * @return User User class
     */
    public function update(array $paramArray, User|array $user): User
    {
        $queryParam = '?'.http_build_query($paramArray);

        $data = json_encode($user);

        $this->log->info('Update User ('.$queryParam.") =\n".$data);

        $ret = $this->exec($this->uri.$queryParam, $data, 'PUT');

        return $this->json_mapper->map(
            json_decode($ret),
            new User()
        );
    }
}
