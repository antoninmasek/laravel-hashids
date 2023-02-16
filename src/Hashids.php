<?php

namespace AntoninMasek\Hashids;

use Hashids\HashidsInterface;

class Hashids implements HashidsInterface
{
    private ?string $salt = null;

    private ?string $alphabet = null;

    private ?int $min_length = null;

    public function salt(string $salt = null): static
    {
        $clone = clone $this;

        $clone->salt = $salt;

        return $clone;
    }

    public function alphabet(string $alphabet = null): static
    {
        $clone = clone $this;

        $clone->alphabet = $alphabet;

        return $clone;
    }

    public function minLength(int $minLength = null): static
    {
        $clone = clone $this;

        $clone->min_length = $minLength;

        return $clone;
    }

    /**
     * @param  string|array<int, string> $numbers
     */
    public function encode(...$numbers): string
    {
        return $this->getHashidsGenerator()
            ->encode(...$numbers);
    }

    /**
     * @param  string  $hash
     * @return array<int, string>
     */
    public function decode($hash): array
    {
        return $this->getHashidsGenerator()
            ->decode($hash);
    }

    /**
     * @param  string  $str
     */
    public function encodeHex($str): string
    {
        return $this->getHashidsGenerator()
            ->encodeHex($str);
    }

    /**
     * @param  string  $hash
     */
    public function decodeHex($hash): string
    {
        return $this->getHashidsGenerator()
            ->decodeHex($hash);
    }

    private function getHashidsGenerator(): \Hashids\Hashids
    {
        $parameters = array_filter([
            'salt' => $this->salt ?? config('hashids.salt'),
            'minHashLength' => $this->min_length ?? config('hashids.min_length'),
            'alphabet' => $this->alphabet ?? config('hashids.alphabet'),
        ]);

        return new \Hashids\Hashids(...$parameters);
    }
}
