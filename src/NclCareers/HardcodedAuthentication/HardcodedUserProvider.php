<?php

namespace NclCareers\HardcodedAuthentication;

use Illuminate\Auth\UserProviderInterface,
    Illuminate\Auth\UserInterface,
    Illuminate\Auth\GenericUser,
    Config;

class HardcodedUserProvider implements UserProviderInterface
{
	public function retrieveByID($id)
	{
		if ($id !== 1)
			return false;

		return $this->createUser();
	}

	public function retrieveByToken($identifier, $token)
	{
		return null;
	}

	public function updateRememberToken(UserInterface $user, $token)
	{
	}

	public function retrieveByCredentials(array $credentials)
	{
		if ($credentials['email'] !== $this->getUsername())
			return null;

		return $this->createUser();
	}

	public function validateCredentials(UserInterface $user, array $credentials)
	{
		return $this->isValidUser($credentials);
	}

	protected function getUsername()
	{
		$user = $this->fetchUser();
		return $user['username'];
	}

	protected function getPassword()
	{
		$user = $this->fetchUser();
		return $user['password'];
	}

	protected function fetchUser()
	{
		return Config::get('auth.hardcoded');
	}

	protected function createUser()
	{
		return new GenericUser(array(
			'id'       => 1,
			'username' => $this->getUsername()
		));
	}

	protected function isValidUser($user)
	{
		return $user['email'] === $this->getUsername()
		   and $user['password'] === $this->getPassword();
	}
}