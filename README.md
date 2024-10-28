# Model Attributes Validation for Laravel

This package enables model attribute validation in Laravel by defining validation rules through attributes on your Eloquent models. It leverages PHP's attributes feature to declare validation rules directly on the model class, facilitating attribute-driven validation.

## Installation

To install this package, use Composer:

```bash
composer require huubverbeek/laravel-model-attributes-validation
```

Once installed, Laravel will automatically register the service provider.

## Support

This project requires PHP version 8 or higher.

## Usage

1. **Define a Validation Rules Class**:
   Define a class that extends `ValidationRules`, specifying the rules for your model's attributes.

   ```php
   use HuubVerbeek\ModelAttributesValidation\ValidationRules;

   class UserValidationRules extends ValidationRules
   {
       public function rules(): array
       {
           /** @note The model being validated is accessible here. */
           $minimumLength = $this->model->getMinimumPasswordLength();
   
           return [
               'name' => ['required', 'string', 'max:255'],
               'email' => ['required', 'email', 'unique:users,email'],
               'password' => ['required',"min:$minimumLength"],
           ];
       }
   }
   ```

2. **Apply Validation to Your Model**:
   Add the `#[ValidationRules(UserValidationRules::class)]` attribute to your model to associate it with the validation rules class.

   ```php
   use Illuminate\Database\Eloquent\Model;
   use HuubVerbeek\ModelAttributesValidation\Attributes\ValidationRules;

   #[ValidationRules(UserValidationRules::class)]
   class User extends Model
   {
       // Model properties and methods
   }
   ```

3. **Saving and Validation**:
   When you attempt to save the model, the package will automatically validate the model's attributes according to the specified rules. If validation fails, a `ValidationException` will be thrown.

   ```php
   $user = User::make([
       'name' => 'John Doe',
       'email' => 'john@example.com',
       'password' => 'securepassword123',
   ]);

   try {
       $user->save(); // Triggers validation
   } catch (ValidationException $e) {
       // Handle validation failure
   }
   ```

## Exceptions

- **NotSubclassOfRulesException**: This exception is thrown if the specified rules class does not extend the `ValidationRules` abstract class.

## How It Works

- The `ModelAttributesValidationServiceProvider` listens for the model's `saving` event.
- Before saving a model, the service attempts to retrieve and validate the model attributes based on the validation rules class defined in the `#[ValidationRules(...)]` attribute.
- Validation rules are dynamically applied, and if they are not met, a `ValidationException` is thrown, halting the save operation.

## License

This package is open-source and licensed under the MIT License.