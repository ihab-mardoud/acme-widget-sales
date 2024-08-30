# Acme Widget Co Sales System

This project implements a proof of concept for Acme Widget Co's new sales system. It calculates the total cost of a basket of items, taking into account delivery charges and special offers.

## GitHub Repository

This project is hosted on GitHub. You can find the repository at:

https://github.com/ihab-mardoud/acme-widget-sales

Feel free to star the repository if you find it useful!

## Requirements

- PHP 8.1 or higher
- Composer
- Docker and Docker Compose (optional)

## Installation

1. Clone this repository:
   ```
   git clone https://github.com/ihab-mardoud/acme-widget-sales.git
   cd acme-widget-sales
   ```
2. Run `composer install` to install dependencies

## Usage

To create a new basket and calculate totals:

```php
$basket = BasketFactory::create();
$basket->add('R01');
$basket->add('G01');
echo $basket->total(); // Outputs the total cost
```

## Running Tests

Run `./vendor/bin/phpunit` to execute the test suite.

## Static Analysis with PHPStan

This project uses PHPStan for static code analysis. To run PHPStan:

```bash
./vendor/bin/phpstan analyse src tests
```

PHPStan is configured to run at level 8 (the highest level). You can adjust the level in the `phpstan.neon` file if needed.

To run PHPStan as part of your development workflow, you can add it to your pre-commit hook or run it before pushing changes.

## Docker

To run the application in a Docker container:

1. Build the image and start the container:
   ```
   docker-compose up -d --build
   ```

2. Execute commands inside the container:
   ```
   docker-compose exec app bash
   ```

3. Once inside the container, you can run tests, use the PHP interactive shell, or run PHPStan:
   ```
   vendor/bin/phpunit
   php -a
   vendor/bin/phpstan analyse src tests
   ```

4. To stop the container:
   ```
   docker-compose down
   ```

## Assumptions

1. Product codes are unique and case-sensitive.
2. Delivery charges are calculated based on the total after applying discounts.
3. The "buy one red widget, get the second half price" offer applies to pairs of red widgets, with no limit.
4. All prices and totals are in dollars and cents, with no currency conversion required.

## Architecture

The system uses the Strategy pattern for flexible application of delivery charge rules and special offers. The main components are:

- `Product`: Represents a product with code, name, and price.
- `Basket`: Holds items and calculates totals.
- `DeliveryChargeRule`: Interface for calculating delivery charges.
- `Offer`: Interface for applying special offers.
- `BasketFactory`: Creates a preconfigured `Basket` with the current catalogue, delivery rules, and offers.

This architecture allows for easy addition of new products, delivery charge rules, and special offers without modifying existing code.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open-sourced software licensed under the MIT license.