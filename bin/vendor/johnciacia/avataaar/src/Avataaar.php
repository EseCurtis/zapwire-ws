<?php

namespace Avataaar;

/**
 *
 */
class Avataaar
{

    /**
     *
     */
    private static array $options = [
        'avatarStyle' => ['Transparent', 'Circle'],
        'topType' => [
            'NoHair', 'Eyepatch', 'Hat', 'Hijab', 'Turban', 'WinterHat1', 'WinterHat2', 'WinterHat3',
            'WinterHat4', 'LongHairBigHair', 'LongHairBob', 'LongHairBun', 'LongHairCurly', 'LongHairCurvy',
            'LongHairDreads', 'LongHairFrida', 'LongHairFro', 'LongHairFroBand', 'LongHairNotTooLong',
            'LongHairShavedSides', 'LongHairMiaWallace', 'LongHairStraight', 'LongHairStraight2',
            'LongHairStraightStrand', 'ShortHairDreads01', 'ShortHairDreads02', 'ShortHairFrizzle',
            'ShortHairShaggyMullet', 'ShortHairShortCurly', 'ShortHairShortFlat', 'ShortHairShortRound',
            'ShortHairShortWaved', 'ShortHairSides', 'ShortHairTheCaesar', 'ShortHairTheCaesarSidePart',
        ],
        'accessoriesType' => [
            'Blank', 'Kurt', 'Prescription01', 'Prescription02', 'Round', 'Sunglasses', 'Wayfarers'
        ],
        'facialHairType' => [
            'Blank', 'BeardMedium', 'BeardLight', 'BeardMajestic', 'MoustacheFancy', 'MoustacheMagnum'
        ],
        'facialHairColor' => [
            'Auburn', 'Black', 'Blonde', 'BlondeGolden', 'Brown', 'BrownDark', 'Platinum', 'Red'
        ],
        'clotheType' => [
            'BlazerShirt', 'BlazerSweater', 'CollarSweater', 'GraphicShirt', 'Hoodie', 'Overall', 'ShirtCrewNeck',
            'ShirtScoopNeck', 'ShirtVNeck'
        ],
        'eyeType' => [
            'Close', 'Cry', 'Default', 'Dizzy', 'EyeRoll', 'Happy', 'Hearts', 'Side', 'Squint', 'Surprised', 'Wink',
            'WinkWacky'
        ],
        'eyebrowType' => [
            'Angry', 'AngryNatural', 'Default', 'DefaultNatural', 'FlatNatural', 'RaisedExcited',
            'RaisedExcitedNatural', 'SadConcerned', 'SadConcernedNatural', 'UnibrowNatural', 'UpDown', 'UpDownNatural'
        ],
        'mouthType' => [
            'Concerned', 'Default', 'Disbelief', 'Eating', 'Grimace', 'Sad', 'ScreamOpen', 'Serious', 'Smile', 'Tongue',
            'Twinkle', 'Vomit',
        ],
        'skinColor' => [
            'Tanned', 'Yellow', 'Pale', 'Light', 'Brown', 'DarkBrown', 'Black'
        ],
    ];


    /**
     *
     */
    public function __construct($host = 'avataaars.io')
    {
        $this->host = $host;
    }

    /**
     *
     */
    public function url()
    {
        return sprintf("https://%s?%s", $this->host, $this->query());
    }

    /**
     *
     */
    public function query()
    {
        $query = [];
        foreach (self::$options as $option => $options) {
            $query[$option] = $options[array_rand($options)];
        }

        return http_build_query($query);
    }
}
