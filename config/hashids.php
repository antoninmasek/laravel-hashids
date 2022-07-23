<?php

return [
    /**
     * If you wish to globally redefine the default alphabet you may do so below. If set to
     * null, then the default value defined in the Hashids library is used.
     *
     * Please make sure your alphabet has at least 16 characters as that is the minimum
     * length of the alphabet the Hashids package requires.
     *
     * @see \Hashids\Hashids::__construct
     */
    'alphabet' => null,

    /**
     * If you wish to globally redefine the default salt you may do so below. If set to
     * null, then the default value defined in the Hashids library is used.
     *
     * @see \Hashids\Hashids::__construct
     */
    'salt' => null,

    /**
     * If you wish to globally redefine the default minimum length of the hash you may do so
     * below. If set to null, then the default value defined in the Hashids library is used.
     *
     * Please note, that this is minimum length and not exact length. This means, that if
     * you specify, for example, 5 the resulting hash id can have length of 5 characters
     * or more.
     *
     * @see \Hashids\Hashids::__construct
     */
    'min_length' => null,
];
