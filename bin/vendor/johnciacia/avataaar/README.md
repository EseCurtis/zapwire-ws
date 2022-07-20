# PHP Avataaar

PHP library for generating random avatars based on [avataaars](https://avataaars.com/).


<img src='https://avataaars.io/?avatarStyle=Circle&topType=ShortHairShortWaved&accessoriesType=Blank&hairColor=BrownDark&facialHairType=Blank&clotheType=Hoodie&clotheColor=Heather&eyeType=Default&eyebrowType=Default&mouthType=Smile&skinColor=Light' />


## Installation

### Dependencies
- PHP 8.0
- Composer 2.0


### Install
Install the library via composer

```
composer require johnciacia/avataaar
```

## Usage


### Basic Usage
```
$avataaar = new \Avataaar\Avataaar();

$avataaar->url();
```

### Faker

```
$faker = (new \Faker\Factory())::create();
$faker->addProvider(new \Avataaar\FakerProvider($faker));


echo $faker->avataaar;
```



### Laravel

When using Laravel, this package will be discovered automatically and added to the applications Faker instance. Just call `avataaar` on the Faker instance and a random image URL will be generated.

```
<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    protected $model = Person::class;

    public function definition()
    {

        return [
            'email' => $this->faker->email,
            'avatar_url' => $this->faker->avataaar,
            'bio' => $this->faker->sentence,
        ];
    }
}
```


## Credits

- https://github.com/gkoberger/avataaars
- https://github.com/fangpenlin/avataaars-generator
