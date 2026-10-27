<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testPasswordHashIsValid(): void
    {
        $password = '123456';

        $hashedPassword = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $this->assertTrue(
            password_verify(
                $password,
                $hashedPassword
            )
        );
    }

    public function testEmailIsValid(): void
    {
        $email = 'user@test.com';

        $this->assertTrue(
            filter_var(
                $email,
                FILTER_VALIDATE_EMAIL
            ) !== false
        );
    }
}