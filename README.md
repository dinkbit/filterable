# Filterable Eloquent Models

[![Build Status](https://img.shields.io/travis/dinkbit/filterable.svg?style=flat-square)](https://travis-ci.org/dinkbit/filterable)

### Setup

```php

use Dinkbit\Filterable\FiterableTrait;

class Post extends Eloquent
{
    use FilterableTrait;

    /**
     * Enabled filterable scopes.
     *
     * @var string
     */
    protected $filterable = ['price', 'quantity'];

    public function scopePrice($query, $param)
    {
        return $query->where('price', $param);
    }

    public function scopeQuantity($query, $param)
    {
        return $query->where('item_quantity', $param);
    }
}
```

### Usage

```php
$posts = Post::filter(['quantity' => 10, 'price' => '100'])->get();
```
