## Usage

In this section we'll show how you can make use of the available traits.

### EventTrait

The EventTrait makes it easy to add dispatching abilities to your classes.

```php
use Cartalyst\Support\Traits\EventTrait;

class FooRepository {

	use EventTrait;

	public function foo()
	{
		$this->fireEvent('foo');
	}

}
```

### RepositoryTrait

The RepositoryTrait makes it easy to create new instances of a model and to retrieve or override the model during runtime.

```php
use Cartalyst\Support\Traits\RepositoryTrait;

class FooRepository {

	use RepositoryTrait;

	public function foo()
	{
		return $this->createModel();
	}

}
```
