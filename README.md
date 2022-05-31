# Magento 2 Event Observer Lister

This Magento 2 module generates a list of event observers for your custom magento 2 setup which is likely have some 3rd party modules with their custom observers.

## Installation
- `composer require alitopaloglu/magento2-event-observer-lister`
- `bin/magento module:enable AliTopaloglu_EventObserverLister`
- `bin/magento setup:upgrade`
- `bin/magento setup:di:compile`

## Compatibility
The module is tested on Magento version 2.4.x

Feel free to fork this project or make a pull request.

## Ideas, bugs or suggestions?
Please create an [issue](https://github.com/alitopaloglu/magento2-event-observer-lister/issues) or a [pull request](https://github.com/alitopaloglu/magento2-event-observer-lister/pulls).

## License
[MIT](LICENSE)
