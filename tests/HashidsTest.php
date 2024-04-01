<?php

namespace AntoninMasek\Hashids\Tests;

use AntoninMasek\Hashids\Facades\Hashids;

class HashidsTest extends TestCase
{
    public function testItReturnsDefaultConfig()
    {
        $config = Hashids::getConfig();
        $expectedConfig = array_filter([
            'salt' => config('hashids.salt'),
            'minHashLength' => config('hashids.min_length'),
            'alphabet' => config('hashids.alphabet'),
        ]);

        $this->assertSame($expectedConfig, $config);
    }

    public function testItRespectsConfigAlphabet()
    {
        config()->set('hashids.alphabet', $alphabet = '1234567890qwertz');
        $config = Hashids::getConfig();

        $this->assertSame($alphabet, $config['alphabet']);
    }

    public function testItRespectsRuntimeAlphabet()
    {
        $config = Hashids::alphabet($alphabet = '1234567890qwertz')->getConfig();

        $this->assertSame($alphabet, $config['alphabet']);
    }

    public function testRuntimeAlphabetHasHigherPriority()
    {
        config()->set('hashids.alphabet', 'ABCDEFGHIJKLMNOP');
        $config = Hashids::alphabet($alphabet = '1234567890qwertz')->getConfig();

        $this->assertSame($alphabet, $config['alphabet']);
    }

    public function testItRespectsConfigSalt()
    {
        config()->set('hashids.salt', $salt = 'test');
        $config = Hashids::getConfig();

        $this->assertSame($salt, $config['salt']);
    }

    public function testItRespectsRuntimeSalt()
    {
        $config = Hashids::salt($salt = 'test')->getConfig();

        $this->assertSame($salt, $config['salt']);
    }

    public function testRuntimeSaltHasHigherPriority()
    {
        config()->set('hashids.salt', 'config-salt');
        $config = Hashids::salt($salt = 'runtime-salt')->getConfig();

        $this->assertSame($salt, $config['salt']);
    }

    public function testItRespectsConfigMinLength()
    {
        config()->set('hashids.min_length', $minLength = 10);
        $config = Hashids::getConfig();

        $this->assertSame($minLength, $config['minHashLength']);
    }

    public function testItRespectsRuntimeMinLength()
    {
        $config = Hashids::minLength($minLength = 10)->getConfig();

        $this->assertSame($minLength, $config['minHashLength']);
    }

    public function testRuntimeMinLengthHasHigherPriority()
    {
        config()->set('hashids.min_length', 8);
        $config = Hashids::minLength($minLength = 10)->getConfig();

        $this->assertSame($minLength, $config['minHashLength']);
    }

    public function testWorksWithDefaultConfig()
    {
        $value = 1;
        $config = Hashids::getConfig();

        $expectedOutput = (new \Hashids\Hashids(...$config))->encode($value);
        $output = Hashids::encode($value);

        $this->assertSame($expectedOutput, $output);

        $this->assertSame(
            [$value],
            Hashids::decode($output),
        );
    }

    public function testItCanEncodeNumber()
    {
        $value = 1;

        $this->assertSame(
            [$value],
            Hashids::decode(Hashids::encode($value)),
        );
    }

    public function testItCanEncodeArrayOfNumbers()
    {
        $value = [1, 2, 3];

        $this->assertSame(
            $value,
            Hashids::decode(Hashids::encode(...$value)),
        );
    }

    public function testItCanEncodeWithSalt()
    {
        $value = 1;
        $generator = Hashids::salt('test');

        $this->assertSame(
            [$value],
            $generator->decode($generator->encode($value)),
        );
    }

    public function testItCanEncodeWithMinLength()
    {
        $value = 1;
        $length = 5;
        $generator = Hashids::minLength($length);
        $encodedValue = $generator->encode($value);

        $this->assertSame(
            [$value],
            $generator->decode($encodedValue),
        );

        $this->assertTrue(strlen($encodedValue) >= $length);
    }

    public function testItCanEncodeWithAlphabet()
    {
        $value = 1;
        $alphabet = '1234567890qwertz';
        $generator = Hashids::alphabet($alphabet);
        $encodedValue = $generator->encode($value);

        $this->assertSame(
            [$value],
            $generator->decode($encodedValue),
        );

        $containsInvalidValue = collect(str_split($encodedValue))->contains(function ($char) use ($alphabet) {
            return ! str($alphabet)->contains($char);
        });

        $this->assertFalse($containsInvalidValue);
    }
}
